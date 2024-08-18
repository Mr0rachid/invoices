<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class invoices extends Model
{
    use SoftDeletes;

    use HasFactory;

    protected $fillable = [
        'invoice-number',
        'invoice-date',
        'due_date',
        'product',
        'section_id',
        'amount_collection',
        'amount_commission',
        'discount',
        'rate-vat',
        'value-vat',
        'total',
        'status',
        'value-status',
        'note',
        'user'
    ];

    protected $dates = ['deleted_at'];

    public function section(){
        return $this->belongsTo('App\Models\section');
    }
}
