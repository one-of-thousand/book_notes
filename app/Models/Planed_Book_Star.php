<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Planed_Book_Star extends Model
{
    use HasFactory;

    //可変項目
    protected $fillable = ['planed_book_stars_num'];
    
    //リレーション
    public function planedBooks(): HasMany {
        return $this->hasMany(PlanedBook::class);
    }
}
