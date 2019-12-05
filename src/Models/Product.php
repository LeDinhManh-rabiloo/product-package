<?php

namespace Manhle\ProductPackage\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;

class Product extends Model implements HasMedia
{
    use HasMediaTrait;

    protected $table = 'products';
    protected $primary_key = 'id';
    protected $fillable = [
        'cate_product_id', 'isNew',
        'publish_date', 'qty', 'price', 'active'
    ];

    public function category()
    {
        return $this->belongsToMany(Category::class, 'category_has_products', 'product_id', 'category_id');
    }

    public function sale()
    {
        return $this->belongsToMany(Sale::class, 'product_has_sales', 'product_id', 'sale_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }

    public function productLang()
    {
        return $this->belongsToMany(Lang::class, 'products_langs', 'product_id', 'id_lang');
    }

    public function productInfor()
    {
        return $this->hasMany(ProductLang::class, 'product_id', 'id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'product_id', 'id');
    }
}
