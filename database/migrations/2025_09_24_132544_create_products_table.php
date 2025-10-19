<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');              // اسم الخدمة/المنتج
            $table->string('image')->nullable(); // صورة
            $table->text('description');
            $table->decimal('price', 10, 2)->default(0);
            $table->json('technologies')->nullable(); // تقنيات مستخدمة (اختياري)
            $table->text('results')->nullable();      // نتائج (اختياري)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
