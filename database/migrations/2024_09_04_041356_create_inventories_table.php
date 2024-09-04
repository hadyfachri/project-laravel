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
        Schema::create('inventories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('supplier_id');
            $table->uuid('product_id');
            $table->integer('quantity');
            $table->decimal('cost_price');
            $table->date('recieved_date');

            $table->timestamps();

            $table->foreign('supplier_id')
                ->references('id')
                ->on('suppliers')
                ->onDelete('Cascade')
                ->onUpdate('Cascade');
            
            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('Cascade')
                ->onUpdate('Cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
