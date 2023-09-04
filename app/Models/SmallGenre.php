<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmallGenre extends Model
{
    use HasFactory;

    public function note() {
        return $this->hasOne(Note::class);
    }
}
