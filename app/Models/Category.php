<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /*sub-category*/
    public function subcategories()
    {
        return $this->hasMany('App\Models\Category', 'parent_id')->where('status', 1);
    }

    /*section id*/
    public function section()
    {
        return $this->belongsTo('App\Models\Section', 'section_id')->select('id', 'name');
    }

    /*parent category*/
    public function parentcategory()
    {
        return $this->belongsTo('App\Models\Category', 'parent_id')->select('id', 'category_name');
    }

    /*category details*/
    public static function catDetails($url)
    {
        $catDetails = Category::select('id', 'category_name', 'url')->with(['subcategories'=>
        function($query) { $query->select('id','parent_id')->where('status',1); } ])->where('url', $url)->first()->toArray();
        $catIds = array();
        $catIds[] = $catDetails['id'];
        foreach ($catDetails['subcategories'] as $key=>$subcat)
        {
            $catIds[] = $subcat['id'];
        }
        return array('catIds'=>$catIds,'catDetails'=>$catDetails);
    }
}
