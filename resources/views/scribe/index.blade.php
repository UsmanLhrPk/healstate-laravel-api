<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Laravel API Documentation</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.style.css") }}" media="screen">
    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.print.css") }}" media="print">

    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>

    <link rel="stylesheet"
          href="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/styles/obsidian.min.css">
    <script src="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/highlight.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jets/0.14.1/jets.min.js"></script>

    <style id="language-style">
        /* starts out as display none and is replaced with js later  */
                    body .content .bash-example code { display: none; }
                    body .content .javascript-example code { display: none; }
            </style>

    <script>
        var tryItOutBaseUrl = "http://localhost";
        var useCsrf = Boolean();
        var csrfUrl = "/sanctum/csrf-cookie";
    </script>
    <script src="{{ asset("/vendor/scribe/js/tryitout-5.6.0.js") }}"></script>

    <script src="{{ asset("/vendor/scribe/js/theme-default-5.6.0.js") }}"></script>

</head>

<body data-languages="[&quot;bash&quot;,&quot;javascript&quot;]">

<a href="#" id="nav-button">
    <span>
        MENU
        <img src="{{ asset("/vendor/scribe/images/navbar.png") }}" alt="navbar-image"/>
    </span>
</a>
<div class="tocify-wrapper">
    
            <div class="lang-selector">
                                            <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                            <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                    </div>
    
    <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>

    <div id="toc">
                    <ul id="tocify-header-introduction" class="tocify-header">
                <li class="tocify-item level-1" data-unique="introduction">
                    <a href="#introduction">Introduction</a>
                </li>
                            </ul>
                    <ul id="tocify-header-authenticating-requests" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authenticating-requests">
                    <a href="#authenticating-requests">Authenticating requests</a>
                </li>
                            </ul>
                    <ul id="tocify-header-address-management" class="tocify-header">
                <li class="tocify-item level-1" data-unique="address-management">
                    <a href="#address-management">Address Management</a>
                </li>
                                    <ul id="tocify-subheader-address-management" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="address-management-GETapi-addresses">
                                <a href="#address-management-GETapi-addresses">Get User Addresses</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="address-management-POSTapi-addresses">
                                <a href="#address-management-POSTapi-addresses">Create Address</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="address-management-PUTapi-addresses--address_id-">
                                <a href="#address-management-PUTapi-addresses--address_id-">Update Address</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="address-management-DELETEapi-addresses--address_id-">
                                <a href="#address-management-DELETEapi-addresses--address_id-">Delete Address</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="address-management-PATCHapi-addresses--address_id--default">
                                <a href="#address-management-PATCHapi-addresses--address_id--default">Set Default Address</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-cart-management" class="tocify-header">
                <li class="tocify-item level-1" data-unique="cart-management">
                    <a href="#cart-management">Cart Management</a>
                </li>
                                    <ul id="tocify-subheader-cart-management" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="cart-management-GETapi-cart">
                                <a href="#cart-management-GETapi-cart">Get Cart</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="cart-management-POSTapi-cart">
                                <a href="#cart-management-POSTapi-cart">Add Item to Cart</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="cart-management-PUTapi-cart--cart_id-">
                                <a href="#cart-management-PUTapi-cart--cart_id-">Update Cart Item</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="cart-management-DELETEapi-cart--cart_id-">
                                <a href="#cart-management-DELETEapi-cart--cart_id-">Remove Item from Cart</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="cart-management-DELETEapi-cart">
                                <a href="#cart-management-DELETEapi-cart">Clear Cart</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="cart-management-GETapi-cart-count">
                                <a href="#cart-management-GETapi-cart-count">Get Cart Count</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-checkout" class="tocify-header">
                <li class="tocify-item level-1" data-unique="checkout">
                    <a href="#checkout">Checkout</a>
                </li>
                                    <ul id="tocify-subheader-checkout" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="checkout-POSTapi-checkout-payment-intent">
                                <a href="#checkout-POSTapi-checkout-payment-intent">Create Payment Intent (supports multi-currency)</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="checkout-POSTapi-checkout-process">
                                <a href="#checkout-POSTapi-checkout-process">Process Checkout (supports multi-currency)</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="checkout-POSTapi-checkout-verify-payment">
                                <a href="#checkout-POSTapi-checkout-verify-payment">Verify Payment</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-comment-management" class="tocify-header">
                <li class="tocify-item level-1" data-unique="comment-management">
                    <a href="#comment-management">Comment Management</a>
                </li>
                                    <ul id="tocify-subheader-comment-management" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="comment-management-GETapi-comments">
                                <a href="#comment-management-GETapi-comments">Get comments</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="comment-management-POSTapi-comments">
                                <a href="#comment-management-POSTapi-comments">Create a comment</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="comment-management-DELETEapi-comments--id-">
                                <a href="#comment-management-DELETEapi-comments--id-">Delete a comment</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-endpoints" class="tocify-header">
                <li class="tocify-item level-1" data-unique="endpoints">
                    <a href="#endpoints">Endpoints</a>
                </li>
                                    <ul id="tocify-subheader-endpoints" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="endpoints-GETapi-vendor-orders">
                                <a href="#endpoints-GETapi-vendor-orders">Get all orders for vendor</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PATCHapi-vendor-orders--order_id--status">
                                <a href="#endpoints-PATCHapi-vendor-orders--order_id--status">Update order status</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-vendor-orders--order_id--cancel">
                                <a href="#endpoints-POSTapi-vendor-orders--order_id--cancel">Vendor cancels order</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-vendor-orders--order_id--approve-cancellation">
                                <a href="#endpoints-POSTapi-vendor-orders--order_id--approve-cancellation">Approve cancellation request</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-vendor-orders--order_id--deny-cancellation">
                                <a href="#endpoints-POSTapi-vendor-orders--order_id--deny-cancellation">Deny cancellation request</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-user">
                                <a href="#endpoints-GETapi-user">Get the authenticated user's data.</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-flag-management" class="tocify-header">
                <li class="tocify-item level-1" data-unique="flag-management">
                    <a href="#flag-management">Flag Management</a>
                </li>
                                    <ul id="tocify-subheader-flag-management" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="flag-management-POSTapi-flags">
                                <a href="#flag-management-POSTapi-flags">Flag content</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-forum-management" class="tocify-header">
                <li class="tocify-item level-1" data-unique="forum-management">
                    <a href="#forum-management">Forum Management</a>
                </li>
                                    <ul id="tocify-subheader-forum-management" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="forum-management-GETapi-forums">
                                <a href="#forum-management-GETapi-forums">List all forums</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="forum-management-GETapi-forums--id-">
                                <a href="#forum-management-GETapi-forums--id-">Get a single forum</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="forum-management-POSTapi-forums">
                                <a href="#forum-management-POSTapi-forums">Create a new forum</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="forum-management-DELETEapi-forums--id-">
                                <a href="#forum-management-DELETEapi-forums--id-">Delete a forum</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="forum-management-POSTapi-forums--id--view">
                                <a href="#forum-management-POSTapi-forums--id--view">Record a view for a forum</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-like-management" class="tocify-header">
                <li class="tocify-item level-1" data-unique="like-management">
                    <a href="#like-management">Like Management</a>
                </li>
                                    <ul id="tocify-subheader-like-management" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="like-management-POSTapi-likes">
                                <a href="#like-management-POSTapi-likes">Toggle like</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-marketplace" class="tocify-header">
                <li class="tocify-item level-1" data-unique="marketplace">
                    <a href="#marketplace">Marketplace</a>
                </li>
                                    <ul id="tocify-subheader-marketplace" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="marketplace-GETapi-marketplace">
                                <a href="#marketplace-GETapi-marketplace">Get Marketplace Products</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-order-management" class="tocify-header">
                <li class="tocify-item level-1" data-unique="order-management">
                    <a href="#order-management">Order Management</a>
                </li>
                                    <ul id="tocify-subheader-order-management" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="order-management-GETapi-orders">
                                <a href="#order-management-GETapi-orders">Get User Orders</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="order-management-GETapi-orders--order_id-">
                                <a href="#order-management-GETapi-orders--order_id-">Get Order Details</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="order-management-GETapi-orders--order_id--cancellation-status">
                                <a href="#order-management-GETapi-orders--order_id--cancellation-status">Check Cancellation Status</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="order-management-POSTapi-orders--order_id--cancel">
                                <a href="#order-management-POSTapi-orders--order_id--cancel">Cancel Order</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-practitioner-applications" class="tocify-header">
                <li class="tocify-item level-1" data-unique="practitioner-applications">
                    <a href="#practitioner-applications">Practitioner Applications</a>
                </li>
                                    <ul id="tocify-subheader-practitioner-applications" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="practitioner-applications-POSTapi-practitioners-applications">
                                <a href="#practitioner-applications-POSTapi-practitioners-applications">Submit Practitioner Application</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="practitioner-applications-GETapi-practitioners-applications-my-application">
                                <a href="#practitioner-applications-GETapi-practitioners-applications-my-application">Get My Application</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="practitioner-applications-GETapi-practitioners-applications-check-pending">
                                <a href="#practitioner-applications-GETapi-practitioners-applications-check-pending">Check Pending Application Status</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="practitioner-applications-GETapi-practitioners-applications--id-">
                                <a href="#practitioner-applications-GETapi-practitioners-applications--id-">Get Application Details</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="practitioner-applications-GETapi-admin-practitioners-applications">
                                <a href="#practitioner-applications-GETapi-admin-practitioners-applications">Get All Applications (Admin)</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="practitioner-applications-GETapi-admin-practitioners-applications-pending">
                                <a href="#practitioner-applications-GETapi-admin-practitioners-applications-pending">Get Pending Applications (Admin)</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="practitioner-applications-POSTapi-admin-practitioners-applications--id--review">
                                <a href="#practitioner-applications-POSTapi-admin-practitioners-applications--id--review">Review Application (Admin)</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-practitioner-profiles" class="tocify-header">
                <li class="tocify-item level-1" data-unique="practitioner-profiles">
                    <a href="#practitioner-profiles">Practitioner Profiles</a>
                </li>
                                    <ul id="tocify-subheader-practitioner-profiles" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="practitioner-profiles-GETapi-practitioners-profiles">
                                <a href="#practitioner-profiles-GETapi-practitioners-profiles">List All Practitioners</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="practitioner-profiles-GETapi-practitioners-profiles--id-">
                                <a href="#practitioner-profiles-GETapi-practitioners-profiles--id-">Get Practitioner Profile</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="practitioner-profiles-GETapi-practitioners-profiles-top-rated">
                                <a href="#practitioner-profiles-GETapi-practitioners-profiles-top-rated">Get Top Rated Practitioners</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="practitioner-profiles-GETapi-practitioners-profiles-category--categoryId-">
                                <a href="#practitioner-profiles-GETapi-practitioners-profiles-category--categoryId-">Get Practitioners by Category</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="practitioner-profiles-GETapi-practitioners-my-profile">
                                <a href="#practitioner-profiles-GETapi-practitioners-my-profile">Get My Practitioner Profile</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="practitioner-profiles-PUTapi-practitioners-profiles--id-">
                                <a href="#practitioner-profiles-PUTapi-practitioners-profiles--id-">Update Practitioner Profile</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="practitioner-profiles-POSTapi-practitioners-profiles--id--toggle-active">
                                <a href="#practitioner-profiles-POSTapi-practitioners-profiles--id--toggle-active">Toggle Profile Active Status</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-product-management" class="tocify-header">
                <li class="tocify-item level-1" data-unique="product-management">
                    <a href="#product-management">Product Management</a>
                </li>
                                    <ul id="tocify-subheader-product-management" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="product-management-GETapi-products--product_id-">
                                <a href="#product-management-GETapi-products--product_id-">Get Product Details</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="product-management-POSTapi-vendors--vendor_id--products">
                                <a href="#product-management-POSTapi-vendors--vendor_id--products">Create Product/Service</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="product-management-GETapi-vendors--vendor_id--products">
                                <a href="#product-management-GETapi-vendors--vendor_id--products">List Vendor Products</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="product-management-PUTapi-products--product_id-">
                                <a href="#product-management-PUTapi-products--product_id-">Update Product/Service</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="product-management-DELETEapi-products--product_id-">
                                <a href="#product-management-DELETEapi-products--product_id-">Delete Product/Service</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-product-variants" class="tocify-header">
                <li class="tocify-item level-1" data-unique="product-variants">
                    <a href="#product-variants">Product Variants</a>
                </li>
                                    <ul id="tocify-subheader-product-variants" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="product-variants-POSTapi-products--product_id--variants">
                                <a href="#product-variants-POSTapi-products--product_id--variants">Create Product Variant</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="product-variants-POSTapi-variants--variant_id-">
                                <a href="#product-variants-POSTapi-variants--variant_id-">Update Product Variant</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="product-variants-DELETEapi-variants--variant_id-">
                                <a href="#product-variants-DELETEapi-variants--variant_id-">Delete Product Variant</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-service-availability-management" class="tocify-header">
                <li class="tocify-item level-1" data-unique="service-availability-management">
                    <a href="#service-availability-management">Service Availability Management</a>
                </li>
                                    <ul id="tocify-subheader-service-availability-management" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="service-availability-management-POSTapi-slots--slot_id--schedule">
                                <a href="#service-availability-management-POSTapi-slots--slot_id--schedule">Store Availability Schedule</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="service-availability-management-GETapi-slots--slot_id--schedule">
                                <a href="#service-availability-management-GETapi-slots--slot_id--schedule">Get Availability Schedule</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="service-availability-management-DELETEapi-slots--slot_id--schedule">
                                <a href="#service-availability-management-DELETEapi-slots--slot_id--schedule">Delete Availability Schedule</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-service-bookings" class="tocify-header">
                <li class="tocify-item level-1" data-unique="service-bookings">
                    <a href="#service-bookings">Service Bookings</a>
                </li>
                                    <ul id="tocify-subheader-service-bookings" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="service-bookings-GETapi-slots--slot_id--availability">
                                <a href="#service-bookings-GETapi-slots--slot_id--availability">Check Slot Availability</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="service-bookings-POSTapi-bookings">
                                <a href="#service-bookings-POSTapi-bookings">Create Booking</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="service-bookings-GETapi-bookings">
                                <a href="#service-bookings-GETapi-bookings">List User Bookings</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="service-bookings-PATCHapi-bookings--booking_id--cancel">
                                <a href="#service-bookings-PATCHapi-bookings--booking_id--cancel">Cancel Booking</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-service-categories" class="tocify-header">
                <li class="tocify-item level-1" data-unique="service-categories">
                    <a href="#service-categories">Service Categories</a>
                </li>
                                    <ul id="tocify-subheader-service-categories" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="service-categories-GETapi-practitioners-categories">
                                <a href="#service-categories-GETapi-practitioners-categories">Get All Service Categories</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="service-categories-GETapi-practitioners-categories--id-">
                                <a href="#service-categories-GETapi-practitioners-categories--id-">Get Category by ID</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="service-categories-GETapi-practitioners-categories-slug--slug-">
                                <a href="#service-categories-GETapi-practitioners-categories-slug--slug-">Get Category by Slug</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="service-categories-GETapi-practitioners-categories--categoryId--subcategories">
                                <a href="#service-categories-GETapi-practitioners-categories--categoryId--subcategories">Get Category Subcategories</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-service-slots" class="tocify-header">
                <li class="tocify-item level-1" data-unique="service-slots">
                    <a href="#service-slots">Service Slots</a>
                </li>
                                    <ul id="tocify-subheader-service-slots" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="service-slots-POSTapi-products--product_id--slots">
                                <a href="#service-slots-POSTapi-products--product_id--slots">Create Service Slot</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="service-slots-PUTapi-slots--slot_id-">
                                <a href="#service-slots-PUTapi-slots--slot_id-">Update Service Slot</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="service-slots-DELETEapi-slots--slot_id-">
                                <a href="#service-slots-DELETEapi-slots--slot_id-">Delete Service Slot</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-vendor-management" class="tocify-header">
                <li class="tocify-item level-1" data-unique="vendor-management">
                    <a href="#vendor-management">Vendor Management</a>
                </li>
                                    <ul id="tocify-subheader-vendor-management" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="vendor-management-GETapi-vendors--vendor_id-">
                                <a href="#vendor-management-GETapi-vendors--vendor_id-">Get Vendor Details</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="vendor-management-POSTapi-vendors">
                                <a href="#vendor-management-POSTapi-vendors">Create Vendor</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="vendor-management-PUTapi-vendors--vendor_id-">
                                <a href="#vendor-management-PUTapi-vendors--vendor_id-">Update Vendor</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="vendor-management-PATCHapi-vendors--vendor_id--verify">
                                <a href="#vendor-management-PATCHapi-vendors--vendor_id--verify">Verify Vendor</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-vendor-reviews" class="tocify-header">
                <li class="tocify-item level-1" data-unique="vendor-reviews">
                    <a href="#vendor-reviews">Vendor Reviews</a>
                </li>
                                    <ul id="tocify-subheader-vendor-reviews" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="vendor-reviews-GETapi-vendors--vendor_id--reviews">
                                <a href="#vendor-reviews-GETapi-vendors--vendor_id--reviews">List Vendor Reviews</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="vendor-reviews-POSTapi-vendors--vendor_id--reviews">
                                <a href="#vendor-reviews-POSTapi-vendors--vendor_id--reviews">Add Review</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-webhooks" class="tocify-header">
                <li class="tocify-item level-1" data-unique="webhooks">
                    <a href="#webhooks">Webhooks</a>
                </li>
                                    <ul id="tocify-subheader-webhooks" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="webhooks-POSTapi-webhooks-stripe">
                                <a href="#webhooks-POSTapi-webhooks-stripe">Handle Stripe Webhook</a>
                            </li>
                                                                        </ul>
                            </ul>
            </div>

    <ul class="toc-footer" id="toc-footer">
                    <li style="padding-bottom: 5px;"><a href="{{ route("scribe.postman") }}">View Postman collection</a></li>
                            <li style="padding-bottom: 5px;"><a href="{{ route("scribe.openapi") }}">View OpenAPI spec</a></li>
                <li><a href="http://github.com/knuckleswtf/scribe">Documentation powered by Scribe ✍</a></li>
    </ul>

    <ul class="toc-footer" id="last-updated">
        <li>Last updated: February 8, 2026</li>
    </ul>
</div>

<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1 id="introduction">Introduction</h1>
<aside>
    <strong>Base URL</strong>: <code>http://localhost</code>
</aside>
<pre><code>This documentation aims to provide all the information you need to work with our API.

&lt;aside&gt;As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile).
You can switch the language used with the tabs at the top right (or from the nav menu at the top left on mobile).&lt;/aside&gt;</code></pre>

        <h1 id="authenticating-requests">Authenticating requests</h1>
<p>This API is not authenticated.</p>

        <h1 id="address-management">Address Management</h1>

    <p>APIs for managing user addresses</p>

                                <h2 id="address-management-GETapi-addresses">Get User Addresses</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retrieve all addresses for the authenticated user.</p>

<span id="example-requests-GETapi-addresses">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/addresses" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/addresses"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-addresses">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;John Doe&quot;,
            &quot;street_address&quot;: &quot;123 Main St&quot;,
            &quot;city&quot;: &quot;New York&quot;,
            &quot;is_default&quot;: true
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-addresses" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-addresses"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-addresses"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-addresses" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-addresses">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-addresses" data-method="GET"
      data-path="api/addresses"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-addresses', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-addresses"
                    onclick="tryItOut('GETapi-addresses');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-addresses"
                    onclick="cancelTryOut('GETapi-addresses');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-addresses"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/addresses</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-addresses"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-addresses"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="address-management-POSTapi-addresses">Create Address</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Add a new address for the authenticated user.</p>

<span id="example-requests-POSTapi-addresses">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/addresses" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"John Doe\",
    \"phone\": \"1234567890\",
    \"email\": \"john@example.com\",
    \"street_address\": \"123 Main St\",
    \"city\": \"New York\",
    \"state_province\": \"NY\",
    \"postal_code\": \"10001\",
    \"country\": \"US\",
    \"is_default\": true
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/addresses"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "John Doe",
    "phone": "1234567890",
    "email": "john@example.com",
    "street_address": "123 Main St",
    "city": "New York",
    "state_province": "NY",
    "postal_code": "10001",
    "country": "US",
    "is_default": true
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-addresses">
            <blockquote>
            <p>Example response (201):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Address created successfully&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;name&quot;: &quot;John Doe&quot;,
        &quot;is_default&quot;: true
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-addresses" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-addresses"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-addresses"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-addresses" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-addresses">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-addresses" data-method="POST"
      data-path="api/addresses"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-addresses', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-addresses"
                    onclick="tryItOut('POSTapi-addresses');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-addresses"
                    onclick="cancelTryOut('POSTapi-addresses');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-addresses"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/addresses</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-addresses"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-addresses"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-addresses"
               value="John Doe"
               data-component="body">
    <br>
<p>Recipient name. Example: <code>John Doe</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>phone</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="phone"                data-endpoint="POSTapi-addresses"
               value="1234567890"
               data-component="body">
    <br>
<p>Phone number. Example: <code>1234567890</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-addresses"
               value="john@example.com"
               data-component="body">
    <br>
<p>Email address. Example: <code>john@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>street_address</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="street_address"                data-endpoint="POSTapi-addresses"
               value="123 Main St"
               data-component="body">
    <br>
<p>Street address. Example: <code>123 Main St</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>city</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="city"                data-endpoint="POSTapi-addresses"
               value="New York"
               data-component="body">
    <br>
<p>City. Example: <code>New York</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>state_province</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="state_province"                data-endpoint="POSTapi-addresses"
               value="NY"
               data-component="body">
    <br>
<p>State/Province. Example: <code>NY</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>postal_code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="postal_code"                data-endpoint="POSTapi-addresses"
               value="10001"
               data-component="body">
    <br>
<p>Postal code. Example: <code>10001</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>country</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="country"                data-endpoint="POSTapi-addresses"
               value="US"
               data-component="body">
    <br>
<p>optional Country code. Example: <code>US</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>is_default</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="POSTapi-addresses" style="display: none">
            <input type="radio" name="is_default"
                   value="true"
                   data-endpoint="POSTapi-addresses"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-addresses" style="display: none">
            <input type="radio" name="is_default"
                   value="false"
                   data-endpoint="POSTapi-addresses"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>optional Set as default address. Example: <code>true</code></p>
        </div>
        </form>

                    <h2 id="address-management-PUTapi-addresses--address_id-">Update Address</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Update an existing address.</p>

<span id="example-requests-PUTapi-addresses--address_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/api/addresses/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"b\",
    \"phone\": \"ngzmiyvdljnikhwa\",
    \"email\": \"breitenberg.gilbert@example.com\",
    \"street_address\": \"u\",
    \"city\": \"w\",
    \"state_province\": \"p\",
    \"postal_code\": \"wlvqwrsitcpscqld\",
    \"country\": \"zs\",
    \"is_default\": true
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/addresses/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "b",
    "phone": "ngzmiyvdljnikhwa",
    "email": "breitenberg.gilbert@example.com",
    "street_address": "u",
    "city": "w",
    "state_province": "p",
    "postal_code": "wlvqwrsitcpscqld",
    "country": "zs",
    "is_default": true
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-addresses--address_id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Address updated successfully&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;name&quot;: &quot;John Doe&quot;,
        &quot;updated_at&quot;: &quot;2024-01-02T00:00:00.000000Z&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-PUTapi-addresses--address_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-addresses--address_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-addresses--address_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-addresses--address_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-addresses--address_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-addresses--address_id-" data-method="PUT"
      data-path="api/addresses/{address_id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-addresses--address_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-addresses--address_id-"
                    onclick="tryItOut('PUTapi-addresses--address_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-addresses--address_id-"
                    onclick="cancelTryOut('PUTapi-addresses--address_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-addresses--address_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/addresses/{address_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-addresses--address_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-addresses--address_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>address_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="address_id"                data-endpoint="PUTapi-addresses--address_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the address. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>address</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="address"                data-endpoint="PUTapi-addresses--address_id-"
               value="1"
               data-component="url">
    <br>
<p>The address ID. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="PUTapi-addresses--address_id-"
               value="b"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>b</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>phone</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="phone"                data-endpoint="PUTapi-addresses--address_id-"
               value="ngzmiyvdljnikhwa"
               data-component="body">
    <br>
<p>Must be at least 10 characters. Must not be greater than 20 characters. Example: <code>ngzmiyvdljnikhwa</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="PUTapi-addresses--address_id-"
               value="breitenberg.gilbert@example.com"
               data-component="body">
    <br>
<p>Must be a valid email address. Must not be greater than 255 characters. Example: <code>breitenberg.gilbert@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>street_address</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="street_address"                data-endpoint="PUTapi-addresses--address_id-"
               value="u"
               data-component="body">
    <br>
<p>Must not be greater than 500 characters. Example: <code>u</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>city</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="city"                data-endpoint="PUTapi-addresses--address_id-"
               value="w"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>w</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>state_province</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="state_province"                data-endpoint="PUTapi-addresses--address_id-"
               value="p"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>p</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>postal_code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="postal_code"                data-endpoint="PUTapi-addresses--address_id-"
               value="wlvqwrsitcpscqld"
               data-component="body">
    <br>
