<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'price',
        'id_category',
        'id_brand',
        'status',
        'sale',
        'company',
        'image',
        'detail',
        'id_user',
    ];
}
