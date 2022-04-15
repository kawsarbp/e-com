<?php

namespace App\Models;

use Database\Seeders\ProductsImagesTableSeeder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function section()
    {
        return $this->belongsTo('App\Models\Section', 'section_id');
    }

    public function attributes()
    {
        return $this->hasMany('App\Models\ProductsAttribute');
    }

    public function images()
    {
        return $this->hasMany('App\Models\ProductsImage');
    }

    public function brand()
    {
        return $this->belongsTo('App\Models\Brand', 'brand_id')->select('id', 'name', 'status');
    }

    public static function productFilters()
    {
        $productFilters['fabricArray'] = array('Cotton', 'Polyester', 'Wool', 'Pure Cotton');
        $productFilters['sleeveArray'] = array('Full Sleeve', 'Half Sleeve', 'Short Sleeve', 'Sleeveless');
        $productFilters['patternArray'] = array('Checked', 'Plain', 'Printed', 'Self', 'Solid');
        $productFilters['fitArray'] = array('Regular', 'Slim');
        $productFilters['occasionArray'] = array('Casual', 'Formal');
        return $productFilters;
    }

    /*discount*/
    public static function getDiscountedPrice($product_id)
    {
        $proDetails = Product::select('product_price', 'product_discount', 'category_id')->where('id', $product_id)->first();
        $catDetails = Category::select('category_discount')->where('id', $proDetails['category_id'])->first();
        if ($proDetails['product_discount']) {
            /*product discount*/
            $discounted_price = $proDetails['product_price'] - ($proDetails['product_price']*$proDetails['product_discount']/100);
        } elseif ($catDetails['category_discount']) {
            $discounted_price = $proDetails['product_price'] - ($proDetails['product_price']*$catDetails['category_discount']/100);
        } else {
            $discounted_price = 0;
        }
        return $discounted_price;

    }
}