<p>Must not be greater than 20 characters. Example: <code>wlvqwrsitcpscqld</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>country</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="country"                data-endpoint="PUTapi-addresses--address_id-"
               value="zs"
               data-component="body">
    <br>
<p>Must not be greater than 2 characters. Example: <code>zs</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>is_default</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="PUTapi-addresses--address_id-" style="display: none">
            <input type="radio" name="is_default"
                   value="true"
                   data-endpoint="PUTapi-addresses--address_id-"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="PUTapi-addresses--address_id-" style="display: none">
            <input type="radio" name="is_default"
                   value="false"
                   data-endpoint="PUTapi-addresses--address_id-"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>true</code></p>
        </div>
        </form>

                    <h2 id="address-management-DELETEapi-addresses--address_id-">Delete Address</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Delete an address.</p>

<span id="example-requests-DELETEapi-addresses--address_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/api/addresses/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/addresses/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-addresses--address_id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Address deleted successfully&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-DELETEapi-addresses--address_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-addresses--address_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-addresses--address_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-addresses--address_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-addresses--address_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-addresses--address_id-" data-method="DELETE"
      data-path="api/addresses/{address_id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-addresses--address_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-addresses--address_id-"
                    onclick="tryItOut('DELETEapi-addresses--address_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-addresses--address_id-"
                    onclick="cancelTryOut('DELETEapi-addresses--address_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-addresses--address_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/addresses/{address_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-addresses--address_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-addresses--address_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>address_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="address_id"                data-endpoint="DELETEapi-addresses--address_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the address. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>address</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="address"                data-endpoint="DELETEapi-addresses--address_id-"
               value="1"
               data-component="url">
    <br>
<p>The address ID. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="address-management-PATCHapi-addresses--address_id--default">Set Default Address</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Set an address as the default.</p>

<span id="example-requests-PATCHapi-addresses--address_id--default">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PATCH \
    "http://localhost/api/addresses/1/default" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/addresses/1/default"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PATCH",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PATCHapi-addresses--address_id--default">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Default address updated&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;is_default&quot;: true
    }
}</code>
 </pre>
    </span>
<span id="execution-results-PATCHapi-addresses--address_id--default" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PATCHapi-addresses--address_id--default"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PATCHapi-addresses--address_id--default"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PATCHapi-addresses--address_id--default" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PATCHapi-addresses--address_id--default">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PATCHapi-addresses--address_id--default" data-method="PATCH"
      data-path="api/addresses/{address_id}/default"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PATCHapi-addresses--address_id--default', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PATCHapi-addresses--address_id--default"
                    onclick="tryItOut('PATCHapi-addresses--address_id--default');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PATCHapi-addresses--address_id--default"
                    onclick="cancelTryOut('PATCHapi-addresses--address_id--default');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PATCHapi-addresses--address_id--default"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/addresses/{address_id}/default</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PATCHapi-addresses--address_id--default"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PATCHapi-addresses--address_id--default"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>address_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="address_id"                data-endpoint="PATCHapi-addresses--address_id--default"
               value="1"
               data-component="url">
    <br>
<p>The ID of the address. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>address</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="address"                data-endpoint="PATCHapi-addresses--address_id--default"
               value="1"
               data-component="url">
    <br>
<p>The address ID. Example: <code>1</code></p>
            </div>
                    </form>

                <h1 id="cart-management">Cart Management</h1>

    <p>APIs for managing shopping cart</p>

                                <h2 id="cart-management-GETapi-cart">Get Cart</h2>

<p>
</p>

<p>Retrieve all items in the user's cart.</p>

<span id="example-requests-GETapi-cart">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/cart" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/cart"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-cart">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;items&quot;: [],
        &quot;count&quot;: 3,
        &quot;totals&quot;: {
            &quot;subtotal&quot;: 89.97,
            &quot;tax&quot;: 7.2,
            &quot;shipping&quot;: 10,
            &quot;total&quot;: 107.17
        }
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-cart" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-cart"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-cart"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-cart" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-cart">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-cart" data-method="GET"
      data-path="api/cart"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-cart', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-cart"
                    onclick="tryItOut('GETapi-cart');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-cart"
                    onclick="cancelTryOut('GETapi-cart');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-cart"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/cart</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-cart"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-cart"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="cart-management-POSTapi-cart">Add Item to Cart</h2>

<p>
</p>

<p>Add a product to the shopping cart. Works for both authenticated and guest users.</p>

<span id="example-requests-POSTapi-cart">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/cart" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"product_id\": 1,
    \"variant_id\": 2,
    \"service_slot_id\": 16,
    \"booking_date\": \"2052-03-03\",
    \"start_time\": \"14:37:28\",
    \"end_time\": \"2052-03-03\",
    \"quantity\": 2
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/cart"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "product_id": 1,
    "variant_id": 2,
    "service_slot_id": 16,
    "booking_date": "2052-03-03",
    "start_time": "14:37:28",
    "end_time": "2052-03-03",
    "quantity": 2
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-cart">
            <blockquote>
            <p>Example response (201):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Item added to cart&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;product_id&quot;: 1,
        &quot;variant_id&quot;: 2,
        &quot;quantity&quot;: 2,
        &quot;product&quot;: {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;Product Name&quot;,
            &quot;price&quot;: 29.99
        }
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-cart" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-cart"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-cart"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-cart" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-cart">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-cart" data-method="POST"
      data-path="api/cart"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-cart', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-cart"
                    onclick="tryItOut('POSTapi-cart');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-cart"
                    onclick="cancelTryOut('POSTapi-cart');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-cart"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/cart</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-cart"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-cart"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>product_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="product_id"                data-endpoint="POSTapi-cart"
               value="1"
               data-component="body">
    <br>
<p>The product ID. Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>variant_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="variant_id"                data-endpoint="POSTapi-cart"
               value="2"
               data-component="body">
    <br>
<p>optional The variant ID if applicable. Example: <code>2</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>service_slot_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="service_slot_id"                data-endpoint="POSTapi-cart"
               value="16"
               data-component="body">
    <br>
<p>This field is required when <code>product_id</code> is not present. The <code>id</code> of an existing record in the service_slots table. Example: <code>16</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>booking_date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="booking_date"                data-endpoint="POSTapi-cart"
               value="2052-03-03"
               data-component="body">
    <br>
<p>This field is required when <code>service_slot_id</code> is <code>*</code>. Must be a valid date. Must be a date after or equal to <code>today</code>. Example: <code>2052-03-03</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>start_time</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="start_time"                data-endpoint="POSTapi-cart"
               value="14:37:28"
               data-component="body">
    <br>
<p>This field is required when <code>service_slot_id</code> is <code>*</code>. Must be a valid date in the format <code>H:i:s</code>. Example: <code>14:37:28</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>end_time</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="end_time"                data-endpoint="POSTapi-cart"
               value="2052-03-03"
               data-component="body">
    <br>
<p>This field is required when <code>service_slot_id</code> is <code>*</code>. Must be a valid date in the format <code>H:i:s</code>. Must be a date after <code>start_time</code>. Example: <code>2052-03-03</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>quantity</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="quantity"                data-endpoint="POSTapi-cart"
               value="2"
               data-component="body">
    <br>
<p>Quantity to add (1-99). Example: <code>2</code></p>
        </div>
        </form>

                    <h2 id="cart-management-PUTapi-cart--cart_id-">Update Cart Item</h2>

<p>
</p>

<p>Update the quantity of an item in the cart.</p>

<span id="example-requests-PUTapi-cart--cart_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/api/cart/2" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"quantity\": 3
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/cart/2"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "quantity": 3
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-cart--cart_id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Cart updated successfully&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;quantity&quot;: 3
    }
}</code>
 </pre>
    </span>
<span id="execution-results-PUTapi-cart--cart_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-cart--cart_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-cart--cart_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-cart--cart_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-cart--cart_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-cart--cart_id-" data-method="PUT"
      data-path="api/cart/{cart_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-cart--cart_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-cart--cart_id-"
                    onclick="tryItOut('PUTapi-cart--cart_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-cart--cart_id-"
                    onclick="cancelTryOut('PUTapi-cart--cart_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-cart--cart_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/cart/{cart_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-cart--cart_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-cart--cart_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>cart_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="cart_id"                data-endpoint="PUTapi-cart--cart_id-"
               value="2"
               data-component="url">
    <br>
<p>The ID of the cart. Example: <code>2</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>cart</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="cart"                data-endpoint="PUTapi-cart--cart_id-"
               value="1"
               data-component="url">
    <br>
<p>The cart item ID. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>quantity</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="quantity"                data-endpoint="PUTapi-cart--cart_id-"
               value="3"
               data-component="body">
    <br>
<p>New quantity (1-99). Example: <code>3</code></p>
        </div>
        </form>

                    <h2 id="cart-management-DELETEapi-cart--cart_id-">Remove Item from Cart</h2>

<p>
</p>

<p>Remove an item from the shopping cart.</p>

<span id="example-requests-DELETEapi-cart--cart_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/api/cart/2" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/cart/2"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-cart--cart_id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Item removed from cart&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-DELETEapi-cart--cart_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-cart--cart_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-cart--cart_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-cart--cart_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-cart--cart_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-cart--cart_id-" data-method="DELETE"
      data-path="api/cart/{cart_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-cart--cart_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-cart--cart_id-"
                    onclick="tryItOut('DELETEapi-cart--cart_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-cart--cart_id-"
                    onclick="cancelTryOut('DELETEapi-cart--cart_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-cart--cart_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/cart/{cart_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-cart--cart_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-cart--cart_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>cart_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="cart_id"                data-endpoint="DELETEapi-cart--cart_id-"
               value="2"
               data-component="url">
    <br>
<p>The ID of the cart. Example: <code>2</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>cart</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="cart"                data-endpoint="DELETEapi-cart--cart_id-"
               value="1"
               data-component="url">
    <br>
<p>The cart item ID. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="cart-management-DELETEapi-cart">Clear Cart</h2>

<p>
</p>

<p>Remove all items from the cart.</p>

<span id="example-requests-DELETEapi-cart">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/api/cart" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/cart"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-cart">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Cart cleared successfully&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-DELETEapi-cart" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-cart"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-cart"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-cart" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-cart">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-cart" data-method="DELETE"
      data-path="api/cart"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-cart', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-cart"
                    onclick="tryItOut('DELETEapi-cart');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-cart"
                    onclick="cancelTryOut('DELETEapi-cart');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-cart"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/cart</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-cart"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-cart"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="cart-management-GETapi-cart-count">Get Cart Count</h2>

<p>
</p>

<p>Get the number of items in cart (for badge display).</p>

<span id="example-requests-GETapi-cart-count">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/cart/count" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/cart/count"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-cart-count">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;count&quot;: 5
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-cart-count" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-cart-count"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-cart-count"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-cart-count" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-cart-count">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-cart-count" data-method="GET"
      data-path="api/cart/count"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-cart-count', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-cart-count"
                    onclick="tryItOut('GETapi-cart-count');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-cart-count"
                    onclick="cancelTryOut('GETapi-cart-count');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-cart-count"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/cart/count</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-cart-count"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-cart-count"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                <h1 id="checkout">Checkout</h1>

    <p>APIs for checkout process</p>

                                <h2 id="checkout-POSTapi-checkout-payment-intent">Create Payment Intent (supports multi-currency)</h2>

<p>
</p>

<p>Create Stripe payment intent(s) for the cart. If cart has multiple currencies,
creates separate payment intents for each currency.</p>

<span id="example-requests-POSTapi-checkout-payment-intent">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/checkout/payment-intent" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"currency\": \"architecto\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/checkout/payment-intent"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "currency": "architecto"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-checkout-payment-intent">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;payment_intents&quot;: [
            {
                &quot;currency&quot;: &quot;USD&quot;,
                &quot;currency_symbol&quot;: &quot;$&quot;,
                &quot;client_secret&quot;: &quot;pi_xxx_secret_xxx&quot;,
                &quot;payment_intent_id&quot;: &quot;pi_xxx&quot;,
                &quot;amount&quot;: 107.17
            }
        ],
        &quot;has_multiple_currencies&quot;: false
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-checkout-payment-intent" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-checkout-payment-intent"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-checkout-payment-intent"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-checkout-payment-intent" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-checkout-payment-intent">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-checkout-payment-intent" data-method="POST"
      data-path="api/checkout/payment-intent"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-checkout-payment-intent', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-checkout-payment-intent"
                    onclick="tryItOut('POSTapi-checkout-payment-intent');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-checkout-payment-intent"
                    onclick="cancelTryOut('POSTapi-checkout-payment-intent');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-checkout-payment-intent"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/checkout/payment-intent</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-checkout-payment-intent"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-checkout-payment-intent"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>currency</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="currency"                data-endpoint="POSTapi-checkout-payment-intent"
               value="architecto"
               data-component="body">
    <br>
<p>optional Specific currency to create payment intent for (when cart has multiple currencies) Example: <code>architecto</code></p>
        </div>
        </form>

                    <h2 id="checkout-POSTapi-checkout-process">Process Checkout (supports multi-currency)</h2>

<p>
</p>

<p>Complete the checkout process and create order(s). If cart has multiple currencies,
creates separate orders for each currency.</p>

