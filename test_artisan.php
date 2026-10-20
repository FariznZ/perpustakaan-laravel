<?php
require 'vendor/autoload.php';

$app = require 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$status = $kernel->handle(
    $input = new Symfony\Component\Console\Input\ArgvInput(['artisan', 'key:generate']),
    new Symfony\Component\Console\Output\ConsoleOutput
);

$kernel->terminate($input, $status);
exit($status);