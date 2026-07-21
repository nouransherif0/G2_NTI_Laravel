import os
import re

def process_file(filepath):
    with open(filepath, 'r', encoding='utf-8') as f:
        content = f.read()
    
    # Extract rules block
    rules_match = re.search(r'public function rules\(\).*?\{[\s\S]*?return\s+\[([\s\S]*?)\];', content, re.IGNORECASE)
    if not rules_match:
        return False
    
    rules_str = rules_match.group(1)
    
    # Find fields
    fields = []
    # match 'field_name' => 'rule1|rule2' or 'field_name' => ['rule1', 'rule2']
    # Simplified regex for keys
    for line in rules_str.split('\n'):
        m = re.search(r"['\"]([a-zA-Z0-9_\.\*]+)['\"]\s*=>", line)
        if m:
            fields.append(m.group(1))
            
    if not fields:
        return False
        
    messages_lines = []
    messages_lines.append("    public function messages(): array\n    {\n        return [")
    
    for field in fields:
        clean_name = field.replace('_', ' ').replace('.*.', ' ').replace('.id', '').title()
        if field == 'add_ons.*.id':
             clean_name = 'Add On'
        
        messages_lines.append(f"            '{field}.required' => '{clean_name} is required.',")
        messages_lines.append(f"            '{field}.string' => '{clean_name} must be a string.',")
        messages_lines.append(f"            '{field}.numeric' => '{clean_name} must be a number.',")
        messages_lines.append(f"            '{field}.integer' => '{clean_name} must be an integer.',")
        messages_lines.append(f"            '{field}.boolean' => '{clean_name} must be true or false.',")
        messages_lines.append(f"            '{field}.exists' => 'The selected {clean_name.lower()} is invalid.',")
        messages_lines.append(f"            '{field}.max' => '{clean_name} exceeds maximum allowed limit.',")
        messages_lines.append(f"            '{field}.min' => '{clean_name} is below minimum allowed limit.',")
        messages_lines.append(f"            '{field}.email' => '{clean_name} must be a valid email address.',")
        messages_lines.append(f"            '{field}.in' => 'The selected {clean_name.lower()} is invalid.',")
        messages_lines.append(f"            '{field}.array' => '{clean_name} must be an array.',")
    
    messages_lines.append("        ];\n    }")
    
    messages_str = "\n".join(messages_lines)
    
    # Remove existing messages() or message() - matches from 'public function message' to the matching closing brace of that function
    # A simpler regex to remove the function if it exists:
    content = re.sub(r'public function messages?\(\)[\s\S]*?return\s+\[[\s\S]*?\];\s*\}', '', content)
    
    # Clean up empty lines left behind
    content = re.sub(r'\n\s*\n\s*\}', '\n}', content)
    
    # Insert new messages() before the last closing brace
    content = re.sub(r'\}(?=\s*$)', messages_str + "\n}\n", content)
    
    with open(filepath, 'w', encoding='utf-8') as f:
        f.write(content)
        
    print(f"Updated {filepath}")
    return True

for root, _, files in os.walk('app/Http/Requests'):
    for file in files:
        if file.endswith('Request.php'):
            process_file(os.path.join(root, file))

