<?php 

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('profesionales', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('lastname');
            $table->string('profesion');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->foreignId('country_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('state_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('city_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('address')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('documents')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profesionales');
    }
};
