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
                    <ul id="tocify-header-admin-authentication" class="tocify-header">
                <li class="tocify-item level-1" data-unique="admin-authentication">
                    <a href="#admin-authentication">Admin Authentication</a>
                </li>
                                    <ul id="tocify-subheader-admin-authentication" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="admin-authentication-POSTapi-admin-login">
                                <a href="#admin-authentication-POSTapi-admin-login">Admin Login</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="admin-authentication-POSTapi-admin-logout">
                                <a href="#admin-authentication-POSTapi-admin-logout">Admin Logout</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="admin-authentication-GETapi-admin-user">
                                <a href="#admin-authentication-GETapi-admin-user">Get Current Admin</a>
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
                                                    <li class="tocify-item level-2" data-unique="endpoints-GETapi-practitioners-profiles--profileId--reviews">
                                <a href="#endpoints-GETapi-practitioners-profiles--profileId--reviews">List reviews for a practitioner profile.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-practitioners-offering-slots--slot_id--availability">
                                <a href="#endpoints-GETapi-practitioners-offering-slots--slot_id--availability">GET api/practitioners/offering-slots/{slot_id}/availability</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-cart">
                                <a href="#endpoints-GETapi-cart">GET api/cart</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-cart">
                                <a href="#endpoints-POSTapi-cart">POST api/cart</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTapi-cart--cart_id-">
                                <a href="#endpoints-PUTapi-cart--cart_id-">PUT api/cart/{cart_id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEapi-cart--cart_id-">
                                <a href="#endpoints-DELETEapi-cart--cart_id-">DELETE api/cart/{cart_id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEapi-cart">
                                <a href="#endpoints-DELETEapi-cart">DELETE api/cart</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-cart-count">
                                <a href="#endpoints-GETapi-cart-count">GET api/cart/count</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-checkout-payment-intent">
                                <a href="#endpoints-POSTapi-checkout-payment-intent">POST api/checkout/payment-intent</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-checkout-process">
                                <a href="#endpoints-POSTapi-checkout-process">POST api/checkout/process</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-checkout-verify-payment">
                                <a href="#endpoints-POSTapi-checkout-verify-payment">POST api/checkout/verify-payment</a>
                            </li>
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
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-practitioners-profiles--profileId--reviews">
                                <a href="#endpoints-POSTapi-practitioners-profiles--profileId--reviews">Submit a review for a practitioner.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-practitioners-profiles--profileId--reviews-eligibility">
                                <a href="#endpoints-GETapi-practitioners-profiles--profileId--reviews-eligibility">Check if the current user can review this practitioner.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-practitioners-offering-slots--slot_id--schedule">
                                <a href="#endpoints-POSTapi-practitioners-offering-slots--slot_id--schedule">POST api/practitioners/offering-slots/{slot_id}/schedule</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-practitioners-offering-slots--slot_id--schedule">
                                <a href="#endpoints-GETapi-practitioners-offering-slots--slot_id--schedule">GET api/practitioners/offering-slots/{slot_id}/schedule</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEapi-practitioners-offering-slots--slot_id--schedule">
                                <a href="#endpoints-DELETEapi-practitioners-offering-slots--slot_id--schedule">DELETE api/practitioners/offering-slots/{slot_id}/schedule</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-practitioners-bookings">
                                <a href="#endpoints-POSTapi-practitioners-bookings">POST api/practitioners/bookings</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-practitioners-bookings">
                                <a href="#endpoints-GETapi-practitioners-bookings">GET api/practitioners/bookings</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PATCHapi-practitioners-bookings--booking_id--cancel">
                                <a href="#endpoints-PATCHapi-practitioners-bookings--booking_id--cancel">PATCH api/practitioners/bookings/{booking_id}/cancel</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-practitioners-bookings--booking_id--request-cancellation">
                                <a href="#endpoints-POSTapi-practitioners-bookings--booking_id--request-cancellation">POST api/practitioners/bookings/{booking_id}/request-cancellation</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-practitioners-my-bookings">
                                <a href="#endpoints-GETapi-practitioners-my-bookings">GET api/practitioners/my-bookings</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-practitioners-my-bookings--booking_id--approve-cancellation">
                                <a href="#endpoints-POSTapi-practitioners-my-bookings--booking_id--approve-cancellation">POST api/practitioners/my-bookings/{booking_id}/approve-cancellation</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-practitioners-my-bookings--booking_id--deny-cancellation">
                                <a href="#endpoints-POSTapi-practitioners-my-bookings--booking_id--deny-cancellation">POST api/practitioners/my-bookings/{booking_id}/deny-cancellation</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-practitioners-availability">
                                <a href="#endpoints-GETapi-practitioners-availability">GET api/practitioners/availability</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-practitioners-availability-repeat">
                                <a href="#endpoints-POSTapi-practitioners-availability-repeat">POST api/practitioners/availability/repeat</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-practitioners-availability-check-skip">
                                <a href="#endpoints-GETapi-practitioners-availability-check-skip">GET api/practitioners/availability/check-skip</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-practitioners-availability-skip">
                                <a href="#endpoints-POSTapi-practitioners-availability-skip">POST api/practitioners/availability/skip</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEapi-practitioners-availability-skip">
                                <a href="#endpoints-DELETEapi-practitioners-availability-skip">DELETE api/practitioners/availability/skip</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTapi-practitioners-availability-pattern">
                                <a href="#endpoints-PUTapi-practitioners-availability-pattern">PUT api/practitioners/availability/pattern</a>
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
                                <a href="#forum-management-GETapi-forums">List forums</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="forum-management-GETapi-forums--id-">
                                <a href="#forum-management-GETapi-forums--id-">Get a forum</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="forum-management-POSTapi-forums">
                                <a href="#forum-management-POSTapi-forums">Create a forum</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="forum-management-DELETEapi-forums--id-">
                                <a href="#forum-management-DELETEapi-forums--id-">Delete a forum</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="forum-management-POSTapi-forums--id--view">
                                <a href="#forum-management-POSTapi-forums--id--view">Record a forum view</a>
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
                                                                                <li class="tocify-item level-2" data-unique="practitioner-applications-GETapi-admin-practitioners-applications--id-">
                                <a href="#practitioner-applications-GETapi-admin-practitioners-applications--id-">Get Application Details</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="practitioner-applications-GETapi-admin-practitioners-applications-pending">
                                <a href="#practitioner-applications-GETapi-admin-practitioners-applications-pending">Get Pending Applications (Admin)</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="practitioner-applications-POSTapi-admin-practitioners-applications--id--review">
                                <a href="#practitioner-applications-POSTapi-admin-practitioners-applications--id--review">Review Application (Admin)</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="practitioner-applications-GETapi-admin-practitioners-documents--document_id--download">
                                <a href="#practitioner-applications-GETapi-admin-practitioners-documents--document_id--download">Download Application Document (Admin)</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-practitioner-offerings" class="tocify-header">
                <li class="tocify-item level-1" data-unique="practitioner-offerings">
                    <a href="#practitioner-offerings">Practitioner Offerings</a>
                </li>
                                    <ul id="tocify-subheader-practitioner-offerings" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="practitioner-offerings-GETapi-practitioners-profiles--profile_id--offerings">
                                <a href="#practitioner-offerings-GETapi-practitioners-profiles--profile_id--offerings">List Profile Offerings — Public</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="practitioner-offerings-GETapi-practitioners-offerings-browse">
                                <a href="#practitioner-offerings-GETapi-practitioners-offerings-browse">Browse All Offerings — Public Marketplace</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="practitioner-offerings-GETapi-practitioners-offerings">
                                <a href="#practitioner-offerings-GETapi-practitioners-offerings">List Offerings by Subcategory — Public</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="practitioner-offerings-GETapi-practitioners-offerings--offering_id-">
                                <a href="#practitioner-offerings-GETapi-practitioners-offerings--offering_id-">Get Offering Details — Public</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="practitioner-offerings-GETapi-practitioners-offerings-all">
                                <a href="#practitioner-offerings-GETapi-practitioners-offerings-all">List Own Offerings — Practitioner Dashboard</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="practitioner-offerings-POSTapi-practitioners-profiles--profile_id--offerings">
                                <a href="#practitioner-offerings-POSTapi-practitioners-profiles--profile_id--offerings">Create Offering</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="practitioner-offerings-PUTapi-practitioners-offerings--offering_id-">
                                <a href="#practitioner-offerings-PUTapi-practitioners-offerings--offering_id-">Update Offering</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="practitioner-offerings-DELETEapi-practitioners-offerings--offering_id-">
                                <a href="#practitioner-offerings-DELETEapi-practitioners-offerings--offering_id-">Delete Offering</a>
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
                                <a href="#product-management-POSTapi-vendors--vendor_id--products">Create Product</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="product-management-GETapi-vendors--vendor_id--products">
                                <a href="#product-management-GETapi-vendors--vendor_id--products">List Vendor Products</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="product-management-PUTapi-products--product_id-">
                                <a href="#product-management-PUTapi-products--product_id-">Update Product</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="product-management-DELETEapi-products--product_id-">
                                <a href="#product-management-DELETEapi-products--product_id-">Delete Product</a>
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
                    <ul id="tocify-header-service-bookings" class="tocify-header">
                <li class="tocify-item level-1" data-unique="service-bookings">
                    <a href="#service-bookings">Service Bookings</a>
                </li>
                                    <ul id="tocify-subheader-service-bookings" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="service-bookings-GETapi-slots--slot_id--availability">
                                <a href="#service-bookings-GETapi-slots--slot_id--availability">Check Slot Availability</a>
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
                                                                                <li class="tocify-item level-2" data-unique="vendor-management-GETapi-admin-vendors">
                                <a href="#vendor-management-GETapi-admin-vendors">List All Vendors (Admin)</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="vendor-management-GETapi-admin-vendors--id-">
                                <a href="#vendor-management-GETapi-admin-vendors--id-">Get Vendor Details (Admin)</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="vendor-management-POSTapi-admin-vendors--id--review">
                                <a href="#vendor-management-POSTapi-admin-vendors--id--review">Review Vendor (Admin)</a>
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
        <li>Last updated: March 9, 2026</li>
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
    "http://localhost/api/addresses/16" \
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
    \"is_default\": false
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/addresses/16"
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
    "is_default": false
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
               value="16"
               data-component="url">
    <br>
<p>The ID of the address. Example: <code>16</code></p>
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
<p>Example: <code>false</code></p>
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
    "http://localhost/api/addresses/16" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/addresses/16"
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
               value="16"
               data-component="url">
    <br>
<p>The ID of the address. Example: <code>16</code></p>
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
    "http://localhost/api/addresses/16/default" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/addresses/16/default"
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
               value="16"
               data-component="url">
    <br>
<p>The ID of the address. Example: <code>16</code></p>
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

                <h1 id="admin-authentication">Admin Authentication</h1>

    <p>APIs for admin authentication (separate from regular users)</p>

                                <h2 id="admin-authentication-POSTapi-admin-login">Admin Login</h2>

<p>
</p>

<p>Authenticate an admin and receive a bearer token.
Use this token with the admin guard for admin-only endpoints.</p>

<span id="example-requests-POSTapi-admin-login">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/admin/login" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"email\": \"admin@example.com\",
    \"password\": \"password\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/admin/login"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "admin@example.com",
    "password": "password"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-admin-login">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;token&quot;: &quot;2|xxxxxxxxxxxxxxxxxxxxxxxx&quot;,
    &quot;admin&quot;: {
        &quot;id&quot;: 1,
        &quot;name&quot;: &quot;Admin User&quot;,
        &quot;email&quot;: &quot;admin@example.com&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;The provided credentials are incorrect.&quot;,
    &quot;errors&quot;: {
        &quot;email&quot;: [
            &quot;The provided credentials are incorrect.&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-admin-login" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-admin-login"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-admin-login"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-admin-login" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-admin-login">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-admin-login" data-method="POST"
      data-path="api/admin/login"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-admin-login', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-admin-login"
                    onclick="tryItOut('POSTapi-admin-login');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-admin-login"
                    onclick="cancelTryOut('POSTapi-admin-login');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-admin-login"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/admin/login</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-admin-login"
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
                              name="Accept"                data-endpoint="POSTapi-admin-login"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-admin-login"
               value="admin@example.com"
               data-component="body">
    <br>
<p>Admin email address. Example: <code>admin@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-admin-login"
               value="password"
               data-component="body">
    <br>
<p>Admin password. Example: <code>password</code></p>
        </div>
        </form>

                    <h2 id="admin-authentication-POSTapi-admin-logout">Admin Logout</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Logout and invalidate the current admin token.</p>

<span id="example-requests-POSTapi-admin-logout">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/admin/logout" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/admin/logout"
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

<span id="example-responses-POSTapi-admin-logout">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Logged out successfully&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-admin-logout" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-admin-logout"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-admin-logout"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-admin-logout" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-admin-logout">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-admin-logout" data-method="POST"
      data-path="api/admin/logout"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-admin-logout', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-admin-logout"
                    onclick="tryItOut('POSTapi-admin-logout');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-admin-logout"
                    onclick="cancelTryOut('POSTapi-admin-logout');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-admin-logout"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/admin/logout</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-admin-logout"
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
                              name="Accept"                data-endpoint="POSTapi-admin-logout"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="admin-authentication-GETapi-admin-user">Get Current Admin</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Get the currently authenticated admin user's information.</p>

<span id="example-requests-GETapi-admin-user">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/admin/user" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/admin/user"
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

<span id="example-responses-GETapi-admin-user">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;admin&quot;: {
        &quot;id&quot;: 1,
        &quot;name&quot;: &quot;Admin User&quot;,
        &quot;email&quot;: &quot;admin@example.com&quot;,
        &quot;email_verified_at&quot;: &quot;2024-02-08T10:00:00Z&quot;,
        &quot;created_at&quot;: &quot;2024-02-08T10:00:00Z&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-admin-user" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-admin-user"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-admin-user"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-admin-user" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-admin-user">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-admin-user" data-method="GET"
      data-path="api/admin/user"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-admin-user', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-admin-user"
                    onclick="tryItOut('GETapi-admin-user');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-admin-user"
                    onclick="cancelTryOut('GETapi-admin-user');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-admin-user"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/admin/user</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-admin-user"
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
                              name="Accept"                data-endpoint="GETapi-admin-user"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
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

    

                                <h2 id="endpoints-GETapi-practitioners-profiles--profileId--reviews">List reviews for a practitioner profile.</h2>

<p>
</p>

<p>Public endpoint.</p>

<span id="example-requests-GETapi-practitioners-profiles--profileId--reviews">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/practitioners/profiles/architecto/reviews" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/practitioners/profiles/architecto/reviews"
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

<span id="example-responses-GETapi-practitioners-profiles--profileId--reviews">
            <blockquote>
            <p>Example response (500):</p>
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
    &quot;message&quot;: &quot;Server error&quot;,
    &quot;error&quot;: &quot;An unexpected error occurred. Please try again later.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-practitioners-profiles--profileId--reviews" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-practitioners-profiles--profileId--reviews"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-practitioners-profiles--profileId--reviews"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-practitioners-profiles--profileId--reviews" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-practitioners-profiles--profileId--reviews">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-practitioners-profiles--profileId--reviews" data-method="GET"
      data-path="api/practitioners/profiles/{profileId}/reviews"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-practitioners-profiles--profileId--reviews', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-practitioners-profiles--profileId--reviews"
                    onclick="tryItOut('GETapi-practitioners-profiles--profileId--reviews');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-practitioners-profiles--profileId--reviews"
                    onclick="cancelTryOut('GETapi-practitioners-profiles--profileId--reviews');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-practitioners-profiles--profileId--reviews"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/practitioners/profiles/{profileId}/reviews</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-practitioners-profiles--profileId--reviews"
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
                              name="Accept"                data-endpoint="GETapi-practitioners-profiles--profileId--reviews"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>profileId</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="profileId"                data-endpoint="GETapi-practitioners-profiles--profileId--reviews"
               value="architecto"
               data-component="url">
    <br>
<p>Example: <code>architecto</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-practitioners-offering-slots--slot_id--availability">GET api/practitioners/offering-slots/{slot_id}/availability</h2>

<p>
</p>



<span id="example-requests-GETapi-practitioners-offering-slots--slot_id--availability">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/practitioners/offering-slots/1/availability" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"start_date\": \"2026-03-09\",
    \"end_date\": \"2052-04-01\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/practitioners/offering-slots/1/availability"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "start_date": "2026-03-09",
    "end_date": "2052-04-01"
};

fetch(url, {
    method: "GET",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-practitioners-offering-slots--slot_id--availability">
            <blockquote>
            <p>Example response (200):</p>
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
    &quot;booked&quot;: []
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-practitioners-offering-slots--slot_id--availability" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-practitioners-offering-slots--slot_id--availability"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-practitioners-offering-slots--slot_id--availability"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-practitioners-offering-slots--slot_id--availability" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-practitioners-offering-slots--slot_id--availability">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-practitioners-offering-slots--slot_id--availability" data-method="GET"
      data-path="api/practitioners/offering-slots/{slot_id}/availability"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-practitioners-offering-slots--slot_id--availability', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-practitioners-offering-slots--slot_id--availability"
                    onclick="tryItOut('GETapi-practitioners-offering-slots--slot_id--availability');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-practitioners-offering-slots--slot_id--availability"
                    onclick="cancelTryOut('GETapi-practitioners-offering-slots--slot_id--availability');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-practitioners-offering-slots--slot_id--availability"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/practitioners/offering-slots/{slot_id}/availability</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-practitioners-offering-slots--slot_id--availability"
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
                              name="Accept"                data-endpoint="GETapi-practitioners-offering-slots--slot_id--availability"
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
               step="any"               name="slot_id"                data-endpoint="GETapi-practitioners-offering-slots--slot_id--availability"
               value="1"
               data-component="url">
    <br>
<p>The ID of the slot. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>start_date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="start_date"                data-endpoint="GETapi-practitioners-offering-slots--slot_id--availability"
               value="2026-03-09"
               data-component="body">
    <br>
<p>Must be a valid date. Must be a valid date in the format <code>Y-m-d</code>. Example: <code>2026-03-09</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>end_date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="end_date"                data-endpoint="GETapi-practitioners-offering-slots--slot_id--availability"
               value="2052-04-01"
               data-component="body">
    <br>
<p>Must be a valid date. Must be a valid date in the format <code>Y-m-d</code>. Must be a date after or equal to <code>start_date</code>. Example: <code>2052-04-01</code></p>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-cart">GET api/cart</h2>

<p>
</p>



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
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: http://localhost:3000
access-control-allow-credentials: true
set-cookie: cart_session_id=b86ba09a-6892-4c63-81be-0c4ca833d6ae; expires=Wed, 08 Apr 2026 13:56:35 GMT; Max-Age=2592000; path=/; httponly; samesite=lax
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;items&quot;: [],
        &quot;count&quot;: 0,
        &quot;totals&quot;: {
            &quot;subtotal&quot;: 0,
            &quot;shipping&quot;: 0,
            &quot;commission_fee&quot;: 0,
            &quot;total&quot;: 0,
            &quot;currency&quot;: &quot;USD&quot;,
            &quot;currency_symbol&quot;: &quot;$&quot;,
            &quot;has_multiple_currencies&quot;: false,
            &quot;currencies&quot;: []
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

                    <h2 id="endpoints-POSTapi-cart">POST api/cart</h2>

<p>
</p>



<span id="example-requests-POSTapi-cart">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/cart" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"product_id\": 16,
    \"variant_id\": 16,
    \"practitioner_offering_slot_id\": 16,
    \"service_slot_id\": 16,
    \"booking_date\": \"2052-04-01\",
    \"start_time\": \"42:55\",
    \"end_time\": \"42:55\",
    \"quantity\": 5
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
    "product_id": 16,
    "variant_id": 16,
    "practitioner_offering_slot_id": 16,
    "service_slot_id": 16,
    "booking_date": "2052-04-01",
    "start_time": "42:55",
    "end_time": "42:55",
    "quantity": 5
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-cart">
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
               value="16"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the products table. Example: <code>16</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>variant_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="variant_id"                data-endpoint="POSTapi-cart"
               value="16"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the product_variants table. Example: <code>16</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>practitioner_offering_slot_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="practitioner_offering_slot_id"                data-endpoint="POSTapi-cart"
               value="16"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the practitioner_offering_slots table. Example: <code>16</code></p>
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
<p>The <code>id</code> of an existing record in the service_slots table. Example: <code>16</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>booking_date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="booking_date"                data-endpoint="POSTapi-cart"
               value="2052-04-01"
               data-component="body">
    <br>
<p>Must be a valid date. Must be a date after or equal to <code>today</code>. Example: <code>2052-04-01</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>start_time</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="start_time"                data-endpoint="POSTapi-cart"
               value="42:55"
               data-component="body">
    <br>
<p>Must match the regex /^\d{1,2}:\d{2}(:\d{2})?$/. Example: <code>42:55</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>end_time</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="end_time"                data-endpoint="POSTapi-cart"
               value="42:55"
               data-component="body">
    <br>
<p>Must match the regex /^\d{1,2}:\d{2}(:\d{2})?$/. Example: <code>42:55</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>quantity</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="quantity"                data-endpoint="POSTapi-cart"
               value="5"
               data-component="body">
    <br>
<p>Must be at least 1. Must not be greater than 99. Example: <code>5</code></p>
        </div>
        </form>

                    <h2 id="endpoints-PUTapi-cart--cart_id-">PUT api/cart/{cart_id}</h2>

<p>
</p>



<span id="example-requests-PUTapi-cart--cart_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/api/cart/16" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/cart/16"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-cart--cart_id-">
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
               value="16"
               data-component="url">
    <br>
<p>The ID of the cart. Example: <code>16</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-DELETEapi-cart--cart_id-">DELETE api/cart/{cart_id}</h2>

<p>
</p>



<span id="example-requests-DELETEapi-cart--cart_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/api/cart/16" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/cart/16"
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
               value="16"
               data-component="url">
    <br>
<p>The ID of the cart. Example: <code>16</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-DELETEapi-cart">DELETE api/cart</h2>

<p>
</p>



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

                    <h2 id="endpoints-GETapi-cart-count">GET api/cart/count</h2>

<p>
</p>



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
    &quot;data&quot;: {
        &quot;count&quot;: 0
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

                    <h2 id="endpoints-POSTapi-checkout-payment-intent">POST api/checkout/payment-intent</h2>

<p>
</p>



<span id="example-requests-POSTapi-checkout-payment-intent">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/checkout/payment-intent" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/checkout/payment-intent"
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

<span id="example-responses-POSTapi-checkout-payment-intent">
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
                        </form>

                    <h2 id="endpoints-POSTapi-checkout-process">POST api/checkout/process</h2>

<p>
</p>



<span id="example-requests-POSTapi-checkout-process">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/checkout/process" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"payment_method_id\": \"architecto\",
    \"order_notes\": \"n\",
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
    \"payment_intents\": [
        {
            \"payment_method_id\": \"architecto\",
            \"currency\": \"ngz\"
        }
    ]
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
    "order_notes": "n",
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
    "payment_intents": [
        {
            "payment_method_id": "architecto",
            "currency": "ngz"
        }
    ]
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-checkout-process">
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
<small>object[]</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
<br>
<p>This field is required when <code>payment_method_id</code> is not present. Must have at least 1 items.</p>
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
                                    </details>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>order_notes</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="order_notes"                data-endpoint="POSTapi-checkout-process"
               value="n"
               data-component="body">
    <br>
<p>Must not be greater than 1000 characters. Example: <code>n</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
        <details>
            <summary style="padding-bottom: 10px;">
                <b style="line-height: 2;"><code>address</code></b>&nbsp;&nbsp;
<small>object</small>&nbsp;
 &nbsp;
 &nbsp;
<br>

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
        </form>

                    <h2 id="endpoints-POSTapi-checkout-verify-payment">POST api/checkout/verify-payment</h2>

<p>
</p>



<span id="example-requests-POSTapi-checkout-verify-payment">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/checkout/verify-payment" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"payment_intent_id\": \"architecto\"
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
    "payment_intent_id": "architecto"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-checkout-verify-payment">
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
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
        </form>

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
    "http://localhost/api/vendor/orders/16/status" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"status\": \"processing\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/vendor/orders/16/status"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "status": "processing"
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
               value="16"
               data-component="url">
    <br>
<p>The ID of the order. Example: <code>16</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="PATCHapi-vendor-orders--order_id--status"
               value="processing"
               data-component="body">
    <br>
<p>Example: <code>processing</code></p>
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
    "http://localhost/api/vendor/orders/16/cancel" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"reason\": \"b\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/vendor/orders/16/cancel"
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
               value="16"
               data-component="url">
    <br>
<p>The ID of the order. Example: <code>16</code></p>
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
    "http://localhost/api/vendor/orders/16/approve-cancellation" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/vendor/orders/16/approve-cancellation"
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
               value="16"
               data-component="url">
    <br>
<p>The ID of the order. Example: <code>16</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-POSTapi-vendor-orders--order_id--deny-cancellation">Deny cancellation request</h2>

<p>
</p>



<span id="example-requests-POSTapi-vendor-orders--order_id--deny-cancellation">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/vendor/orders/16/deny-cancellation" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"reason\": \"b\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/vendor/orders/16/deny-cancellation"
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
               value="16"
               data-component="url">
    <br>
<p>The ID of the order. Example: <code>16</code></p>
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

                    <h2 id="endpoints-POSTapi-practitioners-profiles--profileId--reviews">Submit a review for a practitioner.</h2>

<p>
</p>

<p>Requires auth + a completed booking with this practitioner.</p>

<span id="example-requests-POSTapi-practitioners-profiles--profileId--reviews">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/practitioners/profiles/architecto/reviews" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"rating\": 1,
    \"comment\": \"n\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/practitioners/profiles/architecto/reviews"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "rating": 1,
    "comment": "n"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-practitioners-profiles--profileId--reviews">
</span>
<span id="execution-results-POSTapi-practitioners-profiles--profileId--reviews" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-practitioners-profiles--profileId--reviews"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-practitioners-profiles--profileId--reviews"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-practitioners-profiles--profileId--reviews" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-practitioners-profiles--profileId--reviews">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-practitioners-profiles--profileId--reviews" data-method="POST"
      data-path="api/practitioners/profiles/{profileId}/reviews"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-practitioners-profiles--profileId--reviews', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-practitioners-profiles--profileId--reviews"
                    onclick="tryItOut('POSTapi-practitioners-profiles--profileId--reviews');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-practitioners-profiles--profileId--reviews"
                    onclick="cancelTryOut('POSTapi-practitioners-profiles--profileId--reviews');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-practitioners-profiles--profileId--reviews"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/practitioners/profiles/{profileId}/reviews</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-practitioners-profiles--profileId--reviews"
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
                              name="Accept"                data-endpoint="POSTapi-practitioners-profiles--profileId--reviews"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>profileId</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="profileId"                data-endpoint="POSTapi-practitioners-profiles--profileId--reviews"
               value="architecto"
               data-component="url">
    <br>
<p>Example: <code>architecto</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>rating</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="rating"                data-endpoint="POSTapi-practitioners-profiles--profileId--reviews"
               value="1"
               data-component="body">
    <br>
<p>Must be at least 1. Must not be greater than 5. Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>comment</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="comment"                data-endpoint="POSTapi-practitioners-profiles--profileId--reviews"
               value="n"
               data-component="body">
    <br>
<p>Must not be greater than 1000 characters. Example: <code>n</code></p>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-practitioners-profiles--profileId--reviews-eligibility">Check if the current user can review this practitioner.</h2>

<p>
</p>

<p>Returns eligibility + whether they already reviewed.</p>

<span id="example-requests-GETapi-practitioners-profiles--profileId--reviews-eligibility">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/practitioners/profiles/architecto/reviews/eligibility" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/practitioners/profiles/architecto/reviews/eligibility"
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

<span id="example-responses-GETapi-practitioners-profiles--profileId--reviews-eligibility">
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
<span id="execution-results-GETapi-practitioners-profiles--profileId--reviews-eligibility" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-practitioners-profiles--profileId--reviews-eligibility"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-practitioners-profiles--profileId--reviews-eligibility"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-practitioners-profiles--profileId--reviews-eligibility" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-practitioners-profiles--profileId--reviews-eligibility">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-practitioners-profiles--profileId--reviews-eligibility" data-method="GET"
      data-path="api/practitioners/profiles/{profileId}/reviews/eligibility"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-practitioners-profiles--profileId--reviews-eligibility', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-practitioners-profiles--profileId--reviews-eligibility"
                    onclick="tryItOut('GETapi-practitioners-profiles--profileId--reviews-eligibility');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-practitioners-profiles--profileId--reviews-eligibility"
                    onclick="cancelTryOut('GETapi-practitioners-profiles--profileId--reviews-eligibility');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-practitioners-profiles--profileId--reviews-eligibility"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/practitioners/profiles/{profileId}/reviews/eligibility</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-practitioners-profiles--profileId--reviews-eligibility"
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
                              name="Accept"                data-endpoint="GETapi-practitioners-profiles--profileId--reviews-eligibility"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>profileId</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="profileId"                data-endpoint="GETapi-practitioners-profiles--profileId--reviews-eligibility"
               value="architecto"
               data-component="url">
    <br>
<p>Example: <code>architecto</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-POSTapi-practitioners-offering-slots--slot_id--schedule">POST api/practitioners/offering-slots/{slot_id}/schedule</h2>

<p>
</p>



<span id="example-requests-POSTapi-practitioners-offering-slots--slot_id--schedule">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/practitioners/offering-slots/1/schedule" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"schedule\": [
        {
            \"day_of_week\": 1,
            \"is_available\": true,
            \"time_slots\": [
                {
                    \"start_time\": \"13:56\",
                    \"end_time\": \"2052-04-01\"
                }
            ]
        }
    ]
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/practitioners/offering-slots/1/schedule"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "schedule": [
        {
            "day_of_week": 1,
            "is_available": true,
            "time_slots": [
                {
                    "start_time": "13:56",
                    "end_time": "2052-04-01"
                }
            ]
        }
    ]
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-practitioners-offering-slots--slot_id--schedule">
</span>
<span id="execution-results-POSTapi-practitioners-offering-slots--slot_id--schedule" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-practitioners-offering-slots--slot_id--schedule"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-practitioners-offering-slots--slot_id--schedule"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-practitioners-offering-slots--slot_id--schedule" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-practitioners-offering-slots--slot_id--schedule">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-practitioners-offering-slots--slot_id--schedule" data-method="POST"
      data-path="api/practitioners/offering-slots/{slot_id}/schedule"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-practitioners-offering-slots--slot_id--schedule', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-practitioners-offering-slots--slot_id--schedule"
                    onclick="tryItOut('POSTapi-practitioners-offering-slots--slot_id--schedule');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-practitioners-offering-slots--slot_id--schedule"
                    onclick="cancelTryOut('POSTapi-practitioners-offering-slots--slot_id--schedule');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-practitioners-offering-slots--slot_id--schedule"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/practitioners/offering-slots/{slot_id}/schedule</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-practitioners-offering-slots--slot_id--schedule"
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
                              name="Accept"                data-endpoint="POSTapi-practitioners-offering-slots--slot_id--schedule"
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
               step="any"               name="slot_id"                data-endpoint="POSTapi-practitioners-offering-slots--slot_id--schedule"
               value="1"
               data-component="url">
    <br>
<p>The ID of the slot. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
        <details>
            <summary style="padding-bottom: 10px;">
                <b style="line-height: 2;"><code>schedule</code></b>&nbsp;&nbsp;
<small>object[]</small>&nbsp;
 &nbsp;
 &nbsp;
<br>
<p>Must have at least 1 items.</p>
            </summary>
                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>day_of_week</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="schedule.0.day_of_week"                data-endpoint="POSTapi-practitioners-offering-slots--slot_id--schedule"
               value="1"
               data-component="body">
    <br>
<p>Must be between 0 and 6. Example: <code>1</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>is_available</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
 &nbsp;
 &nbsp;
                <label data-endpoint="POSTapi-practitioners-offering-slots--slot_id--schedule" style="display: none">
            <input type="radio" name="schedule.0.is_available"
                   value="true"
                   data-endpoint="POSTapi-practitioners-offering-slots--slot_id--schedule"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-practitioners-offering-slots--slot_id--schedule" style="display: none">
            <input type="radio" name="schedule.0.is_available"
                   value="false"
                   data-endpoint="POSTapi-practitioners-offering-slots--slot_id--schedule"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>true</code></p>
                    </div>
                                                                <div style=" margin-left: 14px; clear: unset;">
        <details>
            <summary style="padding-bottom: 10px;">
                <b style="line-height: 2;"><code>time_slots</code></b>&nbsp;&nbsp;
<small>object[]</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
<br>

            </summary>
                                                <div style="margin-left: 28px; clear: unset;">
                        <b style="line-height: 2;"><code>start_time</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="schedule.0.time_slots.0.start_time"                data-endpoint="POSTapi-practitioners-offering-slots--slot_id--schedule"
               value="13:56"
               data-component="body">
    <br>
<p>Must be a valid date in the format <code>H:i</code>. Example: <code>13:56</code></p>
                    </div>
                                                                <div style="margin-left: 28px; clear: unset;">
                        <b style="line-height: 2;"><code>end_time</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="schedule.0.time_slots.0.end_time"                data-endpoint="POSTapi-practitioners-offering-slots--slot_id--schedule"
               value="2052-04-01"
               data-component="body">
    <br>
<p>Must be a valid date in the format <code>H:i</code>. Must be a date after <code>schedule.<em>.time_slots.</em>.start_time</code>. Example: <code>2052-04-01</code></p>
                    </div>
                                    </details>
        </div>
                                        </details>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-practitioners-offering-slots--slot_id--schedule">GET api/practitioners/offering-slots/{slot_id}/schedule</h2>

<p>
</p>



<span id="example-requests-GETapi-practitioners-offering-slots--slot_id--schedule">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/practitioners/offering-slots/1/schedule" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/practitioners/offering-slots/1/schedule"
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

<span id="example-responses-GETapi-practitioners-offering-slots--slot_id--schedule">
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
<span id="execution-results-GETapi-practitioners-offering-slots--slot_id--schedule" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-practitioners-offering-slots--slot_id--schedule"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-practitioners-offering-slots--slot_id--schedule"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-practitioners-offering-slots--slot_id--schedule" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-practitioners-offering-slots--slot_id--schedule">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-practitioners-offering-slots--slot_id--schedule" data-method="GET"
      data-path="api/practitioners/offering-slots/{slot_id}/schedule"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-practitioners-offering-slots--slot_id--schedule', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-practitioners-offering-slots--slot_id--schedule"
                    onclick="tryItOut('GETapi-practitioners-offering-slots--slot_id--schedule');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-practitioners-offering-slots--slot_id--schedule"
                    onclick="cancelTryOut('GETapi-practitioners-offering-slots--slot_id--schedule');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-practitioners-offering-slots--slot_id--schedule"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/practitioners/offering-slots/{slot_id}/schedule</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-practitioners-offering-slots--slot_id--schedule"
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
                              name="Accept"                data-endpoint="GETapi-practitioners-offering-slots--slot_id--schedule"
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
               step="any"               name="slot_id"                data-endpoint="GETapi-practitioners-offering-slots--slot_id--schedule"
               value="1"
               data-component="url">
    <br>
<p>The ID of the slot. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-DELETEapi-practitioners-offering-slots--slot_id--schedule">DELETE api/practitioners/offering-slots/{slot_id}/schedule</h2>

<p>
</p>



<span id="example-requests-DELETEapi-practitioners-offering-slots--slot_id--schedule">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/api/practitioners/offering-slots/1/schedule" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/practitioners/offering-slots/1/schedule"
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

<span id="example-responses-DELETEapi-practitioners-offering-slots--slot_id--schedule">
</span>
<span id="execution-results-DELETEapi-practitioners-offering-slots--slot_id--schedule" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-practitioners-offering-slots--slot_id--schedule"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-practitioners-offering-slots--slot_id--schedule"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-practitioners-offering-slots--slot_id--schedule" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-practitioners-offering-slots--slot_id--schedule">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-practitioners-offering-slots--slot_id--schedule" data-method="DELETE"
      data-path="api/practitioners/offering-slots/{slot_id}/schedule"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-practitioners-offering-slots--slot_id--schedule', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-practitioners-offering-slots--slot_id--schedule"
                    onclick="tryItOut('DELETEapi-practitioners-offering-slots--slot_id--schedule');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-practitioners-offering-slots--slot_id--schedule"
                    onclick="cancelTryOut('DELETEapi-practitioners-offering-slots--slot_id--schedule');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-practitioners-offering-slots--slot_id--schedule"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/practitioners/offering-slots/{slot_id}/schedule</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-practitioners-offering-slots--slot_id--schedule"
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
                              name="Accept"                data-endpoint="DELETEapi-practitioners-offering-slots--slot_id--schedule"
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
               step="any"               name="slot_id"                data-endpoint="DELETEapi-practitioners-offering-slots--slot_id--schedule"
               value="1"
               data-component="url">
    <br>
<p>The ID of the slot. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-POSTapi-practitioners-bookings">POST api/practitioners/bookings</h2>

<p>
</p>



<span id="example-requests-POSTapi-practitioners-bookings">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/practitioners/bookings" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"practitioner_offering_slot_id\": \"architecto\",
    \"booking_date\": \"2052-04-01\",
    \"start_time\": \"13:56:36\",
    \"end_time\": \"2052-04-01\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/practitioners/bookings"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "practitioner_offering_slot_id": "architecto",
    "booking_date": "2052-04-01",
    "start_time": "13:56:36",
    "end_time": "2052-04-01"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-practitioners-bookings">
</span>
<span id="execution-results-POSTapi-practitioners-bookings" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-practitioners-bookings"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-practitioners-bookings"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-practitioners-bookings" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-practitioners-bookings">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-practitioners-bookings" data-method="POST"
      data-path="api/practitioners/bookings"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-practitioners-bookings', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-practitioners-bookings"
                    onclick="tryItOut('POSTapi-practitioners-bookings');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-practitioners-bookings"
                    onclick="cancelTryOut('POSTapi-practitioners-bookings');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-practitioners-bookings"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/practitioners/bookings</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-practitioners-bookings"
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
                              name="Accept"                data-endpoint="POSTapi-practitioners-bookings"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>practitioner_offering_slot_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="practitioner_offering_slot_id"                data-endpoint="POSTapi-practitioners-bookings"
               value="architecto"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the practitioner_offering_slots table. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>booking_date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="booking_date"                data-endpoint="POSTapi-practitioners-bookings"
               value="2052-04-01"
               data-component="body">
    <br>
<p>Must be a valid date. Must be a date after or equal to <code>today</code>. Example: <code>2052-04-01</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>start_time</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="start_time"                data-endpoint="POSTapi-practitioners-bookings"
               value="13:56:36"
               data-component="body">
    <br>
<p>Must be a valid date in the format <code>H:i:s</code>. Example: <code>13:56:36</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>end_time</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="end_time"                data-endpoint="POSTapi-practitioners-bookings"
               value="2052-04-01"
               data-component="body">
    <br>
<p>Must be a valid date in the format <code>H:i:s</code>. Must be a date after <code>start_time</code>. Example: <code>2052-04-01</code></p>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-practitioners-bookings">GET api/practitioners/bookings</h2>

<p>
</p>



<span id="example-requests-GETapi-practitioners-bookings">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/practitioners/bookings" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/practitioners/bookings"
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

<span id="example-responses-GETapi-practitioners-bookings">
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
<span id="execution-results-GETapi-practitioners-bookings" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-practitioners-bookings"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-practitioners-bookings"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-practitioners-bookings" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-practitioners-bookings">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-practitioners-bookings" data-method="GET"
      data-path="api/practitioners/bookings"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-practitioners-bookings', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-practitioners-bookings"
                    onclick="tryItOut('GETapi-practitioners-bookings');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-practitioners-bookings"
                    onclick="cancelTryOut('GETapi-practitioners-bookings');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-practitioners-bookings"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/practitioners/bookings</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-practitioners-bookings"
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
                              name="Accept"                data-endpoint="GETapi-practitioners-bookings"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-PATCHapi-practitioners-bookings--booking_id--cancel">PATCH api/practitioners/bookings/{booking_id}/cancel</h2>

<p>
</p>



<span id="example-requests-PATCHapi-practitioners-bookings--booking_id--cancel">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PATCH \
    "http://localhost/api/practitioners/bookings/16/cancel" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/practitioners/bookings/16/cancel"
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

<span id="example-responses-PATCHapi-practitioners-bookings--booking_id--cancel">
</span>
<span id="execution-results-PATCHapi-practitioners-bookings--booking_id--cancel" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PATCHapi-practitioners-bookings--booking_id--cancel"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PATCHapi-practitioners-bookings--booking_id--cancel"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PATCHapi-practitioners-bookings--booking_id--cancel" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PATCHapi-practitioners-bookings--booking_id--cancel">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PATCHapi-practitioners-bookings--booking_id--cancel" data-method="PATCH"
      data-path="api/practitioners/bookings/{booking_id}/cancel"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PATCHapi-practitioners-bookings--booking_id--cancel', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PATCHapi-practitioners-bookings--booking_id--cancel"
                    onclick="tryItOut('PATCHapi-practitioners-bookings--booking_id--cancel');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PATCHapi-practitioners-bookings--booking_id--cancel"
                    onclick="cancelTryOut('PATCHapi-practitioners-bookings--booking_id--cancel');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PATCHapi-practitioners-bookings--booking_id--cancel"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/practitioners/bookings/{booking_id}/cancel</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PATCHapi-practitioners-bookings--booking_id--cancel"
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
                              name="Accept"                data-endpoint="PATCHapi-practitioners-bookings--booking_id--cancel"
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
               step="any"               name="booking_id"                data-endpoint="PATCHapi-practitioners-bookings--booking_id--cancel"
               value="16"
               data-component="url">
    <br>
<p>The ID of the booking. Example: <code>16</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-POSTapi-practitioners-bookings--booking_id--request-cancellation">POST api/practitioners/bookings/{booking_id}/request-cancellation</h2>

<p>
</p>



<span id="example-requests-POSTapi-practitioners-bookings--booking_id--request-cancellation">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/practitioners/bookings/16/request-cancellation" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"reason\": \"b\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/practitioners/bookings/16/request-cancellation"
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

<span id="example-responses-POSTapi-practitioners-bookings--booking_id--request-cancellation">
</span>
<span id="execution-results-POSTapi-practitioners-bookings--booking_id--request-cancellation" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-practitioners-bookings--booking_id--request-cancellation"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-practitioners-bookings--booking_id--request-cancellation"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-practitioners-bookings--booking_id--request-cancellation" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-practitioners-bookings--booking_id--request-cancellation">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-practitioners-bookings--booking_id--request-cancellation" data-method="POST"
      data-path="api/practitioners/bookings/{booking_id}/request-cancellation"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-practitioners-bookings--booking_id--request-cancellation', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-practitioners-bookings--booking_id--request-cancellation"
                    onclick="tryItOut('POSTapi-practitioners-bookings--booking_id--request-cancellation');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-practitioners-bookings--booking_id--request-cancellation"
                    onclick="cancelTryOut('POSTapi-practitioners-bookings--booking_id--request-cancellation');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-practitioners-bookings--booking_id--request-cancellation"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/practitioners/bookings/{booking_id}/request-cancellation</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-practitioners-bookings--booking_id--request-cancellation"
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
                              name="Accept"                data-endpoint="POSTapi-practitioners-bookings--booking_id--request-cancellation"
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
               step="any"               name="booking_id"                data-endpoint="POSTapi-practitioners-bookings--booking_id--request-cancellation"
               value="16"
               data-component="url">
    <br>
<p>The ID of the booking. Example: <code>16</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>reason</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="reason"                data-endpoint="POSTapi-practitioners-bookings--booking_id--request-cancellation"
               value="b"
               data-component="body">
    <br>
<p>Must not be greater than 500 characters. Example: <code>b</code></p>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-practitioners-my-bookings">GET api/practitioners/my-bookings</h2>

<p>
</p>



<span id="example-requests-GETapi-practitioners-my-bookings">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/practitioners/my-bookings" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/practitioners/my-bookings"
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

<span id="example-responses-GETapi-practitioners-my-bookings">
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
<span id="execution-results-GETapi-practitioners-my-bookings" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-practitioners-my-bookings"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-practitioners-my-bookings"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-practitioners-my-bookings" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-practitioners-my-bookings">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-practitioners-my-bookings" data-method="GET"
      data-path="api/practitioners/my-bookings"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-practitioners-my-bookings', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-practitioners-my-bookings"
                    onclick="tryItOut('GETapi-practitioners-my-bookings');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-practitioners-my-bookings"
                    onclick="cancelTryOut('GETapi-practitioners-my-bookings');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-practitioners-my-bookings"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/practitioners/my-bookings</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-practitioners-my-bookings"
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
                              name="Accept"                data-endpoint="GETapi-practitioners-my-bookings"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-practitioners-my-bookings--booking_id--approve-cancellation">POST api/practitioners/my-bookings/{booking_id}/approve-cancellation</h2>

<p>
</p>



<span id="example-requests-POSTapi-practitioners-my-bookings--booking_id--approve-cancellation">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/practitioners/my-bookings/16/approve-cancellation" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/practitioners/my-bookings/16/approve-cancellation"
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

<span id="example-responses-POSTapi-practitioners-my-bookings--booking_id--approve-cancellation">
</span>
<span id="execution-results-POSTapi-practitioners-my-bookings--booking_id--approve-cancellation" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-practitioners-my-bookings--booking_id--approve-cancellation"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-practitioners-my-bookings--booking_id--approve-cancellation"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-practitioners-my-bookings--booking_id--approve-cancellation" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-practitioners-my-bookings--booking_id--approve-cancellation">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-practitioners-my-bookings--booking_id--approve-cancellation" data-method="POST"
      data-path="api/practitioners/my-bookings/{booking_id}/approve-cancellation"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-practitioners-my-bookings--booking_id--approve-cancellation', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-practitioners-my-bookings--booking_id--approve-cancellation"
                    onclick="tryItOut('POSTapi-practitioners-my-bookings--booking_id--approve-cancellation');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-practitioners-my-bookings--booking_id--approve-cancellation"
                    onclick="cancelTryOut('POSTapi-practitioners-my-bookings--booking_id--approve-cancellation');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-practitioners-my-bookings--booking_id--approve-cancellation"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/practitioners/my-bookings/{booking_id}/approve-cancellation</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-practitioners-my-bookings--booking_id--approve-cancellation"
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
                              name="Accept"                data-endpoint="POSTapi-practitioners-my-bookings--booking_id--approve-cancellation"
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
               step="any"               name="booking_id"                data-endpoint="POSTapi-practitioners-my-bookings--booking_id--approve-cancellation"
               value="16"
               data-component="url">
    <br>
<p>The ID of the booking. Example: <code>16</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-POSTapi-practitioners-my-bookings--booking_id--deny-cancellation">POST api/practitioners/my-bookings/{booking_id}/deny-cancellation</h2>

<p>
</p>



<span id="example-requests-POSTapi-practitioners-my-bookings--booking_id--deny-cancellation">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/practitioners/my-bookings/16/deny-cancellation" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"reason\": \"b\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/practitioners/my-bookings/16/deny-cancellation"
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

<span id="example-responses-POSTapi-practitioners-my-bookings--booking_id--deny-cancellation">
</span>
<span id="execution-results-POSTapi-practitioners-my-bookings--booking_id--deny-cancellation" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-practitioners-my-bookings--booking_id--deny-cancellation"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-practitioners-my-bookings--booking_id--deny-cancellation"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-practitioners-my-bookings--booking_id--deny-cancellation" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-practitioners-my-bookings--booking_id--deny-cancellation">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-practitioners-my-bookings--booking_id--deny-cancellation" data-method="POST"
      data-path="api/practitioners/my-bookings/{booking_id}/deny-cancellation"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-practitioners-my-bookings--booking_id--deny-cancellation', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-practitioners-my-bookings--booking_id--deny-cancellation"
                    onclick="tryItOut('POSTapi-practitioners-my-bookings--booking_id--deny-cancellation');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-practitioners-my-bookings--booking_id--deny-cancellation"
                    onclick="cancelTryOut('POSTapi-practitioners-my-bookings--booking_id--deny-cancellation');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-practitioners-my-bookings--booking_id--deny-cancellation"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/practitioners/my-bookings/{booking_id}/deny-cancellation</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-practitioners-my-bookings--booking_id--deny-cancellation"
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
                              name="Accept"                data-endpoint="POSTapi-practitioners-my-bookings--booking_id--deny-cancellation"
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
               step="any"               name="booking_id"                data-endpoint="POSTapi-practitioners-my-bookings--booking_id--deny-cancellation"
               value="16"
               data-component="url">
    <br>
<p>The ID of the booking. Example: <code>16</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>reason</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="reason"                data-endpoint="POSTapi-practitioners-my-bookings--booking_id--deny-cancellation"
               value="b"
               data-component="body">
    <br>
<p>Must not be greater than 500 characters. Example: <code>b</code></p>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-practitioners-availability">GET api/practitioners/availability</h2>

<p>
</p>



<span id="example-requests-GETapi-practitioners-availability">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/practitioners/availability" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/practitioners/availability"
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

<span id="example-responses-GETapi-practitioners-availability">
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
<span id="execution-results-GETapi-practitioners-availability" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-practitioners-availability"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-practitioners-availability"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-practitioners-availability" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-practitioners-availability">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-practitioners-availability" data-method="GET"
      data-path="api/practitioners/availability"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-practitioners-availability', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-practitioners-availability"
                    onclick="tryItOut('GETapi-practitioners-availability');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-practitioners-availability"
                    onclick="cancelTryOut('GETapi-practitioners-availability');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-practitioners-availability"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/practitioners/availability</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-practitioners-availability"
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
                              name="Accept"                data-endpoint="GETapi-practitioners-availability"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-practitioners-availability-repeat">POST api/practitioners/availability/repeat</h2>

<p>
</p>



<span id="example-requests-POSTapi-practitioners-availability-repeat">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/practitioners/availability/repeat" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/practitioners/availability/repeat"
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

<span id="example-responses-POSTapi-practitioners-availability-repeat">
</span>
<span id="execution-results-POSTapi-practitioners-availability-repeat" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-practitioners-availability-repeat"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-practitioners-availability-repeat"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-practitioners-availability-repeat" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-practitioners-availability-repeat">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-practitioners-availability-repeat" data-method="POST"
      data-path="api/practitioners/availability/repeat"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-practitioners-availability-repeat', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-practitioners-availability-repeat"
                    onclick="tryItOut('POSTapi-practitioners-availability-repeat');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-practitioners-availability-repeat"
                    onclick="cancelTryOut('POSTapi-practitioners-availability-repeat');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-practitioners-availability-repeat"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/practitioners/availability/repeat</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-practitioners-availability-repeat"
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
                              name="Accept"                data-endpoint="POSTapi-practitioners-availability-repeat"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-practitioners-availability-check-skip">GET api/practitioners/availability/check-skip</h2>

<p>
</p>



<span id="example-requests-GETapi-practitioners-availability-check-skip">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/practitioners/availability/check-skip" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"date\": \"2026-03-09\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/practitioners/availability/check-skip"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "date": "2026-03-09"
};

fetch(url, {
    method: "GET",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-practitioners-availability-check-skip">
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
<span id="execution-results-GETapi-practitioners-availability-check-skip" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-practitioners-availability-check-skip"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-practitioners-availability-check-skip"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-practitioners-availability-check-skip" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-practitioners-availability-check-skip">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-practitioners-availability-check-skip" data-method="GET"
      data-path="api/practitioners/availability/check-skip"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-practitioners-availability-check-skip', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-practitioners-availability-check-skip"
                    onclick="tryItOut('GETapi-practitioners-availability-check-skip');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-practitioners-availability-check-skip"
                    onclick="cancelTryOut('GETapi-practitioners-availability-check-skip');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-practitioners-availability-check-skip"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/practitioners/availability/check-skip</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-practitioners-availability-check-skip"
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
                              name="Accept"                data-endpoint="GETapi-practitioners-availability-check-skip"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="date"                data-endpoint="GETapi-practitioners-availability-check-skip"
               value="2026-03-09"
               data-component="body">
    <br>
<p>Must be a valid date in the format <code>Y-m-d</code>. Example: <code>2026-03-09</code></p>
        </div>
        </form>

                    <h2 id="endpoints-POSTapi-practitioners-availability-skip">POST api/practitioners/availability/skip</h2>

<p>
</p>



<span id="example-requests-POSTapi-practitioners-availability-skip">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/practitioners/availability/skip" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"date\": \"2026-03-09\",
    \"reason\": \"b\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/practitioners/availability/skip"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "date": "2026-03-09",
    "reason": "b"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-practitioners-availability-skip">
</span>
<span id="execution-results-POSTapi-practitioners-availability-skip" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-practitioners-availability-skip"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-practitioners-availability-skip"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-practitioners-availability-skip" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-practitioners-availability-skip">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-practitioners-availability-skip" data-method="POST"
      data-path="api/practitioners/availability/skip"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-practitioners-availability-skip', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-practitioners-availability-skip"
                    onclick="tryItOut('POSTapi-practitioners-availability-skip');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-practitioners-availability-skip"
                    onclick="cancelTryOut('POSTapi-practitioners-availability-skip');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-practitioners-availability-skip"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/practitioners/availability/skip</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-practitioners-availability-skip"
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
                              name="Accept"                data-endpoint="POSTapi-practitioners-availability-skip"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="date"                data-endpoint="POSTapi-practitioners-availability-skip"
               value="2026-03-09"
               data-component="body">
    <br>
<p>Must be a valid date in the format <code>Y-m-d</code>. Example: <code>2026-03-09</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>reason</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="reason"                data-endpoint="POSTapi-practitioners-availability-skip"
               value="b"
               data-component="body">
    <br>
<p>Must be at least 10 characters. Must not be greater than 500 characters. Example: <code>b</code></p>
        </div>
        </form>

                    <h2 id="endpoints-DELETEapi-practitioners-availability-skip">DELETE api/practitioners/availability/skip</h2>

<p>
</p>



<span id="example-requests-DELETEapi-practitioners-availability-skip">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/api/practitioners/availability/skip" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"date\": \"2026-03-09\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/practitioners/availability/skip"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "date": "2026-03-09"
};

fetch(url, {
    method: "DELETE",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-practitioners-availability-skip">
</span>
<span id="execution-results-DELETEapi-practitioners-availability-skip" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-practitioners-availability-skip"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-practitioners-availability-skip"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-practitioners-availability-skip" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-practitioners-availability-skip">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-practitioners-availability-skip" data-method="DELETE"
      data-path="api/practitioners/availability/skip"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-practitioners-availability-skip', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-practitioners-availability-skip"
                    onclick="tryItOut('DELETEapi-practitioners-availability-skip');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-practitioners-availability-skip"
                    onclick="cancelTryOut('DELETEapi-practitioners-availability-skip');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-practitioners-availability-skip"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/practitioners/availability/skip</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-practitioners-availability-skip"
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
                              name="Accept"                data-endpoint="DELETEapi-practitioners-availability-skip"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="date"                data-endpoint="DELETEapi-practitioners-availability-skip"
               value="2026-03-09"
               data-component="body">
    <br>
<p>Must be a valid date in the format <code>Y-m-d</code>. Example: <code>2026-03-09</code></p>
        </div>
        </form>

                    <h2 id="endpoints-PUTapi-practitioners-availability-pattern">PUT api/practitioners/availability/pattern</h2>

<p>
</p>



<span id="example-requests-PUTapi-practitioners-availability-pattern">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/api/practitioners/availability/pattern" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"pattern\": [
        {
            \"is_available\": false,
            \"time_slots\": [
                {
                    \"start_time\": \"13:56\",
                    \"end_time\": \"13:56\"
                }
            ],
            \"slot_duration_minutes\": 30
        }
    ],
    \"reason\": \"b\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/practitioners/availability/pattern"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "pattern": [
        {
            "is_available": false,
            "time_slots": [
                {
                    "start_time": "13:56",
                    "end_time": "13:56"
                }
            ],
            "slot_duration_minutes": 30
        }
    ],
    "reason": "b"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-practitioners-availability-pattern">
</span>
<span id="execution-results-PUTapi-practitioners-availability-pattern" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-practitioners-availability-pattern"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-practitioners-availability-pattern"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-practitioners-availability-pattern" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-practitioners-availability-pattern">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-practitioners-availability-pattern" data-method="PUT"
      data-path="api/practitioners/availability/pattern"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-practitioners-availability-pattern', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-practitioners-availability-pattern"
                    onclick="tryItOut('PUTapi-practitioners-availability-pattern');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-practitioners-availability-pattern"
                    onclick="cancelTryOut('PUTapi-practitioners-availability-pattern');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-practitioners-availability-pattern"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/practitioners/availability/pattern</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-practitioners-availability-pattern"
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
                              name="Accept"                data-endpoint="PUTapi-practitioners-availability-pattern"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
        <details>
            <summary style="padding-bottom: 10px;">
                <b style="line-height: 2;"><code>pattern</code></b>&nbsp;&nbsp;
<small>object[]</small>&nbsp;
 &nbsp;
 &nbsp;
<br>

            </summary>
                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>is_available</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
 &nbsp;
 &nbsp;
                <label data-endpoint="PUTapi-practitioners-availability-pattern" style="display: none">
            <input type="radio" name="pattern.0.is_available"
                   value="true"
                   data-endpoint="PUTapi-practitioners-availability-pattern"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="PUTapi-practitioners-availability-pattern" style="display: none">
            <input type="radio" name="pattern.0.is_available"
                   value="false"
                   data-endpoint="PUTapi-practitioners-availability-pattern"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>false</code></p>
                    </div>
                                                                <div style=" margin-left: 14px; clear: unset;">
        <details>
            <summary style="padding-bottom: 10px;">
                <b style="line-height: 2;"><code>time_slots</code></b>&nbsp;&nbsp;
<small>object[]</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
<br>

            </summary>
                                                <div style="margin-left: 28px; clear: unset;">
                        <b style="line-height: 2;"><code>start_time</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="pattern.0.time_slots.0.start_time"                data-endpoint="PUTapi-practitioners-availability-pattern"
               value="13:56"
               data-component="body">
    <br>
<p>This field is required when <code>pattern.*.is_available</code> is <code>true</code>. Must be a valid date in the format <code>H:i</code>. Example: <code>13:56</code></p>
                    </div>
                                                                <div style="margin-left: 28px; clear: unset;">
                        <b style="line-height: 2;"><code>end_time</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="pattern.0.time_slots.0.end_time"                data-endpoint="PUTapi-practitioners-availability-pattern"
               value="13:56"
               data-component="body">
    <br>
<p>This field is required when <code>pattern.*.is_available</code> is <code>true</code>. Must be a valid date in the format <code>H:i</code>. Example: <code>13:56</code></p>
                    </div>
                                    </details>
        </div>
                                                                    <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>slot_duration_minutes</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="pattern.0.slot_duration_minutes"                data-endpoint="PUTapi-practitioners-availability-pattern"
               value="30"
               data-component="body">
    <br>
<p>Must be at least 15. Example: <code>30</code></p>
                    </div>
                                    </details>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>reason</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="reason"                data-endpoint="PUTapi-practitioners-availability-pattern"
               value="b"
               data-component="body">
    <br>
<p>Must be at least 10 characters. Must not be greater than 500 characters. Example: <code>b</code></p>
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

    <p>APIs for managing community forums. Forums are scoped by type:</p>
<ul>
<li><strong>general</strong> — open to all authenticated users</li>
<li><strong>healer</strong>  — only verified practitioners may post (anyone can read)</li>
<li><strong>vendor</strong>  — only approved vendors may post (anyone can read)</li>
</ul>

                                <h2 id="forum-management-GETapi-forums">List forums</h2>

<p>
</p>

<p>Returns a paginated list of approved forums. Supports filtering by
category, sub-category, and forum type, plus sorting by latest or popularity.</p>

<span id="example-requests-GETapi-forums">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/forums?category=Mind&amp;sub_category=Mental+Health&amp;forum_type=healer&amp;sort=popular&amp;page=1" \
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
    "forum_type": "healer",
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
    &quot;current_page&quot;: 1,
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;title&quot;: &quot;How to improve mental clarity?&quot;,
            &quot;content&quot;: &quot;I&#039;ve been struggling with focus lately...&quot;,
            &quot;category&quot;: &quot;Mind&quot;,
            &quot;sub_category&quot;: &quot;Mental Health&quot;,
            &quot;forum_type&quot;: &quot;general&quot;,
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
    &quot;last_page&quot;: 5,
    &quot;per_page&quot;: 10,
    &quot;total&quot;: 50,
    &quot;from&quot;: 1,
    &quot;to&quot;: 10
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
<p>Filter by category. Must be one of: Mind, Body, Spirit, Biohacking, Frequency Healing, Holistic Health. Example: <code>Mind</code></p>
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
<p>Filter by sub-category (requires category to be set). Example: <code>Mental Health</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>forum_type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="forum_type"                data-endpoint="GETapi-forums"
               value="healer"
               data-component="query">
    <br>
<p>Filter by forum type. Must be one of: general, healer, vendor. Defaults to returning all types when omitted. Example: <code>healer</code></p>
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
<p>Sort order. Must be one of: latest, popular. Defaults to latest. Example: <code>popular</code></p>
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
<p>Page number for pagination. Defaults to 1. Example: <code>1</code></p>
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
            <b style="line-height: 2;"><code>forum_type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="forum_type"                data-endpoint="GETapi-forums"
               value=""
               data-component="body">
    <br>

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

                    <h2 id="forum-management-GETapi-forums--id-">Get a forum</h2>

<p>
</p>

<p>Returns a single forum with its paginated comments and reply previews.
The <code>is_liked</code> and <code>is_flagged</code> fields reflect the authenticated user's
state when a valid Sanctum token is provided; they default to <code>false</code>
for guests.</p>

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
    &quot;forum&quot;: {
        &quot;id&quot;: 1,
        &quot;title&quot;: &quot;How to improve mental clarity?&quot;,
        &quot;content&quot;: &quot;I&#039;ve been struggling with focus lately. Has anyone tried meditation or nootropics?&quot;,
        &quot;category&quot;: &quot;Mind&quot;,
        &quot;sub_category&quot;: &quot;Mental Health&quot;,
        &quot;forum_type&quot;: &quot;general&quot;,
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
        &quot;comments_count&quot;: 5,
        &quot;likes_count&quot;: 12,
        &quot;flags_count&quot;: 0,
        &quot;is_liked&quot;: false,
        &quot;is_flagged&quot;: false
    },
    &quot;comments&quot;: {
        &quot;current_page&quot;: 1,
        &quot;data&quot;: [
            {
                &quot;id&quot;: 1,
                &quot;comment&quot;: &quot;I&#039;ve had great success with daily meditation!&quot;,
                &quot;author_id&quot;: 2,
                &quot;parent_id&quot;: null,
                &quot;created_at&quot;: &quot;2024-01-15T11:00:00.000000Z&quot;,
                &quot;author&quot;: {
                    &quot;id&quot;: 2,
                    &quot;name&quot;: &quot;Jane Smith&quot;
                },
                &quot;likes_count&quot;: 3,
                &quot;replies_count&quot;: 2,
                &quot;is_liked&quot;: false,
                &quot;is_flagged&quot;: false,
                &quot;recent_replies&quot;: []
            }
        ],
        &quot;last_page&quot;: 1,
        &quot;per_page&quot;: 10,
        &quot;total&quot;: 5
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;No query results for model [App\\Models\\Forum] 999&quot;
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

                    <h2 id="forum-management-POSTapi-forums">Create a forum</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Creates a new forum post. The <code>forum_type</code> field controls who may post:</p>
<ul>
<li><code>general</code> — any authenticated user</li>
<li><code>healer</code>  — requires the user to be a verified practitioner (<code>is_practitioner = true</code>)</li>
<li><code>vendor</code>  — requires the user to have an approved vendor account</li>
</ul>
<p>Attempting to post in a restricted type without the required role returns <strong>403</strong>.</p>

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
    \"sub_category\": \"Mental Health\",
    \"forum_type\": \"general\"
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
    "sub_category": "Mental Health",
    "forum_type": "general"
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
        &quot;id&quot;: 42,
        &quot;title&quot;: &quot;How to improve mental clarity?&quot;,
        &quot;content&quot;: &quot;I&#039;ve been struggling with focus lately...&quot;,
        &quot;category&quot;: &quot;Mind&quot;,
        &quot;sub_category&quot;: &quot;Mental Health&quot;,
        &quot;forum_type&quot;: &quot;general&quot;,
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
            <p>Example response (403):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Only verified healers can post in the Healers forum.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Only verified vendors can post in the Vendors forum.&quot;
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
            &quot;Forum title is required&quot;
        ],
        &quot;category&quot;: [
            &quot;Please select a category&quot;
        ],
        &quot;forum_type&quot;: [
            &quot;Please select a forum type&quot;
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
<p>Forum title. Max 400 characters. Example: <code>How to improve mental clarity?</code></p>
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
<p>Forum body text. Example: <code>I've been struggling with focus lately...</code></p>
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
<p>Must be one of: Mind, Body, Spirit, Biohacking, Frequency Healing, Holistic Health. Example: <code>Mind</code></p>
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
<p>Sub-category matching the selected category. Example: <code>Mental Health</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>forum_type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="forum_type"                data-endpoint="POSTapi-forums"
               value="general"
               data-component="body">
    <br>
<p>Must be one of: general, healer, vendor. Example: <code>general</code></p>
        </div>
        </form>

                    <h2 id="forum-management-DELETEapi-forums--id-">Delete a forum</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Soft-deletes a forum. Only the original author may delete their own forum.
Deleted forums are not returned in any listing or detail endpoint.</p>

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
    &quot;message&quot;: &quot;No query results for model [App\\Models\\Forum] 999&quot;
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

                    <h2 id="forum-management-POSTapi-forums--id--view">Record a forum view</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Increments the view counter for a forum. Should be called by the frontend
after the user has actively read the forum for at least 30 seconds.
A per-user cooldown of <strong>2 hours</strong> is enforced via cache — repeated calls
within the cooldown window return <strong>429</strong> and do not increment the counter.</p>

<span id="example-requests-POSTapi-forums--id--view">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/forums/1/view" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/forums/1/view"
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
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;View recorded successfully&quot;,
    &quot;views&quot;: 127
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
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;No query results for model [App\\Models\\Forum] 999&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (429):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;View not recorded - cooldown active&quot;,
    &quot;views&quot;: 126
}</code>
 </pre>
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
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="POSTapi-forums--id--view"
               value="1"
               data-component="url">
    <br>
<p>The ID of the forum. Example: <code>1</code></p>
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

    <p>APIs for browsing marketplace products from approved vendors.
Only products from vendors with an approved status are listed.
Practitioner services are browsed separately via Practitioner Offerings.</p>

                                <h2 id="marketplace-GETapi-marketplace">Get Marketplace Products</h2>

<p>
</p>

<p>Retrieve a paginated list of active products from approved vendors.
Supports filtering by category, search, and sorting.
Public endpoint, no authentication required.</p>

<span id="example-requests-GETapi-marketplace">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/marketplace?category=Photography&amp;search=wedding&amp;sort=latest&amp;page=1&amp;per_page=12" \
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
            &quot;title&quot;: &quot;Yoga Mat Pro&quot;,
            &quot;brief&quot;: &quot;Premium non-slip yoga mat&quot;,
            &quot;description&quot;: &quot;High-density foam with alignment lines...&quot;,
            &quot;image_url&quot;: &quot;https://example.com/image.jpg&quot;,
            &quot;active&quot;: true,
            &quot;variants&quot;: [
                {
                    &quot;id&quot;: 1,
                    &quot;name&quot;: &quot;Large&quot;,
                    &quot;price&quot;: &quot;49.99&quot;,
                    &quot;stock&quot;: 100
                }
            ],
            &quot;vendor&quot;: {
                &quot;id&quot;: 1,
                &quot;business_name&quot;: &quot;Wellness Supplies Co&quot;,
                &quot;category&quot;: [
                    &quot;Wellness&quot;,
                    &quot;Fitness&quot;
                ],
                &quot;city&quot;: &quot;New York&quot;,
                &quot;average_rating&quot;: 4.8,
                &quot;review_count&quot;: 127,
                &quot;is_verified&quot;: true
            },
            &quot;min_price&quot;: &quot;49.99&quot;,
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
<p>Search in product title, brief, and description. Example: <code>wedding</code></p>
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
    --get "http://localhost/api/orders/16" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/orders/16"
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
               value="16"
               data-component="url">
    <br>
<p>The ID of the order. Example: <code>16</code></p>
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
    --get "http://localhost/api/orders/16/cancellation-status" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/orders/16/cancellation-status"
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
               value="16"
               data-component="url">
    <br>
<p>The ID of the order. Example: <code>16</code></p>
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
    "http://localhost/api/orders/16/cancel" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"reason\": \"Changed my mind\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/orders/16/cancel"
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
               value="16"
               data-component="url">
    <br>
<p>The ID of the order. Example: <code>16</code></p>
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
    \"credentials\": [
        {
            \"file\": \"...\",
            \"document_type\": \"license\"
        }
    ],
    \"primary_category_id\": 1,
    \"selected_services\": [
        16
    ],
    \"service_description\": \"I specialize in deep tissue massage...\",
    \"availability_schedule\": {
        \"monday\": {
            \"morning\": true,
            \"afternoon\": false,
            \"evening\": true
        },
        \"schedule_type\": \"date_range\",
        \"start_date\": \"2026-03-09T13:56:36\",
        \"end_date\": \"2052-04-01\",
        \"days\": [
            {
                \"is_available\": true,
                \"slot_duration_minutes\": \"60\",
                \"time_slots\": [
                    {
                        \"start_time\": \"64:25\",
                        \"end_time\": \"64:25\"
                    }
                ]
            }
        ]
    },
    \"timezone\": \"America\\/New_York\",
    \"terms_agreed\": true,
    \"license_number\": \"LMT123456\",
    \"issuing_organization\": \"State Board of Massage\",
    \"service_subcategories\": [
        1,
        2,
        3
    ]
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
    "credentials": [
        {
            "file": "...",
            "document_type": "license"
        }
    ],
    "primary_category_id": 1,
    "selected_services": [
        16
    ],
    "service_description": "I specialize in deep tissue massage...",
    "availability_schedule": {
        "monday": {
            "morning": true,
            "afternoon": false,
            "evening": true
        },
        "schedule_type": "date_range",
        "start_date": "2026-03-09T13:56:36",
        "end_date": "2052-04-01",
        "days": [
            {
                "is_available": true,
                "slot_duration_minutes": "60",
                "time_slots": [
                    {
                        "start_time": "64:25",
                        "end_time": "64:25"
                    }
                ]
            }
        ]
    },
    "timezone": "America\/New_York",
    "terms_agreed": true,
    "license_number": "LMT123456",
    "issuing_organization": "State Board of Massage",
    "service_subcategories": [
        1,
        2,
        3
    ]
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
<p>Must be a file. Must be at least 1 kilobyte. Must not be greater than 5120 kilobytes. Example: <code>/tmp/phpba2fi25gmeofeWqFjjN</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>license_number</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="credentials.0.license_number"                data-endpoint="POSTapi-practitioners-applications"
               value="n"
               data-component="body">
    <br>
