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
        Schema::create('sales_operations', function (Blueprint $table) {
            $table->id();
            $table->date('date');
           // $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete(); /*one to many  */ 
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete(); /*one to many  */
            $table->json('quantity_sold');
            $table->bigInteger('total_price');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_operations');
    }
};
