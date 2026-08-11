<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image_url')->nullable();
            $table->integer('display_order')->default(0);
            $table->timestamps();
        });

        $now = now();
        $partners = [
            ['name' => 'CHAS', 'file' => 'chas.png'],
            ['name' => 'Constructionline', 'file' => 'constructionline.png'],
            ['name' => 'NICEIC', 'file' => 'niceic.png'],
            ['name' => 'Federation of Master Builders', 'file' => 'fmb.png'],
            ['name' => 'TrustMark', 'file' => 'trustmark.png'],
            ['name' => 'SafeContractor', 'file' => 'safecontractor.png'],
            ['name' => 'Gas Safe Register', 'file' => 'gassafe.png'],
            ['name' => 'NAPIT', 'file' => 'napit.png'],
            ['name' => 'RIBA', 'file' => 'riba.svg'],
            ['name' => 'ARB', 'file' => 'arb.png'],
            ['name' => 'SMAS Worksafe', 'file' => 'smas.svg'],
            ['name' => 'IWA', 'file' => 'iwa.png'],
            ['name' => 'HomePro', 'file' => 'homepro.svg'],
            ['name' => 'Freedom Homes Architects', 'file' => 'freedom-homes.svg'],
            ['name' => 'Extension Plans', 'file' => 'extension-plans.svg'],
            ['name' => 'Trusted Partner', 'file' => 'teal-house.svg'],
            ['name' => 'RAMs', 'file' => 'rams.svg'],
        ];

        foreach ($partners as $index => $partner) {
            DB::table('partners')->insert([
                'name' => $partner['name'],
                'image_url' => 'images/partners/' . $partner['file'],
                'display_order' => $index + 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partners');
    }
};
