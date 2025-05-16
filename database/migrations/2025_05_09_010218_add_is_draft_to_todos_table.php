<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('todos', function (Blueprint $table) {
            $table->boolean('is_draft')->default(false); // Default false berarti bukan draft
        });
    }

    public function down()
    {
        Schema::table('todos', function (Blueprint $table) {
            $table->dropColumn('is_draft');
        });
    }
};
