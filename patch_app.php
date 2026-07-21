<?php
$content = file_get_contents('bootstrap/app.php');
// Fix json render
$content = str_replace(
    "fn (Request \$request) => \$request->is('api/*'),",
    "fn (Request \$request) => \$request->is('api/*') || \$request->expectsJson(),",
    $content
);
// Append SecurityHeadersMiddleware
$content = str_replace(
    "        ]);\n    })",
    "        ]);\n\n        \$middleware->append(\App\Http\Middleware\SecurityHeadersMiddleware::class);\n    })",
    $content
);
file_put_contents('bootstrap/app.php', $content);
