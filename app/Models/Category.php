<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['title', 'parent_id'];

    public function subcategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
    public function category_products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
    public function subcategory_products()
    {
        return $this->hasMany(Product::class, 'subcategory_id');
    }
}
