<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("loans", function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->uuid("book_id");
            $table->date("loan_date");
            $table->date("return_date")->nullable();
            $table
                ->foreign("book_id")
                ->references("id")
                ->on("books")
                ->onUpdate("CASCADE")
                ->onDelete("CASCADE");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("loans");
    }
};