<p>Must not be greater than 100 characters. Example: <code>n</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>issuing_organization</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="credentials.0.issuing_organization"                data-endpoint="POSTapi-practitioners-applications"
               value="g"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>g</code></p>
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
<p>Credential document file (PDF/JPG/PNG, max 5MB). Example: <code>/tmp/phprpoam8rrv9ao9X94Q8Q</code></p>
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
            <b style="line-height: 2;"><code>selected_services</code></b>&nbsp;&nbsp;
<small>integer[]</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="selected_services[0]"                data-endpoint="POSTapi-practitioners-applications"
               data-component="body">
        <input type="number" style="display: none"
               name="selected_services[1]"                data-endpoint="POSTapi-practitioners-applications"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the service_subcategories table.</p>
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
                        <b style="line-height: 2;"><code>schedule_type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="availability_schedule.schedule_type"                data-endpoint="POSTapi-practitioners-applications"
               value="date_range"
               data-component="body">
    <br>
<p>Example: <code>date_range</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>date_range</code></li> <li><code>weekly</code></li></ul>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>start_date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="availability_schedule.start_date"                data-endpoint="POSTapi-practitioners-applications"
               value="2026-03-09T13:56:36"
               data-component="body">
    <br>
<p>This field is required when <code>availability_schedule.schedule_type</code> is <code>date_range</code>. Must be a valid date. Example: <code>2026-03-09T13:56:36</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>end_date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="availability_schedule.end_date"                data-endpoint="POSTapi-practitioners-applications"
               value="2052-04-01"
               data-component="body">
    <br>
