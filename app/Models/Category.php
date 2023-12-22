<?php

namespace App\Models;

use GuzzleHttp\Psr7\Query;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Category extends Model
{
    use HasFactory;

       public function parentcategory(){
       return $this->HasOne('App\Models\Category','id','parent_id')->select('id','category_name','url')->where('status',1);
    }

    public function subCategories(){
        return $this->hasMany(Category::class, 'parent_id')->where('status',1);
    }

    public static function getCategories(){
        $getCategories = Category::with(['subCategories'=>function($Query){
            $Query->with('subCategories');
        }])->where('parent_id',0)->where('status',1)->get()->toArray();
        //dd($Categories );
        return $getCategories;
    }
}