<span id="example-requests-POSTapi-checkout-process">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/checkout/process" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"payment_method_id\": \"architecto\",
    \"payment_intents\": [
        \"architecto\"
    ],
    \"order_notes\": \"architecto\",
    \"address\": {
        \"name\": \"b\",
        \"phone\": \"ngzmiyvdljnikhwa\",
        \"email\": \"breitenberg.gilbert@example.com\",
        \"street_address\": \"u\",
        \"city\": \"w\",
        \"state_province\": \"p\",
        \"postal_code\": \"wlvqwrsitcpscqld\",
        \"country\": \"zs\"
    },
    \"address_id\": 16
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/checkout/process"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "payment_method_id": "architecto",
    "payment_intents": [
        "architecto"
    ],
    "order_notes": "architecto",
    "address": {
        "name": "b",
        "phone": "ngzmiyvdljnikhwa",
        "email": "breitenberg.gilbert@example.com",
        "street_address": "u",
        "city": "w",
        "state_province": "p",
        "postal_code": "wlvqwrsitcpscqld",
        "country": "zs"
    },
    "address_id": 16
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-checkout-process">
            <blockquote>
            <p>Example response (201):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Order(s) placed successfully&quot;,
    &quot;data&quot;: {
        &quot;orders&quot;: [
            {
                &quot;order_number&quot;: &quot;ORD-ABC123&quot;,
                &quot;total&quot;: 107.17,
                &quot;currency&quot;: &quot;USD&quot;,
                &quot;status&quot;: &quot;paid&quot;
            }
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-checkout-process" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-checkout-process"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-checkout-process"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-checkout-process" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-checkout-process">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-checkout-process" data-method="POST"
      data-path="api/checkout/process"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-checkout-process', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-checkout-process"
                    onclick="tryItOut('POSTapi-checkout-process');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-checkout-process"
                    onclick="cancelTryOut('POSTapi-checkout-process');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-checkout-process"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/checkout/process</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-checkout-process"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-checkout-process"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>payment_method_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="payment_method_id"                data-endpoint="POSTapi-checkout-process"
               value="architecto"
               data-component="body">
    <br>
<p>This field is required when <code>payment_intents</code> is not present. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
        <details>
            <summary style="padding-bottom: 10px;">
                <b style="line-height: 2;"><code>payment_intents</code></b>&nbsp;&nbsp;
<small>string[]</small>&nbsp;
 &nbsp;
 &nbsp;
<br>
<p>Array of payment method IDs with their currencies</p>
            </summary>
                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>payment_method_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="payment_intents.0.payment_method_id"                data-endpoint="POSTapi-checkout-process"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>currency</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="payment_intents.0.currency"                data-endpoint="POSTapi-checkout-process"
               value="ngz"
               data-component="body">
    <br>
<p>Must be 3 characters. Example: <code>ngz</code></p>
                    </div>
                                                                <div style=" margin-left: 14px; clear: unset;">
        <details>
            <summary style="padding-bottom: 10px;">
                <b style="line-height: 2;"><code>*</code></b>&nbsp;&nbsp;
<small>object</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
<br>

            </summary>
                                                <div style="margin-left: 28px; clear: unset;">
                        <b style="line-height: 2;"><code>payment_method_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="payment_intents.*.payment_method_id"                data-endpoint="POSTapi-checkout-process"
               value="architecto"
               data-component="body">
    <br>
<p>Stripe payment method ID Example: <code>architecto</code></p>
                    </div>
                                                                <div style="margin-left: 28px; clear: unset;">
                        <b style="line-height: 2;"><code>currency</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="payment_intents.*.currency"                data-endpoint="POSTapi-checkout-process"
               value="architecto"
               data-component="body">
    <br>
<p>Currency for this payment Example: <code>architecto</code></p>
                    </div>
                                    </details>
        </div>
                                        </details>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>order_notes</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="order_notes"                data-endpoint="POSTapi-checkout-process"
               value="architecto"
               data-component="body">
    <br>
<p>optional Order notes Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
        <details>
            <summary style="padding-bottom: 10px;">
                <b style="line-height: 2;"><code>address</code></b>&nbsp;&nbsp;
<small>object</small>&nbsp;
 &nbsp;
 &nbsp;
<br>
<p>Address object (for guest users)</p>
            </summary>
                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="address.name"                data-endpoint="POSTapi-checkout-process"
               value="b"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>b</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>phone</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="address.phone"                data-endpoint="POSTapi-checkout-process"
               value="ngzmiyvdljnikhwa"
               data-component="body">
    <br>
<p>Must be at least 10 characters. Must not be greater than 20 characters. Example: <code>ngzmiyvdljnikhwa</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="address.email"                data-endpoint="POSTapi-checkout-process"
               value="breitenberg.gilbert@example.com"
               data-component="body">
    <br>
<p>Must be a valid email address. Must not be greater than 255 characters. Example: <code>breitenberg.gilbert@example.com</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>street_address</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="address.street_address"                data-endpoint="POSTapi-checkout-process"
               value="u"
               data-component="body">
    <br>
<p>Must not be greater than 500 characters. Example: <code>u</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>city</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="address.city"                data-endpoint="POSTapi-checkout-process"
               value="w"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>w</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>state_province</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="address.state_province"                data-endpoint="POSTapi-checkout-process"
               value="p"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>p</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>postal_code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="address.postal_code"                data-endpoint="POSTapi-checkout-process"
               value="wlvqwrsitcpscqld"
               data-component="body">
    <br>
<p>Must not be greater than 20 characters. Example: <code>wlvqwrsitcpscqld</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>country</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="address.country"                data-endpoint="POSTapi-checkout-process"
               value="zs"
               data-component="body">
    <br>
<p>Must not be greater than 2 characters. Example: <code>zs</code></p>
                    </div>
                                    </details>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>address_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="address_id"                data-endpoint="POSTapi-checkout-process"
               value="16"
               data-component="body">
    <br>
<p>Address ID (for authenticated users) Example: <code>16</code></p>
        </div>
        </form>

                    <h2 id="checkout-POSTapi-checkout-verify-payment">Verify Payment</h2>

<p>
</p>

<p>Verify a payment intent status.</p>

<span id="example-requests-POSTapi-checkout-verify-payment">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/checkout/verify-payment" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"payment_intent_id\": \"pi_xxx\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/checkout/verify-payment"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "payment_intent_id": "pi_xxx"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-checkout-verify-payment">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;status&quot;: &quot;succeeded&quot;,
        &quot;payment_intent_id&quot;: &quot;pi_xxx&quot;,
        &quot;amount&quot;: 107.17
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-checkout-verify-payment" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-checkout-verify-payment"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-checkout-verify-payment"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-checkout-verify-payment" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-checkout-verify-payment">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-checkout-verify-payment" data-method="POST"
      data-path="api/checkout/verify-payment"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-checkout-verify-payment', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-checkout-verify-payment"
                    onclick="tryItOut('POSTapi-checkout-verify-payment');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-checkout-verify-payment"
                    onclick="cancelTryOut('POSTapi-checkout-verify-payment');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-checkout-verify-payment"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/checkout/verify-payment</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-checkout-verify-payment"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-checkout-verify-payment"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>payment_intent_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="payment_intent_id"                data-endpoint="POSTapi-checkout-verify-payment"
               value="pi_xxx"
               data-component="body">
    <br>
<p>Payment intent ID. Example: <code>pi_xxx</code></p>
        </div>
        </form>

                <h1 id="comment-management">Comment Management</h1>

    <p>APIs for managing comments on forums</p>

                                <h2 id="comment-management-GETapi-comments">Get comments</h2>

<p>
</p>

<p>Retrieve comments for a commentable entity (e.g., Forum).
If parent_id is null, returns top-level comments with 3 most recent replies each (paginated 10 per page).
If parent_id is provided, returns all replies for that comment (paginated 10 per page).</p>

<span id="example-requests-GETapi-comments">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/comments?commentable_type=App%5CModels%5CForum&amp;commentable_id=1&amp;parent_id=5&amp;page=1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"commentable_type\": \"architecto\",
    \"commentable_id\": 16,
    \"parent_id\": 16
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/comments"
);

const params = {
    "commentable_type": "App\Models\Forum",
    "commentable_id": "1",
    "parent_id": "5",
    "page": "1",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "commentable_type": "architecto",
    "commentable_id": 16,
    "parent_id": 16
};

fetch(url, {
    method: "GET",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-comments">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;comment&quot;: &quot;Great post! I&#039;ve been researching this topic too.&quot;,
            &quot;author_id&quot;: 2,
            &quot;commentable_type&quot;: &quot;App\\Models\\Forum&quot;,
            &quot;commentable_id&quot;: 1,
            &quot;parent_id&quot;: null,
            &quot;created_at&quot;: &quot;2024-01-15T11:00:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2024-01-15T11:00:00.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;author&quot;: {
                &quot;id&quot;: 2,
                &quot;name&quot;: &quot;Jane Smith&quot;,
                &quot;email&quot;: &quot;jane@example.com&quot;
            },
            &quot;likes_count&quot;: 3,
            &quot;is_liked&quot;: false,
            &quot;is_flagged&quot;: false,
            &quot;replies_count&quot;: 2,
            &quot;replies&quot;: [
                {
                    &quot;id&quot;: 3,
                    &quot;comment&quot;: &quot;Thanks for sharing!&quot;,
                    &quot;author_id&quot;: 1,
                    &quot;parent_id&quot;: 1,
                    &quot;created_at&quot;: &quot;2024-01-15T11:30:00.000000Z&quot;,
                    &quot;author&quot;: {
                        &quot;id&quot;: 1,
                        &quot;name&quot;: &quot;John Doe&quot;
                    },
                    &quot;likes_count&quot;: 1
                }
            ]
        }
    ],
    &quot;current_page&quot;: 1,
    &quot;last_page&quot;: 1,
    &quot;per_page&quot;: 10,
    &quot;total&quot;: 5
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;The given data was invalid.&quot;,
    &quot;errors&quot;: {
        &quot;commentable_type&quot;: [
            &quot;The commentable type field is required.&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-comments" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-comments"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-comments"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-comments" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-comments">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-comments" data-method="GET"
      data-path="api/comments"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-comments', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-comments"
                    onclick="tryItOut('GETapi-comments');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-comments"
                    onclick="cancelTryOut('GETapi-comments');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-comments"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/comments</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-comments"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-comments"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>commentable_type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="commentable_type"                data-endpoint="GETapi-comments"
               value="App\Models\Forum"
               data-component="query">
    <br>
<p>The type of entity being commented on. Example: <code>App\Models\Forum</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>commentable_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="commentable_id"                data-endpoint="GETapi-comments"
               value="1"
               data-component="query">
    <br>
<p>The ID of the entity being commented on. Example: <code>1</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>parent_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="parent_id"                data-endpoint="GETapi-comments"
               value="5"
               data-component="query">
    <br>
<p>optional The parent comment ID (for fetching replies). Example: <code>5</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="page"                data-endpoint="GETapi-comments"
               value="1"
               data-component="query">
    <br>
<p>optional The page number for pagination. Example: <code>1</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>commentable_type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="commentable_type"                data-endpoint="GETapi-comments"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>commentable_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="commentable_id"                data-endpoint="GETapi-comments"
               value="16"
               data-component="body">
    <br>
<p>Example: <code>16</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>parent_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="parent_id"                data-endpoint="GETapi-comments"
               value="16"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the comments table. Example: <code>16</code></p>
        </div>
        </form>

                    <h2 id="comment-management-POSTapi-comments">Create a comment</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Post a new comment on a forum or reply to an existing comment. Requires authentication.</p>

<span id="example-requests-POSTapi-comments">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/comments" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"comment\": \"I completely agree with this approach!\",
    \"commentable_type\": \"App\\\\Models\\\\Forum\",
    \"commentable_id\": 1,
    \"parent_id\": 5
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/comments"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "comment": "I completely agree with this approach!",
    "commentable_type": "App\\Models\\Forum",
    "commentable_id": 1,
    "parent_id": 5
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-comments">
            <blockquote>
            <p>Example response (201):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Comment created successfully&quot;,
    &quot;comment&quot;: {
        &quot;id&quot;: 10,
        &quot;comment&quot;: &quot;I completely agree with this approach!&quot;,
        &quot;author_id&quot;: 2,
        &quot;commentable_type&quot;: &quot;App\\Models\\Forum&quot;,
        &quot;commentable_id&quot;: 1,
        &quot;parent_id&quot;: null,
        &quot;created_at&quot;: &quot;2024-01-15T12:00:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2024-01-15T12:00:00.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;author&quot;: {
            &quot;id&quot;: 2,
            &quot;name&quot;: &quot;Jane Smith&quot;,
            &quot;email&quot;: &quot;jane@example.com&quot;
        },
        &quot;likes&quot;: [],
        &quot;flags&quot;: []
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;The given data was invalid.&quot;,
    &quot;errors&quot;: {
        &quot;comment&quot;: [
            &quot;The comment field is required.&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-comments" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-comments"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-comments"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-comments" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-comments">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-comments" data-method="POST"
      data-path="api/comments"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-comments', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-comments"
                    onclick="tryItOut('POSTapi-comments');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-comments"
                    onclick="cancelTryOut('POSTapi-comments');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-comments"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/comments</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-comments"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-comments"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>comment</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="comment"                data-endpoint="POSTapi-comments"
               value="I completely agree with this approach!"
               data-component="body">
    <br>
<p>The comment text. Example: <code>I completely agree with this approach!</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>commentable_type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="commentable_type"                data-endpoint="POSTapi-comments"
               value="App\Models\Forum"
               data-component="body">
    <br>
<p>The type of entity being commented on. Example: <code>App\Models\Forum</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>commentable_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="commentable_id"                data-endpoint="POSTapi-comments"
               value="1"
               data-component="body">
    <br>
<p>The ID of the entity being commented on. Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>parent_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="parent_id"                data-endpoint="POSTapi-comments"
               value="5"
               data-component="body">
    <br>
<p>optional The parent comment ID if this is a reply. Example: <code>5</code></p>
        </div>
        </form>

                    <h2 id="comment-management-DELETEapi-comments--id-">Delete a comment</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Soft delete a comment. Only the comment author can delete their own comment.</p>

<span id="example-requests-DELETEapi-comments--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/api/comments/10" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/comments/10"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-comments--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Comment deleted successfully&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthorized. You can only delete your own comments.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Comment not found&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-DELETEapi-comments--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-comments--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-comments--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-comments--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-comments--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-comments--id-" data-method="DELETE"
      data-path="api/comments/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-comments--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-comments--id-"
                    onclick="tryItOut('DELETEapi-comments--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-comments--id-"
                    onclick="cancelTryOut('DELETEapi-comments--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-comments--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/comments/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-comments--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-comments--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-comments--id-"
               value="10"
               data-component="url">
    <br>
<p>The ID of the comment to delete. Example: <code>10</code></p>
            </div>
                    </form>

                <h1 id="endpoints">Endpoints</h1>

    

                                <h2 id="endpoints-GETapi-vendor-orders">Get all orders for vendor</h2>

<p>
</p>



<span id="example-requests-GETapi-vendor-orders">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/vendor/orders" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/vendor/orders"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-vendor-orders">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: http://localhost:3000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated&quot;,
    &quot;error&quot;: &quot;You must be authenticated to access this resource&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-vendor-orders" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-vendor-orders"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-vendor-orders"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-vendor-orders" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-vendor-orders">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-vendor-orders" data-method="GET"
      data-path="api/vendor/orders"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-vendor-orders', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-vendor-orders"
                    onclick="tryItOut('GETapi-vendor-orders');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-vendor-orders"
                    onclick="cancelTryOut('GETapi-vendor-orders');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-vendor-orders"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/vendor/orders</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-vendor-orders"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-vendor-orders"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-PATCHapi-vendor-orders--order_id--status">Update order status</h2>

<p>
</p>



<span id="example-requests-PATCHapi-vendor-orders--order_id--status">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PATCH \
    "http://localhost/api/vendor/orders/7/status" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"status\": \"delivered\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/vendor/orders/7/status"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "status": "delivered"
};

fetch(url, {
    method: "PATCH",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PATCHapi-vendor-orders--order_id--status">
</span>
<span id="execution-results-PATCHapi-vendor-orders--order_id--status" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PATCHapi-vendor-orders--order_id--status"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PATCHapi-vendor-orders--order_id--status"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PATCHapi-vendor-orders--order_id--status" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PATCHapi-vendor-orders--order_id--status">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PATCHapi-vendor-orders--order_id--status" data-method="PATCH"
      data-path="api/vendor/orders/{order_id}/status"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PATCHapi-vendor-orders--order_id--status', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PATCHapi-vendor-orders--order_id--status"
                    onclick="tryItOut('PATCHapi-vendor-orders--order_id--status');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PATCHapi-vendor-orders--order_id--status"
                    onclick="cancelTryOut('PATCHapi-vendor-orders--order_id--status');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PATCHapi-vendor-orders--order_id--status"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/vendor/orders/{order_id}/status</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PATCHapi-vendor-orders--order_id--status"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PATCHapi-vendor-orders--order_id--status"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>order_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="order_id"                data-endpoint="PATCHapi-vendor-orders--order_id--status"
               value="7"
               data-component="url">
    <br>
<p>The ID of the order. Example: <code>7</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="PATCHapi-vendor-orders--order_id--status"
               value="delivered"
               data-component="body">
    <br>
<p>Example: <code>delivered</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>processing</code></li> <li><code>shipped</code></li> <li><code>delivered</code></li></ul>
        </div>
        </form>

                    <h2 id="endpoints-POSTapi-vendor-orders--order_id--cancel">Vendor cancels order</h2>

<p>
</p>



<span id="example-requests-POSTapi-vendor-orders--order_id--cancel">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/vendor/orders/7/cancel" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"reason\": \"b\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/vendor/orders/7/cancel"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "reason": "b"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-vendor-orders--order_id--cancel">
</span>
<span id="execution-results-POSTapi-vendor-orders--order_id--cancel" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-vendor-orders--order_id--cancel"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-vendor-orders--order_id--cancel"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-vendor-orders--order_id--cancel" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-vendor-orders--order_id--cancel">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-vendor-orders--order_id--cancel" data-method="POST"
      data-path="api/vendor/orders/{order_id}/cancel"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-vendor-orders--order_id--cancel', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-vendor-orders--order_id--cancel"
                    onclick="tryItOut('POSTapi-vendor-orders--order_id--cancel');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-vendor-orders--order_id--cancel"
                    onclick="cancelTryOut('POSTapi-vendor-orders--order_id--cancel');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-vendor-orders--order_id--cancel"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/vendor/orders/{order_id}/cancel</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-vendor-orders--order_id--cancel"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-vendor-orders--order_id--cancel"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>order_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="order_id"                data-endpoint="POSTapi-vendor-orders--order_id--cancel"
               value="7"
               data-component="url">
    <br>
<p>The ID of the order. Example: <code>7</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>reason</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="reason"                data-endpoint="POSTapi-vendor-orders--order_id--cancel"
               value="b"
               data-component="body">
    <br>
<p>Must not be greater than 500 characters. Example: <code>b</code></p>
        </div>
        </form>

                    <h2 id="endpoints-POSTapi-vendor-orders--order_id--approve-cancellation">Approve cancellation request</h2>

<p>
</p>



<span id="example-requests-POSTapi-vendor-orders--order_id--approve-cancellation">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/vendor/orders/7/approve-cancellation" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/vendor/orders/7/approve-cancellation"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-vendor-orders--order_id--approve-cancellation">
</span>
<span id="execution-results-POSTapi-vendor-orders--order_id--approve-cancellation" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-vendor-orders--order_id--approve-cancellation"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-vendor-orders--order_id--approve-cancellation"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-vendor-orders--order_id--approve-cancellation" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-vendor-orders--order_id--approve-cancellation">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-vendor-orders--order_id--approve-cancellation" data-method="POST"
      data-path="api/vendor/orders/{order_id}/approve-cancellation"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-vendor-orders--order_id--approve-cancellation', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-vendor-orders--order_id--approve-cancellation"
                    onclick="tryItOut('POSTapi-vendor-orders--order_id--approve-cancellation');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-vendor-orders--order_id--approve-cancellation"
                    onclick="cancelTryOut('POSTapi-vendor-orders--order_id--approve-cancellation');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-vendor-orders--order_id--approve-cancellation"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/vendor/orders/{order_id}/approve-cancellation</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-vendor-orders--order_id--approve-cancellation"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-vendor-orders--order_id--approve-cancellation"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>order_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="order_id"                data-endpoint="POSTapi-vendor-orders--order_id--approve-cancellation"
               value="7"
               data-component="url">
    <br>
<p>The ID of the order. Example: <code>7</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-POSTapi-vendor-orders--order_id--deny-cancellation">Deny cancellation request</h2>

<p>
</p>



<span id="example-requests-POSTapi-vendor-orders--order_id--deny-cancellation">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/vendor/orders/7/deny-cancellation" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"reason\": \"b\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/vendor/orders/7/deny-cancellation"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "reason": "b"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-vendor-orders--order_id--deny-cancellation">
</span>
<span id="execution-results-POSTapi-vendor-orders--order_id--deny-cancellation" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-vendor-orders--order_id--deny-cancellation"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-vendor-orders--order_id--deny-cancellation"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-vendor-orders--order_id--deny-cancellation" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-vendor-orders--order_id--deny-cancellation">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-vendor-orders--order_id--deny-cancellation" data-method="POST"
      data-path="api/vendor/orders/{order_id}/deny-cancellation"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-vendor-orders--order_id--deny-cancellation', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-vendor-orders--order_id--deny-cancellation"
                    onclick="tryItOut('POSTapi-vendor-orders--order_id--deny-cancellation');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-vendor-orders--order_id--deny-cancellation"
                    onclick="cancelTryOut('POSTapi-vendor-orders--order_id--deny-cancellation');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-vendor-orders--order_id--deny-cancellation"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/vendor/orders/{order_id}/deny-cancellation</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-vendor-orders--order_id--deny-cancellation"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-vendor-orders--order_id--deny-cancellation"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>order_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="order_id"                data-endpoint="POSTapi-vendor-orders--order_id--deny-cancellation"
               value="7"
               data-component="url">
    <br>
<p>The ID of the order. Example: <code>7</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>reason</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="reason"                data-endpoint="POSTapi-vendor-orders--order_id--deny-cancellation"
               value="b"
               data-component="body">
    <br>
<p>Must not be greater than 500 characters. Example: <code>b</code></p>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-user">Get the authenticated user&#039;s data.</h2>

<p>
</p>



<span id="example-requests-GETapi-user">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/user" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/user"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-user">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: http://localhost:3000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated&quot;,
    &quot;error&quot;: &quot;You must be authenticated to access this resource&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-user" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-user"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-user"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-user" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-user">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-user" data-method="GET"
      data-path="api/user"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-user', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-user"
                    onclick="tryItOut('GETapi-user');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-user"
                    onclick="cancelTryOut('GETapi-user');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-user"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/user</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-user"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-user"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                <h1 id="flag-management">Flag Management</h1>

    <p>APIs for flagging inappropriate content</p>

                                <h2 id="flag-management-POSTapi-flags">Flag content</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Flag a forum or comment as inappropriate. A user can only flag the same content once. Requires authentication.</p>

<span id="example-requests-POSTapi-flags">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/flags" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"flaggable_type\": \"App\\\\Models\\\\Forum\",
    \"flaggable_id\": 1
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/flags"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "flaggable_type": "App\\Models\\Forum",
    "flaggable_id": 1
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-flags">
            <blockquote>
            <p>Example response (201):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Content flagged successfully&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (409):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;You have already flagged this content&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;The given data was invalid.&quot;,
    &quot;errors&quot;: {
        &quot;flaggable_type&quot;: [
            &quot;The flaggable type field is required.&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-flags" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-flags"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-flags"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-flags" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-flags">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-flags" data-method="POST"
      data-path="api/flags"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-flags', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-flags"
                    onclick="tryItOut('POSTapi-flags');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-flags"
                    onclick="cancelTryOut('POSTapi-flags');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-flags"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/flags</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-flags"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-flags"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>flaggable_type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="flaggable_type"                data-endpoint="POSTapi-flags"
               value="App\Models\Forum"
               data-component="body">
    <br>
<p>The type of entity to flag. Example: <code>App\Models\Forum</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>flaggable_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="flaggable_id"                data-endpoint="POSTapi-flags"
               value="1"
               data-component="body">
    <br>
<p>The ID of the entity to flag. Example: <code>1</code></p>
        </div>
        </form>

                <h1 id="forum-management">Forum Management</h1>

    <p>APIs for managing community forums</p>

                                <h2 id="forum-management-GETapi-forums">List all forums</h2>

<p>
</p>

<p>Get a paginated list of all forums. Results can be filtered by category, sub-category, and sorted by latest or popularity.</p>

<span id="example-requests-GETapi-forums">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/forums?category=Mind&amp;sub_category=Mental+Health&amp;sort=popular&amp;page=1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"category\": \"architecto\",
    \"sub_category\": \"architecto\",
    \"sort\": \"latest\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/forums"
);

const params = {
    "category": "Mind",
    "sub_category": "Mental Health",
    "sort": "popular",
    "page": "1",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "category": "architecto",
    "sub_category": "architecto",
    "sort": "latest"
};

fetch(url, {
    method: "GET",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-forums">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;title&quot;: &quot;How to improve mental clarity?&quot;,
            &quot;content&quot;: &quot;I&#039;ve been struggling with focus lately...&quot;,
            &quot;category&quot;: &quot;Mind&quot;,
            &quot;sub_category&quot;: &quot;Mental Health&quot;,
            &quot;author_id&quot;: 1,
            &quot;status&quot;: &quot;approved&quot;,
            &quot;views&quot;: 125,
            &quot;created_at&quot;: &quot;2024-01-15T10:30:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2024-01-15T10:30:00.000000Z&quot;,
            &quot;author&quot;: {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;John Doe&quot;,
                &quot;email&quot;: &quot;john@example.com&quot;
            },
            &quot;comments_count&quot;: 5,
            &quot;likes_count&quot;: 12,
            &quot;flags_count&quot;: 0
        }
    ],
    &quot;current_page&quot;: 1,
    &quot;last_page&quot;: 5,
    &quot;per_page&quot;: 20,
    &quot;total&quot;: 100,
    &quot;from&quot;: 1,
    &quot;to&quot;: 20
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-forums" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-forums"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-forums"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-forums" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-forums">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-forums" data-method="GET"
      data-path="api/forums"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-forums', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-forums"
                    onclick="tryItOut('GETapi-forums');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-forums"
                    onclick="cancelTryOut('GETapi-forums');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-forums"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/forums</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-forums"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-forums"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>category</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="category"                data-endpoint="GETapi-forums"
               value="Mind"
               data-component="query">
    <br>
<p>Filter forums by category. Example: <code>Mind</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>sub_category</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="sub_category"                data-endpoint="GETapi-forums"
               value="Mental Health"
               data-component="query">
    <br>
<p>Filter forums by sub-category. Example: <code>Mental Health</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>sort</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="sort"                data-endpoint="GETapi-forums"
               value="popular"
               data-component="query">
    <br>
<p>Sort forums by 'latest' or 'popular'. Defaults to 'latest'. Example: <code>popular</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="page"                data-endpoint="GETapi-forums"
               value="1"
               data-component="query">
    <br>
<p>The page number for pagination. Example: <code>1</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>category</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="category"                data-endpoint="GETapi-forums"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>sub_category</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="sub_category"                data-endpoint="GETapi-forums"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>sort</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="sort"                data-endpoint="GETapi-forums"
               value="latest"
               data-component="body">
    <br>
<p>Example: <code>latest</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>latest</code></li> <li><code>popular</code></li></ul>
        </div>
        </form>

                    <h2 id="forum-management-GETapi-forums--id-">Get a single forum</h2>

<p>
</p>

<p>Retrieve detailed information about a specific forum including its comments.
View count is automatically incremented for non-authors.</p>

<span id="example-requests-GETapi-forums--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/forums/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/forums/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-forums--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id&quot;: 1,
    &quot;title&quot;: &quot;How to improve mental clarity?&quot;,
    &quot;content&quot;: &quot;I&#039;ve been struggling with focus lately. Has anyone tried meditation or nootropics?&quot;,
    &quot;category&quot;: &quot;Mind&quot;,
    &quot;sub_category&quot;: &quot;Mental Health&quot;,
    &quot;author_id&quot;: 1,
    &quot;status&quot;: &quot;approved&quot;,
    &quot;views&quot;: 126,
    &quot;created_at&quot;: &quot;2024-01-15T10:30:00.000000Z&quot;,
    &quot;updated_at&quot;: &quot;2024-01-15T10:30:00.000000Z&quot;,
    &quot;author&quot;: {
        &quot;id&quot;: 1,
        &quot;name&quot;: &quot;John Doe&quot;,
        &quot;email&quot;: &quot;john@example.com&quot;
    },
    &quot;comments&quot;: {
        &quot;data&quot;: [
            {
                &quot;id&quot;: 1,
                &quot;comment&quot;: &quot;I&#039;ve had great success with daily meditation!&quot;,
                &quot;author_id&quot;: 2,
                &quot;created_at&quot;: &quot;2024-01-15T11:00:00.000000Z&quot;,
                &quot;author&quot;: {
                    &quot;id&quot;: 2,
                    &quot;name&quot;: &quot;Jane Smith&quot;
                },
                &quot;likes_count&quot;: 3,
                &quot;is_liked&quot;: false,
                &quot;is_flagged&quot;: false,
                &quot;replies_count&quot;: 2,
                &quot;replies&quot;: []
            }
        ],
        &quot;current_page&quot;: 1,
        &quot;last_page&quot;: 1
    },
    &quot;likes_count&quot;: 12,
    &quot;flags_count&quot;: 0,
    &quot;comments_count&quot;: 5,
    &quot;is_liked&quot;: false,
    &quot;is_flagged&quot;: false
}</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Forum not found&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-forums--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-forums--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-forums--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-forums--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-forums--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-forums--id-" data-method="GET"
      data-path="api/forums/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-forums--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-forums--id-"
                    onclick="tryItOut('GETapi-forums--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-forums--id-"
                    onclick="cancelTryOut('GETapi-forums--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-forums--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/forums/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-forums--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-forums--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-forums--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the forum. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="forum-management-POSTapi-forums">Create a new forum</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Create a new forum post. Requires authentication.</p>

<span id="example-requests-POSTapi-forums">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/forums" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"title\": \"How to improve mental clarity?\",
    \"content\": \"I\'ve been struggling with focus lately...\",
    \"category\": \"Mind\",
    \"sub_category\": \"Mental Health\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/forums"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "title": "How to improve mental clarity?",
    "content": "I've been struggling with focus lately...",
    "category": "Mind",
    "sub_category": "Mental Health"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-forums">
            <blockquote>
            <p>Example response (201):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Forum created successfully&quot;,
    &quot;forum&quot;: {
        &quot;id&quot;: 1,
        &quot;title&quot;: &quot;How to improve mental clarity?&quot;,
        &quot;content&quot;: &quot;I&#039;ve been struggling with focus lately...&quot;,
        &quot;category&quot;: &quot;Mind&quot;,
        &quot;sub_category&quot;: &quot;Mental Health&quot;,
        &quot;author_id&quot;: 1,
        &quot;status&quot;: &quot;approved&quot;,
        &quot;views&quot;: 0,
        &quot;created_at&quot;: &quot;2024-01-15T10:30:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2024-01-15T10:30:00.000000Z&quot;,
        &quot;author&quot;: {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;John Doe&quot;,
            &quot;email&quot;: &quot;john@example.com&quot;
        }
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;The given data was invalid.&quot;,
    &quot;errors&quot;: {
        &quot;title&quot;: [
            &quot;The title field is required.&quot;
        ],
        &quot;category&quot;: [
            &quot;The selected category is invalid.&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-forums" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-forums"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-forums"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-forums" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-forums">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-forums" data-method="POST"
      data-path="api/forums"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-forums', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-forums"
                    onclick="tryItOut('POSTapi-forums');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-forums"
                    onclick="cancelTryOut('POSTapi-forums');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-forums"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/forums</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-forums"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-forums"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>title</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="title"                data-endpoint="POSTapi-forums"
               value="How to improve mental clarity?"
               data-component="body">
    <br>
<p>The forum title (max 400 characters). Example: <code>How to improve mental clarity?</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>content</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="content"                data-endpoint="POSTapi-forums"
               value="I've been struggling with focus lately..."
               data-component="body">
    <br>
<p>The forum content/description. Example: <code>I've been struggling with focus lately...</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>category</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="category"                data-endpoint="POSTapi-forums"
               value="Mind"
               data-component="body">
    <br>
<p>The forum category. Must be one of: Mind, Body, Spirit, Biohacking, Frequency Healing, Holistic Health. Example: <code>Mind</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>sub_category</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="sub_category"                data-endpoint="POSTapi-forums"
               value="Mental Health"
               data-component="body">
    <br>
<p>The forum sub-category. Example: <code>Mental Health</code></p>
        </div>
        </form>

                    <h2 id="forum-management-DELETEapi-forums--id-">Delete a forum</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Soft delete a forum. Only the forum author can delete their own forum.</p>

<span id="example-requests-DELETEapi-forums--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/api/forums/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/forums/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-forums--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Forum deleted successfully&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthorized. You can only delete your own forums.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Forum not found&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-DELETEapi-forums--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-forums--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-forums--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-forums--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-forums--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-forums--id-" data-method="DELETE"
      data-path="api/forums/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-forums--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-forums--id-"
                    onclick="tryItOut('DELETEapi-forums--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-forums--id-"
                    onclick="cancelTryOut('DELETEapi-forums--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-forums--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/forums/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-forums--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-forums--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-forums--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the forum to delete. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="forum-management-POSTapi-forums--id--view">Record a view for a forum</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-forums--id--view">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/forums/architecto/view" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/forums/architecto/view"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-forums--id--view">
</span>
<span id="execution-results-POSTapi-forums--id--view" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-forums--id--view"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-forums--id--view"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-forums--id--view" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-forums--id--view">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-forums--id--view" data-method="POST"
      data-path="api/forums/{id}/view"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-forums--id--view', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-forums--id--view"
                    onclick="tryItOut('POSTapi-forums--id--view');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-forums--id--view"
                    onclick="cancelTryOut('POSTapi-forums--id--view');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-forums--id--view"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/forums/{id}/view</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-forums--id--view"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-forums--id--view"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="POSTapi-forums--id--view"
               value="architecto"
               data-component="url">
    <br>
<p>The ID of the forum. Example: <code>architecto</code></p>
            </div>
                    </form>

                <h1 id="like-management">Like Management</h1>

    <p>APIs for liking/unliking forums and comments</p>

                                <h2 id="like-management-POSTapi-likes">Toggle like</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Like or unlike a forum or comment. If the user has already liked the content, it will be unliked.
If the user hasn't liked it yet, a like will be created. Requires authentication.</p>

<span id="example-requests-POSTapi-likes">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/likes" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"likeable_type\": \"App\\\\Models\\\\Forum\",
    \"likeable_id\": 1
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/likes"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "likeable_type": "App\\Models\\Forum",
    "likeable_id": 1
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-likes">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;liked&quot;: true,
    &quot;like_count&quot;: 13
}</code>
 </pre>
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;liked&quot;: false,
    &quot;like_count&quot;: 12
}</code>
 </pre>
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;The given data was invalid.&quot;,
    &quot;errors&quot;: {
        &quot;likeable_type&quot;: [
            &quot;The likeable type field is required.&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-likes" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-likes"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-likes"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-likes" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-likes">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-likes" data-method="POST"
      data-path="api/likes"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-likes', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-likes"
                    onclick="tryItOut('POSTapi-likes');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-likes"
                    onclick="cancelTryOut('POSTapi-likes');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-likes"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/likes</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-likes"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-likes"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>likeable_type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="likeable_type"                data-endpoint="POSTapi-likes"
               value="App\Models\Forum"
               data-component="body">
    <br>
<p>The type of entity to like. Example: <code>App\Models\Forum</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>likeable_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="likeable_id"                data-endpoint="POSTapi-likes"
               value="1"
               data-component="body">
    <br>
<p>The ID of the entity to like. Example: <code>1</code></p>
        </div>
        </form>

                <h1 id="marketplace">Marketplace</h1>

    <p>APIs for browsing marketplace products and services</p>

                                <h2 id="marketplace-GETapi-marketplace">Get Marketplace Products</h2>

<p>
</p>

<p>Retrieve paginated list of all active products and services from verified vendors.
Supports filtering by type, category, search, and sorting.</p>

<span id="example-requests-GETapi-marketplace">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/marketplace?type=product&amp;category=Photography&amp;search=wedding&amp;sort=latest&amp;page=1&amp;per_page=12" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"type\": \"product\",
    \"category\": \"b\",
    \"search\": \"n\",
    \"sort\": \"price_high\",
    \"page\": 67,
    \"per_page\": 16
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/marketplace"
);

const params = {
    "type": "product",
    "category": "Photography",
    "search": "wedding",
    "sort": "latest",
    "page": "1",
    "per_page": "12",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "type": "product",
    "category": "b",
    "search": "n",
    "sort": "price_high",
    "page": 67,
    "per_page": 16
};

fetch(url, {
    method: "GET",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-marketplace">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;vendor_id&quot;: 1,
            &quot;title&quot;: &quot;Professional Photography Session&quot;,
            &quot;brief&quot;: &quot;Capture your special moments&quot;,
            &quot;description&quot;: &quot;Full description here&quot;,
            &quot;type&quot;: &quot;service&quot;,
            &quot;image_url&quot;: &quot;https://example.com/image.jpg&quot;,
            &quot;active&quot;: true,
            &quot;variants&quot;: [],
            &quot;service_slots&quot;: [
                {
                    &quot;id&quot;: 1,
                    &quot;duration&quot;: 60,
                    &quot;price&quot;: &quot;150.00&quot;
                }
            ],
            &quot;vendor&quot;: {
                &quot;id&quot;: 1,
                &quot;business_name&quot;: &quot;Pixel Perfect Studios&quot;,
                &quot;category&quot;: [
                    &quot;Photography&quot;,
                    &quot;Videography&quot;
                ],
                &quot;city&quot;: &quot;New York&quot;,
                &quot;average_rating&quot;: 4.8,
                &quot;review_count&quot;: 127,
                &quot;is_verified&quot;: true
            },
            &quot;min_price&quot;: &quot;150.00&quot;,
            &quot;created_at&quot;: &quot;2024-01-15T10:00:00.000000Z&quot;
        }
    ],
    &quot;current_page&quot;: 1,
    &quot;last_page&quot;: 3,
    &quot;per_page&quot;: 12,
    &quot;total&quot;: 32
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-marketplace" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-marketplace"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-marketplace"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-marketplace" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-marketplace">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-marketplace" data-method="GET"
      data-path="api/marketplace"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-marketplace', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-marketplace"
                    onclick="tryItOut('GETapi-marketplace');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-marketplace"
                    onclick="cancelTryOut('GETapi-marketplace');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-marketplace"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/marketplace</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-marketplace"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-marketplace"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="type"                data-endpoint="GETapi-marketplace"
               value="product"
               data-component="query">
    <br>
<p>Filter by product type. Allowed values: product, service. Example: <code>product</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>category</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="category"                data-endpoint="GETapi-marketplace"
               value="Photography"
               data-component="query">
    <br>
<p>Filter by vendor category. Example: <code>Photography</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>search</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="search"                data-endpoint="GETapi-marketplace"
               value="wedding"
               data-component="query">
    <br>
<p>Search in title and brief. Example: <code>wedding</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>sort</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="sort"                data-endpoint="GETapi-marketplace"
               value="latest"
               data-component="query">
    <br>
<p>Sort results. Allowed values: latest, price_low, price_high, rating. Default: latest. Example: <code>latest</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="page"                data-endpoint="GETapi-marketplace"
               value="1"
               data-component="query">
    <br>
<p>Page number for pagination. Default: 1. Example: <code>1</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>per_page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_page"                data-endpoint="GETapi-marketplace"
               value="12"
               data-component="query">
    <br>
<p>Items per page. Default: 12. Example: <code>12</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="type"                data-endpoint="GETapi-marketplace"
               value="product"
               data-component="body">
    <br>
<p>Example: <code>product</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>product</code></li> <li><code>service</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>category</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="category"                data-endpoint="GETapi-marketplace"
               value="b"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>b</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>search</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="search"                data-endpoint="GETapi-marketplace"
               value="n"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>n</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>sort</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="sort"                data-endpoint="GETapi-marketplace"
               value="price_high"
               data-component="body">
    <br>
<p>Example: <code>price_high</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>latest</code></li> <li><code>price_low</code></li> <li><code>price_high</code></li> <li><code>rating</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="page"                data-endpoint="GETapi-marketplace"
               value="67"
               data-component="body">
    <br>
<p>Must be at least 1. Example: <code>67</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>per_page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_page"                data-endpoint="GETapi-marketplace"
               value="16"
               data-component="body">
    <br>
<p>Must be at least 1. Must not be greater than 50. Example: <code>16</code></p>
        </div>
        </form>

                <h1 id="order-management">Order Management</h1>

    <p>APIs for managing orders</p>

                                <h2 id="order-management-GETapi-orders">Get User Orders</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retrieve all orders for the authenticated user.</p>

<span id="example-requests-GETapi-orders">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/orders" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/orders"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-orders">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;order_number&quot;: &quot;ORD-ABC123&quot;,
            &quot;total&quot;: 107.17,
            &quot;status&quot;: &quot;paid&quot;,
            &quot;cancellation_type&quot;: null,
            &quot;can_cancel_immediately&quot;: true,
            &quot;time_remaining_minutes&quot;: 25,
            &quot;created_at&quot;: &quot;2024-01-01T00:00:00.000000Z&quot;
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-orders" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-orders"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-orders"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-orders" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-orders">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-orders" data-method="GET"
      data-path="api/orders"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-orders', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-orders"
                    onclick="tryItOut('GETapi-orders');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-orders"
                    onclick="cancelTryOut('GETapi-orders');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-orders"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/orders</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-orders"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-orders"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="order-management-GETapi-orders--order_id-">Get Order Details</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retrieve detailed information about a specific order.</p>

<span id="example-requests-GETapi-orders--order_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/orders/7" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/orders/7"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-orders--order_id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;order_number&quot;: &quot;ORD-ABC123&quot;,
        &quot;total&quot;: 107.17,
        &quot;status&quot;: &quot;paid&quot;,
        &quot;cancellation_type&quot;: null,
        &quot;cancellation_requested_at&quot;: null,
        &quot;cancellation_reason&quot;: null,
        &quot;items&quot;: [],
        &quot;address&quot;: {}
    },
    &quot;cancellation_info&quot;: {
        &quot;can_cancel_immediately&quot;: true,
        &quot;can_request_cancellation&quot;: true,
        &quot;time_remaining_minutes&quot;: 25,
        &quot;cancellation_deadline&quot;: &quot;2024-01-01T00:30:00.000000Z&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-orders--order_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-orders--order_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-orders--order_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-orders--order_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-orders--order_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-orders--order_id-" data-method="GET"
      data-path="api/orders/{order_id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-orders--order_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-orders--order_id-"
                    onclick="tryItOut('GETapi-orders--order_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-orders--order_id-"
                    onclick="cancelTryOut('GETapi-orders--order_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-orders--order_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/orders/{order_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-orders--order_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-orders--order_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>order_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="order_id"                data-endpoint="GETapi-orders--order_id-"
               value="7"
               data-component="url">
    <br>
<p>The ID of the order. Example: <code>7</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>order</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="order"                data-endpoint="GETapi-orders--order_id-"
               value="1"
               data-component="url">
    <br>
<p>The order ID. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="order-management-GETapi-orders--order_id--cancellation-status">Check Cancellation Status</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Check if an order can be cancelled and what type of cancellation is available.</p>

<span id="example-requests-GETapi-orders--order_id--cancellation-status">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/orders/7/cancellation-status" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/orders/7/cancellation-status"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-orders--order_id--cancellation-status">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;can_cancel_immediately&quot;: true,
    &quot;can_request_cancellation&quot;: true,
    &quot;time_remaining_minutes&quot;: 25,
    &quot;cancellation_deadline&quot;: &quot;2024-01-01T00:30:00.000000Z&quot;,
    &quot;current_status&quot;: &quot;paid&quot;,
    &quot;message&quot;: &quot;You can cancel this order immediately for the next 25 minutes.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (200, After 30 Minutes):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;can_cancel_immediately&quot;: false,
    &quot;can_request_cancellation&quot;: true,
    &quot;time_remaining_minutes&quot;: 0,
    &quot;cancellation_deadline&quot;: &quot;2024-01-01T00:30:00.000000Z&quot;,
    &quot;current_status&quot;: &quot;paid&quot;,
    &quot;message&quot;: &quot;You can request cancellation. The vendor will need to approve your request.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-orders--order_id--cancellation-status" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-orders--order_id--cancellation-status"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-orders--order_id--cancellation-status"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-orders--order_id--cancellation-status" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-orders--order_id--cancellation-status">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-orders--order_id--cancellation-status" data-method="GET"
      data-path="api/orders/{order_id}/cancellation-status"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-orders--order_id--cancellation-status', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-orders--order_id--cancellation-status"
                    onclick="tryItOut('GETapi-orders--order_id--cancellation-status');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-orders--order_id--cancellation-status"
                    onclick="cancelTryOut('GETapi-orders--order_id--cancellation-status');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-orders--order_id--cancellation-status"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/orders/{order_id}/cancellation-status</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-orders--order_id--cancellation-status"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-orders--order_id--cancellation-status"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>order_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="order_id"                data-endpoint="GETapi-orders--order_id--cancellation-status"
               value="7"
               data-component="url">
    <br>
<p>The ID of the order. Example: <code>7</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>order</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="order"                data-endpoint="GETapi-orders--order_id--cancellation-status"
               value="1"
               data-component="url">
    <br>
<p>The order ID. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="order-management-POSTapi-orders--order_id--cancel">Cancel Order</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Cancel an order immediately (within 30 minutes) or request cancellation (after 30 minutes).</p>
<ul>
<li><strong>Within 30 minutes</strong>: Order is cancelled immediately</li>
<li><strong>After 30 minutes</strong>: Cancellation request is sent to vendor for approval</li>
</ul>

<span id="example-requests-POSTapi-orders--order_id--cancel">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/orders/7/cancel" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"reason\": \"Changed my mind\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/orders/7/cancel"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "reason": "Changed my mind"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-orders--order_id--cancel">
            <blockquote>
            <p>Example response (200, Immediate Cancellation):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Order cancelled successfully&quot;,
    &quot;cancellation_type&quot;: &quot;immediate&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;order_number&quot;: &quot;ORD-ABC123&quot;,
        &quot;status&quot;: &quot;cancelled&quot;,
        &quot;cancellation_type&quot;: &quot;immediate&quot;,
        &quot;cancelled_by&quot;: &quot;user&quot;,
        &quot;cancellation_reason&quot;: &quot;Changed my mind&quot;,
        &quot;cancellation_requested_at&quot;: &quot;2024-01-01T00:15:00.000000Z&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (200, Cancellation Request):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Cancellation request sent to vendor. You will be notified once the vendor responds.&quot;,
    &quot;cancellation_type&quot;: &quot;requested&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;order_number&quot;: &quot;ORD-ABC123&quot;,
        &quot;status&quot;: &quot;cancellation_requested&quot;,
        &quot;cancellation_type&quot;: &quot;requested&quot;,
        &quot;cancellation_reason&quot;: &quot;Changed my mind&quot;,
        &quot;cancellation_requested_at&quot;: &quot;2024-01-01T01:00:00.000000Z&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Cannot Cancel):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Order cannot be cancelled at this time&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-orders--order_id--cancel" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-orders--order_id--cancel"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-orders--order_id--cancel"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-orders--order_id--cancel" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-orders--order_id--cancel">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-orders--order_id--cancel" data-method="POST"
      data-path="api/orders/{order_id}/cancel"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-orders--order_id--cancel', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-orders--order_id--cancel"
                    onclick="tryItOut('POSTapi-orders--order_id--cancel');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-orders--order_id--cancel"
                    onclick="cancelTryOut('POSTapi-orders--order_id--cancel');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-orders--order_id--cancel"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/orders/{order_id}/cancel</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-orders--order_id--cancel"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-orders--order_id--cancel"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>order_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="order_id"                data-endpoint="POSTapi-orders--order_id--cancel"
               value="7"
               data-component="url">
    <br>
<p>The ID of the order. Example: <code>7</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>order</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="order"                data-endpoint="POSTapi-orders--order_id--cancel"
               value="1"
               data-component="url">
    <br>
<p>The order ID. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>reason</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="reason"                data-endpoint="POSTapi-orders--order_id--cancel"
               value="Changed my mind"
               data-component="body">
    <br>
<p>optional Reason for cancellation. Example: <code>Changed my mind</code></p>
        </div>
        </form>

                <h1 id="practitioner-applications">Practitioner Applications</h1>

    <p>APIs for managing practitioner/healer applications</p>

                                <h2 id="practitioner-applications-POSTapi-practitioners-applications">Submit Practitioner Application</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Submit a new application to become a practitioner on the platform.
Users can upload up to 5 credential documents (PDF/JPG, max 5MB each).
Only one pending application is allowed per user.</p>

<span id="example-requests-POSTapi-practitioners-applications">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/practitioners/applications" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"phone_number\": \"+1234567890\",
    \"professional_title\": \"Licensed Massage Therapist\",
    \"years_experience\": \"5-10\",
    \"bio\": \"Experienced massage therapist specializing in...\",
    \"license_number\": \"LMT123456\",
    \"issuing_organization\": \"State Board of Massage\",
    \"credentials\": [
        {
            \"file\": \"...\",
            \"document_type\": \"license\"
        }
    ],
    \"primary_category_id\": 1,
    \"service_subcategories\": [
        1,
        2,
        3
    ],
    \"service_description\": \"I specialize in deep tissue massage...\",
    \"availability_schedule\": {
        \"monday\": {
            \"morning\": true,
            \"afternoon\": false,
            \"evening\": true
        },
        \"0\": {
            \"morning\": true,
            \"afternoon\": true,
            \"evening\": false
        }
    },
    \"timezone\": \"America\\/New_York\",
    \"terms_agreed\": true
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/practitioners/applications"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "phone_number": "+1234567890",
    "professional_title": "Licensed Massage Therapist",
    "years_experience": "5-10",
    "bio": "Experienced massage therapist specializing in...",
    "license_number": "LMT123456",
    "issuing_organization": "State Board of Massage",
    "credentials": [
        {
            "file": "...",
            "document_type": "license"
        }
    ],
    "primary_category_id": 1,
    "service_subcategories": [
        1,
        2,
        3
    ],
    "service_description": "I specialize in deep tissue massage...",
    "availability_schedule": {
        "monday": {
            "morning": true,
            "afternoon": false,
            "evening": true
        },
        "0": {
            "morning": true,
            "afternoon": true,
            "evening": false
        }
    },
    "timezone": "America\/New_York",
    "terms_agreed": true
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-practitioners-applications">
            <blockquote>
            <p>Example response (201):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Application submitted successfully. We will review within 3-5 business days.&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;user_id&quot;: 123,
        &quot;status&quot;: &quot;pending&quot;,
        &quot;professional_title&quot;: &quot;Licensed Massage Therapist&quot;,
        &quot;submitted_at&quot;: &quot;2024-02-08T14:30:00Z&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (403):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;You already have a pending application.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;Validation failed&quot;,
    &quot;errors&quot;: {
        &quot;bio&quot;: [
            &quot;The bio must not exceed 500 characters.&quot;
        ],
        &quot;credentials&quot;: [
            &quot;At least one credential document is required.&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-practitioners-applications" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-practitioners-applications"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-practitioners-applications"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-practitioners-applications" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-practitioners-applications">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-practitioners-applications" data-method="POST"
      data-path="api/practitioners/applications"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-practitioners-applications', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-practitioners-applications"
                    onclick="tryItOut('POSTapi-practitioners-applications');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-practitioners-applications"
                    onclick="cancelTryOut('POSTapi-practitioners-applications');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-practitioners-applications"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/practitioners/applications</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-practitioners-applications"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-practitioners-applications"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>phone_number</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="phone_number"                data-endpoint="POSTapi-practitioners-applications"
               value="+1234567890"
               data-component="body">
    <br>
<p>The practitioner's phone number. Example: <code>+1234567890</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>professional_title</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="professional_title"                data-endpoint="POSTapi-practitioners-applications"
               value="Licensed Massage Therapist"
               data-component="body">
    <br>
<p>Professional title or credentials. Example: <code>Licensed Massage Therapist</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>years_experience</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="years_experience"                data-endpoint="POSTapi-practitioners-applications"
               value="5-10"
               data-component="body">
    <br>
<p>Years of experience. Example: <code>5-10</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>bio</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="bio"                data-endpoint="POSTapi-practitioners-applications"
               value="Experienced massage therapist specializing in..."
               data-component="body">
    <br>
<p>Bio/About me (max 500 characters). Example: <code>Experienced massage therapist specializing in...</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>license_number</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="license_number"                data-endpoint="POSTapi-practitioners-applications"
               value="LMT123456"
               data-component="body">
    <br>
<p>optional License or certification number. Example: <code>LMT123456</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>issuing_organization</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="issuing_organization"                data-endpoint="POSTapi-practitioners-applications"
               value="State Board of Massage"
               data-component="body">
    <br>
<p>optional Issuing organization name. Example: <code>State Board of Massage</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
        <details>
            <summary style="padding-bottom: 10px;">
                <b style="line-height: 2;"><code>credentials</code></b>&nbsp;&nbsp;
<small>string[]</small>&nbsp;
 &nbsp;
 &nbsp;
<br>
<p>Array of credential files (1-5 files).</p>
            </summary>
                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>file</code></b>&nbsp;&nbsp;
<small>file</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="file" style="display: none"
                              name="credentials.0.file"                data-endpoint="POSTapi-practitioners-applications"
               value=""
               data-component="body">
    <br>
<p>Must be a file. Must not be greater than 5120 kilobytes. Example: <code>/tmp/php2k2h8dbju6i36BlfXz3</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>document_type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="credentials.0.document_type"                data-endpoint="POSTapi-practitioners-applications"
               value="other"
               data-component="body">
    <br>
<p>Example: <code>other</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>certification</code></li> <li><code>license</code></li> <li><code>credential</code></li> <li><code>other</code></li></ul>
                    </div>
                                                                <div style=" margin-left: 14px; clear: unset;">
        <details>
            <summary style="padding-bottom: 10px;">
                <b style="line-height: 2;"><code>*</code></b>&nbsp;&nbsp;
<small>object</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
<br>

            </summary>
                                                <div style="margin-left: 28px; clear: unset;">
                        <b style="line-height: 2;"><code>file</code></b>&nbsp;&nbsp;
<small>file</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="file" style="display: none"
                              name="credentials.*.file"                data-endpoint="POSTapi-practitioners-applications"
               value=""
               data-component="body">
    <br>
<p>Credential document file (PDF/JPG/PNG, max 5MB). Example: <code>/tmp/phpgmv28e507i1ed4ZjVNA</code></p>
                    </div>
                                                                <div style="margin-left: 28px; clear: unset;">
                        <b style="line-height: 2;"><code>document_type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="credentials.*.document_type"                data-endpoint="POSTapi-practitioners-applications"
               value="license"
               data-component="body">
    <br>
<p>Type of document. Example: <code>license</code></p>
                    </div>
                                    </details>
        </div>
                                        </details>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>primary_category_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="primary_category_id"                data-endpoint="POSTapi-practitioners-applications"
               value="1"
               data-component="body">
    <br>
<p>Primary service category ID. Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>service_subcategories</code></b>&nbsp;&nbsp;
<small>string[]</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="service_subcategories[0]"                data-endpoint="POSTapi-practitioners-applications"
               data-component="body">
        <input type="text" style="display: none"
               name="service_subcategories[1]"                data-endpoint="POSTapi-practitioners-applications"
               data-component="body">
    <br>
<p>Array of service subcategory IDs.</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>service_description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="service_description"                data-endpoint="POSTapi-practitioners-applications"
               value="I specialize in deep tissue massage..."
               data-component="body">
    <br>
<p>Description of services offered (max 1000 characters). Example: <code>I specialize in deep tissue massage...</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
        <details>
            <summary style="padding-bottom: 10px;">
                <b style="line-height: 2;"><code>availability_schedule</code></b>&nbsp;&nbsp;
<small>object</small>&nbsp;
 &nbsp;
 &nbsp;
<br>
<p>Weekly availability schedule.</p>
            </summary>
                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>morning</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="POSTapi-practitioners-applications" style="display: none">
            <input type="radio" name="availability_schedule.0.morning"
                   value="true"
                   data-endpoint="POSTapi-practitioners-applications"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-practitioners-applications" style="display: none">
            <input type="radio" name="availability_schedule.0.morning"
                   value="false"
                   data-endpoint="POSTapi-practitioners-applications"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>true</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>afternoon</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="POSTapi-practitioners-applications" style="display: none">
            <input type="radio" name="availability_schedule.0.afternoon"
                   value="true"
                   data-endpoint="POSTapi-practitioners-applications"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-practitioners-applications" style="display: none">
            <input type="radio" name="availability_schedule.0.afternoon"
                   value="false"
                   data-endpoint="POSTapi-practitioners-applications"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>true</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>evening</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="POSTapi-practitioners-applications" style="display: none">
            <input type="radio" name="availability_schedule.0.evening"
                   value="true"
                   data-endpoint="POSTapi-practitioners-applications"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-practitioners-applications" style="display: none">
            <input type="radio" name="availability_schedule.0.evening"
                   value="false"
                   data-endpoint="POSTapi-practitioners-applications"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>false</code></p>
                    </div>
                                    </details>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>timezone</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="timezone"                data-endpoint="POSTapi-practitioners-applications"
               value="America/New_York"
               data-component="body">
    <br>
<p>Timezone. Example: <code>America/New_York</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>terms_agreed</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
 &nbsp;
 &nbsp;
                <label data-endpoint="POSTapi-practitioners-applications" style="display: none">
            <input type="radio" name="terms_agreed"
                   value="true"
                   data-endpoint="POSTapi-practitioners-applications"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-practitioners-applications" style="display: none">
            <input type="radio" name="terms_agreed"
                   value="false"
                   data-endpoint="POSTapi-practitioners-applications"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Must agree to terms of service. Example: <code>true</code></p>
        </div>
        </form>

                    <h2 id="practitioner-applications-GETapi-practitioners-applications-my-application">Get My Application</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retrieve the current authenticated user's latest practitioner application.</p>

<span id="example-requests-GETapi-practitioners-applications-my-application">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/practitioners/applications/my-application" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/practitioners/applications/my-application"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-practitioners-applications-my-application">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;user_id&quot;: 123,
        &quot;status&quot;: &quot;pending&quot;,
        &quot;professional_title&quot;: &quot;Licensed Massage Therapist&quot;,
        &quot;years_experience&quot;: &quot;5-10&quot;,
        &quot;primary_category&quot;: {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;Body-Based Services&quot;
        },
        &quot;services&quot;: [
            {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Massage Therapy&quot;
            }
        ],
        &quot;documents&quot;: [
            {
                &quot;id&quot;: 1,
                &quot;file_name&quot;: &quot;license.pdf&quot;,
                &quot;document_type&quot;: &quot;license&quot;,
                &quot;file_size_mb&quot;: 1.2
            }
        ],
        &quot;rejection_reason&quot;: null,
        &quot;reviewed_at&quot;: null,
        &quot;submitted_at&quot;: &quot;2024-02-08T14:30:00Z&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;No application found.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-practitioners-applications-my-application" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-practitioners-applications-my-application"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-practitioners-applications-my-application"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-practitioners-applications-my-application" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-practitioners-applications-my-application">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-practitioners-applications-my-application" data-method="GET"
      data-path="api/practitioners/applications/my-application"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-practitioners-applications-my-application', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-practitioners-applications-my-application"
                    onclick="tryItOut('GETapi-practitioners-applications-my-application');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-practitioners-applications-my-application"
                    onclick="cancelTryOut('GETapi-practitioners-applications-my-application');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-practitioners-applications-my-application"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/practitioners/applications/my-application</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-practitioners-applications-my-application"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-practitioners-applications-my-application"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="practitioner-applications-GETapi-practitioners-applications-check-pending">Check Pending Application Status</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Check if the current user has a pending practitioner application.
Useful for determining whether to show the application form.</p>

<span id="example-requests-GETapi-practitioners-applications-check-pending">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/practitioners/applications/check-pending" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/practitioners/applications/check-pending"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-practitioners-applications-check-pending">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;has_pending_application&quot;: true
}</code>
 </pre>
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;has_pending_application&quot;: false
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-practitioners-applications-check-pending" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-practitioners-applications-check-pending"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-practitioners-applications-check-pending"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-practitioners-applications-check-pending" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-practitioners-applications-check-pending">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-practitioners-applications-check-pending" data-method="GET"
      data-path="api/practitioners/applications/check-pending"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-practitioners-applications-check-pending', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-practitioners-applications-check-pending"
                    onclick="tryItOut('GETapi-practitioners-applications-check-pending');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-practitioners-applications-check-pending"
                    onclick="cancelTryOut('GETapi-practitioners-applications-check-pending');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-practitioners-applications-check-pending"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/practitioners/applications/check-pending</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-practitioners-applications-check-pending"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-practitioners-applications-check-pending"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="practitioner-applications-GETapi-practitioners-applications--id-">Get Application Details</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retrieve details of a specific practitioner application.
Users can only view their own applications. Admins can view any application.</p>

<span id="example-requests-GETapi-practitioners-applications--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/practitioners/applications/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/practitioners/applications/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-practitioners-applications--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;user_id&quot;: 123,
        &quot;status&quot;: &quot;pending&quot;,
        &quot;professional_title&quot;: &quot;Licensed Massage Therapist&quot;,
        &quot;bio&quot;: &quot;Experienced therapist...&quot;,
        &quot;documents&quot;: [],
        &quot;submitted_at&quot;: &quot;2024-02-08T14:30:00Z&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (403):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;Unauthorized.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;Application not found.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-practitioners-applications--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-practitioners-applications--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-practitioners-applications--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-practitioners-applications--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-practitioners-applications--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-practitioners-applications--id-" data-method="GET"
      data-path="api/practitioners/applications/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-practitioners-applications--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-practitioners-applications--id-"
                    onclick="tryItOut('GETapi-practitioners-applications--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-practitioners-applications--id-"
                    onclick="cancelTryOut('GETapi-practitioners-applications--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-practitioners-applications--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/practitioners/applications/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-practitioners-applications--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-practitioners-applications--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-practitioners-applications--id-"
               value="1"
               data-component="url">
    <br>
<p>The application ID. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="practitioner-applications-GETapi-admin-practitioners-applications">Get All Applications (Admin)</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retrieve all practitioner applications with filtering and sorting options.
Admin access required.</p>

<span id="example-requests-GETapi-admin-practitioners-applications">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/admin/practitioners/applications?status=pending&amp;category_id=1&amp;sort_by=submitted_at&amp;sort_order=desc&amp;per_page=15" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/admin/practitioners/applications"
);

const params = {
    "status": "pending",
    "category_id": "1",
    "sort_by": "submitted_at",
    "sort_order": "desc",
    "per_page": "15",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-admin-practitioners-applications">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;user&quot;: {
                &quot;id&quot;: 123,
                &quot;name&quot;: &quot;Jane Smith&quot;,
                &quot;email&quot;: &quot;jane@example.com&quot;
            },
            &quot;status&quot;: &quot;pending&quot;,
            &quot;professional_title&quot;: &quot;Licensed Massage Therapist&quot;,
            &quot;submitted_at&quot;: &quot;2024-02-08T14:30:00Z&quot;
        }
    ],
    &quot;meta&quot;: {
        &quot;current_page&quot;: 1,
        &quot;last_page&quot;: 3,
        &quot;per_page&quot;: 15,
        &quot;total&quot;: 42
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (403):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;Unauthorized. Admin access required.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-admin-practitioners-applications" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-admin-practitioners-applications"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-admin-practitioners-applications"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-admin-practitioners-applications" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-admin-practitioners-applications">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-admin-practitioners-applications" data-method="GET"
      data-path="api/admin/practitioners/applications"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-admin-practitioners-applications', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-admin-practitioners-applications"
                    onclick="tryItOut('GETapi-admin-practitioners-applications');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-admin-practitioners-applications"
                    onclick="cancelTryOut('GETapi-admin-practitioners-applications');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-admin-practitioners-applications"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/admin/practitioners/applications</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-admin-practitioners-applications"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-admin-practitioners-applications"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="GETapi-admin-practitioners-applications"
               value="pending"
               data-component="query">
    <br>
<p>Filter by status: &quot;pending&quot;, &quot;approved&quot;, or &quot;rejected&quot;. Example: <code>pending</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>category_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="category_id"                data-endpoint="GETapi-admin-practitioners-applications"
               value="1"
               data-component="query">
    <br>
<p>Filter by primary category ID. Example: <code>1</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>sort_by</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="sort_by"                data-endpoint="GETapi-admin-practitioners-applications"
               value="submitted_at"
               data-component="query">
    <br>
<p>Field to sort by. Example: <code>submitted_at</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>sort_order</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="sort_order"                data-endpoint="GETapi-admin-practitioners-applications"
               value="desc"
               data-component="query">
    <br>
<p>Sort order: &quot;asc&quot; or &quot;desc&quot;. Example: <code>desc</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>per_page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_page"                data-endpoint="GETapi-admin-practitioners-applications"
               value="15"
               data-component="query">
    <br>
<p>Number of results per page. Example: <code>15</code></p>
            </div>
                </form>

                    <h2 id="practitioner-applications-GETapi-admin-practitioners-applications-pending">Get Pending Applications (Admin)</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retrieve all pending practitioner applications for admin review.
Admin access required.</p>

<span id="example-requests-GETapi-admin-practitioners-applications-pending">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/admin/practitioners/applications/pending" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/admin/practitioners/applications/pending"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-admin-practitioners-applications-pending">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;user&quot;: {
                &quot;id&quot;: 123,
                &quot;name&quot;: &quot;Jane Smith&quot;,
                &quot;email&quot;: &quot;jane@example.com&quot;
            },
            &quot;professional_title&quot;: &quot;Licensed Massage Therapist&quot;,
            &quot;years_experience&quot;: &quot;5-10&quot;,
            &quot;primary_category&quot;: {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Body-Based Services&quot;
            },
            &quot;submitted_at&quot;: &quot;2024-02-08T14:30:00Z&quot;
        }
    ],
    &quot;count&quot;: 5
}</code>
 </pre>
            <blockquote>
            <p>Example response (403):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;Unauthorized. Admin access required.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-admin-practitioners-applications-pending" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-admin-practitioners-applications-pending"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-admin-practitioners-applications-pending"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-admin-practitioners-applications-pending" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-admin-practitioners-applications-pending">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-admin-practitioners-applications-pending" data-method="GET"
      data-path="api/admin/practitioners/applications/pending"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-admin-practitioners-applications-pending', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-admin-practitioners-applications-pending"
                    onclick="tryItOut('GETapi-admin-practitioners-applications-pending');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-admin-practitioners-applications-pending"
                    onclick="cancelTryOut('GETapi-admin-practitioners-applications-pending');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-admin-practitioners-applications-pending"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/admin/practitioners/applications/pending</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-admin-practitioners-applications-pending"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-admin-practitioners-applications-pending"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="practitioner-applications-POSTapi-admin-practitioners-applications--id--review">Review Application (Admin)</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Approve or reject a practitioner application. Admin access required.
