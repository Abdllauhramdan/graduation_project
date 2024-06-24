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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('emp_first_name'); 
            $table->string('emp_last_name'); 
            $table->string('email');
            $table->string('password');
            $table->date('birth_date');
            $table->string('phone');
            $table->string('address');
            $table->enum('employee_gender', ['male', 'fmale',]);
            $table->boolean('is_employee')->default(false);
            $table->string('job_title');
            $table->decimal('salary');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
