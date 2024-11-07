<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'name',
        'price',
        'size',
        'colour',
        'description',
        'category_id',
        'stock'
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

}
