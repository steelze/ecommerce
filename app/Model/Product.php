<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{

    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $fillable = ['name', 'slug', 'category_id', 'sub_category_id', 'brand_id', 'price', 'qty', 'last_price', 'last_price', 'description', 'featured', 'images'];

    public function category()
    {
        return $this->belongsTo(new Category);
    }

    public function subCategory()
    {
        return $this->belongsTo(new SubCategory);
    }

    public function brand()
    {
        return $this->belongsTo(new Brand);
    }

    /**
     *
     * @param  string  $value
     * @return void
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords($value);
    }
    
    public function getPriceAttribute($value)
    {
        return number_format($value, 2, '.', ',');
    }
    
    public function getLastPriceAttribute($value)
    {
        if($value) return number_format($value, 2, '.', ',');
    }

    public function discount($product)
    {
        return round(1 - filter_var($product->last_price, FILTER_SANITIZE_NUMBER_INT) /filter_var($product->price, FILTER_SANITIZE_NUMBER_INT) ,2);
    }
}
