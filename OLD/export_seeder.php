<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

$tables = ['projects', 'teams', 'site_contents'];

$seederContent = "<?php\n\nnamespace Database\Seeders;\n\nuse Illuminate\Database\Seeder;\nuse Illuminate\Support\Facades\DB;\n\nclass LiveSyncSeeder extends Seeder\n{\n    public function run()\n    {\n";

foreach ($tables as $table) {
    if (!DB::getSchemaBuilder()->hasTable($table)) {
        continue;
    }
    
    $rows = DB::table($table)->get();
    if ($rows->isEmpty()) {
        continue;
    }
    
    $seederContent .= "        DB::table('$table')->truncate();\n\n";
    $seederContent .= "        \$data = [\n";
    
    foreach ($rows as $row) {
        $seederContent .= "            [\n";
        foreach ((array) $row as $key => $value) {
            if ($value === null) {
                $seederContent .= "                '$key' => null,\n";
            } else {
                $escaped = addcslashes($value, "'\\");
                $seederContent .= "                '$key' => '$escaped',\n";
            }
        }
        $seederContent .= "            ],\n";
    }
    $seederContent .= "        ];\n\n";
    $seederContent .= "        DB::table('$table')->insert(\$data);\n\n";
}

$seederContent .= "    }\n}\n";

file_put_contents(__DIR__.'/database/seeders/LiveSyncSeeder.php', $seederContent);
echo "Seeder generated at database/seeders/LiveSyncSeeder.php\n";
