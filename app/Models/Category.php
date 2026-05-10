<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories'; // GANTI sesuai nama tabel kamu

    protected $fillable = ['name', 'slug'];

    public function tours()
    {
        return $this->hasMany(Tour::class);
    }
}
