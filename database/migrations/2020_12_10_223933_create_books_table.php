<?php

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('isbn', 32)->unique();
            $table->string('title', 256);
            $table->string('authors', 1024);
            $table->string('editor', 1024);
            $table->text('summary');
            $table->foreignIdFor(Category::class, 'category_id');
            $table->foreignIdFor(User::class, 'owner_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('books');
    }
}
