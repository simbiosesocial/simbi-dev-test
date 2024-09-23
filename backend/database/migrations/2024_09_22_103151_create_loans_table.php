<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('book_id');
           // $table->uuid('user_id'); Se Houver User
            $table->date('loan_date');
            $table->date('return_date')->nullable(); 
            $table->timestamps();

            
            $table
                ->foreign("book_id")
                ->references("id")
                ->on("books")
                ->onDelete("CASCADE")
                ->onUpdate("CASCADE");
            //$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Se você tiver uma tabela de usuários
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loans');
    }
}
