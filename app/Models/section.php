<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class section extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_name',
        'description',
        'created_by'
    ];

    public function product(){
        return $this->hasMany('App\Models\products');
    }

    public function invoices(){
        return $this->hasMany('App\Models\invoices');
    }

    public function invoices_details(){
        return $this->hasMany('App\Models\invoices_details');
    }
    
}
