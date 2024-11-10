<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;

    protected $fillable = [
        'cmt',
        'id_blog',
        'id_user',
        'level',
        'avatar',
        'name',
    ];
}
