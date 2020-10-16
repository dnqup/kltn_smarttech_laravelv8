<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orderdetail extends Model
{
    use HasFactory;

    protected $table = 'orderdetails';

    public $timestamps = true;

    protected $fillable = [
        'id',
        'id_product',
        'id_order',
        'quantity',
        'unit_price',
    ];
}
