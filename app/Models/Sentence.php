<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sentence extends Model
{
    use HasFactory;

    //可変項目
    protected $fillable = [
        'note_id',
        'user_id',
        'sentence_page',
        'sentence_body',
        'sentence_memo',
        'tag_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function note() {
        return $this->belongsTo(Note::class);
    }

    public function tag() {
        return $this->belongsTo(Tag::class);
    }
}
