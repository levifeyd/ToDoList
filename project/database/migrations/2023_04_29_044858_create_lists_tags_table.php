<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lists_tags', function (Blueprint $table) {
            $table->foreignId('lists_id')->constrained('lists', 'id')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('tag_id')->constrained('tags', 'id')
                ->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lists_tags');
    }
};
