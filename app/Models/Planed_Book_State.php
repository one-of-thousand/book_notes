<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Planed_Book_State extends Model
{
    use HasFactory;

    //テーブル名
    protected $table = 'planed_book_states';

    //可変項目
    protected $fillable = ['planed_book_state_name'];

    //リレーション
    public function planedBooks(): HasMany {
        return $this->hasMany(PlanedBook::class);
    }
}
