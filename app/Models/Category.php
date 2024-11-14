<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Class for product categories.

class Category extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'name',
        'description'
    ];
    public function products() {
        return $this->hasMany(Product::class);
    }
}
