<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $table = "products";
    protected $fillable = ["name","title","subTitle","SKU","price","discount","quantity","images","category_id","category_name","admin_id","thumbnail"];
}
