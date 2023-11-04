<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up() : void
    {
        Schema::create('forfeits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('book_id');
            $table->foreignId('booking_id');
            $table->integer('cost');
            $table->string('status');
            $table->string('pay_image')->nullable();
            $table->timestamp('pay_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() : void
    {
        Schema::dropIfExists('forfeits');
    }
};