When approved, a practitioner profile is automatically created.
Email notifications are sent to the applicant.</p>

<span id="example-requests-POSTapi-admin-practitioners-applications--id--review">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/admin/practitioners/applications/1/review" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"action\": \"approve\",
    \"rejection_reason\": \"Insufficient credentials provided.\",
    \"admin_notes\": \"Follow up in 6 months.\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/admin/practitioners/applications/1/review"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "action": "approve",
    "rejection_reason": "Insufficient credentials provided.",
    "admin_notes": "Follow up in 6 months."
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-admin-practitioners-applications--id--review">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Application approved successfully.&quot;,
    &quot;data&quot;: {
        &quot;application&quot;: {
            &quot;id&quot;: 1,
            &quot;status&quot;: &quot;approved&quot;,
            &quot;reviewed_by&quot;: 1,
            &quot;reviewed_at&quot;: &quot;2024-02-08T15:00:00Z&quot;
        },
        &quot;profile_id&quot;: 1
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Application rejected.&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;status&quot;: &quot;rejected&quot;,
        &quot;rejection_reason&quot;: &quot;Insufficient credentials...&quot;,
        &quot;reviewed_at&quot;: &quot;2024-02-08T15:00:00Z&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;Application has already been reviewed.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;Application not found.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-admin-practitioners-applications--id--review" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-admin-practitioners-applications--id--review"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-admin-practitioners-applications--id--review"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-admin-practitioners-applications--id--review" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-admin-practitioners-applications--id--review">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-admin-practitioners-applications--id--review" data-method="POST"
      data-path="api/admin/practitioners/applications/{id}/review"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-admin-practitioners-applications--id--review', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-admin-practitioners-applications--id--review"
                    onclick="tryItOut('POSTapi-admin-practitioners-applications--id--review');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-admin-practitioners-applications--id--review"
                    onclick="cancelTryOut('POSTapi-admin-practitioners-applications--id--review');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-admin-practitioners-applications--id--review"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/admin/practitioners/applications/{id}/review</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-admin-practitioners-applications--id--review"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-admin-practitioners-applications--id--review"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="POSTapi-admin-practitioners-applications--id--review"
               value="1"
               data-component="url">
    <br>
<p>The application ID. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>action</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="action"                data-endpoint="POSTapi-admin-practitioners-applications--id--review"
               value="approve"
               data-component="body">
    <br>
<p>Action to take: &quot;approve&quot; or &quot;reject&quot;. Example: <code>approve</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>rejection_reason</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="rejection_reason"                data-endpoint="POSTapi-admin-practitioners-applications--id--review"
               value="Insufficient credentials provided."
               data-component="body">
    <br>
<p>optional Reason for rejection (required if action is &quot;reject&quot;). Example: <code>Insufficient credentials provided.</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>admin_notes</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="admin_notes"                data-endpoint="POSTapi-admin-practitioners-applications--id--review"
               value="Follow up in 6 months."
               data-component="body">
    <br>
<p>optional Internal notes not shown to applicant. Example: <code>Follow up in 6 months.</code></p>
        </div>
        </form>

                <h1 id="practitioner-profiles">Practitioner Profiles</h1>

    <p>APIs for browsing and managing practitioner profiles</p>

                                <h2 id="practitioner-profiles-GETapi-practitioners-profiles">List All Practitioners</h2>

<p>
</p>

<p>Get a paginated list of all active practitioner profiles with filtering,
searching, and sorting capabilities. Public endpoint, no authentication required.</p>

<span id="example-requests-GETapi-practitioners-profiles">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/practitioners/profiles?category_id=1&amp;service_id=5&amp;accepting_clients=1&amp;search=massage&amp;sort_by=rating&amp;sort_order=desc&amp;per_page=20" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/practitioners/profiles"
);

