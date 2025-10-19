<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
    $table->id();
    $table->string('name'); // اسم العميل (لو الطلب من زائر)
    $table->string('email');
    $table->foreignId('product_id')->nullable()->constrained()->onDelete('cascade');
    $table->foreignId('service_id')->nullable()->constrained()->onDelete('cascade');


    $table->foreignId('client_id')->nullable()->constrained()->onDelete('cascade'); // ربط بالعميل إذا مسجل
    $table->text('description')->nullable();
    $table->decimal('price', 10, 2)->default(0); // السعر
    $table->date('delivery_date')->nullable();   // تاريخ التسليم
    $table->string('status')->default('pending');
    $table->timestamps();
    });

    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
