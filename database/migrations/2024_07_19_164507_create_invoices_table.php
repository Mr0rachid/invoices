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
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('invoice-number');
            $table->date('invoice-date');
            $table->string('product');
            $table->string('section');
            $table->string('discount');
            $table->string('rate-vat');
            $table->decimal('value-vat',8,2);
            $table->decimal('total',8,2);
            $table->string('status',50);
            $table->integer('value-status');
            $table->text('note');
            $table->string('user');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