const params = {
    "category_id": "1",
    "service_id": "5",
    "accepting_clients": "1",
    "search": "massage",
    "sort_by": "rating",
    "sort_order": "desc",
    "per_page": "20",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-practitioners-profiles">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;user_id&quot;: 123,
            &quot;user&quot;: {
                &quot;id&quot;: 123,
                &quot;name&quot;: &quot;Jane Smith&quot;
            },
            &quot;phone_number&quot;: &quot;+1234567890&quot;,
            &quot;professional_title&quot;: &quot;Licensed Massage Therapist&quot;,
            &quot;years_experience&quot;: &quot;5-10&quot;,
            &quot;bio&quot;: &quot;Experienced therapist...&quot;,
            &quot;primary_category&quot;: {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Body-Based Services&quot;
            },
            &quot;services&quot;: [
                {
                    &quot;id&quot;: 1,
                    &quot;name&quot;: &quot;Massage Therapy&quot;
                }
            ],
            &quot;is_accepting_clients&quot;: true,
            &quot;statistics&quot;: {
                &quot;total_bookings&quot;: 45,
                &quot;average_rating&quot;: 4.85,
                &quot;total_reviews&quot;: 23
            },
            &quot;approved_at&quot;: &quot;2024-01-15T10:30:00Z&quot;
        }
    ],
    &quot;meta&quot;: {
        &quot;current_page&quot;: 1,
        &quot;last_page&quot;: 5,
        &quot;per_page&quot;: 20,
        &quot;total&quot;: 87
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-practitioners-profiles" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-practitioners-profiles"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-practitioners-profiles"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-practitioners-profiles" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-practitioners-profiles">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-practitioners-profiles" data-method="GET"
      data-path="api/practitioners/profiles"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-practitioners-profiles', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-practitioners-profiles"
                    onclick="tryItOut('GETapi-practitioners-profiles');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-practitioners-profiles"
                    onclick="cancelTryOut('GETapi-practitioners-profiles');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-practitioners-profiles"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/practitioners/profiles</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-practitioners-profiles"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-practitioners-profiles"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>category_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="category_id"                data-endpoint="GETapi-practitioners-profiles"
               value="1"
               data-component="query">
    <br>
<p>Filter by primary service category. Example: <code>1</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>service_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="service_id"                data-endpoint="GETapi-practitioners-profiles"
               value="5"
               data-component="query">
    <br>
<p>Filter by specific service subcategory. Example: <code>5</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>accepting_clients</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="GETapi-practitioners-profiles" style="display: none">
            <input type="radio" name="accepting_clients"
                   value="1"
                   data-endpoint="GETapi-practitioners-profiles"
                   data-component="query"             >
            <code>true</code>
        </label>
        <label data-endpoint="GETapi-practitioners-profiles" style="display: none">
            <input type="radio" name="accepting_clients"
                   value="0"
                   data-endpoint="GETapi-practitioners-profiles"
                   data-component="query"             >
            <code>false</code>
        </label>
    <br>
<p>Only show practitioners accepting new clients. Example: <code>true</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>search</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="search"                data-endpoint="GETapi-practitioners-profiles"
               value="massage"
               data-component="query">
    <br>
<p>Search by practitioner name or professional title. Example: <code>massage</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>sort_by</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="sort_by"                data-endpoint="GETapi-practitioners-profiles"
               value="rating"
               data-component="query">
    <br>
<p>Sort field: &quot;created_at&quot;, &quot;rating&quot;, or &quot;bookings&quot;. Example: <code>rating</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>sort_order</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="sort_order"                data-endpoint="GETapi-practitioners-profiles"
               value="desc"
               data-component="query">
    <br>
<p>Sort order: &quot;asc&quot; or &quot;desc&quot;. Example: <code>desc</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>per_page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_page"                data-endpoint="GETapi-practitioners-profiles"
               value="20"
               data-component="query">
    <br>
<p>Results per page (1-100). Example: <code>20</code></p>
            </div>
                </form>

                    <h2 id="practitioner-profiles-GETapi-practitioners-profiles--id-">Get Practitioner Profile</h2>

<p>
</p>

<p>Retrieve detailed information about a specific practitioner.
Public endpoint, no authentication required.</p>

<span id="example-requests-GETapi-practitioners-profiles--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/practitioners/profiles/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/practitioners/profiles/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-practitioners-profiles--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;user&quot;: {
            &quot;id&quot;: 123,
            &quot;name&quot;: &quot;Jane Smith&quot;
        },
        &quot;professional_title&quot;: &quot;Licensed Massage Therapist&quot;,
        &quot;years_experience&quot;: &quot;5-10&quot;,
        &quot;bio&quot;: &quot;I am an experienced massage therapist...&quot;,
        &quot;license_number&quot;: &quot;LMT123456&quot;,
        &quot;issuing_organization&quot;: &quot;State Board of Massage&quot;,
        &quot;primary_category&quot;: {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;Body-Based Services&quot;
        },
        &quot;services&quot;: [
            {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Massage Therapy&quot;
            },
            {
                &quot;id&quot;: 2,
                &quot;name&quot;: &quot;Acupuncture&quot;
            }
        ],
        &quot;service_description&quot;: &quot;I specialize in deep tissue massage...&quot;,
        &quot;availability_schedule&quot;: {
            &quot;monday&quot;: {
                &quot;morning&quot;: true,
                &quot;afternoon&quot;: false,
                &quot;evening&quot;: true
            },
            &quot;tuesday&quot;: {
                &quot;morning&quot;: true,
                &quot;afternoon&quot;: true,
                &quot;evening&quot;: false
            }
        },
        &quot;timezone&quot;: &quot;America/New_York&quot;,
        &quot;is_active&quot;: true,
        &quot;is_accepting_clients&quot;: true,
        &quot;profile_image_url&quot;: &quot;https://example.com/image.jpg&quot;,
        &quot;statistics&quot;: {
            &quot;total_bookings&quot;: 45,
            &quot;average_rating&quot;: 4.85,
            &quot;total_reviews&quot;: 23
        },
        &quot;approved_at&quot;: &quot;2024-01-15T10:30:00Z&quot;,
        &quot;created_at&quot;: &quot;2024-01-15T10:30:00Z&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;Practitioner profile not found.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-practitioners-profiles--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-practitioners-profiles--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-practitioners-profiles--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-practitioners-profiles--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-practitioners-profiles--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-practitioners-profiles--id-" data-method="GET"
      data-path="api/practitioners/profiles/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-practitioners-profiles--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-practitioners-profiles--id-"
                    onclick="tryItOut('GETapi-practitioners-profiles--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-practitioners-profiles--id-"
                    onclick="cancelTryOut('GETapi-practitioners-profiles--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-practitioners-profiles--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/practitioners/profiles/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-practitioners-profiles--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-practitioners-profiles--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-practitioners-profiles--id-"
               value="1"
               data-component="url">
    <br>
<p>The practitioner profile ID. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="practitioner-profiles-GETapi-practitioners-profiles-top-rated">Get Top Rated Practitioners</h2>

<p>
</p>

<p>Retrieve a list of the highest-rated practitioners.
Only includes active practitioners accepting clients.
Public endpoint, no authentication required.</p>

<span id="example-requests-GETapi-practitioners-profiles-top-rated">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/practitioners/profiles/top-rated?limit=10" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/practitioners/profiles/top-rated"
);

const params = {
    "limit": "10",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-practitioners-profiles-top-rated">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;user&quot;: {
                &quot;id&quot;: 123,
                &quot;name&quot;: &quot;Jane Smith&quot;
            },
            &quot;professional_title&quot;: &quot;Licensed Massage Therapist&quot;,
            &quot;statistics&quot;: {
                &quot;average_rating&quot;: 4.95,
                &quot;total_reviews&quot;: 120,
                &quot;total_bookings&quot;: 250
            }
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-practitioners-profiles-top-rated" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-practitioners-profiles-top-rated"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-practitioners-profiles-top-rated"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-practitioners-profiles-top-rated" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-practitioners-profiles-top-rated">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-practitioners-profiles-top-rated" data-method="GET"
      data-path="api/practitioners/profiles/top-rated"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-practitioners-profiles-top-rated', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-practitioners-profiles-top-rated"
                    onclick="tryItOut('GETapi-practitioners-profiles-top-rated');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-practitioners-profiles-top-rated"
                    onclick="cancelTryOut('GETapi-practitioners-profiles-top-rated');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-practitioners-profiles-top-rated"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/practitioners/profiles/top-rated</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-practitioners-profiles-top-rated"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-practitioners-profiles-top-rated"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>limit</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="limit"                data-endpoint="GETapi-practitioners-profiles-top-rated"
               value="10"
               data-component="query">
    <br>
<p>Number of practitioners to return (1-50). Example: <code>10</code></p>
            </div>
                </form>

                    <h2 id="practitioner-profiles-GETapi-practitioners-profiles-category--categoryId-">Get Practitioners by Category</h2>

<p>
</p>

<p>Retrieve practitioners in a specific service category.
Only includes active practitioners accepting clients, sorted by rating.
Public endpoint, no authentication required.</p>

<span id="example-requests-GETapi-practitioners-profiles-category--categoryId-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/practitioners/profiles/category/1?limit=10" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/practitioners/profiles/category/1"
);

const params = {
    "limit": "10",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-practitioners-profiles-category--categoryId-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;professional_title&quot;: &quot;Licensed Massage Therapist&quot;,
            &quot;primary_category&quot;: {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Body-Based Services&quot;
            },
            &quot;statistics&quot;: {
                &quot;average_rating&quot;: 4.85,
                &quot;total_reviews&quot;: 23
            }
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-practitioners-profiles-category--categoryId-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-practitioners-profiles-category--categoryId-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-practitioners-profiles-category--categoryId-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-practitioners-profiles-category--categoryId-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-practitioners-profiles-category--categoryId-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-practitioners-profiles-category--categoryId-" data-method="GET"
      data-path="api/practitioners/profiles/category/{categoryId}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-practitioners-profiles-category--categoryId-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-practitioners-profiles-category--categoryId-"
                    onclick="tryItOut('GETapi-practitioners-profiles-category--categoryId-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-practitioners-profiles-category--categoryId-"
                    onclick="cancelTryOut('GETapi-practitioners-profiles-category--categoryId-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-practitioners-profiles-category--categoryId-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/practitioners/profiles/category/{categoryId}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-practitioners-profiles-category--categoryId-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-practitioners-profiles-category--categoryId-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>categoryId</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="categoryId"                data-endpoint="GETapi-practitioners-profiles-category--categoryId-"
               value="1"
               data-component="url">
    <br>
<p>The service category ID. Example: <code>1</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>limit</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="limit"                data-endpoint="GETapi-practitioners-profiles-category--categoryId-"
               value="10"
               data-component="query">
    <br>
<p>Number of practitioners to return (1-50). Example: <code>10</code></p>
            </div>
                </form>

                    <h2 id="practitioner-profiles-GETapi-practitioners-my-profile">Get My Practitioner Profile</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retrieve the authenticated user's practitioner profile.
User must be an approved practitioner.</p>

<span id="example-requests-GETapi-practitioners-my-profile">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/practitioners/my-profile" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/practitioners/my-profile"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-practitioners-my-profile">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;professional_title&quot;: &quot;Licensed Massage Therapist&quot;,
        &quot;is_active&quot;: true,
        &quot;is_accepting_clients&quot;: true,
        &quot;statistics&quot;: {
            &quot;total_bookings&quot;: 45,
            &quot;average_rating&quot;: 4.85,
            &quot;total_reviews&quot;: 23
        }
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;You do not have a practitioner profile.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-practitioners-my-profile" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-practitioners-my-profile"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-practitioners-my-profile"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-practitioners-my-profile" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-practitioners-my-profile">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-practitioners-my-profile" data-method="GET"
      data-path="api/practitioners/my-profile"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-practitioners-my-profile', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-practitioners-my-profile"
                    onclick="tryItOut('GETapi-practitioners-my-profile');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-practitioners-my-profile"
                    onclick="cancelTryOut('GETapi-practitioners-my-profile');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-practitioners-my-profile"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/practitioners/my-profile</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-practitioners-my-profile"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-practitioners-my-profile"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="practitioner-profiles-PUTapi-practitioners-profiles--id-">Update Practitioner Profile</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Update the practitioner profile information.
Users can only update their own profile. Admins can update any profile.</p>

<span id="example-requests-PUTapi-practitioners-profiles--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/api/practitioners/profiles/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"phone_number\": \"+1234567890\",
    \"professional_title\": \"Licensed Massage Therapist\",
    \"bio\": \"Updated bio text...\",
    \"service_description\": \"I specialize in...\",
    \"availability_schedule\": {
        \"monday\": {
            \"morning\": true
        }
    },
    \"timezone\": \"America\\/Los_Angeles\",
    \"is_accepting_clients\": true,
    \"service_subcategories\": [
        1,
        2,
        3
    ]
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/practitioners/profiles/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "phone_number": "+1234567890",
    "professional_title": "Licensed Massage Therapist",
    "bio": "Updated bio text...",
    "service_description": "I specialize in...",
    "availability_schedule": {
        "monday": {
            "morning": true
        }
    },
    "timezone": "America\/Los_Angeles",
    "is_accepting_clients": true,
    "service_subcategories": [
        1,
        2,
        3
    ]
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-practitioners-profiles--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Profile updated successfully.&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;professional_title&quot;: &quot;Licensed Massage Therapist&quot;,
        &quot;bio&quot;: &quot;Updated bio...&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (403):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;Unauthorized.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;Profile not found.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-PUTapi-practitioners-profiles--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-practitioners-profiles--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-practitioners-profiles--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-practitioners-profiles--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-practitioners-profiles--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-practitioners-profiles--id-" data-method="PUT"
      data-path="api/practitioners/profiles/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-practitioners-profiles--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-practitioners-profiles--id-"
                    onclick="tryItOut('PUTapi-practitioners-profiles--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-practitioners-profiles--id-"
                    onclick="cancelTryOut('PUTapi-practitioners-profiles--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-practitioners-profiles--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/practitioners/profiles/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-practitioners-profiles--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-practitioners-profiles--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-practitioners-profiles--id-"
               value="1"
               data-component="url">
    <br>
<p>The profile ID. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>phone_number</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="phone_number"                data-endpoint="PUTapi-practitioners-profiles--id-"
               value="+1234567890"
               data-component="body">
    <br>
<p>optional Phone number. Example: <code>+1234567890</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>professional_title</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="professional_title"                data-endpoint="PUTapi-practitioners-profiles--id-"
               value="Licensed Massage Therapist"
               data-component="body">
    <br>
<p>optional Professional title. Example: <code>Licensed Massage Therapist</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>bio</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="bio"                data-endpoint="PUTapi-practitioners-profiles--id-"
               value="Updated bio text..."
               data-component="body">
    <br>
<p>optional Bio (max 500 characters). Example: <code>Updated bio text...</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>service_description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="service_description"                data-endpoint="PUTapi-practitioners-profiles--id-"
               value="I specialize in..."
               data-component="body">
    <br>
<p>optional Service description (max 1000 characters). Example: <code>I specialize in...</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>availability_schedule</code></b>&nbsp;&nbsp;
<small>object</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="availability_schedule"                data-endpoint="PUTapi-practitioners-profiles--id-"
               value=""
               data-component="body">
    <br>
<p>optional Weekly availability.</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>timezone</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="timezone"                data-endpoint="PUTapi-practitioners-profiles--id-"
               value="America/Los_Angeles"
               data-component="body">
    <br>
<p>optional Timezone. Example: <code>America/Los_Angeles</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>is_accepting_clients</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="PUTapi-practitioners-profiles--id-" style="display: none">
            <input type="radio" name="is_accepting_clients"
                   value="true"
                   data-endpoint="PUTapi-practitioners-profiles--id-"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="PUTapi-practitioners-profiles--id-" style="display: none">
            <input type="radio" name="is_accepting_clients"
                   value="false"
                   data-endpoint="PUTapi-practitioners-profiles--id-"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>optional Whether accepting new clients. Example: <code>true</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>service_subcategories</code></b>&nbsp;&nbsp;
