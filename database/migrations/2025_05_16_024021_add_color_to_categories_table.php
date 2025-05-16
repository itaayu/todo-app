<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColorToCategoriesTable extends Migration
{
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            // nullable agar kategori lama tetap valid, default warna abu-abu
            $table->string('color')->nullable()->default('#9CA3AF'); // #9CA3AF = Tailwind gray-400
        });
    }

    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('color');
        });
    }
}
