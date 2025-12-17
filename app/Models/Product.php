<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'photo',
        'description',
    ];

    /**
     * Get the records for the product.
     */
    public function records()
    {
        return $this->hasMany(Record::class, 'id_products');
    }
}
