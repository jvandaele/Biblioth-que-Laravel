<?php

use App\Models\Book;
use App\Models\Library;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibrariesBooks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('library_books', function (Blueprint $table) {
            $table->id();
            $table->string('library_id');
            $table->foreign('library_id')
                ->references('id')
                ->on('libraries');
            $table->string('book_id');
            $table->foreign('book_id')
                ->references('id')
                ->on('books');
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
        Schema::dropIfExists('library_books');
    }
}
