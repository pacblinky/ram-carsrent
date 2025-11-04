#!/usr/bin/env php
<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$admin = User::create([
    'name'          => 'Admin',
    'email'         => 'admin@admin.com',
    'password'      => Hash::make('password'),
    'phone_number'  => '01000000000',
    'government_id' => 'A123456789',
    'is_admin'      => true,
]);

echo "✅ Admin user created:\n";
print_r($admin->toArray());
