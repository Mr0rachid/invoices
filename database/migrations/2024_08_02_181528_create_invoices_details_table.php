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
        Schema::create('invoices_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_invoice');
            $table->foreign('id_invoice')->references('id')->on('invoices')->onDelete('cascade');
            $table->string('invoice_number',50);
            $table->string('product',50);
            $table->unsignedBigInteger('Section_id');
            $table->foreign('Section_id')->references('id')->on('sections')->onDelete('cascade');
            $table->string('Status',50);
            $table->integer('value_Status',50);
            $table->text('note')->nullable();
            $table->date('payment_date')->nullable();
            $table->string('user',300);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices_details');
    }
};
