<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\AddToCartRequest;
use App\Http\Requests\Cart\UpdateCartItemRequest;
use App\Models\Cart;
use App\Services\CartService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CartController extends Controller
{
    public function __construct(
        protected CartService $cartService
    ) {}

    // ── Helpers ───────────────────────────────────────────────────────────────

    private function getSessionId(Request $request): ?string
    {
        if (auth('sanctum')->check()) {
            return null;
        }

        $sessionId = $request->header('X-Cart-Session-ID')
            ?? $request->cookie('cart_session_id');

        return $sessionId ?? Str::uuid()->toString();
    }

    // ── Endpoints ─────────────────────────────────────────────────────────────

    public function store(AddToCartRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $userId    = auth('sanctum')->id();
        $sessionId = $this->getSessionId($request);

        $cart = $this->cartService->addToCart($userId, $sessionId, $validated);

        return response()->json([
            'message' => 'Item added to cart',
            'data'    => $cart,
        ], 201);
    }

    public function index(Request $request): JsonResponse
    {
        $userId    = auth('sanctum')->id();
        $sessionId = $this->getSessionId($request);

        $items  = $this->cartService->getCart($userId, $sessionId);
        $count  = $this->cartService->getCartCount($userId, $sessionId);
        $totals = $this->cartService->calculateCartTotals($userId, $sessionId);

        $response = response()->json([
            'data' => compact('items', 'count', 'totals'),
        ]);

        if (! auth('sanctum')->check() && $sessionId) {
            $response->cookie('cart_session_id', $sessionId, 60 * 24 * 30);
        }

        return $response;
    }

    public function update(UpdateCartItemRequest $request, Cart $cart): JsonResponse
    {
        $cartItem = $this->cartService->updateCartItem(
            $cart,
            $request->validated()['quantity']
        );

        return response()->json([
            'message' => 'Cart updated successfully',
            'data'    => $cartItem,
        ]);
    }

    public function destroy(Cart $cart): JsonResponse
    {
        $this->cartService->removeFromCart($cart);

        return response()->json(['message' => 'Item removed from cart']);
    }

    public function clear(Request $request): JsonResponse
    {
        $userId    = auth('sanctum')->id();
        $sessionId = $this->getSessionId($request);

        $this->cartService->clearCart($userId, $sessionId);

        return response()->json(['message' => 'Cart cleared successfully']);
    }

    public function count(Request $request): JsonResponse
    {
        $userId    = auth('sanctum')->id();
        $sessionId = $this->getSessionId($request);

        $count = $this->cartService->getCartCount($userId, $sessionId);

        return response()->json(['data' => ['count' => $count]]);
    }
}