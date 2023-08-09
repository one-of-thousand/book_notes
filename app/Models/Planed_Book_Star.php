<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planed_Book_Star extends Model
{
    use HasFactory;

    public function planed_book() {
        return $this->hasMany('App\Models\Planed_Book');
    }
}
