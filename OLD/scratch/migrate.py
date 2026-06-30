import os
import re

migration_file = 'database/migrations/2026_06_17_161152_sync_live_database_data.php'
seeder_file = 'database/seeders/LiveSyncSeeder.php'

with open(seeder_file, 'r', encoding='utf-8') as f:
    seeder_content = f.read()

# Extract everything between public function run() { ... }
match = re.search(r'public function run\(\)\s*\{([\s\S]*?)\n    \}', seeder_content)
if not match:
    print("Could not find run() content")
    exit(1)

insert_logic = match.group(1).strip()

with open(migration_file, 'r', encoding='utf-8') as f:
    migration_content = f.read()

# Replace the empty up() method with the insert_logic
# Note: up() looks like:
#     public function up(): void
#     {
#         //
#     }

new_migration_content = re.sub(
    r'public function up\(\): void\s*\{\s*//\s*\}',
    f"public function up(): void\n    {{\n        {insert_logic}\n    }}",
    migration_content
)

# Replace the empty down() method with truncation logic just in case
new_migration_content = re.sub(
    r'public function down\(\): void\s*\{\s*//\s*\}',
    f"public function down(): void\n    {{\n        \\Illuminate\\Support\\Facades\\DB::table('projects')->truncate();\n        \\Illuminate\\Support\\Facades\\DB::table('site_contents')->truncate();\n    }}",
    new_migration_content
)

# Add DB facade import
new_migration_content = new_migration_content.replace('use Illuminate\\Support\\Facades\\Schema;', 'use Illuminate\\Support\\Facades\\Schema;\nuse Illuminate\\Support\\Facades\\DB;')

with open(migration_file, 'w', encoding='utf-8') as f:
    f.write(new_migration_content)

print("Migration updated!")
