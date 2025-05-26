<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'unit',
    ];

    public function priceEntries()
    {
        return $this->hasMany(PriceEntry::class);
    }
}
