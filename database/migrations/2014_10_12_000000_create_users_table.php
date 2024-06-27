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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('pharma_name'); 
            $table->string('pharmacist_name');
            $table->string('email')->unique();;
            $table->timestamp('email_verified_at')->nullable(); 
            $table->string('password');
            $table->date('license_date');
            $table->string('license_number')->unique();
            $table->string('phone');
            $table->string('address');
            $table->enum('pharmacist_gender', ['male', 'female']);
            $table->boolean('is_band')->default(false);
            $table->string('role_name')->default('client')->change();
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
