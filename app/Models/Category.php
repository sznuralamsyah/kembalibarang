<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;

    protected $fillable = [
        'id',
        'category_name',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }
}
