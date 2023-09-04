<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    //可変項目
    protected $fillable = [
        'user_id',
        'note_title',
        'note_start_reading',
        'note_end_reading',
        'note_memo',
        'note_publisher',
        'big_genre_id',
        'small_genre_id',
        'note_score',
        'note_outline',
        'note_impression'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function authors() {
        return $this->hasMany(Author::class);
    }

    public function sentences() {
        return $this->hasMany(Sentence::class);
    }

    public function bigGenre() {
        return $this->belongsTo(BigGenre::class);
    }

    public function smallGenre() {
        return $this->belongsTo(SmallGenre::class);
    }
}
