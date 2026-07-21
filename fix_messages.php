<?php
$files = glob("app/Http/Requests/**/*.php") + glob("app/Http/Requests/*.php");
foreach ($files as $file) {
    if (!is_file($file)) continue;
    $content = file_get_contents($file);
    
    // rename `public function message` to `public function messages`
    $content = preg_replace('/public function message\(/', 'public function messages(', $content);
    
    // Check if messages() exists
    if (strpos($content, 'function messages()') === false) {
        // extract rules
        preg_match('/public function rules\(\)[\s\S]*?return \[([\s\S]*?)\];/im', $content, $matches);
        if (isset($matches[1])) {
            $rulesStr = $matches[1];
            preg_match_all("/['\"]([a-zA-Z0-9_\.\*]+)['\"]\s*=>/", $rulesStr, $fieldMatches);
            $fields = $fieldMatches[1];
            
            if (count($fields) > 0) {
                $messages = [];
                foreach ($fields as $field) {
                    $cleanName = ucwords(str_replace(['_', '.*.', '.id'], [' ', ' ', ''], $field));
                    if ($field == 'add_ons.*.id' || $field == 'add_ons.*.name' || $field == 'add_ons.*.price_adjustment') {
                        $cleanName = 'Add On';
                    }
                    
                    $messages[] = "            '$field.required' => '$cleanName is required.',";
                    $messages[] = "            '$field.string' => '$cleanName must be a string.',";
                    $messages[] = "            '$field.numeric' => '$cleanName must be a number.',";
                    $messages[] = "            '$field.integer' => '$cleanName must be an integer.',";
                    $messages[] = "            '$field.exists' => 'The selected $cleanName is invalid.',";
                    $messages[] = "            '$field.boolean' => '$cleanName must be true or false.',";
                    $messages[] = "            '$field.array' => '$cleanName must be an array.',";
                    $messages[] = "            '$field.email' => '$cleanName must be a valid email address.',";
                    $messages[] = "            '$field.max' => '$cleanName exceeds the maximum allowed length.',";
                    $messages[] = "            '$field.min' => '$cleanName is below the minimum allowed length.',";
                }
                
                $msgFunc = "\n    public function messages(): array\n    {\n        return [\n" . implode("\n", $messages) . "\n        ];\n    }\n";
                
                // insert before last brace
                $content = preg_replace('/}(?=[^}]*$)/', $msgFunc . "}", $content);
            }
        }
    }
    
    file_put_contents($file, $content);
    echo "Processed $file\n";
}
