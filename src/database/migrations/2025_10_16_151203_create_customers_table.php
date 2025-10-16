<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('external_customer_id')->index();

            $table->boolean('fraudulent')->nullable();

            $table->unsignedBigInteger('bsn')->index();

            $table->string('iban', 18)->index();

            $table->string('first_name');
            $table->string('last_name');

            $table->date('date_of_birth');

            $table->string('phone_number');
            $table->string('street');
            $table->string('city');
            $table->string('postal_code');

            $table->json('products');

            $table->string('tag')->index();

            $table->ipAddress();

            $table->date('last_invoice_at')->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->timestamp('last_fraudulent_check_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
