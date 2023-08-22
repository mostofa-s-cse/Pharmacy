<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id','subtotal','discount','total','paid_by',
        'amount_paid','due_return'
    ];
}
