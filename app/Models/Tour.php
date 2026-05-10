<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;

    protected $table = 'tours'; // ⬅️ Ganti sesuai nama tabel

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'thumbnail',
        'images',
        'price',
        'description',
        'route_name', // ⬅️ tambahkan ini
        'status'
    ];

    protected $casts = [
        'images' => 'array',
        'status' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function days()
    {
        return $this->hasMany(TourDay::class)->orderBy('order');
    }
}
