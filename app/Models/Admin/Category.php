<?php

namespace App\Models\Admin;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $table="categories";
    protected $fillable=['name','image','description','status'];

    public function products(){
        return $this->hasMany(Product::class,'category_id','id');
    }
}
