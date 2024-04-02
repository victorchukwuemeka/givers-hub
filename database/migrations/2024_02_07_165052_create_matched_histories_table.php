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
        Schema::create('matched_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('upgrade_id');
            $table->unsignedBigInteger('sender_user_id');
            $table->unsignedBigInteger('receiver_user_id');
            $table->decimal('amount', 10, 2);
            $table->string('account_name')->nullable();
            $table->text('account_number')->nullable();
            $table->string('payment_method')->nullable();
            $table->date('penalty_date')->nullable();
            $table->date('payment_date')->nullable();
            $table->dateTime('approved_date')->nullable();
            $table->text('proof')->nullable();
            $table->string('txn_id')->unique()->nullable();
            $table->text('memo')->nullable();
            $table->string('status');
            $table->timestamps();

            $table->foreign('upgrade_id')->references('id')->on('upgrades')->onDelete('cascade');
            $table->foreign('sender_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('receiver_user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matched_histories');
    }
};
