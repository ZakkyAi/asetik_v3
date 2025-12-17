<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Repair extends Model
{
    protected $primaryKey = 'id_repair';
    
    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'id_record',
        'note',
        'created_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    /**
     * Get the user that owns the repair.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    /**
     * Get the record that owns the repair.
     */
    public function record()
    {
        return $this->belongsTo(Record::class, 'id_record', 'id_records');
    }
}
