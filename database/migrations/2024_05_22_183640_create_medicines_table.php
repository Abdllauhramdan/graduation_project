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
        Schema::create('medicines', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('quantity');
            $table->string('company_name');
            $table->boolean('prescription_status')->default(false);
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();   /*we will see if we could link it with category_name */
            $table->date('production_date'); //->default(DB::raw('CURRENT_TIMESTAMP'))->change();
            $table->date('expiration_date'); //->default(now()->addYear())->change();
            $table->decimal('purchase_price', 8, 2); //->default(0.00)->change();
            $table->decimal('selling_price', 8, 2); //->default(0.00)->change();
            $table->string('med_image')->nullable();
            $table->json('alternative')->nullable();
            $table->string('description');
            $table->string('contraindications');
            $table->string('dose');
            $table->enum('medicine_shape', ['syrub', 'pills', 'injection', 'cream', 'drops', 'suppositories', 'others']);
            $table->bigInteger('max_quantity_allowed');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicines');
        // $table->date('production_date')->default(null)->change();
        // $table->date('expiration_date')->default(null)->change();
        // $table->decimal('purchase_price', 8, 2)->default(null)->change();
        // $table->decimal('selling_price', 8, 2)->default(null)->change();
    }
};
