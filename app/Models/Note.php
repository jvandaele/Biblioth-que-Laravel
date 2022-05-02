<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $note
 * @property string $commentaire
 * @property int $user_id
 *
 * @property-read User $user
 * @property-read Book $book
 */
class Note extends Model
{
    use HasFactory;

    public function setNote($value) { $this->attributes['note'] = $value; }
    public function setCommentaire($value) { $this->attributes['commentaire'] = $value; }
    public function setBookId($value) { $this->attributes['book_id'] = $value; }
    public function setUserId($value) { $this->attributes['user_id'] = $value; }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
}
