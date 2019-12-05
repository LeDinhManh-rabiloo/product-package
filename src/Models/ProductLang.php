<?php

namespace Manhle\ProductPackage\Models;

use Illuminate\Database\Eloquent\Model;

class ProductLang extends Model
{
    protected $table = 'products_langs';
    protected $primary_key = 'id';
    protected $fillable = [
        'product_id', 'id_lang', 'name', 'meta_title', 'meta_description', 'description',
        'short_description', 'url_key', 'slug'
    ];
}
