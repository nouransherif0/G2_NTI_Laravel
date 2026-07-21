<?php
$files = glob("app/Http/Controllers/Api/V1/**/*.php");
foreach ($files as $file) {
    if (is_file($file)) {
        $content = file_get_contents($file);
        if (strpos($content, 'OpenApi\Attributes') === false) {
            echo "Missing OA: $file\n";
        }
    }
}
