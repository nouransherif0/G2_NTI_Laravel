<?php
$files = glob("tests/Feature/Api/Admin/*.php");
foreach ($files as $file) {
    $content = file_get_contents($file);
    $content = str_replace(
        "User::factory()->create()",
        "User::factory()->create(['role' => 'admin'])",
        $content
    );
    file_put_contents($file, $content);
}
echo "Tests updated.\n";