<p>This field is required when <code>availability_schedule.schedule_type</code> is <code>date_range</code>. Must be a valid date. Must be a date after or equal to <code>availability_schedule.start_date</code>. Example: <code>2052-04-01</code></p>
                    </div>
                                                                <div style=" margin-left: 14px; clear: unset;">
        <details>
            <summary style="padding-bottom: 10px;">
                <b style="line-height: 2;"><code>days</code></b>&nbsp;&nbsp;
<small>object[]</small>&nbsp;
 &nbsp;
 &nbsp;
<br>

            </summary>
                                                <div style="margin-left: 28px; clear: unset;">
                        <b style="line-height: 2;"><code>is_available</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="POSTapi-practitioners-applications" style="display: none">
            <input type="radio" name="availability_schedule.days.0.is_available"
                   value="true"
                   data-endpoint="POSTapi-practitioners-applications"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-practitioners-applications" style="display: none">
            <input type="radio" name="availability_schedule.days.0.is_available"
                   value="false"
                   data-endpoint="POSTapi-practitioners-applications"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>true</code></p>
                    </div>
                                                                <div style="margin-left: 28px; clear: unset;">
                        <b style="line-height: 2;"><code>slot_duration_minutes</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="availability_schedule.days.0.slot_duration_minutes"                data-endpoint="POSTapi-practitioners-applications"
               value="60"
               data-component="body">
    <br>
