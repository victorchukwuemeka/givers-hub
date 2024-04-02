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
        Schema::create('activations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->text('txn_id')->nullable();
            $table->decimal('amount', 10, 2)->nullable()->default(0);
            $table->string('payment_method')->nullable();
            $table->string('account_name')->nullable();
            $table->string('account_number')->nullable();
            $table->dateTime('date_paid')->nullable();
            $table->dateTime('panelty_date')->nullable();
            $table->text('comment')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activations');
    }
};
