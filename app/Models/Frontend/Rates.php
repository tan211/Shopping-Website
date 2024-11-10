<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rates extends Model
{
    use HasFactory;

    protected $table = 'rates';

    protected $fillable = [
        'rate',
        'id_blog',
        'id_user',
    ];
}
