<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $primaryKey = 'id_records';
    
    public $timestamps = false;

    protected $fillable = [
        'id_users',
        'id_products',
        'status',
        'no_serial',
        'no_inventaris',
        'note_record',
        'record_time',
    ];

    protected $casts = [
        'record_time' => 'datetime',
    ];

    /**
     * Get the user that owns the record.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_users');
    }

    /**
     * Get the product that owns the record.
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'id_products');
    }

    /**
     * Get the repairs for the record.
     */
    public function repairs()
    {
        return $this->hasMany(Repair::class, 'id_record', 'id_records');
    }
}
