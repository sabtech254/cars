<?php
'bidding' => \App\Http\Middleware\BiddingAccess::class,
protected $routeMiddleware = [
    // ... other middlewares
    'admin' => \App\Http\Middleware\AdminAccess::class,
];
}