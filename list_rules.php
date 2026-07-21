<?php
$files = glob("app/Http/Requests/**/*.php") + glob("app/Http/Requests/*.php");
foreach ($files as $file) {
    if (is_file($file)) {
        echo "=== $file ===\n";
        $content = file_get_contents($file);
        preg_match('/public function rules\(\)[\s\S]*?return \[([\s\S]*?)\];/im', $content, $matches);
        if (isset($matches[1])) {
            echo trim($matches[1]) . "\n";
        }
    }
}
