<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->uuid("book_id")->unique();
            $table->date("start_loan_date");
            $table->date("end_loan_date");
            $table->timestamps();

            $table
                ->foreign("book_id")
                ->references("id")
                ->on("books")
                ->onDelete("CASCADE")
                ->onUpdate("CASCADE");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