<p>Example: <code>60</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>15</code></li> <li><code>30</code></li> <li><code>45</code></li> <li><code>60</code></li> <li><code>90</code></li> <li><code>120</code></li></ul>
                    </div>
                                                                <div style=" margin-left: 28px; clear: unset;">
        <details>
            <summary style="padding-bottom: 10px;">
                <b style="line-height: 2;"><code>time_slots</code></b>&nbsp;&nbsp;
<small>object[]</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
<br>

            </summary>
                                                <div style="margin-left: 42px; clear: unset;">
                        <b style="line-height: 2;"><code>start_time</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="availability_schedule.days.0.time_slots.0.start_time"                data-endpoint="POSTapi-practitioners-applications"
               value="64:25"
               data-component="body">
    <br>
<p>Must match the regex /^\d{2}:\d{2}$/. Example: <code>64:25</code></p>
                    </div>
                                                                <div style="margin-left: 42px; clear: unset;">
                        <b style="line-height: 2;"><code>end_time</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="availability_schedule.days.0.time_slots.0.end_time"                data-endpoint="POSTapi-practitioners-applications"
               value="64:25"
               data-component="body">
    <br>
<p>Must match the regex /^\d{2}:\d{2}$/. Example: <code>64:25</code></p>
                    </div>
                                    </details>
        </div>
                                        </details>
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
  &quot;data&quot;: [...],
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

                    <h2 id="practitioner-applications-GETapi-admin-practitioners-applications--id-">Get Application Details</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retrieve details of a specific practitioner application.
