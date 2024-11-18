<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'product_images';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'product_id',
        // this will be the name of the image file located in the images directory
        'image_name'
    ];

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
