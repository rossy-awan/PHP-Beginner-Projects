<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->date('deadline');
            $table->string('team');
            $table->integer('progress')->default(0);
            $table->enum('priority', ['Low', 'Medium', 'High', 'Urgent'])->default('Low');
            $table->enum('status', ['Planned', 'On Going', 'Done', 'Delayed', 'Canceled'])->default('Planned');
            $table->decimal('cost', 15, 2)->default(0);
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