Users can only view their own applications. Admins can view any application.</p>

<span id="example-requests-GETapi-admin-practitioners-applications--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/admin/practitioners/applications/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/admin/practitioners/applications/1"
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

<span id="example-responses-GETapi-admin-practitioners-applications--id-">
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
<span id="execution-results-GETapi-admin-practitioners-applications--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-admin-practitioners-applications--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-admin-practitioners-applications--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-admin-practitioners-applications--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-admin-practitioners-applications--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-admin-practitioners-applications--id-" data-method="GET"
      data-path="api/admin/practitioners/applications/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-admin-practitioners-applications--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-admin-practitioners-applications--id-"
                    onclick="tryItOut('GETapi-admin-practitioners-applications--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-admin-practitioners-applications--id-"
                    onclick="cancelTryOut('GETapi-admin-practitioners-applications--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-admin-practitioners-applications--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/admin/practitioners/applications/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-admin-practitioners-applications--id-"
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
                              name="Accept"                data-endpoint="GETapi-admin-practitioners-applications--id-"
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
               step="any"               name="id"                data-endpoint="GETapi-admin-practitioners-applications--id-"
               value="1"
               data-component="url">
    <br>
<p>The application ID. Example: <code>1</code></p>
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

                    <h2 id="practitioner-applications-GETapi-admin-practitioners-documents--document_id--download">Download Application Document (Admin)</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Download a credential document uploaded by a practitioner applicant.
Files are stored privately and served through this authenticated endpoint.
Admin access required.</p>

<span id="example-requests-GETapi-admin-practitioners-documents--document_id--download">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/admin/practitioners/documents/1/download" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/admin/practitioners/documents/1/download"
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

<span id="example-responses-GETapi-admin-practitioners-documents--document_id--download">
            <blockquote>
            <p>Example response (200, File download):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
  Binary file content with appropriate Content-Disposition header.
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
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;File not found.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-admin-practitioners-documents--document_id--download" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-admin-practitioners-documents--document_id--download"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-admin-practitioners-documents--document_id--download"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-admin-practitioners-documents--document_id--download" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-admin-practitioners-documents--document_id--download">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-admin-practitioners-documents--document_id--download" data-method="GET"
      data-path="api/admin/practitioners/documents/{document_id}/download"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-admin-practitioners-documents--document_id--download', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-admin-practitioners-documents--document_id--download"
                    onclick="tryItOut('GETapi-admin-practitioners-documents--document_id--download');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-admin-practitioners-documents--document_id--download"
                    onclick="cancelTryOut('GETapi-admin-practitioners-documents--document_id--download');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-admin-practitioners-documents--document_id--download"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/admin/practitioners/documents/{document_id}/download</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-admin-practitioners-documents--document_id--download"
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
                              name="Accept"                data-endpoint="GETapi-admin-practitioners-documents--document_id--download"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>document_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="document_id"                data-endpoint="GETapi-admin-practitioners-documents--document_id--download"
               value="1"
               data-component="url">
    <br>