<small>string[]</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="service_subcategories[0]"                data-endpoint="PUTapi-practitioners-profiles--id-"
               data-component="body">
        <input type="text" style="display: none"
               name="service_subcategories[1]"                data-endpoint="PUTapi-practitioners-profiles--id-"
               data-component="body">
    <br>
<p>optional Array of service subcategory IDs.</p>
        </div>
        </form>

                    <h2 id="practitioner-profiles-POSTapi-practitioners-profiles--id--toggle-active">Toggle Profile Active Status</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Activate or deactivate a practitioner profile.
Users can toggle their own profile. Admins can toggle any profile.
Inactive profiles are hidden from public listings.</p>

<span id="example-requests-POSTapi-practitioners-profiles--id--toggle-active">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/practitioners/profiles/1/toggle-active" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/practitioners/profiles/1/toggle-active"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-practitioners-profiles--id--toggle-active">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Profile status updated.&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;is_active&quot;: false
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (403):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;Unauthorized.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;Profile not found.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-practitioners-profiles--id--toggle-active" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-practitioners-profiles--id--toggle-active"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-practitioners-profiles--id--toggle-active"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-practitioners-profiles--id--toggle-active" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-practitioners-profiles--id--toggle-active">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-practitioners-profiles--id--toggle-active" data-method="POST"
      data-path="api/practitioners/profiles/{id}/toggle-active"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-practitioners-profiles--id--toggle-active', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-practitioners-profiles--id--toggle-active"
                    onclick="tryItOut('POSTapi-practitioners-profiles--id--toggle-active');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-practitioners-profiles--id--toggle-active"
                    onclick="cancelTryOut('POSTapi-practitioners-profiles--id--toggle-active');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-practitioners-profiles--id--toggle-active"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/practitioners/profiles/{id}/toggle-active</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-practitioners-profiles--id--toggle-active"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-practitioners-profiles--id--toggle-active"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="POSTapi-practitioners-profiles--id--toggle-active"
               value="1"
               data-component="url">
    <br>
<p>The profile ID. Example: <code>1</code></p>
            </div>
                    </form>

                <h1 id="product-management">Product Management</h1>

    <p>APIs for managing products and services</p>

                                <h2 id="product-management-GETapi-products--product_id-">Get Product Details</h2>

<p>
</p>

<p>Retrieve detailed information about a product/service including variants or slots.</p>

<span id="example-requests-GETapi-products--product_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/products/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/products/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-products--product_id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;vendor_id&quot;: 1,
        &quot;title&quot;: &quot;Web Development Package&quot;,
        &quot;brief&quot;: &quot;Professional website development&quot;,
        &quot;description&quot;: &quot;Full description here...&quot;,
        &quot;type&quot;: &quot;service&quot;,
        &quot;active&quot;: true,
        &quot;vendor&quot;: {
            &quot;id&quot;: 1,
            &quot;business_name&quot;: &quot;Tech Solutions Inc&quot;
        },
        &quot;variants&quot;: [],
        &quot;service_slots&quot;: []
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-products--product_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-products--product_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-products--product_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-products--product_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-products--product_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-products--product_id-" data-method="GET"
      data-path="api/products/{product_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-products--product_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-products--product_id-"
                    onclick="tryItOut('GETapi-products--product_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-products--product_id-"
                    onclick="cancelTryOut('GETapi-products--product_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-products--product_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/products/{product_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-products--product_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-products--product_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>product_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="product_id"                data-endpoint="GETapi-products--product_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the product. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>product</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="product"                data-endpoint="GETapi-products--product_id-"
               value="1"
               data-component="url">
    <br>
<p>The product ID. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="product-management-POSTapi-vendors--vendor_id--products">Create Product/Service</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Create a new product or service for a vendor.</p>

<span id="example-requests-POSTapi-vendors--vendor_id--products">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/vendors/1/products" \
    --header "Content-Type: multipart/form-data" \
    --header "Accept: application/json" \
    --form "title=Web Development Package"\
    --form "brief=Professional website development"\
    --form "description=We build responsive websites..."\
    --form "type=service"\
    --form "active=1"\
    --form "variants[][name]=d"\
    --form "variants[][price]=37"\
    --form "variants[][stock]=9"\
    --form "slots[][duration]=2"\
    --form "slots[][price]=8"\
    --form "images[]=@/tmp/phpuije6dnkdlhhe7c9EZ2" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/vendors/1/products"
);

const headers = {
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
};

const body = new FormData();
body.append('title', 'Web Development Package');
body.append('brief', 'Professional website development');
body.append('description', 'We build responsive websites...');
body.append('type', 'service');
body.append('active', '1');
body.append('variants[][name]', 'd');
body.append('variants[][price]', '37');
body.append('variants[][stock]', '9');
body.append('slots[][duration]', '2');
body.append('slots[][price]', '8');
body.append('images[]', document.querySelector('input[name="images[]"]').files[0]);

fetch(url, {
    method: "POST",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-vendors--vendor_id--products">
            <blockquote>
            <p>Example response (201):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Product created successfully&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;vendor_id&quot;: 1,
        &quot;title&quot;: &quot;Web Development Package&quot;,
        &quot;brief&quot;: &quot;Professional website development&quot;,
        &quot;type&quot;: &quot;service&quot;,
        &quot;active&quot;: true,
        &quot;created_at&quot;: &quot;2024-01-01T00:00:00.000000Z&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-vendors--vendor_id--products" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-vendors--vendor_id--products"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-vendors--vendor_id--products"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-vendors--vendor_id--products" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-vendors--vendor_id--products">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-vendors--vendor_id--products" data-method="POST"
      data-path="api/vendors/{vendor_id}/products"
      data-authed="1"
      data-hasfiles="1"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-vendors--vendor_id--products', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-vendors--vendor_id--products"
                    onclick="tryItOut('POSTapi-vendors--vendor_id--products');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-vendors--vendor_id--products"
                    onclick="cancelTryOut('POSTapi-vendors--vendor_id--products');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-vendors--vendor_id--products"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/vendors/{vendor_id}/products</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-vendors--vendor_id--products"
               value="multipart/form-data"
               data-component="header">
    <br>
<p>Example: <code>multipart/form-data</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-vendors--vendor_id--products"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>vendor_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="vendor_id"                data-endpoint="POSTapi-vendors--vendor_id--products"
               value="1"
               data-component="url">
    <br>
<p>The ID of the vendor. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>vendor</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="vendor"                data-endpoint="POSTapi-vendors--vendor_id--products"
               value="1"
               data-component="url">
    <br>
<p>The vendor ID. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>title</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="title"                data-endpoint="POSTapi-vendors--vendor_id--products"
               value="Web Development Package"
               data-component="body">
    <br>
<p>Product/service title. Example: <code>Web Development Package</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>brief</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="brief"                data-endpoint="POSTapi-vendors--vendor_id--products"
               value="Professional website development"
               data-component="body">
    <br>
<p>Short description (max 255 chars). Example: <code>Professional website development</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="POSTapi-vendors--vendor_id--products"
               value="We build responsive websites..."
               data-component="body">
    <br>
<p>Detailed description (max 4000 chars). Example: <code>We build responsive websites...</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="type"                data-endpoint="POSTapi-vendors--vendor_id--products"
               value="service"
               data-component="body">
    <br>
<p>Type: &quot;product&quot; or &quot;service&quot;. Example: <code>service</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="POSTapi-vendors--vendor_id--products" style="display: none">
            <input type="radio" name="active"
                   value="true"
                   data-endpoint="POSTapi-vendors--vendor_id--products"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-vendors--vendor_id--products" style="display: none">
            <input type="radio" name="active"
                   value="false"
                   data-endpoint="POSTapi-vendors--vendor_id--products"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>optional Whether product is active. Example: <code>true</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>images</code></b>&nbsp;&nbsp;
<small>file[]</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="file" style="display: none"
                              name="images[0]"                data-endpoint="POSTapi-vendors--vendor_id--products"
               data-component="body">
        <input type="file" style="display: none"
               name="images[1]"                data-endpoint="POSTapi-vendors--vendor_id--products"
               data-component="body">
    <br>
<p>Must be an image. Must not be greater than 5120 kilobytes.</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
        <details>
            <summary style="padding-bottom: 10px;">
                <b style="line-height: 2;"><code>variants</code></b>&nbsp;&nbsp;
<small>object[]</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
<br>
<p>This field is required when <code>type</code> is <code>product</code>.</p>
            </summary>
                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="variants.0.name"                data-endpoint="POSTapi-vendors--vendor_id--products"
               value="d"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>d</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>price</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="variants.0.price"                data-endpoint="POSTapi-vendors--vendor_id--products"
               value="37"
               data-component="body">
    <br>
<p>Must be at least 0. Example: <code>37</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>stock</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="variants.0.stock"                data-endpoint="POSTapi-vendors--vendor_id--products"
               value="9"
               data-component="body">
    <br>
<p>Must be at least 0. Example: <code>9</code></p>
                    </div>
                                    </details>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
        <details>
            <summary style="padding-bottom: 10px;">
                <b style="line-height: 2;"><code>slots</code></b>&nbsp;&nbsp;
<small>object[]</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
<br>
<p>This field is required when <code>type</code> is <code>service</code>.</p>
            </summary>
                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>duration</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="slots.0.duration"                data-endpoint="POSTapi-vendors--vendor_id--products"
               value="2"
               data-component="body">
    <br>
<p>Must be at least 1. Example: <code>2</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>price</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="slots.0.price"                data-endpoint="POSTapi-vendors--vendor_id--products"
               value="8"
               data-component="body">
    <br>
<p>Must be at least 0. Example: <code>8</code></p>
                    </div>
                                    </details>
        </div>
        </form>

                    <h2 id="product-management-GETapi-vendors--vendor_id--products">List Vendor Products</h2>

<p>
</p>

<p>Get all products/services for a specific vendor with pagination.</p>

<span id="example-requests-GETapi-vendors--vendor_id--products">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/vendors/1/products?page=1&amp;per_page=15" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/vendors/1/products"
);

const params = {
    "page": "1",
    "per_page": "15",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-vendors--vendor_id--products">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;title&quot;: &quot;Web Development Package&quot;,
            &quot;type&quot;: &quot;service&quot;,
            &quot;variants&quot;: [],
            &quot;service_slots&quot;: [
                {
                    &quot;id&quot;: 1,
                    &quot;duration&quot;: 60,
                    &quot;price&quot;: &quot;150.00&quot;
                }
            ]
        }
    ],
    &quot;links&quot;: {
        &quot;first&quot;: &quot;http://localhost/api/vendors/1/products?page=1&quot;,
        &quot;last&quot;: &quot;http://localhost/api/vendors/1/products?page=3&quot;,
        &quot;prev&quot;: null,
        &quot;next&quot;: &quot;http://localhost/api/vendors/1/products?page=2&quot;
    },
    &quot;meta&quot;: {
        &quot;current_page&quot;: 1,
        &quot;from&quot;: 1,
        &quot;last_page&quot;: 3,
        &quot;per_page&quot;: 15,
        &quot;to&quot;: 15,
        &quot;total&quot;: 45
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-vendors--vendor_id--products" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-vendors--vendor_id--products"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-vendors--vendor_id--products"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-vendors--vendor_id--products" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-vendors--vendor_id--products">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-vendors--vendor_id--products" data-method="GET"
      data-path="api/vendors/{vendor_id}/products"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-vendors--vendor_id--products', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-vendors--vendor_id--products"
                    onclick="tryItOut('GETapi-vendors--vendor_id--products');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-vendors--vendor_id--products"
                    onclick="cancelTryOut('GETapi-vendors--vendor_id--products');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-vendors--vendor_id--products"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/vendors/{vendor_id}/products</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-vendors--vendor_id--products"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-vendors--vendor_id--products"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>vendor_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="vendor_id"                data-endpoint="GETapi-vendors--vendor_id--products"
               value="1"
               data-component="url">
    <br>
<p>The ID of the vendor. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>vendor</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="vendor"                data-endpoint="GETapi-vendors--vendor_id--products"
               value="1"
               data-component="url">
    <br>
<p>The vendor ID. Example: <code>1</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="page"                data-endpoint="GETapi-vendors--vendor_id--products"
               value="1"
               data-component="query">
    <br>
<p>Page number. Example: <code>1</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>per_page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_page"                data-endpoint="GETapi-vendors--vendor_id--products"
               value="15"
               data-component="query">
    <br>
<p>Items per page (max 100). Example: <code>15</code></p>
            </div>
                </form>

                    <h2 id="product-management-PUTapi-products--product_id-">Update Product/Service</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Update product/service details. Only vendor owner can update.</p>

<span id="example-requests-PUTapi-products--product_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/api/products/1" \
    --header "Content-Type: multipart/form-data" \
    --header "Accept: application/json" \
    --form "title=Updated Web Package"\
    --form "brief=Updated description"\
    --form "description=New detailed info..."\
    --form "type=service"\
    --form "active="\
    --form "variants[][name]=d"\
    --form "variants[][price]=37"\
    --form "variants[][stock]=9"\
    --form "slots[][duration]=2"\
    --form "slots[][price]=8"\
    --form "images[]=@/tmp/phpgjr09rcvmofnegC3dua" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/products/1"
);

const headers = {
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
};

const body = new FormData();
body.append('title', 'Updated Web Package');
body.append('brief', 'Updated description');
body.append('description', 'New detailed info...');
body.append('type', 'service');
body.append('active', '');
body.append('variants[][name]', 'd');
body.append('variants[][price]', '37');
body.append('variants[][stock]', '9');
body.append('slots[][duration]', '2');
body.append('slots[][price]', '8');
body.append('images[]', document.querySelector('input[name="images[]"]').files[0]);

fetch(url, {
    method: "PUT",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-products--product_id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Product updated successfully&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;title&quot;: &quot;Updated Web Package&quot;,
        &quot;updated_at&quot;: &quot;2024-01-02T00:00:00.000000Z&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-PUTapi-products--product_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-products--product_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-products--product_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-products--product_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-products--product_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-products--product_id-" data-method="PUT"
      data-path="api/products/{product_id}"
      data-authed="1"
      data-hasfiles="1"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-products--product_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-products--product_id-"
                    onclick="tryItOut('PUTapi-products--product_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-products--product_id-"
                    onclick="cancelTryOut('PUTapi-products--product_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-products--product_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/products/{product_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-products--product_id-"
               value="multipart/form-data"
               data-component="header">
    <br>
<p>Example: <code>multipart/form-data</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-products--product_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>product_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="product_id"                data-endpoint="PUTapi-products--product_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the product. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>product</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="product"                data-endpoint="PUTapi-products--product_id-"
               value="1"
               data-component="url">
    <br>
<p>The product ID. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>title</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="title"                data-endpoint="PUTapi-products--product_id-"
               value="Updated Web Package"
               data-component="body">
    <br>
<p>optional Product title. Example: <code>Updated Web Package</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>brief</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="brief"                data-endpoint="PUTapi-products--product_id-"
               value="Updated description"
               data-component="body">
    <br>
<p>optional Short description. Example: <code>Updated description</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="PUTapi-products--product_id-"
               value="New detailed info..."
               data-component="body">
    <br>
<p>optional Detailed description. Example: <code>New detailed info...</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="type"                data-endpoint="PUTapi-products--product_id-"
               value="service"
               data-component="body">
    <br>
<p>optional Type: &quot;product&quot; or &quot;service&quot;. Example: <code>service</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="PUTapi-products--product_id-" style="display: none">
            <input type="radio" name="active"
                   value="true"
                   data-endpoint="PUTapi-products--product_id-"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="PUTapi-products--product_id-" style="display: none">
            <input type="radio" name="active"
                   value="false"
                   data-endpoint="PUTapi-products--product_id-"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>optional Active status. Example: <code>false</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>images</code></b>&nbsp;&nbsp;
<small>file[]</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="file" style="display: none"
                              name="images[0]"                data-endpoint="PUTapi-products--product_id-"
               data-component="body">
        <input type="file" style="display: none"
               name="images[1]"                data-endpoint="PUTapi-products--product_id-"
               data-component="body">
    <br>
<p>Must be an image. Must not be greater than 5120 kilobytes.</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
        <details>
            <summary style="padding-bottom: 10px;">
                <b style="line-height: 2;"><code>variants</code></b>&nbsp;&nbsp;
<small>object[]</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
<br>

            </summary>
                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="variants.0.id"                data-endpoint="PUTapi-products--product_id-"
               value=""
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the product_variants table.</p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="variants.0.name"                data-endpoint="PUTapi-products--product_id-"
               value="d"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>d</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>price</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="variants.0.price"                data-endpoint="PUTapi-products--product_id-"
               value="37"
               data-component="body">
    <br>
<p>Must be at least 0. Example: <code>37</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>stock</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="variants.0.stock"                data-endpoint="PUTapi-products--product_id-"
               value="9"
               data-component="body">
    <br>
<p>Must be at least 0. Example: <code>9</code></p>
                    </div>
                                    </details>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
        <details>
            <summary style="padding-bottom: 10px;">
                <b style="line-height: 2;"><code>slots</code></b>&nbsp;&nbsp;
<small>object[]</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
<br>

            </summary>
                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="slots.0.id"                data-endpoint="PUTapi-products--product_id-"
               value=""
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the service_slots table.</p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>duration</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="slots.0.duration"                data-endpoint="PUTapi-products--product_id-"
               value="2"
               data-component="body">
    <br>
<p>Must be at least 1. Example: <code>2</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>price</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="slots.0.price"                data-endpoint="PUTapi-products--product_id-"
               value="8"
               data-component="body">
    <br>
<p>Must be at least 0. Example: <code>8</code></p>
                    </div>
                                    </details>
        </div>
        </form>

                    <h2 id="product-management-DELETEapi-products--product_id-">Delete Product/Service</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Delete a product/service. Only vendor owner can delete.</p>

<span id="example-requests-DELETEapi-products--product_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/api/products/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/products/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-products--product_id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Product deleted successfully&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthorized&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-DELETEapi-products--product_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-products--product_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-products--product_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-products--product_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-products--product_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-products--product_id-" data-method="DELETE"
      data-path="api/products/{product_id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-products--product_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-products--product_id-"
                    onclick="tryItOut('DELETEapi-products--product_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-products--product_id-"
                    onclick="cancelTryOut('DELETEapi-products--product_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-products--product_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/products/{product_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-products--product_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-products--product_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>product_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="product_id"                data-endpoint="DELETEapi-products--product_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the product. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>product</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="product"                data-endpoint="DELETEapi-products--product_id-"
               value="1"
               data-component="url">
    <br>
<p>The product ID. Example: <code>1</code></p>
            </div>
                    </form>

                <h1 id="product-variants">Product Variants</h1>

    <p>APIs for managing product variants (sizes, colors, etc.)</p>

                                <h2 id="product-variants-POSTapi-products--product_id--variants">Create Product Variant</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Add a new variant to a product. Sort order is auto-incremented.</p>

<span id="example-requests-POSTapi-products--product_id--variants">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/products/1/variants" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"Large (Blue)\",
    \"price\": 29.99,
    \"stock\": 100
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/products/1/variants"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "Large (Blue)",
    "price": 29.99,
    "stock": 100
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-products--product_id--variants">
            <blockquote>
            <p>Example response (201):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Variant created successfully&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;product_id&quot;: 1,
        &quot;name&quot;: &quot;Large (Blue)&quot;,
        &quot;price&quot;: &quot;29.99&quot;,
        &quot;stock&quot;: 100,
        &quot;sort&quot;: 1,
        &quot;created_at&quot;: &quot;2024-01-01T00:00:00.000000Z&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-products--product_id--variants" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-products--product_id--variants"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-products--product_id--variants"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-products--product_id--variants" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-products--product_id--variants">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-products--product_id--variants" data-method="POST"
      data-path="api/products/{product_id}/variants"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-products--product_id--variants', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-products--product_id--variants"
                    onclick="tryItOut('POSTapi-products--product_id--variants');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-products--product_id--variants"
                    onclick="cancelTryOut('POSTapi-products--product_id--variants');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-products--product_id--variants"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/products/{product_id}/variants</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-products--product_id--variants"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-products--product_id--variants"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>product_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="product_id"                data-endpoint="POSTapi-products--product_id--variants"
               value="1"
               data-component="url">
    <br>
<p>The ID of the product. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>product</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="product"                data-endpoint="POSTapi-products--product_id--variants"
               value="1"
               data-component="url">
    <br>
<p>The product ID. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-products--product_id--variants"
               value="Large (Blue)"
               data-component="body">
    <br>
<p>Variant name. Example: <code>Large (Blue)</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>price</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="price"                data-endpoint="POSTapi-products--product_id--variants"
               value="29.99"
               data-component="body">
    <br>
<p>Variant price. Example: <code>29.99</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>stock</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="stock"                data-endpoint="POSTapi-products--product_id--variants"
               value="100"
               data-component="body">
    <br>
<p>optional Stock quantity. Example: <code>100</code></p>
        </div>
        </form>

                    <h2 id="product-variants-POSTapi-variants--variant_id-">Update Product Variant</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Update variant details. Only vendor owner can update.</p>

<span id="example-requests-POSTapi-variants--variant_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/variants/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"Medium (Red)\",
    \"price\": 24.99,
    \"stock\": 50
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/variants/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "Medium (Red)",
    "price": 24.99,
    "stock": 50
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-variants--variant_id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Variant updated successfully&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;name&quot;: &quot;Medium (Red)&quot;,
        &quot;price&quot;: &quot;24.99&quot;,
        &quot;stock&quot;: 50,
        &quot;updated_at&quot;: &quot;2024-01-02T00:00:00.000000Z&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-variants--variant_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-variants--variant_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-variants--variant_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-variants--variant_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-variants--variant_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-variants--variant_id-" data-method="POST"
      data-path="api/variants/{variant_id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-variants--variant_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-variants--variant_id-"
                    onclick="tryItOut('POSTapi-variants--variant_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-variants--variant_id-"
                    onclick="cancelTryOut('POSTapi-variants--variant_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-variants--variant_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/variants/{variant_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-variants--variant_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-variants--variant_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>variant_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="variant_id"                data-endpoint="POSTapi-variants--variant_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the variant. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>variant</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="variant"                data-endpoint="POSTapi-variants--variant_id-"
               value="1"
               data-component="url">
    <br>
<p>The variant ID. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-variants--variant_id-"
               value="Medium (Red)"
               data-component="body">
    <br>
<p>optional Variant name. Example: <code>Medium (Red)</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>price</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="price"                data-endpoint="POSTapi-variants--variant_id-"
               value="24.99"
               data-component="body">
    <br>
<p>optional Variant price. Example: <code>24.99</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>stock</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="stock"                data-endpoint="POSTapi-variants--variant_id-"
               value="50"
               data-component="body">
    <br>
<p>optional Stock quantity. Example: <code>50</code></p>
        </div>
        </form>

                    <h2 id="product-variants-DELETEapi-variants--variant_id-">Delete Product Variant</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Delete a variant. Only vendor owner can delete.</p>

<span id="example-requests-DELETEapi-variants--variant_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/api/variants/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/variants/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-variants--variant_id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Variant deleted successfully&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthorized&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-DELETEapi-variants--variant_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-variants--variant_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-variants--variant_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-variants--variant_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-variants--variant_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-variants--variant_id-" data-method="DELETE"
      data-path="api/variants/{variant_id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-variants--variant_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-variants--variant_id-"
                    onclick="tryItOut('DELETEapi-variants--variant_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-variants--variant_id-"
                    onclick="cancelTryOut('DELETEapi-variants--variant_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-variants--variant_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/variants/{variant_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-variants--variant_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-variants--variant_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>variant_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="variant_id"                data-endpoint="DELETEapi-variants--variant_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the variant. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>variant</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="variant"                data-endpoint="DELETEapi-variants--variant_id-"
               value="1"
               data-component="url">
    <br>
<p>The variant ID. Example: <code>1</code></p>
            </div>
                    </form>

                <h1 id="service-availability-management">Service Availability Management</h1>

    <p>APIs for managing service slot availability schedules. Vendors can set their weekly availability
(days and time ranges) for each service slot.</p>

                                <h2 id="service-availability-management-POSTapi-slots--slot_id--schedule">Store Availability Schedule</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Set or update the weekly availability schedule for a service slot. This defines which days and times
the vendor is available for bookings. The schedule will replace any existing schedule for the slot.</p>

<span id="example-requests-POSTapi-slots--slot_id--schedule">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/slots/1/schedule" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"schedule\": [
        \"architecto\"
    ]
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/slots/1/schedule"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "schedule": [
        "architecto"
    ]
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-slots--slot_id--schedule">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Availability schedule saved successfully&quot;,
    &quot;schedule&quot;: [
        {
            &quot;day_of_week&quot;: 0,
            &quot;is_available&quot;: false,
            &quot;time_slots&quot;: []
        },
        {
            &quot;day_of_week&quot;: 1,
            &quot;is_available&quot;: true,
            &quot;time_slots&quot;: [
                {
                    &quot;start_time&quot;: &quot;09:00&quot;,
                    &quot;end_time&quot;: &quot;12:00&quot;
                },
                {
                    &quot;start_time&quot;: &quot;14:00&quot;,
                    &quot;end_time&quot;: &quot;18:00&quot;
                }
            ]
        },
        {
            &quot;day_of_week&quot;: 2,
            &quot;is_available&quot;: true,
            &quot;time_slots&quot;: [
                {
                    &quot;start_time&quot;: &quot;09:00&quot;,
                    &quot;end_time&quot;: &quot;17:00&quot;
                }
            ]
        },
        {
            &quot;day_of_week&quot;: 3,
            &quot;is_available&quot;: true,
            &quot;time_slots&quot;: [
                {
                    &quot;start_time&quot;: &quot;09:00&quot;,
                    &quot;end_time&quot;: &quot;17:00&quot;
                }
            ]
        },
        {
            &quot;day_of_week&quot;: 4,
            &quot;is_available&quot;: true,
            &quot;time_slots&quot;: [
                {
                    &quot;start_time&quot;: &quot;09:00&quot;,
                    &quot;end_time&quot;: &quot;17:00&quot;
                }
            ]
        },
        {
            &quot;day_of_week&quot;: 5,
            &quot;is_available&quot;: true,
            &quot;time_slots&quot;: [
                {
                    &quot;start_time&quot;: &quot;09:00&quot;,
                    &quot;end_time&quot;: &quot;17:00&quot;
                }
            ]
        },
        {
            &quot;day_of_week&quot;: 6,
            &quot;is_available&quot;: false,
            &quot;time_slots&quot;: []
        }
    ]
}</code>
 </pre>
            <blockquote>
            <p>Example response (403):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthorized&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;The given data was invalid.&quot;,
    &quot;errors&quot;: {
        &quot;schedule.0.day_of_week&quot;: [
            &quot;The schedule.0.day_of_week field is required.&quot;
        ],
        &quot;schedule.0.time_slots.0.end_time&quot;: [
            &quot;The schedule.0.time_slots.0.end_time must be after schedule.0.time_slots.0.start_time.&quot;
        ]
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (500):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Failed to save availability schedule&quot;,
    &quot;error&quot;: &quot;Database error message&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-slots--slot_id--schedule" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-slots--slot_id--schedule"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-slots--slot_id--schedule"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-slots--slot_id--schedule" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-slots--slot_id--schedule">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-slots--slot_id--schedule" data-method="POST"
      data-path="api/slots/{slot_id}/schedule"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-slots--slot_id--schedule', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-slots--slot_id--schedule"
                    onclick="tryItOut('POSTapi-slots--slot_id--schedule');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-slots--slot_id--schedule"
                    onclick="cancelTryOut('POSTapi-slots--slot_id--schedule');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-slots--slot_id--schedule"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/slots/{slot_id}/schedule</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-slots--slot_id--schedule"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-slots--slot_id--schedule"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>slot_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="slot_id"                data-endpoint="POSTapi-slots--slot_id--schedule"
               value="1"
               data-component="url">
    <br>
<p>The ID of the slot. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>slot</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="slot"                data-endpoint="POSTapi-slots--slot_id--schedule"
               value="1"
               data-component="url">
    <br>
<p>The ID of the service slot. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
        <details>
            <summary style="padding-bottom: 10px;">
                <b style="line-height: 2;"><code>schedule</code></b>&nbsp;&nbsp;
<small>string[]</small>&nbsp;
 &nbsp;
 &nbsp;
<br>
<p>Array of weekly schedule data. Must contain 7 elements (one for each day).</p>
            </summary>
                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>day_of_week</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="schedule.0.day_of_week"                data-endpoint="POSTapi-slots--slot_id--schedule"
               value="1"
               data-component="body">
    <br>
<p>Day of the week (0=Sunday, 1=Monday, ..., 6=Saturday). Example: <code>1</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>is_available</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
 &nbsp;
 &nbsp;
                <label data-endpoint="POSTapi-slots--slot_id--schedule" style="display: none">
            <input type="radio" name="schedule.0.is_available"
                   value="true"
                   data-endpoint="POSTapi-slots--slot_id--schedule"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-slots--slot_id--schedule" style="display: none">
            <input type="radio" name="schedule.0.is_available"
                   value="false"
                   data-endpoint="POSTapi-slots--slot_id--schedule"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Whether the vendor is available on this day. Example: <code>true</code></p>
                    </div>
                                                                <div style=" margin-left: 14px; clear: unset;">
        <details>
            <summary style="padding-bottom: 10px;">
                <b style="line-height: 2;"><code>time_slots</code></b>&nbsp;&nbsp;
<small>string[]</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
<br>
<p>optional Array of time slots for the day. Required if is_available is true.</p>
            </summary>
                                                <div style="margin-left: 28px; clear: unset;">
                        <b style="line-height: 2;"><code>start_time</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="schedule.0.time_slots.0.start_time"                data-endpoint="POSTapi-slots--slot_id--schedule"
               value="09:00"
               data-component="body">
    <br>
<p>Start time in HH:MM format (24-hour). Example: <code>09:00</code></p>
                    </div>
                                                                <div style="margin-left: 28px; clear: unset;">
                        <b style="line-height: 2;"><code>end_time</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="schedule.0.time_slots.0.end_time"                data-endpoint="POSTapi-slots--slot_id--schedule"
               value="17:00"
               data-component="body">
    <br>
<p>End time in HH:MM format (24-hour). Must be after start_time. Example: <code>17:00</code></p>
                    </div>
                                    </details>
        </div>
                                        </details>
        </div>
        </form>

                    <h2 id="service-availability-management-GETapi-slots--slot_id--schedule">Get Availability Schedule</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retrieve the weekly availability schedule for a service slot. Returns the days and times when
the vendor is available for bookings. Used by vendors to view/edit their schedule.</p>

<span id="example-requests-GETapi-slots--slot_id--schedule">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/slots/1/schedule" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/slots/1/schedule"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-slots--slot_id--schedule">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;schedule&quot;: [
        {
            &quot;day_of_week&quot;: 0,
            &quot;is_available&quot;: false,
            &quot;time_slots&quot;: []
        },
        {
            &quot;day_of_week&quot;: 1,
            &quot;is_available&quot;: true,
            &quot;time_slots&quot;: [
                {
                    &quot;start_time&quot;: &quot;09:00&quot;,
                    &quot;end_time&quot;: &quot;12:00&quot;
                },
                {
                    &quot;start_time&quot;: &quot;14:00&quot;,
                    &quot;end_time&quot;: &quot;18:00&quot;
                }
            ]
        },
        {
            &quot;day_of_week&quot;: 2,
            &quot;is_available&quot;: true,
            &quot;time_slots&quot;: [
                {
                    &quot;start_time&quot;: &quot;09:00&quot;,
                    &quot;end_time&quot;: &quot;17:00&quot;
                }
            ]
        },
        {
            &quot;day_of_week&quot;: 3,
            &quot;is_available&quot;: true,
            &quot;time_slots&quot;: [
                {
                    &quot;start_time&quot;: &quot;09:00&quot;,
                    &quot;end_time&quot;: &quot;17:00&quot;
                }
            ]
        },
        {
            &quot;day_of_week&quot;: 4,
            &quot;is_available&quot;: true,
            &quot;time_slots&quot;: [
                {
                    &quot;start_time&quot;: &quot;09:00&quot;,
                    &quot;end_time&quot;: &quot;17:00&quot;
                }
            ]
        },
        {
            &quot;day_of_week&quot;: 5,
            &quot;is_available&quot;: true,
            &quot;time_slots&quot;: [
                {
                    &quot;start_time&quot;: &quot;09:00&quot;,
                    &quot;end_time&quot;: &quot;17:00&quot;
                }
            ]
        },
        {
            &quot;day_of_week&quot;: 6,
            &quot;is_available&quot;: false,
            &quot;time_slots&quot;: []
        }
    ]
}</code>
 </pre>
            <blockquote>
            <p>Example response (403):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthorized&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Service slot not found&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (500):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Failed to load availability schedule&quot;,
    &quot;error&quot;: &quot;Error message&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-slots--slot_id--schedule" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-slots--slot_id--schedule"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-slots--slot_id--schedule"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-slots--slot_id--schedule" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-slots--slot_id--schedule">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-slots--slot_id--schedule" data-method="GET"
      data-path="api/slots/{slot_id}/schedule"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-slots--slot_id--schedule', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-slots--slot_id--schedule"
                    onclick="tryItOut('GETapi-slots--slot_id--schedule');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-slots--slot_id--schedule"
                    onclick="cancelTryOut('GETapi-slots--slot_id--schedule');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-slots--slot_id--schedule"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/slots/{slot_id}/schedule</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-slots--slot_id--schedule"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-slots--slot_id--schedule"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>slot_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="slot_id"                data-endpoint="GETapi-slots--slot_id--schedule"
               value="1"
               data-component="url">
    <br>
