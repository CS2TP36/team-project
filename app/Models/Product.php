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
        'colour',
        'description',
        'mens',
        'category_id',
        'stock'
    ];

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function reviews(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function images(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    // A function which returns all the image paths for the current product as assets (put straight into href)
    public function getImagePaths(): array {
        // Gets the current product id
        $pid = $this->getAttribute('id');
        /*
         *  Gets all productImage objects relating to product
         * (should have probably just used \App\Models\Product::images)
        */
        $productImages = ProductImage::all()->where('product_id', $pid);
        // Put all the image names in a new array
        $imageNames = [];
        foreach ($productImages as $image) {
            $imageNames[] = $image->getAttribute('image_name');
        }
        // Generate a new array of paths to each image
        $imageLinks = [];
        foreach ($imageNames as $imageName) {
            $imageLinks[] = "images/productImage/" . $imageName;
        }
        // Return the images so they can be used by the individual product page (could also be used by the products page with a [0] but that seems inefficient.)
        return $imageLinks;
    }

    // A function which returns the first image
    public function getMainImage(): string {
        try {
            return $this->getImagePaths()[0];
        } catch (\Exception $e) {
            // if there aren't any images or something breaks just don't return one
            return '';
        }
    }
}
