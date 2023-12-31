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
        'planed_book_state',
        'user_id'
    ];

    //日付表示のフォーマット
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    //リレーション
    public function user() {
        return $this->belongsTo(User::class);
    }
}
