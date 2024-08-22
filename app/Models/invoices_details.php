<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoices_details extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_invoice',
        'invoice_number',
        'product',
        'Section_id',
        'Status',
        'value_Status',
        'note',
        'payment_date',
        'user',
    ];

    public function section(){
        return $this->belongsTo('App\Models\section');
    }
}
