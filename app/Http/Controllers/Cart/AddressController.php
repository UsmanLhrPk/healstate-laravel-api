<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\StoreAddressRequest;
use App\Http\Requests\Cart\UpdateAddressRequest;
use App\Models\Address;
use App\Services\AddressService;
use Illuminate\Http\JsonResponse;

/**
 * @group Address Management
 * 
 * APIs for managing user addresses
 */
class AddressController extends Controller
{
    public function __construct(
        protected AddressService $addressService
    ) {}

    /**
     * Create Address
     * 
     * Add a new address for the authenticated user.
     * 
     * @authenticated
     * 
     * @bodyParam name string required Recipient name. Example: John Doe
     * @bodyParam phone string required Phone number. Example: 1234567890
     * @bodyParam email string required Email address. Example: john@example.com
     * @bodyParam street_address string required Street address. Example: 123 Main St
     * @bodyParam city string required City. Example: New York
     * @bodyParam state_province string required State/Province. Example: NY
     * @bodyParam postal_code string required Postal code. Example: 10001
     * @bodyParam country string optional Country code. Example: US
     * @bodyParam is_default boolean optional Set as default address. Example: true
     * 
     * @response 201 {
     *   "message": "Address created successfully",
     *   "data": {
     *     "id": 1,
     *     "name": "John Doe",
     *     "is_default": true
     *   }
     * }
     */
    public function store(StoreAddressRequest $request): JsonResponse
    {
        $address = $this->addressService->createAddress(
            auth()->id(),
            $request->validated()
        );

        return response()->json([
            'message' => 'Address created successfully',
            'data' => $address,
        ], 201);
    }

    /**
     * Get User Addresses
     * 
     * Retrieve all addresses for the authenticated user.
     * 
     * @authenticated
     * 
     * @response {
     *   "data": [
     *     {
     *       "id": 1,
     *       "name": "John Doe",
     *       "street_address": "123 Main St",
     *       "city": "New York",
     *       "is_default": true
     *     }
     *   ]
     * }
     */
    public function index(): JsonResponse
    {
        $addresses = $this->addressService->getUserAddresses(auth()->id());

        return response()->json([
            'data' => $addresses,
        ]);
    }

    /**
     * Update Address
     * 
     * Update an existing address.
     * 
     * @authenticated
     * 
     * @urlParam address integer required The address ID. Example: 1
     * 
     * @response {
     *   "message": "Address updated successfully",
     *   "data": {
     *     "id": 1,
     *     "name": "John Doe",
     *     "updated_at": "2024-01-02T00:00:00.000000Z"
     *   }
     * }
     */
    public function update(UpdateAddressRequest $request, Address $address): JsonResponse
    {
        $address = $this->addressService->updateAddress(
            $address,
            $request->validated()
        );

        return response()->json([
            'message' => 'Address updated successfully',
            'data' => $address,
        ]);
    }

    /**
     * Delete Address
     * 
     * Delete an address.
     * 
     * @authenticated
     * 
     * @urlParam address integer required The address ID. Example: 1
     * 
     * @response {
     *   "message": "Address deleted successfully"
     * }
     */
    public function destroy(Address $address): JsonResponse
    {
        $this->authorize('delete', $address);
        
        $this->addressService->deleteAddress($address);

        return response()->json([
            'message' => 'Address deleted successfully',
        ]);
    }

    /**
     * Set Default Address
     * 
     * Set an address as the default.
     * 
     * @authenticated
     * 
     * @urlParam address integer required The address ID. Example: 1
     * 
     * @response {
     *   "message": "Default address updated",
     *   "data": {
     *     "id": 1,
     *     "is_default": true
     *   }
     * }
     */
    public function setDefault(Address $address): JsonResponse
    {
        $this->authorize('update', $address);
        
        $address = $this->addressService->setDefaultAddress($address);

        return response()->json([
            'message' => 'Default address updated',
            'data' => $address,
        ]);
    }
}