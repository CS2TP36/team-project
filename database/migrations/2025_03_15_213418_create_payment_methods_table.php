<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('card_number');
            $table->string('card_name');
            $table->string('expiry_month');
            $table->string('expiry_year');
            $table->string('cvv');
            $table->boolean('is_default')->default(false);
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('payment_methods');
    }
};