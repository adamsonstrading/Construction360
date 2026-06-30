import os

seeder_file = 'database/seeders/LiveSyncSeeder.php'
migration_file = 'database/migrations/2026_06_17_161152_sync_live_database_data.php'

with open(seeder_file, 'r', encoding='utf-8') as f:
    seeder_content = f.read()

# Extract content of run method
start_idx = seeder_content.find('public function run()')
start_idx = seeder_content.find('{', start_idx) + 1
end_idx = seeder_content.rfind('}')
end_idx = seeder_content.rfind('}', 0, end_idx)

insert_logic = seeder_content[start_idx:end_idx]

migration_template = f"""<?php

use Illuminate\\Database\\Migrations\\Migration;
use Illuminate\\Database\\Schema\\Blueprint;
use Illuminate\\Support\\Facades\\Schema;
use Illuminate\\Support\\Facades\\DB;

return new class extends Migration
{{
    /**
     * Run the migrations.
     */
    public function up(): void
    {{
        {insert_logic}
    }}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {{
        DB::table('projects')->truncate();
        DB::table('site_contents')->truncate();
    }}
}};
"""

with open(migration_file, 'w', encoding='utf-8') as f:
    f.write(migration_template)

print("Migration successfully rewritten!")
