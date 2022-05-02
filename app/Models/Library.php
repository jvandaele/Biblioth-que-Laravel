<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property int $user_id
 *
 * @property-read Book $book
 * @property-read User $user
 */
class Library extends Model
{
    use HasFactory;

    public function setName($value) { $this->attributes['name'] = $value; }
    public function setUserId($value) { $this->attributes['user_id'] = $value; }

    public function books()
    {
        return $this->belongsToMany(Book::class, 'library_books', 'library_id', 'book_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'libraries_users', 'library_id', 'user_id');
    }
}
