<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;



class SalesInvoice extends Model
{
    use HasFactory;

    protected $fillable = ['customer_name', 'address'];

    public function getCreatedAtFormattedAttribute()
    {
        return date('d-M-Y', strtotime(($this->created_at)));
    }

    protected $appends = ['created_at_formatted'];

    public function lineItems(): HasMany
    {
        return $this->hasMany(LineItem::class,'customer_id','id');
    }
}