<p>The ID of the document. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>document</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="document"                data-endpoint="GETapi-admin-practitioners-documents--document_id--download"
               value="1"
               data-component="url">
    <br>
<p>The document ID. Example: <code>1</code></p>
            </div>
                    </form>

                <h1 id="practitioner-offerings">Practitioner Offerings</h1>

    

                                <h2 id="practitioner-offerings-GETapi-practitioners-profiles--profile_id--offerings">List Profile Offerings — Public</h2>

<p>
</p>

<p>Returns active offerings for a specific practitioner profile.
Used by the public practitioner profile page.</p>
<p>Route: GET /practitioners/profiles/{profile}/offerings</p>

<span id="example-requests-GETapi-practitioners-profiles--profile_id--offerings">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/practitioners/profiles/1/offerings" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/practitioners/profiles/1/offerings"
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

<span id="example-responses-GETapi-practitioners-profiles--profile_id--offerings">
            <blockquote>
            <p>Example response (200):</p>
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
    &quot;current_page&quot;: 1,
    &quot;data&quot;: [],
    &quot;first_page_url&quot;: &quot;http://localhost/api/practitioners/profiles/1/offerings?page=1&quot;,
    &quot;from&quot;: null,
    &quot;last_page&quot;: 1,
    &quot;last_page_url&quot;: &quot;http://localhost/api/practitioners/profiles/1/offerings?page=1&quot;,
    &quot;links&quot;: [
        {
            &quot;url&quot;: null,
            &quot;label&quot;: &quot;&amp;laquo; Previous&quot;,
            &quot;page&quot;: null,
            &quot;active&quot;: false
        },
        {
            &quot;url&quot;: &quot;http://localhost/api/practitioners/profiles/1/offerings?page=1&quot;,
            &quot;label&quot;: &quot;1&quot;,
            &quot;page&quot;: 1,
            &quot;active&quot;: true
        },
        {
            &quot;url&quot;: null,
            &quot;label&quot;: &quot;Next &amp;raquo;&quot;,
            &quot;page&quot;: null,
            &quot;active&quot;: false
        }
    ],
    &quot;next_page_url&quot;: null,
    &quot;path&quot;: &quot;http://localhost/api/practitioners/profiles/1/offerings&quot;,
    &quot;per_page&quot;: 12,
    &quot;prev_page_url&quot;: null,
    &quot;to&quot;: null,
    &quot;total&quot;: 0
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-practitioners-profiles--profile_id--offerings" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-practitioners-profiles--profile_id--offerings"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-practitioners-profiles--profile_id--offerings"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-practitioners-profiles--profile_id--offerings" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-practitioners-profiles--profile_id--offerings">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-practitioners-profiles--profile_id--offerings" data-method="GET"
      data-path="api/practitioners/profiles/{profile_id}/offerings"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-practitioners-profiles--profile_id--offerings', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-practitioners-profiles--profile_id--offerings"
                    onclick="tryItOut('GETapi-practitioners-profiles--profile_id--offerings');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-practitioners-profiles--profile_id--offerings"
                    onclick="cancelTryOut('GETapi-practitioners-profiles--profile_id--offerings');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-practitioners-profiles--profile_id--offerings"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/practitioners/profiles/{profile_id}/offerings</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-practitioners-profiles--profile_id--offerings"
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
                              name="Accept"                data-endpoint="GETapi-practitioners-profiles--profile_id--offerings"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>profile_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="profile_id"                data-endpoint="GETapi-practitioners-profiles--profile_id--offerings"
               value="1"
               data-component="url">
    <br>
<p>The ID of the profile. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="practitioner-offerings-GETapi-practitioners-offerings-browse">Browse All Offerings — Public Marketplace</h2>

<p>
</p>

<p>Returns active offerings across ALL practitioners.
Used by the public /services browse page. No authentication required.</p>
<p>Route: GET /practitioners/offerings/browse</p>

<span id="example-requests-GETapi-practitioners-offerings-browse">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/practitioners/offerings/browse" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/practitioners/offerings/browse"
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

<span id="example-responses-GETapi-practitioners-offerings-browse">
            <blockquote>
            <p>Example response (200):</p>
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
    &quot;current_page&quot;: 1,
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;practitioner_profile_id&quot;: 3,
            &quot;subcategory_id&quot;: 1,
            &quot;title&quot;: &quot;Riki Session&quot;,
            &quot;brief&quot;: &quot;Description&quot;,
            &quot;description&quot;: &quot;Description&quot;,
            &quot;duration&quot;: 105,
            &quot;price&quot;: &quot;12.00&quot;,
            &quot;active&quot;: true,
            &quot;images&quot;: [
                &quot;/storage/practitioner_offerings/TtwMt8EkUZT3lJk5ZsR9rAqTmKGaZ4C43aL2msf4.jpg&quot;
            ],
            &quot;created_at&quot;: &quot;2026-03-09T11:57:33.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-03-09T11:57:33.000000Z&quot;,
            &quot;practitioner&quot;: {
                &quot;id&quot;: 3,
                &quot;user_id&quot;: 3,
                &quot;application_id&quot;: 3,
                &quot;phone_number&quot;: &quot;+923336242414&quot;,
                &quot;professional_title&quot;: &quot;Fitness Coach&quot;,
                &quot;years_experience&quot;: &quot;20+&quot;,
                &quot;bio&quot;: &quot;asd&quot;,
                &quot;license_number&quot;: null,
                &quot;issuing_organization&quot;: null,
                &quot;primary_category_id&quot;: 1,
                &quot;service_description&quot;: &quot;asdsad&quot;,
                &quot;availability_schedule&quot;: {
                    &quot;days&quot;: {
                        &quot;friday&quot;: {
                            &quot;time_slots&quot;: [],
                            &quot;is_available&quot;: false,
                            &quot;slot_duration_minutes&quot;: 60
                        },
                        &quot;monday&quot;: {
                            &quot;time_slots&quot;: [
                                {
                                    &quot;end_time&quot;: &quot;17:00&quot;,
                                    &quot;start_time&quot;: &quot;09:00&quot;
                                }
                            ],
                            &quot;is_available&quot;: true,
                            &quot;slot_duration_minutes&quot;: 60
                        },
                        &quot;sunday&quot;: {
                            &quot;time_slots&quot;: [],
                            &quot;is_available&quot;: false,
                            &quot;slot_duration_minutes&quot;: 60
                        },
                        &quot;tuesday&quot;: {
                            &quot;time_slots&quot;: [
                                {
                                    &quot;end_time&quot;: &quot;17:00&quot;,
                                    &quot;start_time&quot;: &quot;09:00&quot;
                                }
                            ],
                            &quot;is_available&quot;: true,
                            &quot;slot_duration_minutes&quot;: 60
                        },
                        &quot;saturday&quot;: {
                            &quot;time_slots&quot;: [],
                            &quot;is_available&quot;: false,
                            &quot;slot_duration_minutes&quot;: 60
                        },
                        &quot;thursday&quot;: {
                            &quot;time_slots&quot;: [],
                            &quot;is_available&quot;: false,
                            &quot;slot_duration_minutes&quot;: 60
                        },
                        &quot;wednesday&quot;: {
                            &quot;time_slots&quot;: [],
                            &quot;is_available&quot;: false,
                            &quot;slot_duration_minutes&quot;: 60
                        }
                    },
                    &quot;end_date&quot;: null,
                    &quot;start_date&quot;: null,
                    &quot;schedule_type&quot;: &quot;weekly&quot;
                },
                &quot;timezone&quot;: &quot;Australia/Sydney&quot;,
                &quot;is_active&quot;: true,
                &quot;is_accepting_clients&quot;: true,
                &quot;profile_image_path&quot;: null,
                &quot;total_bookings&quot;: 0,
                &quot;average_rating&quot;: null,
                &quot;total_reviews&quot;: 0,
                &quot;created_at&quot;: &quot;2026-03-09T11:55:23.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-03-09T11:55:23.000000Z&quot;,
                &quot;approved_at&quot;: &quot;2026-03-09T11:55:23.000000Z&quot;,
                &quot;user&quot;: {
                    &quot;id&quot;: 3,
                    &quot;name&quot;: &quot;New User&quot;,
                    &quot;email&quot;: &quot;newuser@example.com&quot;,
                    &quot;email_verified_at&quot;: null,
                    &quot;is_practitioner&quot;: true,
                    &quot;created_at&quot;: &quot;2026-03-07T20:26:08.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2026-03-09T11:55:23.000000Z&quot;,
                    &quot;has_pending_practitioner_application&quot;: false,
                    &quot;is_vendor&quot;: false,
                    &quot;has_pending_vendor_application&quot;: false,
                    &quot;vendor&quot;: null
                }
            },
            &quot;subcategory&quot;: {
                &quot;id&quot;: 1,
                &quot;category_id&quot;: 1,
                &quot;name&quot;: &quot;Massage Therapy&quot;,
                &quot;slug&quot;: &quot;massage-therapy&quot;,
                &quot;description&quot;: &quot;Therapeutic massage services&quot;,
                &quot;display_order&quot;: 1,
                &quot;is_active&quot;: true,
                &quot;created_at&quot;: &quot;2026-03-06 17:05:22&quot;
            },
            &quot;slots&quot;: [
                {
                    &quot;id&quot;: 1,
                    &quot;practitioner_offering_id&quot;: 1,
                    &quot;duration&quot;: 105,
                    &quot;price&quot;: &quot;12.00&quot;,
                    &quot;created_at&quot;: &quot;2026-03-09T11:57:33.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2026-03-09T11:57:33.000000Z&quot;,
                    &quot;availability&quot;: [
                        {
                            &quot;id&quot;: 1,
                            &quot;practitioner_offering_slot_id&quot;: 1,
                            &quot;day_of_week&quot;: 6,
                            &quot;start_time&quot;: &quot;09:00:00&quot;,
                            &quot;end_time&quot;: &quot;17:00:00&quot;,
                            &quot;created_at&quot;: &quot;2026-03-09T11:57:33.000000Z&quot;,
                            &quot;updated_at&quot;: &quot;2026-03-09T11:57:33.000000Z&quot;
                        }
                    ]
                }
            ]
        }
    ],
    &quot;first_page_url&quot;: &quot;http://localhost/api/practitioners/offerings/browse?page=1&quot;,
    &quot;from&quot;: 1,
    &quot;last_page&quot;: 1,
    &quot;last_page_url&quot;: &quot;http://localhost/api/practitioners/offerings/browse?page=1&quot;,
    &quot;links&quot;: [
        {
            &quot;url&quot;: null,
            &quot;label&quot;: &quot;&amp;laquo; Previous&quot;,
            &quot;page&quot;: null,
            &quot;active&quot;: false
        },
        {
            &quot;url&quot;: &quot;http://localhost/api/practitioners/offerings/browse?page=1&quot;,
            &quot;label&quot;: &quot;1&quot;,
            &quot;page&quot;: 1,
            &quot;active&quot;: true
        },
        {
            &quot;url&quot;: null,
            &quot;label&quot;: &quot;Next &amp;raquo;&quot;,
            &quot;page&quot;: null,
            &quot;active&quot;: false
        }
    ],
    &quot;next_page_url&quot;: null,
    &quot;path&quot;: &quot;http://localhost/api/practitioners/offerings/browse&quot;,
    &quot;per_page&quot;: 12,
    &quot;prev_page_url&quot;: null,
    &quot;to&quot;: 1,
    &quot;total&quot;: 1
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-practitioners-offerings-browse" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-practitioners-offerings-browse"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-practitioners-offerings-browse"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-practitioners-offerings-browse" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-practitioners-offerings-browse">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-practitioners-offerings-browse" data-method="GET"
      data-path="api/practitioners/offerings/browse"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-practitioners-offerings-browse', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-practitioners-offerings-browse"
                    onclick="tryItOut('GETapi-practitioners-offerings-browse');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-practitioners-offerings-browse"
                    onclick="cancelTryOut('GETapi-practitioners-offerings-browse');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-practitioners-offerings-browse"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/practitioners/offerings/browse</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-practitioners-offerings-browse"
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
                              name="Accept"                data-endpoint="GETapi-practitioners-offerings-browse"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="practitioner-offerings-GETapi-practitioners-offerings">List Offerings by Subcategory — Public</h2>

<p>
</p>

<p>Route: GET /practitioners/offerings?subcategory_id=X</p>

<span id="example-requests-GETapi-practitioners-offerings">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/practitioners/offerings" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"subcategory_id\": \"architecto\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/practitioners/offerings"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "subcategory_id": "architecto"
};

