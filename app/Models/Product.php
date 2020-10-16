<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    public $timestamps = true;

    protected $fillable = [
        'id',
        'product_name',
        'image',
        'description',
        'price',
        'promotion_price',
        'id_categorie',
        'id_brand',
        'status ',
    ];

    public function categorie(){
        return $this->belongsTo('App\Models\Categorie', 'id', 'id_categorie');
    }

    public function brand(){
        return $this->belongsTo('App\Models\Brand', 'id', 'id_brand');
    }
}
