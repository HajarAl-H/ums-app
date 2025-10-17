<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('collaborations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();
            $table->foreignId('collaborator_id')->constrained('companies')->cascadeOnDelete();
            $table->foreignId('city_id')->constrained('cities')->cascadeOnDelete();
            $table->date('collaboration_date');
            $table->string('status')->default('active'); // active, pending, completed, canceled
            $table->timestamps();

            $table->index(['collaboration_date', 'city_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('collaborations');
    }
};
