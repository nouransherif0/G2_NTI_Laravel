<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$request = Illuminate\Http\Request::create('/admin/add-ons', 'POST', [
    'name' => '',
    'price_adjustment' => -5
]);
$request->headers->set('Accept', 'application/json');
$request->headers->set('X-Requested-With', 'XMLHttpRequest');

// Let's mock a user login to bypass Auth middleware
$user = App\Models\User::first();
$app['auth']->login($user);

$response = $kernel->handle($request);
echo "STATUS: " . $response->getStatusCode() . "\n";
echo "BODY: " . $response->getContent() . "\n";
