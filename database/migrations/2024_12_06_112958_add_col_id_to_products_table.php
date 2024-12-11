<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('department_id')->nullable()->after('brand_id');
            $table->tinyInteger('is_prescription')->default(0)->after('department_id');
            $table->text('reference')->nullable()->after('details');
            $table->text('disclaimer')->nullable()->after('reference');
            $table->text('indication')->nullable()->after('disclaimer');
            $table->string('contains')->nullable()->after('details');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
};
