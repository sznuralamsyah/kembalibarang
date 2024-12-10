<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Item extends Model
{
    /** @use HasFactory<\Database\Factories\LostItemsFactory> */
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'category_id',
        'item_name',
        'type',
        'main_picture',
        'second_picture',
        'third_picture',
        'lost_found_date',
    ];

    public $casts = ['lost_found_date' => 'datetime'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function closedCase(): HasOne
    {
        return $this->hasOne(ClosedCase::class);
    }
}