<p>The ID of the slot. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>slot</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="slot"                data-endpoint="GETapi-slots--slot_id--schedule"
               value="1"
               data-component="url">
    <br>
<p>The ID of the service slot. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="service-availability-management-DELETEapi-slots--slot_id--schedule">Delete Availability Schedule</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Remove all availability schedule data for a service slot. After deletion, the slot will have
no defined availability and customers won't be able to book it until a new schedule is set.</p>

<span id="example-requests-DELETEapi-slots--slot_id--schedule">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/api/slots/1/schedule" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/slots/1/schedule"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-slots--slot_id--schedule">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Availability schedule deleted successfully&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthorized&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Service slot not found&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (500):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Failed to delete availability schedule&quot;,
    &quot;error&quot;: &quot;Error message&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-DELETEapi-slots--slot_id--schedule" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-slots--slot_id--schedule"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-slots--slot_id--schedule"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-slots--slot_id--schedule" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-slots--slot_id--schedule">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-slots--slot_id--schedule" data-method="DELETE"
      data-path="api/slots/{slot_id}/schedule"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-slots--slot_id--schedule', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-slots--slot_id--schedule"
                    onclick="tryItOut('DELETEapi-slots--slot_id--schedule');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-slots--slot_id--schedule"
                    onclick="cancelTryOut('DELETEapi-slots--slot_id--schedule');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-slots--slot_id--schedule"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/slots/{slot_id}/schedule</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-slots--slot_id--schedule"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-slots--slot_id--schedule"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>slot_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="slot_id"                data-endpoint="DELETEapi-slots--slot_id--schedule"
               value="1"
               data-component="url">
    <br>
<p>The ID of the slot. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>slot</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="slot"                data-endpoint="DELETEapi-slots--slot_id--schedule"
               value="1"
               data-component="url">
    <br>
<p>The ID of the service slot. Example: <code>1</code></p>
            </div>
                    </form>

                <h1 id="service-bookings">Service Bookings</h1>

    <p>APIs for managing service bookings and availability</p>

                                <h2 id="service-bookings-GETapi-slots--slot_id--availability">Check Slot Availability</h2>

<p>
</p>

<p>Get available and booked time slots for a date range.</p>

<span id="example-requests-GETapi-slots--slot_id--availability">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/slots/1/availability?start_date=2024-01-01&amp;end_date=2024-01-07" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"start_date\": \"2026-02-08\",
    \"end_date\": \"2052-03-03\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/slots/1/availability"
);

const params = {
    "start_date": "2024-01-01",
    "end_date": "2024-01-07",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "start_date": "2026-02-08",
    "end_date": "2052-03-03"
};

fetch(url, {
    method: "GET",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-slots--slot_id--availability">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;2024-01-01&quot;: {
            &quot;date&quot;: &quot;2024-01-01&quot;,
            &quot;booked_slots&quot;: [
                {
                    &quot;start_time&quot;: &quot;09:00:00&quot;,
                    &quot;end_time&quot;: &quot;10:00:00&quot;
                },
                {
                    &quot;start_time&quot;: &quot;14:00:00&quot;,
                    &quot;end_time&quot;: &quot;15:00:00&quot;
                }
            ]
        },
        &quot;2024-01-02&quot;: {
            &quot;date&quot;: &quot;2024-01-02&quot;,
            &quot;booked_slots&quot;: []
        }
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-slots--slot_id--availability" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-slots--slot_id--availability"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-slots--slot_id--availability"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-slots--slot_id--availability" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-slots--slot_id--availability">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-slots--slot_id--availability" data-method="GET"
      data-path="api/slots/{slot_id}/availability"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-slots--slot_id--availability', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-slots--slot_id--availability"
                    onclick="tryItOut('GETapi-slots--slot_id--availability');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-slots--slot_id--availability"
                    onclick="cancelTryOut('GETapi-slots--slot_id--availability');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-slots--slot_id--availability"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/slots/{slot_id}/availability</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-slots--slot_id--availability"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-slots--slot_id--availability"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>slot_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="slot_id"                data-endpoint="GETapi-slots--slot_id--availability"
               value="1"
               data-component="url">
    <br>
<p>The ID of the slot. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>slot</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="slot"                data-endpoint="GETapi-slots--slot_id--availability"
               value="1"
               data-component="url">
    <br>
<p>The service slot ID. Example: <code>1</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>start_date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="start_date"                data-endpoint="GETapi-slots--slot_id--availability"
               value="2024-01-01"
               data-component="query">
    <br>
<p>date Start date (YYYY-MM-DD). Example: <code>2024-01-01</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>end_date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="end_date"                data-endpoint="GETapi-slots--slot_id--availability"
               value="2024-01-07"
               data-component="query">
    <br>
<p>date End date (YYYY-MM-DD). Example: <code>2024-01-07</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>start_date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="start_date"                data-endpoint="GETapi-slots--slot_id--availability"
               value="2026-02-08"
               data-component="body">
    <br>
<p>Must be a valid date. Must be a valid date in the format <code>Y-m-d</code>. Example: <code>2026-02-08</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>end_date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="end_date"                data-endpoint="GETapi-slots--slot_id--availability"
               value="2052-03-03"
               data-component="body">
    <br>
<p>Must be a valid date. Must be a valid date in the format <code>Y-m-d</code>. Must be a date after or equal to <code>start_date</code>. Example: <code>2052-03-03</code></p>
        </div>
        </form>

                    <h2 id="service-bookings-POSTapi-bookings">Create Booking</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Book a service time slot. Prevents overlapping bookings.</p>

<span id="example-requests-POSTapi-bookings">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/bookings" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"service_slot_id\": 1,
    \"booking_date\": \"2024-01-15\",
    \"start_time\": \"10:00:00\",
    \"end_time\": \"11:00:00\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/bookings"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "service_slot_id": 1,
    "booking_date": "2024-01-15",
    "start_time": "10:00:00",
    "end_time": "11:00:00"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-bookings">
            <blockquote>
            <p>Example response (201):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Booking created successfully&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;service_slot_id&quot;: 1,
        &quot;user_id&quot;: 1,
        &quot;booking_date&quot;: &quot;2024-01-15&quot;,
        &quot;start_time&quot;: &quot;10:00:00&quot;,
        &quot;end_time&quot;: &quot;11:00:00&quot;,
        &quot;status&quot;: &quot;pending&quot;,
        &quot;created_at&quot;: &quot;2024-01-01T00:00:00.000000Z&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Time slot is already booked&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-bookings" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-bookings"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-bookings"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-bookings" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-bookings">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-bookings" data-method="POST"
      data-path="api/bookings"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-bookings', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-bookings"
                    onclick="tryItOut('POSTapi-bookings');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-bookings"
                    onclick="cancelTryOut('POSTapi-bookings');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-bookings"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/bookings</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-bookings"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-bookings"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>service_slot_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="service_slot_id"                data-endpoint="POSTapi-bookings"
               value="1"
               data-component="body">
    <br>
<p>The service slot ID. Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>booking_date</code></b>&nbsp;&nbsp;
<small>date</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="booking_date"                data-endpoint="POSTapi-bookings"
               value="2024-01-15"
               data-component="body">
    <br>
<p>Booking date (YYYY-MM-DD). Example: <code>2024-01-15</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>start_time</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="start_time"                data-endpoint="POSTapi-bookings"
               value="10:00:00"
               data-component="body">
    <br>
<p>Start time (HH:MM:SS). Example: <code>10:00:00</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>end_time</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="end_time"                data-endpoint="POSTapi-bookings"
               value="11:00:00"
               data-component="body">
    <br>
<p>End time (HH:MM:SS). Example: <code>11:00:00</code></p>
        </div>
        </form>

                    <h2 id="service-bookings-GETapi-bookings">List User Bookings</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Get all bookings for the authenticated user with pagination.</p>

<span id="example-requests-GETapi-bookings">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/bookings?page=1&amp;per_page=15" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/bookings"
);

const params = {
    "page": "1",
    "per_page": "15",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-bookings">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;service_slot_id&quot;: 1,
            &quot;booking_date&quot;: &quot;2024-01-15&quot;,
            &quot;start_time&quot;: &quot;10:00:00&quot;,
            &quot;end_time&quot;: &quot;11:00:00&quot;,
            &quot;status&quot;: &quot;confirmed&quot;,
            &quot;service_slot&quot;: {
                &quot;id&quot;: 1,
                &quot;duration&quot;: 60,
                &quot;price&quot;: &quot;150.00&quot;,
                &quot;product&quot;: {
                    &quot;id&quot;: 1,
                    &quot;title&quot;: &quot;Web Development Consultation&quot;,
                    &quot;vendor&quot;: {
                        &quot;id&quot;: 1,
                        &quot;business_name&quot;: &quot;Tech Solutions Inc&quot;
                    }
                }
            }
        }
    ],
    &quot;links&quot;: {
        &quot;first&quot;: &quot;http://localhost/api/bookings?page=1&quot;,
        &quot;last&quot;: &quot;http://localhost/api/bookings?page=2&quot;,
        &quot;prev&quot;: null,
        &quot;next&quot;: &quot;http://localhost/api/bookings?page=2&quot;
    },
    &quot;meta&quot;: {
        &quot;current_page&quot;: 1,
        &quot;from&quot;: 1,
        &quot;last_page&quot;: 2,
        &quot;per_page&quot;: 15,
        &quot;to&quot;: 15,
        &quot;total&quot;: 28
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-bookings" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-bookings"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-bookings"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-bookings" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-bookings">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-bookings" data-method="GET"
      data-path="api/bookings"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-bookings', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-bookings"
                    onclick="tryItOut('GETapi-bookings');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-bookings"
                    onclick="cancelTryOut('GETapi-bookings');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-bookings"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/bookings</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-bookings"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-bookings"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="page"                data-endpoint="GETapi-bookings"
               value="1"
               data-component="query">
    <br>
<p>Page number. Example: <code>1</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>per_page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_page"                data-endpoint="GETapi-bookings"
               value="15"
               data-component="query">
    <br>
<p>Items per page (max 100). Example: <code>15</code></p>
            </div>
                </form>

                    <h2 id="service-bookings-PATCHapi-bookings--booking_id--cancel">Cancel Booking</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Cancel a booking. Only the booking owner can cancel.</p>

<span id="example-requests-PATCHapi-bookings--booking_id--cancel">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PATCH \
    "http://localhost/api/bookings/1/cancel" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/bookings/1/cancel"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PATCH",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PATCHapi-bookings--booking_id--cancel">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Booking cancelled successfully&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;status&quot;: &quot;cancelled&quot;,
        &quot;updated_at&quot;: &quot;2024-01-02T00:00:00.000000Z&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (403):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthorized&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-PATCHapi-bookings--booking_id--cancel" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PATCHapi-bookings--booking_id--cancel"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PATCHapi-bookings--booking_id--cancel"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PATCHapi-bookings--booking_id--cancel" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PATCHapi-bookings--booking_id--cancel">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PATCHapi-bookings--booking_id--cancel" data-method="PATCH"
      data-path="api/bookings/{booking_id}/cancel"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PATCHapi-bookings--booking_id--cancel', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PATCHapi-bookings--booking_id--cancel"
                    onclick="tryItOut('PATCHapi-bookings--booking_id--cancel');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PATCHapi-bookings--booking_id--cancel"
                    onclick="cancelTryOut('PATCHapi-bookings--booking_id--cancel');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PATCHapi-bookings--booking_id--cancel"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/bookings/{booking_id}/cancel</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PATCHapi-bookings--booking_id--cancel"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PATCHapi-bookings--booking_id--cancel"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>booking_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="booking_id"                data-endpoint="PATCHapi-bookings--booking_id--cancel"
               value="1"
               data-component="url">
    <br>
<p>The ID of the booking. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>booking</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="booking"                data-endpoint="PATCHapi-bookings--booking_id--cancel"
               value="1"
               data-component="url">
    <br>
<p>The booking ID. Example: <code>1</code></p>
            </div>
                    </form>

                <h1 id="service-categories">Service Categories</h1>

    <p>APIs for browsing practitioner service categories and subcategories</p>

                                <h2 id="service-categories-GETapi-practitioners-categories">Get All Service Categories</h2>

<p>
</p>

<p>Retrieve all active service categories with optional subcategories.
Returns the 5 main categories: Body-Based, Mind-Based, Spirit-Based,
Frequency &amp; Technology, and Integrated Services.</p>

<span id="example-requests-GETapi-practitioners-categories">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/practitioners/categories?include_subcategories=1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/practitioners/categories"
);