fetch(url, {
    method: "GET",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-practitioners-offerings">
            <blockquote>
            <p>Example response (422):</p>
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
    &quot;message&quot;: &quot;Validation failed&quot;,
    &quot;errors&quot;: {
        &quot;subcategory_id&quot;: [
            &quot;The selected subcategory id is invalid.&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-practitioners-offerings" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-practitioners-offerings"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-practitioners-offerings"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-practitioners-offerings" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-practitioners-offerings">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-practitioners-offerings" data-method="GET"
      data-path="api/practitioners/offerings"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-practitioners-offerings', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-practitioners-offerings"
                    onclick="tryItOut('GETapi-practitioners-offerings');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-practitioners-offerings"
                    onclick="cancelTryOut('GETapi-practitioners-offerings');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-practitioners-offerings"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/practitioners/offerings</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-practitioners-offerings"
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
                              name="Accept"                data-endpoint="GETapi-practitioners-offerings"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>subcategory_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="subcategory_id"                data-endpoint="GETapi-practitioners-offerings"
               value="architecto"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the service_subcategories table. Example: <code>architecto</code></p>
        </div>
        </form>

                    <h2 id="practitioner-offerings-GETapi-practitioners-offerings--offering_id-">Get Offering Details — Public</h2>

<p>
</p>

<p>Route: GET /practitioners/offerings/{offering}</p>

<span id="example-requests-GETapi-practitioners-offerings--offering_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/practitioners/offerings/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/practitioners/offerings/1"
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

<span id="example-responses-GETapi-practitioners-offerings--offering_id-">
            <blockquote>
            <p>Example response (200):</p>
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
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;practitioner_profile_id&quot;: 3,
        &quot;subcategory_id&quot;: 1,
        &quot;subcategory&quot;: {
            &quot;id&quot;: 1,
            &quot;category_id&quot;: 1,
            &quot;name&quot;: &quot;Massage Therapy&quot;,
            &quot;slug&quot;: &quot;massage-therapy&quot;,
            &quot;description&quot;: &quot;Therapeutic massage services&quot;,
            &quot;display_order&quot;: 1,
            &quot;is_active&quot;: true,
            &quot;created_at&quot;: &quot;2026-03-06 17:05:22&quot;
        },
        &quot;title&quot;: &quot;Riki Session&quot;,
        &quot;brief&quot;: &quot;Description&quot;,
        &quot;description&quot;: &quot;Description&quot;,
        &quot;duration&quot;: 105,
        &quot;price&quot;: &quot;12.00&quot;,
        &quot;active&quot;: true,
        &quot;images&quot;: [
            &quot;/storage/practitioner_offerings/TtwMt8EkUZT3lJk5ZsR9rAqTmKGaZ4C43aL2msf4.jpg&quot;
        ],
        &quot;slots&quot;: [
            {
                &quot;id&quot;: 1,
                &quot;practitioner_offering_id&quot;: 1,
                &quot;duration&quot;: 105,
                &quot;price&quot;: &quot;12.00&quot;,
                &quot;availability&quot;: [
                    {
                        &quot;id&quot;: 1,
                        &quot;practitioner_offering_slot_id&quot;: 1,
                        &quot;day_of_week&quot;: 6,
                        &quot;start_time&quot;: &quot;09:00:00&quot;,
                        &quot;end_time&quot;: &quot;17:00:00&quot;,
                        &quot;created_at&quot;: &quot;2026-03-09T11:57:33.000000Z&quot;,
                        &quot;updated_at&quot;: &quot;2026-03-09T11:57:33.000000Z&quot;
                    }
                ],
                &quot;created_at&quot;: &quot;2026-03-09T11:57:33.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-03-09T11:57:33.000000Z&quot;
            }
        ],
        &quot;practitioner_profile&quot;: {
            &quot;id&quot;: 3,
            &quot;user_id&quot;: 3,
            &quot;application_id&quot;: 3,
            &quot;phone_number&quot;: &quot;+923336242414&quot;,
            &quot;professional_title&quot;: &quot;Fitness Coach&quot;,
            &quot;years_experience&quot;: &quot;20+&quot;,
            &quot;bio&quot;: &quot;asd&quot;,
            &quot;license_number&quot;: null,
            &quot;issuing_organization&quot;: null,
            &quot;primary_category_id&quot;: 1,
            &quot;service_description&quot;: &quot;asdsad&quot;,
            &quot;availability_schedule&quot;: {
                &quot;days&quot;: {
                    &quot;friday&quot;: {
                        &quot;time_slots&quot;: [],
                        &quot;is_available&quot;: false,
                        &quot;slot_duration_minutes&quot;: 60
                    },
                    &quot;monday&quot;: {
                        &quot;time_slots&quot;: [
                            {
                                &quot;end_time&quot;: &quot;17:00&quot;,
                                &quot;start_time&quot;: &quot;09:00&quot;
                            }
                        ],
                        &quot;is_available&quot;: true,
                        &quot;slot_duration_minutes&quot;: 60
                    },
                    &quot;sunday&quot;: {
                        &quot;time_slots&quot;: [],
                        &quot;is_available&quot;: false,
                        &quot;slot_duration_minutes&quot;: 60
                    },
                    &quot;tuesday&quot;: {
                        &quot;time_slots&quot;: [
                            {
                                &quot;end_time&quot;: &quot;17:00&quot;,
                                &quot;start_time&quot;: &quot;09:00&quot;
                            }
                        ],
                        &quot;is_available&quot;: true,
                        &quot;slot_duration_minutes&quot;: 60
                    },
                    &quot;saturday&quot;: {
                        &quot;time_slots&quot;: [],
                        &quot;is_available&quot;: false,
                        &quot;slot_duration_minutes&quot;: 60
                    },
                    &quot;thursday&quot;: {
                        &quot;time_slots&quot;: [],
                        &quot;is_available&quot;: false,
                        &quot;slot_duration_minutes&quot;: 60
                    },
                    &quot;wednesday&quot;: {
                        &quot;time_slots&quot;: [],
                        &quot;is_available&quot;: false,
                        &quot;slot_duration_minutes&quot;: 60
                    }
                },
                &quot;end_date&quot;: null,
                &quot;start_date&quot;: null,
                &quot;schedule_type&quot;: &quot;weekly&quot;
            },
            &quot;timezone&quot;: &quot;Australia/Sydney&quot;,
            &quot;is_active&quot;: true,
            &quot;is_accepting_clients&quot;: true,
            &quot;profile_image_path&quot;: null,
            &quot;total_bookings&quot;: 0,
            &quot;average_rating&quot;: null,
            &quot;total_reviews&quot;: 0,
            &quot;created_at&quot;: &quot;2026-03-09T11:55:23.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-03-09T11:55:23.000000Z&quot;,
            &quot;approved_at&quot;: &quot;2026-03-09T11:55:23.000000Z&quot;,
            &quot;user&quot;: {
                &quot;id&quot;: 3,
                &quot;name&quot;: &quot;New User&quot;,
                &quot;email&quot;: &quot;newuser@example.com&quot;,
                &quot;email_verified_at&quot;: null,
                &quot;is_practitioner&quot;: true,
                &quot;created_at&quot;: &quot;2026-03-07T20:26:08.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-03-09T11:55:23.000000Z&quot;,
                &quot;has_pending_practitioner_application&quot;: false,
                &quot;is_vendor&quot;: false,
                &quot;has_pending_vendor_application&quot;: false,
                &quot;vendor&quot;: null
            }
        },
        &quot;created_at&quot;: &quot;2026-03-09T11:57:33.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-03-09T11:57:33.000000Z&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-practitioners-offerings--offering_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-practitioners-offerings--offering_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-practitioners-offerings--offering_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-practitioners-offerings--offering_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-practitioners-offerings--offering_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-practitioners-offerings--offering_id-" data-method="GET"
      data-path="api/practitioners/offerings/{offering_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-practitioners-offerings--offering_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-practitioners-offerings--offering_id-"
                    onclick="tryItOut('GETapi-practitioners-offerings--offering_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-practitioners-offerings--offering_id-"
                    onclick="cancelTryOut('GETapi-practitioners-offerings--offering_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-practitioners-offerings--offering_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/practitioners/offerings/{offering_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-practitioners-offerings--offering_id-"
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
                              name="Accept"                data-endpoint="GETapi-practitioners-offerings--offering_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>offering_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="offering_id"                data-endpoint="GETapi-practitioners-offerings--offering_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the offering. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="practitioner-offerings-GETapi-practitioners-offerings-all">List Own Offerings — Practitioner Dashboard</h2>

<p>
</p>

<p>Returns ALL offerings (active + inactive) belonging to the authenticated
practitioner only. Requires authentication.</p>
<p>Route: GET /practitioners/offerings/all  (auth:sanctum)</p>

<span id="example-requests-GETapi-practitioners-offerings-all">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/practitioners/offerings/all" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/practitioners/offerings/all"
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

<span id="example-responses-GETapi-practitioners-offerings-all">
            <blockquote>
            <p>Example response (404):</p>
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
    &quot;message&quot;: &quot;Resource not found&quot;,
    &quot;error&quot;: &quot;The practitioneroffering with ID all was not found&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-practitioners-offerings-all" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-practitioners-offerings-all"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-practitioners-offerings-all"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-practitioners-offerings-all" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-practitioners-offerings-all">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-practitioners-offerings-all" data-method="GET"
      data-path="api/practitioners/offerings/all"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-practitioners-offerings-all', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-practitioners-offerings-all"
                    onclick="tryItOut('GETapi-practitioners-offerings-all');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-practitioners-offerings-all"
                    onclick="cancelTryOut('GETapi-practitioners-offerings-all');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-practitioners-offerings-all"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/practitioners/offerings/all</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-practitioners-offerings-all"
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
                              name="Accept"                data-endpoint="GETapi-practitioners-offerings-all"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="practitioner-offerings-POSTapi-practitioners-profiles--profile_id--offerings">Create Offering</h2>

<p>
</p>

<p>Route: POST /practitioners/profiles/{profile}/offerings  (auth:sanctum)</p>

<span id="example-requests-POSTapi-practitioners-profiles--profile_id--offerings">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/practitioners/profiles/1/offerings" \
    --header "Content-Type: multipart/form-data" \
    --header "Accept: application/json" \
    --form "subcategory_id=architecto"\
    --form "title=n"\
    --form "brief=g"\
    --form "description=Quos velit et fugiat sunt nihil accusantium harum."\
    --form "duration=35"\
    --form "price=75"\
    --form "active="\
    --form "images[]=@/tmp/php3o18itt0llivaC1o25X" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/practitioners/profiles/1/offerings"
);

const headers = {
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
};

const body = new FormData();
body.append('subcategory_id', 'architecto');
body.append('title', 'n');
body.append('brief', 'g');
body.append('description', 'Quos velit et fugiat sunt nihil accusantium harum.');
body.append('duration', '35');
body.append('price', '75');
body.append('active', '');
body.append('images[]', document.querySelector('input[name="images[]"]').files[0]);

fetch(url, {
    method: "POST",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-practitioners-profiles--profile_id--offerings">
</span>
<span id="execution-results-POSTapi-practitioners-profiles--profile_id--offerings" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-practitioners-profiles--profile_id--offerings"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-practitioners-profiles--profile_id--offerings"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-practitioners-profiles--profile_id--offerings" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-practitioners-profiles--profile_id--offerings">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-practitioners-profiles--profile_id--offerings" data-method="POST"
      data-path="api/practitioners/profiles/{profile_id}/offerings"
      data-authed="0"
      data-hasfiles="1"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-practitioners-profiles--profile_id--offerings', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-practitioners-profiles--profile_id--offerings"
                    onclick="tryItOut('POSTapi-practitioners-profiles--profile_id--offerings');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-practitioners-profiles--profile_id--offerings"
                    onclick="cancelTryOut('POSTapi-practitioners-profiles--profile_id--offerings');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-practitioners-profiles--profile_id--offerings"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/practitioners/profiles/{profile_id}/offerings</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-practitioners-profiles--profile_id--offerings"
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
                              name="Accept"                data-endpoint="POSTapi-practitioners-profiles--profile_id--offerings"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>profile_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="profile_id"                data-endpoint="POSTapi-practitioners-profiles--profile_id--offerings"
               value="1"
               data-component="url">
    <br>
<p>The ID of the profile. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>subcategory_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="subcategory_id"                data-endpoint="POSTapi-practitioners-profiles--profile_id--offerings"
               value="architecto"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the service_subcategories table. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>title</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="title"                data-endpoint="POSTapi-practitioners-profiles--profile_id--offerings"
               value="n"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>n</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>brief</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="brief"                data-endpoint="POSTapi-practitioners-profiles--profile_id--offerings"
               value="g"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>g</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="POSTapi-practitioners-profiles--profile_id--offerings"
               value="Quos velit et fugiat sunt nihil accusantium harum."
               data-component="body">
    <br>
<p>Must not be greater than 10000 characters. Example: <code>Quos velit et fugiat sunt nihil accusantium harum.</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>duration</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="duration"                data-endpoint="POSTapi-practitioners-profiles--profile_id--offerings"
               value="35"
               data-component="body">
    <br>
<p>Must be at least 1. Example: <code>35</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>price</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="price"                data-endpoint="POSTapi-practitioners-profiles--profile_id--offerings"
               value="75"
               data-component="body">
    <br>
<p>Must be at least 0. Example: <code>75</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="POSTapi-practitioners-profiles--profile_id--offerings" style="display: none">
            <input type="radio" name="active"
                   value="true"
                   data-endpoint="POSTapi-practitioners-profiles--profile_id--offerings"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-practitioners-profiles--profile_id--offerings" style="display: none">
            <input type="radio" name="active"
                   value="false"
                   data-endpoint="POSTapi-practitioners-profiles--profile_id--offerings"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>false</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>images</code></b>&nbsp;&nbsp;
<small>file[]</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="file" style="display: none"
                              name="images[0]"                data-endpoint="POSTapi-practitioners-profiles--profile_id--offerings"
               data-component="body">
        <input type="file" style="display: none"
               name="images[1]"                data-endpoint="POSTapi-practitioners-profiles--profile_id--offerings"
               data-component="body">
    <br>
<p>Must be an image. Must not be greater than 5120 kilobytes.</p>
        </div>
        </form>

                    <h2 id="practitioner-offerings-PUTapi-practitioners-offerings--offering_id-">Update Offering</h2>

<p>
</p>

<p>Route: PUT /practitioners/offerings/{offering}  (auth:sanctum)</p>

<span id="example-requests-PUTapi-practitioners-offerings--offering_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/api/practitioners/offerings/1" \
    --header "Content-Type: multipart/form-data" \
    --header "Accept: application/json" \
    --form "title=b"\
    --form "brief=n"\
    --form "description=Animi quos velit et fugiat."\
    --form "duration=26"\
    --form "price=37"\
    --form "active="\
    --form "images[]=@/tmp/phpchfljt8s1h6kb5Si0xm" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/practitioners/offerings/1"
);

const headers = {
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
};

const body = new FormData();
body.append('title', 'b');
body.append('brief', 'n');
body.append('description', 'Animi quos velit et fugiat.');
body.append('duration', '26');
body.append('price', '37');
body.append('active', '');
body.append('images[]', document.querySelector('input[name="images[]"]').files[0]);

fetch(url, {
    method: "PUT",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-practitioners-offerings--offering_id-">
</span>
<span id="execution-results-PUTapi-practitioners-offerings--offering_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-practitioners-offerings--offering_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-practitioners-offerings--offering_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-practitioners-offerings--offering_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-practitioners-offerings--offering_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-practitioners-offerings--offering_id-" data-method="PUT"
      data-path="api/practitioners/offerings/{offering_id}"
      data-authed="0"
      data-hasfiles="1"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-practitioners-offerings--offering_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-practitioners-offerings--offering_id-"
                    onclick="tryItOut('PUTapi-practitioners-offerings--offering_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-practitioners-offerings--offering_id-"
                    onclick="cancelTryOut('PUTapi-practitioners-offerings--offering_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-practitioners-offerings--offering_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/practitioners/offerings/{offering_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-practitioners-offerings--offering_id-"
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
                              name="Accept"                data-endpoint="PUTapi-practitioners-offerings--offering_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>offering_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="offering_id"                data-endpoint="PUTapi-practitioners-offerings--offering_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the offering. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>subcategory_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="subcategory_id"                data-endpoint="PUTapi-practitioners-offerings--offering_id-"
               value=""
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the service_subcategories table.</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>title</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="title"                data-endpoint="PUTapi-practitioners-offerings--offering_id-"
               value="b"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>b</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>brief</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="brief"                data-endpoint="PUTapi-practitioners-offerings--offering_id-"
               value="n"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>n</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="PUTapi-practitioners-offerings--offering_id-"
               value="Animi quos velit et fugiat."
               data-component="body">
    <br>
<p>Must not be greater than 10000 characters. Example: <code>Animi quos velit et fugiat.</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>duration</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="duration"                data-endpoint="PUTapi-practitioners-offerings--offering_id-"
               value="26"
               data-component="body">
    <br>
<p>Must be at least 1. Example: <code>26</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>price</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="price"                data-endpoint="PUTapi-practitioners-offerings--offering_id-"
               value="37"
               data-component="body">
    <br>
<p>Must be at least 0. Example: <code>37</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="PUTapi-practitioners-offerings--offering_id-" style="display: none">
            <input type="radio" name="active"
                   value="true"
                   data-endpoint="PUTapi-practitioners-offerings--offering_id-"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="PUTapi-practitioners-offerings--offering_id-" style="display: none">
            <input type="radio" name="active"
                   value="false"
                   data-endpoint="PUTapi-practitioners-offerings--offering_id-"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>false</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>images</code></b>&nbsp;&nbsp;
<small>file[]</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="file" style="display: none"
                              name="images[0]"                data-endpoint="PUTapi-practitioners-offerings--offering_id-"
               data-component="body">
        <input type="file" style="display: none"
               name="images[1]"                data-endpoint="PUTapi-practitioners-offerings--offering_id-"
               data-component="body">
    <br>
<p>Must be an image. Must not be greater than 5120 kilobytes.</p>
        </div>
        </form>

                    <h2 id="practitioner-offerings-DELETEapi-practitioners-offerings--offering_id-">Delete Offering</h2>

<p>
</p>

<p>Route: DELETE /practitioners/offerings/{offering}  (auth:sanctum)</p>

<span id="example-requests-DELETEapi-practitioners-offerings--offering_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/api/practitioners/offerings/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/practitioners/offerings/1"
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

<span id="example-responses-DELETEapi-practitioners-offerings--offering_id-">
</span>
<span id="execution-results-DELETEapi-practitioners-offerings--offering_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-practitioners-offerings--offering_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-practitioners-offerings--offering_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-practitioners-offerings--offering_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-practitioners-offerings--offering_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-practitioners-offerings--offering_id-" data-method="DELETE"
      data-path="api/practitioners/offerings/{offering_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-practitioners-offerings--offering_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-practitioners-offerings--offering_id-"
                    onclick="tryItOut('DELETEapi-practitioners-offerings--offering_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-practitioners-offerings--offering_id-"
                    onclick="cancelTryOut('DELETEapi-practitioners-offerings--offering_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-practitioners-offerings--offering_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/practitioners/offerings/{offering_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-practitioners-offerings--offering_id-"
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
                              name="Accept"                data-endpoint="DELETEapi-practitioners-offerings--offering_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>offering_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="offering_id"                data-endpoint="DELETEapi-practitioners-offerings--offering_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the offering. Example: <code>1</code></p>
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

    <p>APIs for managing vendor products (physical goods).
Services are managed separately under Practitioner Offerings.</p>

                                <h2 id="product-management-GETapi-products--product_id-">Get Product Details</h2>

<p>
</p>

<p>Retrieve detailed information about a product including its variants.</p>

<span id="example-requests-GETapi-products--product_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/products/16" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/products/16"
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
        &quot;title&quot;: &quot;Yoga Mat Pro&quot;,
        &quot;brief&quot;: &quot;Premium non-slip yoga mat&quot;,
        &quot;description&quot;: &quot;Full description here...&quot;,
        &quot;active&quot;: true,
        &quot;vendor&quot;: {
            &quot;id&quot;: 1,
            &quot;business_name&quot;: &quot;Wellness Supplies Co&quot;
        },
        &quot;variants&quot;: [
            {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Large&quot;,
                &quot;price&quot;: &quot;49.99&quot;,
                &quot;stock&quot;: 100
            }
        ]
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
               value="16"
               data-component="url">
    <br>
<p>The ID of the product. Example: <code>16</code></p>
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

                    <h2 id="product-management-POSTapi-vendors--vendor_id--products">Create Product</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Create a new product for a vendor.</p>

<span id="example-requests-POSTapi-vendors--vendor_id--products">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/vendors/16/products" \
    --header "Content-Type: multipart/form-data" \
    --header "Accept: application/json" \
    --form "title=Yoga Mat Pro"\
    --form "brief=Premium non-slip yoga mat"\
    --form "description=High-density foam with alignment lines..."\
    --form "active=1"\
    --form "variants[][name]=b"\
    --form "variants[][price]=39"\
    --form "variants[][stock]=84"\
    --form "images[]=@/tmp/php1k7e708u6kogdojy25l" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/vendors/16/products"
);

const headers = {
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
};

const body = new FormData();
body.append('title', 'Yoga Mat Pro');
body.append('brief', 'Premium non-slip yoga mat');
body.append('description', 'High-density foam with alignment lines...');
body.append('active', '1');
body.append('variants[][name]', 'b');
body.append('variants[][price]', '39');
body.append('variants[][stock]', '84');
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
        &quot;title&quot;: &quot;Yoga Mat Pro&quot;,
        &quot;brief&quot;: &quot;Premium non-slip yoga mat&quot;,
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
               value="16"
               data-component="url">
    <br>
<p>The ID of the vendor. Example: <code>16</code></p>
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
               value="Yoga Mat Pro"
               data-component="body">
    <br>
<p>Product title. Example: <code>Yoga Mat Pro</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>brief</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="brief"                data-endpoint="POSTapi-vendors--vendor_id--products"
               value="Premium non-slip yoga mat"
               data-component="body">
    <br>
<p>Short description (max 255 chars). Example: <code>Premium non-slip yoga mat</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="POSTapi-vendors--vendor_id--products"
               value="High-density foam with alignment lines..."
               data-component="body">
    <br>
<p>Detailed description (max 4000 chars). Example: <code>High-density foam with alignment lines...</code></p>
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
 &nbsp;
 &nbsp;
<br>
<p>Must have at least 1 items.</p>
            </summary>
                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="variants.0.name"                data-endpoint="POSTapi-vendors--vendor_id--products"
               value="b"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>b</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>price</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="variants.0.price"                data-endpoint="POSTapi-vendors--vendor_id--products"
               value="39"
               data-component="body">
    <br>
<p>Must be at least 0. Example: <code>39</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>stock</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="variants.0.stock"                data-endpoint="POSTapi-vendors--vendor_id--products"
               value="84"
               data-component="body">
    <br>
<p>Must be at least 0. Example: <code>84</code></p>
                    </div>
                                    </details>
        </div>
        </form>

                    <h2 id="product-management-GETapi-vendors--vendor_id--products">List Vendor Products</h2>

<p>
</p>

<p>Get all products for a specific vendor with pagination.</p>

<span id="example-requests-GETapi-vendors--vendor_id--products">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/vendors/16/products?page=1&amp;per_page=15" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/vendors/16/products"
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
            &quot;title&quot;: &quot;Yoga Mat Pro&quot;,
            &quot;active&quot;: true,
            &quot;variants&quot;: [
                {
                    &quot;id&quot;: 1,
                    &quot;name&quot;: &quot;Large&quot;,
                    &quot;price&quot;: &quot;49.99&quot;,
                    &quot;stock&quot;: 100
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
               value="16"
               data-component="url">
    <br>
<p>The ID of the vendor. Example: <code>16</code></p>
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

                    <h2 id="product-management-PUTapi-products--product_id-">Update Product</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Update product details. Only the vendor owner can update.</p>

<span id="example-requests-PUTapi-products--product_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/api/products/16" \
    --header "Content-Type: multipart/form-data" \
    --header "Accept: application/json" \
    --form "title=Yoga Mat Pro Deluxe"\
    --form "brief=Updated description"\
    --form "description=New detailed info..."\
    --form "active="\
    --form "variants[][name]=d"\
    --form "variants[][price]=37"\
    --form "variants[][stock]=9"\
    --form "images[]=@/tmp/php49vltak8e54oe0ozzYd" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/products/16"
);

const headers = {
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
};

const body = new FormData();
body.append('title', 'Yoga Mat Pro Deluxe');
body.append('brief', 'Updated description');
body.append('description', 'New detailed info...');
body.append('active', '');
body.append('variants[][name]', 'd');
body.append('variants[][price]', '37');
body.append('variants[][stock]', '9');
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
        &quot;title&quot;: &quot;Yoga Mat Pro Deluxe&quot;,
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
               value="16"
               data-component="url">
    <br>
<p>The ID of the product. Example: <code>16</code></p>
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
               value="Yoga Mat Pro Deluxe"
               data-component="body">
    <br>
<p>optional Product title. Example: <code>Yoga Mat Pro Deluxe</code></p>
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
        </form>

                    <h2 id="product-management-DELETEapi-products--product_id-">Delete Product</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Delete a product. Only the vendor owner can delete.</p>

<span id="example-requests-DELETEapi-products--product_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/api/products/16" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/products/16"
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
               value="16"
               data-component="url">
    <br>
<p>The ID of the product. Example: <code>16</code></p>
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
    "http://localhost/api/products/16/variants" \
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
    "http://localhost/api/products/16/variants"
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
               value="16"
               data-component="url">
    <br>
<p>The ID of the product. Example: <code>16</code></p>
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
    "http://localhost/api/variants/16" \
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
    "http://localhost/api/variants/16"
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
               value="16"
               data-component="url">
    <br>
<p>The ID of the variant. Example: <code>16</code></p>
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
    "http://localhost/api/variants/16" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/variants/16"
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
               value="16"
               data-component="url">
    <br>
<p>The ID of the variant. Example: <code>16</code></p>
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
    --get "http://localhost/api/slots/16/availability?start_date=2024-01-01&amp;end_date=2024-01-07" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"start_date\": \"2026-03-09\",
    \"end_date\": \"2052-04-01\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/slots/16/availability"
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
    "start_date": "2026-03-09",
    "end_date": "2052-04-01"
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
               value="16"
               data-component="url">
    <br>
<p>The ID of the slot. Example: <code>16</code></p>
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
               value="2026-03-09"
               data-component="body">
    <br>
<p>Must be a valid date. Must be a valid date in the format <code>Y-m-d</code>. Example: <code>2026-03-09</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>end_date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="end_date"                data-endpoint="GETapi-slots--slot_id--availability"
               value="2052-04-01"
               data-component="body">
    <br>
<p>Must be a valid date. Must be a valid date in the format <code>Y-m-d</code>. Must be a date after or equal to <code>start_date</code>. Example: <code>2052-04-01</code></p>
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
    --get "http://localhost/api/vendors/16" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/vendors/16"
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
        &quot;status&quot;: &quot;approved&quot;,
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
               value="16"
               data-component="url">
    <br>
<p>The ID of the vendor. Example: <code>16</code></p>
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
    &quot;message&quot;: &quot;Vendor created successfully. Pending admin approval.&quot;,
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
        &quot;status&quot;: &quot;pending&quot;,
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
    "http://localhost/api/vendors/16" \
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
    \"currency\": \"USD\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/vendors/16"
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
    "currency": "USD"
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
               value="16"
               data-component="url">
    <br>
<p>The ID of the vendor. Example: <code>16</code></p>
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
               value="USD"
               data-component="body">
    <br>
<p>Example: <code>USD</code></p>
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
    "http://localhost/api/vendors/16/verify" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/vendors/16/verify"
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
               value="16"
               data-component="url">
    <br>
<p>The ID of the vendor. Example: <code>16</code></p>
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

                    <h2 id="vendor-management-GETapi-admin-vendors">List All Vendors (Admin)</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retrieve all vendors with optional status filtering. Admin access required.</p>

<span id="example-requests-GETapi-admin-vendors">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/admin/vendors?status=pending&amp;per_page=15" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/admin/vendors"
);

const params = {
    "status": "pending",
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

<span id="example-responses-GETapi-admin-vendors">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;business_name&quot;: &quot;Tech Solutions Inc&quot;,
            &quot;status&quot;: &quot;pending&quot;,
            &quot;user&quot;: {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;John Doe&quot;,
                &quot;email&quot;: &quot;john@example.com&quot;
            },
            &quot;created_at&quot;: &quot;2024-01-01T00:00:00.000000Z&quot;
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
    &quot;message&quot;: &quot;Unauthorized.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-admin-vendors" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-admin-vendors"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-admin-vendors"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-admin-vendors" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-admin-vendors">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-admin-vendors" data-method="GET"
      data-path="api/admin/vendors"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-admin-vendors', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-admin-vendors"
                    onclick="tryItOut('GETapi-admin-vendors');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-admin-vendors"
                    onclick="cancelTryOut('GETapi-admin-vendors');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-admin-vendors"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/admin/vendors</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-admin-vendors"
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
                              name="Accept"                data-endpoint="GETapi-admin-vendors"
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
                              name="status"                data-endpoint="GETapi-admin-vendors"
               value="pending"
               data-component="query">
    <br>
<p>Filter by status: &quot;pending&quot;, &quot;approved&quot;, or &quot;rejected&quot;. Example: <code>pending</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>per_page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_page"                data-endpoint="GETapi-admin-vendors"
               value="15"
               data-component="query">
    <br>
<p>Number of results per page. Example: <code>15</code></p>
            </div>
                </form>

                    <h2 id="vendor-management-GETapi-admin-vendors--id-">Get Vendor Details (Admin)</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retrieve full details of any vendor including review history. Admin access required.</p>

<span id="example-requests-GETapi-admin-vendors--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/admin/vendors/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/admin/vendors/1"
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

<span id="example-responses-GETapi-admin-vendors--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;business_name&quot;: &quot;Tech Solutions Inc&quot;,
        &quot;status&quot;: &quot;pending&quot;,
        &quot;user&quot;: {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;John Doe&quot;,
            &quot;email&quot;: &quot;john@example.com&quot;
        },
        &quot;admin_notes&quot;: null,
        &quot;rejection_reason&quot;: null,
        &quot;reviewed_at&quot;: null
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Vendor not found.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-admin-vendors--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-admin-vendors--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-admin-vendors--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-admin-vendors--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-admin-vendors--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-admin-vendors--id-" data-method="GET"
      data-path="api/admin/vendors/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-admin-vendors--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-admin-vendors--id-"
                    onclick="tryItOut('GETapi-admin-vendors--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-admin-vendors--id-"
                    onclick="cancelTryOut('GETapi-admin-vendors--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-admin-vendors--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/admin/vendors/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-admin-vendors--id-"
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
                              name="Accept"                data-endpoint="GETapi-admin-vendors--id-"
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
               step="any"               name="id"                data-endpoint="GETapi-admin-vendors--id-"
               value="1"
               data-component="url">
    <br>
<p>The vendor ID. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="vendor-management-POSTapi-admin-vendors--id--review">Review Vendor (Admin)</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Approve or reject a vendor application. Admin access required.
When approved, verified_at is set and the vendor becomes publicly visible.</p>

<span id="example-requests-POSTapi-admin-vendors--id--review">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/admin/vendors/1/review" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"action\": \"approve\",
    \"rejection_reason\": \"Insufficient business information provided.\",
    \"admin_notes\": \"Follow up in 30 days.\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/admin/vendors/1/review"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "action": "approve",
    "rejection_reason": "Insufficient business information provided.",
    "admin_notes": "Follow up in 30 days."
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-admin-vendors--id--review">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Vendor approved successfully.&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;status&quot;: &quot;approved&quot;,
        &quot;verified_at&quot;: &quot;2024-01-01T00:00:00.000000Z&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Vendor rejected.&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;status&quot;: &quot;rejected&quot;,
        &quot;rejection_reason&quot;: &quot;Insufficient information.&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;Vendor has already been reviewed.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;Vendor not found.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-admin-vendors--id--review" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-admin-vendors--id--review"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-admin-vendors--id--review"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-admin-vendors--id--review" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-admin-vendors--id--review">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-admin-vendors--id--review" data-method="POST"
      data-path="api/admin/vendors/{id}/review"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-admin-vendors--id--review', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-admin-vendors--id--review"
                    onclick="tryItOut('POSTapi-admin-vendors--id--review');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-admin-vendors--id--review"
                    onclick="cancelTryOut('POSTapi-admin-vendors--id--review');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-admin-vendors--id--review"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/admin/vendors/{id}/review</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-admin-vendors--id--review"
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
                              name="Accept"                data-endpoint="POSTapi-admin-vendors--id--review"
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
               step="any"               name="id"                data-endpoint="POSTapi-admin-vendors--id--review"
               value="1"
               data-component="url">
    <br>
<p>The vendor ID. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>action</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="action"                data-endpoint="POSTapi-admin-vendors--id--review"
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
                              name="rejection_reason"                data-endpoint="POSTapi-admin-vendors--id--review"
               value="Insufficient business information provided."
               data-component="body">
    <br>
<p>optional Reason for rejection (required if action is &quot;reject&quot;). Example: <code>Insufficient business information provided.</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>admin_notes</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="admin_notes"                data-endpoint="POSTapi-admin-vendors--id--review"
               value="Follow up in 30 days."
               data-component="body">
    <br>
<p>optional Internal notes not shown to vendor owner. Example: <code>Follow up in 30 days.</code></p>
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
    --get "http://localhost/api/vendors/16/reviews?page=1&amp;per_page=15" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/vendors/16/reviews"
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
               value="16"
               data-component="url">
    <br>
<p>The ID of the vendor. Example: <code>16</code></p>
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
    "http://localhost/api/vendors/16/reviews" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"rating\": 5
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/vendors/16/reviews"
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
               value="16"
               data-component="url">
    <br>
<p>The ID of the vendor. Example: <code>16</code></p>
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
