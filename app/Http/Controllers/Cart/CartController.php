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

/**
 * @group Cart Management
 *
 * APIs for managing shopping cart
 */
class CartController extends Controller
{
    public function __construct(
        protected CartService $cartService
    ) {}

    /**
     * Get or generate session ID for guest users
     */
    private function getSessionId(Request $request): ?string
    {
        // For authenticated users, return null (will use user_id instead)
        if (auth('sanctum')->check()) {
            return null;
        }

        // For guests, get session ID from header or cookie
        $sessionId = $request->header('X-Cart-Session-ID') ?? $request->cookie('cart_session_id');

        // Generate new session ID if not exists
        if (! $sessionId) {
            $sessionId = Str::uuid()->toString();
        }

        return $sessionId;
    }

    /**
     * Add Item to Cart
     *
     * Add a product to the shopping cart. Works for both authenticated and guest users.
     *
     * @bodyParam product_id integer required The product ID. Example: 1
     * @bodyParam variant_id integer optional The variant ID if applicable. Example: 2
     * @bodyParam quantity integer required Quantity to add (1-99). Example: 2
     *
     * @response 201 {
     *   "message": "Item added to cart",
     *   "data": {
     *     "id": 1,
     *     "product_id": 1,
     *     "variant_id": 2,
     *     "quantity": 2,
     *     "product": {
     *       "id": 1,
     *       "name": "Product Name",
     *       "price": 29.99
     *     }
     *   }
     * }
     */
    public function store(AddToCartRequest $request): JsonResponse
    {
        $userId = auth('sanctum')->id();
        $sessionId = $this->getSessionId($request);

        // Add logging
        \Log::info('Cart Store Debug', [
            'user_id' => $userId,
            'session_id' => $sessionId,
            'header_session' => $request->header('X-Cart-Session-ID'),
            'cookie_session' => $request->cookie('cart_session_id'),
        ]);

        $cartItem = $this->cartService->addToCart(
            $userId,
            $sessionId,
            $request->validated()
        );

        $response = response()->json([
            'message' => 'Item added to cart',
            'data' => $cartItem,
        ], 201);

        // Set cookie for guest users
        if (! auth('sanctum')->check() && $sessionId) {
            \Log::info('Setting cart cookie', ['session_id' => $sessionId]);
            $response->cookie('cart_session_id', $sessionId, 60 * 24 * 30);
        }

        return $response;
    }

    /**
     * Get Cart
     *
     * Retrieve all items in the user's cart.
     *
     * @response {
     *   "data": {
     *     "items": [],
     *     "count": 3,
     *     "totals": {
     *       "subtotal": 89.97,
     *       "tax": 7.20,
     *       "shipping": 10.00,
     *       "total": 107.17
     *     }
     *   }
     * }
     */
    public function index(Request $request): JsonResponse
    {
        $userId = auth('sanctum')->id();
        $sessionId = $this->getSessionId($request);

        \Log::info('Cart Index Debug', [
            'user_id' => $userId,
            'session_id' => $sessionId,
            'header_session' => $request->header('X-Cart-Session-ID'),
            'cookie_session' => $request->cookie('cart_session_id'),
        ]);

        $items = $this->cartService->getCart($userId, $sessionId);

        \Log::info('Cart Items Found', [
            'count' => $items->count(),
            'items' => $items->pluck('id')->toArray(),
        ]);
        $count = $this->cartService->getCartCount($userId, $sessionId);
        $totals = $this->cartService->calculateCartTotals($userId, $sessionId);

        $response = response()->json([
            'data' => [
                'items' => $items,
                'count' => $count,
                'totals' => $totals,
            ],
        ]);

        // Set cookie for guest users
        if (! auth('sanctum')->check() && $sessionId) {
            $response->cookie('cart_session_id', $sessionId, 60 * 24 * 30); // 30 days
        }

        return $response;
    }

    /**
     * Update Cart Item
     *
     * Update the quantity of an item in the cart.
     *
     * @urlParam cart integer required The cart item ID. Example: 1
     *
     * @bodyParam quantity integer required New quantity (1-99). Example: 3
     *
     * @response {
     *   "message": "Cart updated successfully",
     *   "data": {
     *     "id": 1,
     *     "quantity": 3
     *   }
     * }
     */
    public function update(UpdateCartItemRequest $request, Cart $cart): JsonResponse
    {
        $cartItem = $this->cartService->updateCartItem(
            $cart,
            $request->validated()['quantity']
        );

        return response()->json([
            'message' => 'Cart updated successfully',
            'data' => $cartItem,
        ]);
    }

    /**
     * Remove Item from Cart
     *
     * Remove an item from the shopping cart.
     *
     * @urlParam cart integer required The cart item ID. Example: 1
     *
     * @response {
     *   "message": "Item removed from cart"
     * }
     */
    public function destroy(Cart $cart): JsonResponse
    {
        $this->cartService->removeFromCart($cart);

        return response()->json([
            'message' => 'Item removed from cart',
        ]);
    }

    /**
     * Clear Cart
     *
     * Remove all items from the cart.
     *
     * @response {
     *   "message": "Cart cleared successfully"
     * }
     */
    public function clear(Request $request): JsonResponse
    {
        $userId = auth('sanctum')->id();
        $sessionId = $this->getSessionId($request);

        $this->cartService->clearCart($userId, $sessionId);

        return response()->json([
            'message' => 'Cart cleared successfully',
        ]);
    }

    /**
     * Get Cart Count
     *
     * Get the number of items in cart (for badge display).
     *
     * @response {
     *   "data": {
     *     "count": 5
     *   }
     * }
     */
    public function count(Request $request): JsonResponse
    {
        $userId = auth('sanctum')->id();
        $sessionId = $this->getSessionId($request);

        $count = $this->cartService->getCartCount($userId, $sessionId);

        return response()->json([
            'data' => [
                'count' => $count,
            ],
        ]);
    }
}
