<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Characteristic extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'value',
        'product_id',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
