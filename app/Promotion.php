<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $fillable = [
        'code',
        'company_name',
        'company_description',
        'company_logo',
        'offer_name',
        'offer_description',
        'discount',
        'type_id',
    ];

    public function type()
    {
        return $this->belongsTo('App\PromotionType');
    }
}