const params = {
    "include_subcategories": "1",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-practitioners-categories">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;Body-Based Services&quot;,
            &quot;slug&quot;: &quot;body-based-services&quot;,
            &quot;description&quot;: &quot;Physical healing modalities that work with the body&quot;,
            &quot;display_order&quot;: 1,
            &quot;is_active&quot;: true,
            &quot;active_subcategories&quot;: [
                {
                    &quot;id&quot;: 1,
                    &quot;category_id&quot;: 1,
                    &quot;name&quot;: &quot;Massage Therapy&quot;,
                    &quot;slug&quot;: &quot;massage-therapy&quot;,
                    &quot;display_order&quot;: 1,
                    &quot;is_active&quot;: true
                }
            ]
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-practitioners-categories" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-practitioners-categories"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-practitioners-categories"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-practitioners-categories" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-practitioners-categories">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-practitioners-categories" data-method="GET"
      data-path="api/practitioners/categories"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-practitioners-categories', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-practitioners-categories"
                    onclick="tryItOut('GETapi-practitioners-categories');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-practitioners-categories"
                    onclick="cancelTryOut('GETapi-practitioners-categories');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-practitioners-categories"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/practitioners/categories</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-practitioners-categories"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-practitioners-categories"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>include_subcategories</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="GETapi-practitioners-categories" style="display: none">
            <input type="radio" name="include_subcategories"
                   value="1"
                   data-endpoint="GETapi-practitioners-categories"
                   data-component="query"             >
            <code>true</code>
        </label>
        <label data-endpoint="GETapi-practitioners-categories" style="display: none">
            <input type="radio" name="include_subcategories"
                   value="0"
                   data-endpoint="GETapi-practitioners-categories"
                   data-component="query"             >
            <code>false</code>
        </label>
    <br>
<p>Include subcategories in response. Defaults to true. Example: <code>true</code></p>
            </div>
                </form>

                    <h2 id="service-categories-GETapi-practitioners-categories--id-">Get Category by ID</h2>

<p>
</p>

<p>Retrieve a specific service category with its subcategories.</p>

<span id="example-requests-GETapi-practitioners-categories--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/practitioners/categories/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/practitioners/categories/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-practitioners-categories--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;name&quot;: &quot;Body-Based Services&quot;,
        &quot;slug&quot;: &quot;body-based-services&quot;,
        &quot;description&quot;: &quot;Physical healing modalities&quot;,
        &quot;active_subcategories&quot;: [
            {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Massage Therapy&quot;,
                &quot;slug&quot;: &quot;massage-therapy&quot;
            }
        ]
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;Category not found.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-practitioners-categories--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-practitioners-categories--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-practitioners-categories--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-practitioners-categories--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-practitioners-categories--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-practitioners-categories--id-" data-method="GET"
      data-path="api/practitioners/categories/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-practitioners-categories--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-practitioners-categories--id-"
                    onclick="tryItOut('GETapi-practitioners-categories--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-practitioners-categories--id-"
                    onclick="cancelTryOut('GETapi-practitioners-categories--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-practitioners-categories--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/practitioners/categories/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-practitioners-categories--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-practitioners-categories--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-practitioners-categories--id-"
               value="1"
               data-component="url">
    <br>
<p>The category ID. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="service-categories-GETapi-practitioners-categories-slug--slug-">Get Category by Slug</h2>

<p>
</p>

<p>Retrieve a service category using its URL-friendly slug.</p>

<span id="example-requests-GETapi-practitioners-categories-slug--slug-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/practitioners/categories/slug/body-based-services" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/practitioners/categories/slug/body-based-services"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-practitioners-categories-slug--slug-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;name&quot;: &quot;Body-Based Services&quot;,
        &quot;slug&quot;: &quot;body-based-services&quot;,
        &quot;active_subcategories&quot;: []
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;Category not found.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-practitioners-categories-slug--slug-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-practitioners-categories-slug--slug-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-practitioners-categories-slug--slug-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-practitioners-categories-slug--slug-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-practitioners-categories-slug--slug-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-practitioners-categories-slug--slug-" data-method="GET"
      data-path="api/practitioners/categories/slug/{slug}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-practitioners-categories-slug--slug-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-practitioners-categories-slug--slug-"
                    onclick="tryItOut('GETapi-practitioners-categories-slug--slug-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-practitioners-categories-slug--slug-"
                    onclick="cancelTryOut('GETapi-practitioners-categories-slug--slug-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-practitioners-categories-slug--slug-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/practitioners/categories/slug/{slug}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-practitioners-categories-slug--slug-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-practitioners-categories-slug--slug-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>slug</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="slug"                data-endpoint="GETapi-practitioners-categories-slug--slug-"
               value="body-based-services"
               data-component="url">
    <br>
<p>The category slug. Example: <code>body-based-services</code></p>
            </div>
                    </form>

                    <h2 id="service-categories-GETapi-practitioners-categories--categoryId--subcategories">Get Category Subcategories</h2>

<p>
</p>

<p>Retrieve all subcategories for a specific service category.</p>

<span id="example-requests-GETapi-practitioners-categories--categoryId--subcategories">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/practitioners/categories/1/subcategories" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/practitioners/categories/1/subcategories"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-practitioners-categories--categoryId--subcategories">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;category_id&quot;: 1,
            &quot;name&quot;: &quot;Massage Therapy&quot;,
            &quot;slug&quot;: &quot;massage-therapy&quot;,
            &quot;description&quot;: null,
            &quot;display_order&quot;: 1,
            &quot;is_active&quot;: true
        },
        {
            &quot;id&quot;: 2,
            &quot;category_id&quot;: 1,
            &quot;name&quot;: &quot;Acupuncture&quot;,
            &quot;slug&quot;: &quot;acupuncture&quot;,
            &quot;display_order&quot;: 2,
            &quot;is_active&quot;: true
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-practitioners-categories--categoryId--subcategories" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-practitioners-categories--categoryId--subcategories"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-practitioners-categories--categoryId--subcategories"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-practitioners-categories--categoryId--subcategories" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-practitioners-categories--categoryId--subcategories">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-practitioners-categories--categoryId--subcategories" data-method="GET"
      data-path="api/practitioners/categories/{categoryId}/subcategories"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-practitioners-categories--categoryId--subcategories', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-practitioners-categories--categoryId--subcategories"
                    onclick="tryItOut('GETapi-practitioners-categories--categoryId--subcategories');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-practitioners-categories--categoryId--subcategories"
                    onclick="cancelTryOut('GETapi-practitioners-categories--categoryId--subcategories');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-practitioners-categories--categoryId--subcategories"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/practitioners/categories/{categoryId}/subcategories</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-practitioners-categories--categoryId--subcategories"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-practitioners-categories--categoryId--subcategories"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>categoryId</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="categoryId"                data-endpoint="GETapi-practitioners-categories--categoryId--subcategories"
               value="1"
               data-component="url">
    <br>
<p>The category ID. Example: <code>1</code></p>
            </div>
                    </form>

                <h1 id="service-slots">Service Slots</h1>

    <p>APIs for managing service time slots</p>

                                <h2 id="service-slots-POSTapi-products--product_id--slots">Create Service Slot</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Add a new time slot configuration for a service.</p>

<span id="example-requests-POSTapi-products--product_id--slots">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/products/1/slots" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"duration\": 60,
    \"price\": 150
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/products/1/slots"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "duration": 60,
    "price": 150
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-products--product_id--slots">
            <blockquote>
            <p>Example response (201):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Service slot created successfully&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;product_id&quot;: 1,
        &quot;duration&quot;: 60,
        &quot;price&quot;: &quot;150.00&quot;,
        &quot;created_at&quot;: &quot;2024-01-01T00:00:00.000000Z&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-products--product_id--slots" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-products--product_id--slots"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-products--product_id--slots"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-products--product_id--slots" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-products--product_id--slots">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-products--product_id--slots" data-method="POST"
      data-path="api/products/{product_id}/slots"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-products--product_id--slots', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-products--product_id--slots"
                    onclick="tryItOut('POSTapi-products--product_id--slots');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-products--product_id--slots"
                    onclick="cancelTryOut('POSTapi-products--product_id--slots');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-products--product_id--slots"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/products/{product_id}/slots</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-products--product_id--slots"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-products--product_id--slots"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>product_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="product_id"                data-endpoint="POSTapi-products--product_id--slots"
               value="1"
               data-component="url">
    <br>
<p>The ID of the product. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>product</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="product"                data-endpoint="POSTapi-products--product_id--slots"
               value="1"
               data-component="url">
    <br>
<p>The service product ID. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>duration</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="duration"                data-endpoint="POSTapi-products--product_id--slots"
               value="60"
               data-component="body">
    <br>
<p>Slot duration in minutes. Example: <code>60</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>price</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="price"                data-endpoint="POSTapi-products--product_id--slots"
               value="150"
               data-component="body">
    <br>
<p>Slot price. Example: <code>150</code></p>
        </div>
        </form>

                    <h2 id="service-slots-PUTapi-slots--slot_id-">Update Service Slot</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Update slot configuration. Only vendor owner can update.</p>

<span id="example-requests-PUTapi-slots--slot_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/api/slots/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"duration\": 90,
    \"price\": 200
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/slots/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "duration": 90,
    "price": 200
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-slots--slot_id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Service slot updated successfully&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;duration&quot;: 90,
        &quot;price&quot;: &quot;200.00&quot;,
        &quot;updated_at&quot;: &quot;2024-01-02T00:00:00.000000Z&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-PUTapi-slots--slot_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-slots--slot_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-slots--slot_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-slots--slot_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-slots--slot_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-slots--slot_id-" data-method="PUT"
      data-path="api/slots/{slot_id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-slots--slot_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-slots--slot_id-"
                    onclick="tryItOut('PUTapi-slots--slot_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-slots--slot_id-"
                    onclick="cancelTryOut('PUTapi-slots--slot_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-slots--slot_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/slots/{slot_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-slots--slot_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-slots--slot_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>slot_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="slot_id"                data-endpoint="PUTapi-slots--slot_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the slot. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>slot</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="slot"                data-endpoint="PUTapi-slots--slot_id-"
               value="1"
               data-component="url">
    <br>
<p>The slot ID. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>duration</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="duration"                data-endpoint="PUTapi-slots--slot_id-"
               value="90"
               data-component="body">
    <br>
<p>optional Duration in minutes. Example: <code>90</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>price</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="price"                data-endpoint="PUTapi-slots--slot_id-"
               value="200"
               data-component="body">
    <br>
<p>optional Slot price. Example: <code>200</code></p>
        </div>
        </form>

                    <h2 id="service-slots-DELETEapi-slots--slot_id-">Delete Service Slot</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Delete a service slot. Only vendor owner can delete.</p>

<span id="example-requests-DELETEapi-slots--slot_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/api/slots/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/slots/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-slots--slot_id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Service slot deleted successfully&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthorized&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-DELETEapi-slots--slot_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-slots--slot_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-slots--slot_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-slots--slot_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-slots--slot_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-slots--slot_id-" data-method="DELETE"
      data-path="api/slots/{slot_id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-slots--slot_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-slots--slot_id-"
                    onclick="tryItOut('DELETEapi-slots--slot_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-slots--slot_id-"
                    onclick="cancelTryOut('DELETEapi-slots--slot_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-slots--slot_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/slots/{slot_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-slots--slot_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-slots--slot_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>slot_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="slot_id"                data-endpoint="DELETEapi-slots--slot_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the slot. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>slot</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="slot"                data-endpoint="DELETEapi-slots--slot_id-"
               value="1"
               data-component="url">
    <br>
<p>The slot ID. Example: <code>1</code></p>
            </div>
                    </form>

                <h1 id="vendor-management">Vendor Management</h1>

    <p>APIs for managing vendors</p>

                                <h2 id="vendor-management-GETapi-vendors--vendor_id-">Get Vendor Details</h2>

<p>
</p>

<p>Retrieve detailed information about a specific vendor.</p>

<span id="example-requests-GETapi-vendors--vendor_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/vendors/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/vendors/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-vendors--vendor_id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;user_id&quot;: 1,
        &quot;business_name&quot;: &quot;Tech Solutions Inc&quot;,
        &quot;brief&quot;: &quot;We provide IT consulting services&quot;,
        &quot;category&quot;: [
            &quot;IT&quot;,
            &quot;Consulting&quot;
        ],
        &quot;average_rating&quot;: 4.5,
        &quot;review_count&quot;: 20,
        &quot;is_verified&quot;: true,
        &quot;products&quot;: []
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-vendors--vendor_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-vendors--vendor_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-vendors--vendor_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-vendors--vendor_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-vendors--vendor_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-vendors--vendor_id-" data-method="GET"
      data-path="api/vendors/{vendor_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-vendors--vendor_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-vendors--vendor_id-"
                    onclick="tryItOut('GETapi-vendors--vendor_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-vendors--vendor_id-"
                    onclick="cancelTryOut('GETapi-vendors--vendor_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-vendors--vendor_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/vendors/{vendor_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-vendors--vendor_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-vendors--vendor_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>vendor_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="vendor_id"                data-endpoint="GETapi-vendors--vendor_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the vendor. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>vendor</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="vendor"                data-endpoint="GETapi-vendors--vendor_id-"
               value="1"
               data-component="url">
    <br>
<p>The vendor ID. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="vendor-management-POSTapi-vendors">Create Vendor</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Register a new vendor with business details.</p>

<span id="example-requests-POSTapi-vendors">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/vendors" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"business_name\": \"Tech Solutions Inc\",
    \"brief\": \"We provide IT consulting services\",
    \"category\": [
        \"IT\",
        \"Consulting\"
    ],
    \"website\": \"https:\\/\\/techsolutions.com\",
    \"street_address\": \"123 Main St\",
    \"city\": \"New York\",
    \"state_province\": \"NY\",
    \"postal_code\": \"10001\",
    \"currency\": \"EUR\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/vendors"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "business_name": "Tech Solutions Inc",
    "brief": "We provide IT consulting services",
    "category": [
        "IT",
        "Consulting"
    ],
    "website": "https:\/\/techsolutions.com",
    "street_address": "123 Main St",
    "city": "New York",
    "state_province": "NY",
    "postal_code": "10001",
    "currency": "EUR"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-vendors">
            <blockquote>
            <p>Example response (201):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Vendor created successfully&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;user_id&quot;: 1,
        &quot;business_name&quot;: &quot;Tech Solutions Inc&quot;,
        &quot;brief&quot;: &quot;We provide IT consulting services&quot;,
        &quot;category&quot;: [
            &quot;IT&quot;,
            &quot;Consulting&quot;
        ],
        &quot;website&quot;: &quot;https://techsolutions.com&quot;,
        &quot;verified_at&quot;: null,
        &quot;created_at&quot;: &quot;2024-01-01T00:00:00.000000Z&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-vendors" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-vendors"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-vendors"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-vendors" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-vendors">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-vendors" data-method="POST"
      data-path="api/vendors"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-vendors', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-vendors"
                    onclick="tryItOut('POSTapi-vendors');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-vendors"
                    onclick="cancelTryOut('POSTapi-vendors');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-vendors"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/vendors</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-vendors"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-vendors"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>business_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="business_name"                data-endpoint="POSTapi-vendors"
               value="Tech Solutions Inc"
               data-component="body">
    <br>
<p>The business name. Example: <code>Tech Solutions Inc</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>brief</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="brief"                data-endpoint="POSTapi-vendors"
               value="We provide IT consulting services"
               data-component="body">
    <br>
<p>Brief description of the business. Example: <code>We provide IT consulting services</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>category</code></b>&nbsp;&nbsp;
<small>string[]</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="category[0]"                data-endpoint="POSTapi-vendors"
               data-component="body">
        <input type="text" style="display: none"
               name="category[1]"                data-endpoint="POSTapi-vendors"
               data-component="body">
    <br>
<p>Array of business categories.</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>website</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="website"                data-endpoint="POSTapi-vendors"
               value="https://techsolutions.com"
               data-component="body">
    <br>
<p>optional Business website URL. Example: <code>https://techsolutions.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>street_address</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="street_address"                data-endpoint="POSTapi-vendors"
               value="123 Main St"
               data-component="body">
    <br>
<p>optional Street address. Example: <code>123 Main St</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>city</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="city"                data-endpoint="POSTapi-vendors"
               value="New York"
               data-component="body">
    <br>
<p>City (required if street_address is provided). Example: <code>New York</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>state_province</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="state_province"                data-endpoint="POSTapi-vendors"
               value="NY"
               data-component="body">
    <br>
<p>State/Province (required if street_address is provided). Example: <code>NY</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>postal_code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="postal_code"                data-endpoint="POSTapi-vendors"
               value="10001"
               data-component="body">
    <br>
<p>optional Postal/ZIP code. Example: <code>10001</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>currency</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="currency"                data-endpoint="POSTapi-vendors"
               value="EUR"
               data-component="body">
    <br>
<p>Example: <code>EUR</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>USD</code></li> <li><code>EUR</code></li> <li><code>GBP</code></li></ul>
        </div>
        </form>

                    <h2 id="vendor-management-PUTapi-vendors--vendor_id-">Update Vendor</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Update vendor information. Only the vendor owner can update.</p>

<span id="example-requests-PUTapi-vendors--vendor_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/api/vendors/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"business_name\": \"Tech Solutions Inc\",
    \"brief\": \"Updated description\",
    \"category\": [
        \"IT\",
        \"Software\"
    ],
    \"website\": \"https:\\/\\/newtechsolutions.com\",
    \"street_address\": \"456 Oak Ave\",
    \"city\": \"Boston\",
    \"state_province\": \"MA\",
    \"postal_code\": \"02101\",
    \"currency\": \"EUR\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/vendors/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "business_name": "Tech Solutions Inc",
    "brief": "Updated description",
    "category": [
        "IT",
        "Software"
    ],
    "website": "https:\/\/newtechsolutions.com",
    "street_address": "456 Oak Ave",
    "city": "Boston",
    "state_province": "MA",
    "postal_code": "02101",
    "currency": "EUR"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-vendors--vendor_id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Vendor updated successfully&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;business_name&quot;: &quot;Tech Solutions Inc&quot;,
        &quot;updated_at&quot;: &quot;2024-01-02T00:00:00.000000Z&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-PUTapi-vendors--vendor_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-vendors--vendor_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-vendors--vendor_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-vendors--vendor_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-vendors--vendor_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-vendors--vendor_id-" data-method="PUT"
      data-path="api/vendors/{vendor_id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-vendors--vendor_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-vendors--vendor_id-"
                    onclick="tryItOut('PUTapi-vendors--vendor_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-vendors--vendor_id-"
                    onclick="cancelTryOut('PUTapi-vendors--vendor_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-vendors--vendor_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/vendors/{vendor_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-vendors--vendor_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-vendors--vendor_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>vendor_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="vendor_id"                data-endpoint="PUTapi-vendors--vendor_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the vendor. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>vendor</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="vendor"                data-endpoint="PUTapi-vendors--vendor_id-"
               value="1"
               data-component="url">
    <br>
<p>The vendor ID. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>business_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="business_name"                data-endpoint="PUTapi-vendors--vendor_id-"
               value="Tech Solutions Inc"
               data-component="body">
    <br>
<p>optional The business name. Example: <code>Tech Solutions Inc</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>brief</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="brief"                data-endpoint="PUTapi-vendors--vendor_id-"
               value="Updated description"
               data-component="body">
    <br>
<p>optional Brief description. Example: <code>Updated description</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>category</code></b>&nbsp;&nbsp;
<small>string[]</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="category[0]"                data-endpoint="PUTapi-vendors--vendor_id-"
               data-component="body">
        <input type="text" style="display: none"
               name="category[1]"                data-endpoint="PUTapi-vendors--vendor_id-"
               data-component="body">
    <br>
<p>optional Array of categories.</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>website</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="website"                data-endpoint="PUTapi-vendors--vendor_id-"
               value="https://newtechsolutions.com"
               data-component="body">
    <br>
<p>optional Business website. Example: <code>https://newtechsolutions.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>street_address</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="street_address"                data-endpoint="PUTapi-vendors--vendor_id-"
               value="456 Oak Ave"
               data-component="body">
    <br>
<p>optional Street address. Example: <code>456 Oak Ave</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>city</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="city"                data-endpoint="PUTapi-vendors--vendor_id-"
               value="Boston"
               data-component="body">
    <br>
<p>City (required if street_address is provided). Example: <code>Boston</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>state_province</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="state_province"                data-endpoint="PUTapi-vendors--vendor_id-"
               value="MA"
               data-component="body">
    <br>
<p>State (required if street_address is provided). Example: <code>MA</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>postal_code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="postal_code"                data-endpoint="PUTapi-vendors--vendor_id-"
               value="02101"
               data-component="body">
    <br>
<p>optional Postal code. Example: <code>02101</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>currency</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="currency"                data-endpoint="PUTapi-vendors--vendor_id-"
               value="EUR"
               data-component="body">
    <br>
<p>Example: <code>EUR</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>USD</code></li> <li><code>EUR</code></li> <li><code>GBP</code></li></ul>
        </div>
        </form>

                    <h2 id="vendor-management-PATCHapi-vendors--vendor_id--verify">Verify Vendor</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Verify a vendor (admin only). Verified vendors appear in public listings.</p>

<span id="example-requests-PATCHapi-vendors--vendor_id--verify">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PATCH \
    "http://localhost/api/vendors/1/verify" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/vendors/1/verify"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PATCH",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PATCHapi-vendors--vendor_id--verify">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Vendor verified successfully&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;verified_at&quot;: &quot;2024-01-01T00:00:00.000000Z&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (403):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthorized&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-PATCHapi-vendors--vendor_id--verify" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PATCHapi-vendors--vendor_id--verify"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PATCHapi-vendors--vendor_id--verify"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PATCHapi-vendors--vendor_id--verify" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PATCHapi-vendors--vendor_id--verify">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PATCHapi-vendors--vendor_id--verify" data-method="PATCH"
      data-path="api/vendors/{vendor_id}/verify"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PATCHapi-vendors--vendor_id--verify', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PATCHapi-vendors--vendor_id--verify"
                    onclick="tryItOut('PATCHapi-vendors--vendor_id--verify');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PATCHapi-vendors--vendor_id--verify"
                    onclick="cancelTryOut('PATCHapi-vendors--vendor_id--verify');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PATCHapi-vendors--vendor_id--verify"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/vendors/{vendor_id}/verify</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PATCHapi-vendors--vendor_id--verify"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PATCHapi-vendors--vendor_id--verify"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>vendor_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="vendor_id"                data-endpoint="PATCHapi-vendors--vendor_id--verify"
               value="1"
               data-component="url">
    <br>
<p>The ID of the vendor. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>vendor</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="vendor"                data-endpoint="PATCHapi-vendors--vendor_id--verify"
               value="1"
               data-component="url">
    <br>
<p>The vendor ID. Example: <code>1</code></p>
            </div>
                    </form>

                <h1 id="vendor-reviews">Vendor Reviews</h1>

    <p>APIs for managing vendor ratings and reviews</p>

                                <h2 id="vendor-reviews-GETapi-vendors--vendor_id--reviews">List Vendor Reviews</h2>

<p>
</p>

<p>Get all reviews for a vendor with pagination.</p>

<span id="example-requests-GETapi-vendors--vendor_id--reviews">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/vendors/1/reviews?page=1&amp;per_page=15" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/vendors/1/reviews"
);

const params = {
    "page": "1",
    "per_page": "15",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-vendors--vendor_id--reviews">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;vendor_id&quot;: 1,
            &quot;user_id&quot;: 1,
            &quot;rating&quot;: 5,
            &quot;user&quot;: {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;John Doe&quot;
            },
            &quot;created_at&quot;: &quot;2024-01-01T00:00:00.000000Z&quot;
        },
        {
            &quot;id&quot;: 2,
            &quot;vendor_id&quot;: 1,
            &quot;user_id&quot;: 2,
            &quot;rating&quot;: 4,
            &quot;user&quot;: {
                &quot;id&quot;: 2,
                &quot;name&quot;: &quot;Jane Smith&quot;
            },
            &quot;created_at&quot;: &quot;2024-01-02T00:00:00.000000Z&quot;
        }
    ],
    &quot;links&quot;: {
        &quot;first&quot;: &quot;http://localhost/api/vendors/1/reviews?page=1&quot;,
        &quot;last&quot;: &quot;http://localhost/api/vendors/1/reviews?page=5&quot;,
        &quot;prev&quot;: null,
        &quot;next&quot;: &quot;http://localhost/api/vendors/1/reviews?page=2&quot;
    },
    &quot;meta&quot;: {
        &quot;current_page&quot;: 1,
        &quot;from&quot;: 1,
        &quot;last_page&quot;: 5,
        &quot;per_page&quot;: 15,
        &quot;to&quot;: 15,
        &quot;total&quot;: 73
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-vendors--vendor_id--reviews" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-vendors--vendor_id--reviews"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-vendors--vendor_id--reviews"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-vendors--vendor_id--reviews" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-vendors--vendor_id--reviews">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-vendors--vendor_id--reviews" data-method="GET"
      data-path="api/vendors/{vendor_id}/reviews"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-vendors--vendor_id--reviews', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-vendors--vendor_id--reviews"
                    onclick="tryItOut('GETapi-vendors--vendor_id--reviews');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-vendors--vendor_id--reviews"
                    onclick="cancelTryOut('GETapi-vendors--vendor_id--reviews');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-vendors--vendor_id--reviews"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/vendors/{vendor_id}/reviews</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-vendors--vendor_id--reviews"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-vendors--vendor_id--reviews"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>vendor_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="vendor_id"                data-endpoint="GETapi-vendors--vendor_id--reviews"
               value="1"
               data-component="url">
    <br>
<p>The ID of the vendor. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>vendor</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="vendor"                data-endpoint="GETapi-vendors--vendor_id--reviews"
               value="1"
               data-component="url">
    <br>
<p>The vendor ID. Example: <code>1</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="page"                data-endpoint="GETapi-vendors--vendor_id--reviews"
               value="1"
               data-component="query">
    <br>
<p>Page number. Example: <code>1</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>per_page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_page"                data-endpoint="GETapi-vendors--vendor_id--reviews"
               value="15"
               data-component="query">
    <br>
<p>Items per page (max 100). Example: <code>15</code></p>
            </div>
                </form>

                    <h2 id="vendor-reviews-POSTapi-vendors--vendor_id--reviews">Add Review</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Submit a rating for a vendor.</p>

<span id="example-requests-POSTapi-vendors--vendor_id--reviews">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/vendors/1/reviews" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"rating\": 5
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/vendors/1/reviews"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "rating": 5
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-vendors--vendor_id--reviews">
            <blockquote>
            <p>Example response (201):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Review created successfully&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;vendor_id&quot;: 1,
        &quot;user_id&quot;: 1,
        &quot;rating&quot;: 5,
        &quot;created_at&quot;: &quot;2024-01-01T00:00:00.000000Z&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-vendors--vendor_id--reviews" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-vendors--vendor_id--reviews"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-vendors--vendor_id--reviews"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-vendors--vendor_id--reviews" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-vendors--vendor_id--reviews">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-vendors--vendor_id--reviews" data-method="POST"
      data-path="api/vendors/{vendor_id}/reviews"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-vendors--vendor_id--reviews', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-vendors--vendor_id--reviews"
                    onclick="tryItOut('POSTapi-vendors--vendor_id--reviews');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-vendors--vendor_id--reviews"
                    onclick="cancelTryOut('POSTapi-vendors--vendor_id--reviews');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-vendors--vendor_id--reviews"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/vendors/{vendor_id}/reviews</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-vendors--vendor_id--reviews"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-vendors--vendor_id--reviews"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>vendor_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="vendor_id"                data-endpoint="POSTapi-vendors--vendor_id--reviews"
               value="1"
               data-component="url">
    <br>
<p>The ID of the vendor. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>vendor</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="vendor"                data-endpoint="POSTapi-vendors--vendor_id--reviews"
               value="1"
               data-component="url">
    <br>
<p>The vendor ID. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>rating</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="rating"                data-endpoint="POSTapi-vendors--vendor_id--reviews"
               value="5"
               data-component="body">
    <br>
<p>Rating from 1-5. Example: <code>5</code></p>
        </div>
        </form>

                <h1 id="webhooks">Webhooks</h1>

    <p>Stripe webhook handlers</p>

                                <h2 id="webhooks-POSTapi-webhooks-stripe">Handle Stripe Webhook</h2>

<p>
</p>

<p>Process Stripe webhook events for payment confirmations.</p>

<span id="example-requests-POSTapi-webhooks-stripe">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/webhooks/stripe" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/webhooks/stripe"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-webhooks-stripe">
</span>
<span id="execution-results-POSTapi-webhooks-stripe" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-webhooks-stripe"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-webhooks-stripe"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-webhooks-stripe" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-webhooks-stripe">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-webhooks-stripe" data-method="POST"
      data-path="api/webhooks/stripe"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-webhooks-stripe', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-webhooks-stripe"
                    onclick="tryItOut('POSTapi-webhooks-stripe');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-webhooks-stripe"
                    onclick="cancelTryOut('POSTapi-webhooks-stripe');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-webhooks-stripe"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/webhooks/stripe</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-webhooks-stripe"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-webhooks-stripe"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

            

        
    </div>
    <div class="dark-box">
                    <div class="lang-selector">
                                                        <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                                        <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                            </div>
            </div>
</div>
</body>
</html>
