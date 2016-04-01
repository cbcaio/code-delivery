<?php
/** Route Partial Map
=================================================== */

Route::get('/', function ()
{
    return view('welcome');
});

Route::get('/home', function ()
{
    return view('welcome');
});

// ORDER MATTERS!
$route_partials = [

    'admin_categories',
    'admin_clients',
    'admin_cupoms',
    'admin_orders',
    'admin_products',
    'customer_orders',
    'oauth'
];

/** Route Partial Loadup
=================================================== */

foreach ($route_partials as $partial) {

    $file = __DIR__.'/Routes/'.$partial.'.php';

    if ( ! file_exists($file))
    {
        $msg = "Route partial [{$partial}] not found.";
        throw new FileNotFoundException($msg);
    }

    require_once $file;
}