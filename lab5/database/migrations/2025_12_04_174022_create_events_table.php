<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id(); // Id (автоматски)
            $table->string('name'); // Име на настанот
            $table->text('description'); // Краток опис (мин 20 карактери)
            $table->string('type'); // Тип на настан (семинар, работилница...)
            $table->date('date'); // Датум (не смее да е во минатото)
            $table->foreignId('organizer_id') // Организатор
            ->constrained('organizers')
                ->onDelete('cascade'); // ако се избрише организаторот, бриши ги настаните

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
