<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Orders;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaction', function (Blueprint $table) {
            $table->id();
            $table->foreignIDFor(Orders::Class);
            $table->timestamps();
            $table->decimal('transaction_amount', 10, 2);
            $table->enum('transaction_info',['purchase', 'refund', 'transfer']);
            $table->enum('transaction_status'['pending', 'completed', 'failed']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction');
    }
};
