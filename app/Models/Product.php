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
        return $this->belongsTo('App\Models\Category','category_id')->select('id','category_name');
    }

    public function section()
    {
        return $this->belongsTo('App\Models\Section','section_id')->select('id','name');
    }

    public function attributes()
    {
        return $this->hasMany('App\Models\ProductsAttribute');
    }

    public function images()
    {
        return $this->hasMany('App\Models\ProductsImage');
    }

}
