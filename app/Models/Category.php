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
        $catDetails = Category::select('id', 'parent_id', 'category_name', 'url', 'description')->with(['subcategories' =>
            function ($query) {
                $query->select('id', 'parent_id', 'category_name', 'url', 'description')->where('status', 1);
            }])->where('url', $url)->first()->toArray();
        if ($catDetails['parent_id'] == 0) {
            $breadcrumbs = '<a href="' . url($catDetails['url']) . '">' . $catDetails['category_name'] . '</a>';
        } else {
            $parentCategory = Category::select('category_name', 'url')->where('id', $catDetails['parent_id'])->first();
            $breadcrumbs = '<a href="' . url($parentCategory['url']) . '">' . $parentCategory['category_name'] . '</a>
            <span class="divider">/</span>
            <a href="' . url($catDetails['url']) . '">' . $catDetails['category_name'] . '</a>';
        }
        $catIds = array();
        $catIds[] = $catDetails['id'];
        foreach ($catDetails['subcategories'] as $key => $subcat) {
            $catIds[] = $subcat['id'];
        }
        return array('catIds' => $catIds, 'catDetails' => $catDetails, 'breadcrumbs' => $breadcrumbs);
    }
}
