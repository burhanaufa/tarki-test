<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Category extends Model
{
    use SoftDeletes;
    protected $table = 'categories';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'category_name', 'image', 'parent','slug','category_view', 'is_home', 'is_menu', 'is_enable',  'created_by'
    ];
}
