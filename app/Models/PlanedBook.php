<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlanedBook extends Model
{
    use HasFactory;

    //テーブル名
    protected $table = 'planed_books';

    //可変項目
    protected $fillable = [
        'planed_book_title',
        'planed_book_author',
        'planed_book_importance',
        'planed_book_state'
    ];

    //日付表示のフォーマット
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    //リレーション
    public function planedBookStar(): BelongsTo{
        return $this->belongsTo(Planed_Book_Star::class);
    }
    public function planedBookState(): BelongsTo{
        return $this->belongsTo(Planed_Book_State::class);
    }
}
