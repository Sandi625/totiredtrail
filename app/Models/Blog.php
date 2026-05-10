<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory;

    protected $table = 'blogs'; // ⬅️ GANTI sesuai nama tabel kamu

    protected $fillable = [
        'title',
        'slug',
        'image',
        'description',
        'route_name',
        'status'
    ];

    public function days()
    {
        return $this->hasMany(BlogDay::class);
    }
}
