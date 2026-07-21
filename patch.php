<?php
$content = file_get_contents('bootstrap/app.php');
$content = str_replace(
    "fn (Request \$request) => \$request->is('api/*'),",
    "fn (Request \$request) => \$request->is('api/*') || \$request->expectsJson(),",
    $content
);
file_put_contents('bootstrap/app.php', $content);
