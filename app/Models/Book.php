<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * @property int $id
 * @property string $isbn
 * @property string $title
 * @property string $authors
 * @property string $editor
 * @property string $summary
 * @property int $category_id
 * @property int $owner_id
 *
 * @property-read Category $category
 * @property-read Library $library
 */
class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'isbn',
        'title',
        'authors',
        'editor',
        'summary',
        'category_id',
    ];

    protected $casts = [
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function libraries()
    {
        return $this->belongsToMany(Library::class, 'library_books', 'book_id', 'library_id');
    }

    public function setISBN($value) { $this->attributes['isbn'] = $value; }
    public function setTitle($value) { $this->attributes['title'] = $value; }
    public function setAuthors($value) { $this->attributes['authors'] = $value; }
    public function setEditor($value) { $this->attributes['editor'] = $value; }
    public function setSummary($value) { $this->attributes['summary'] = $value; }
    public function setCategoryId($value) { $this->attributes['category_id'] = $value; }
    public function setOwnerId($value) { $this->attributes['owner_id'] = $value; }
}
