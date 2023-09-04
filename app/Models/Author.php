<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Author extends Model
{
    use HasFactory;

    //可変項目
    protected $fillable = [
        'note_id',
        'author_name'
    ];

    public function notes() {
        return $this->belongsTo(Note::class);
    }
    
}


