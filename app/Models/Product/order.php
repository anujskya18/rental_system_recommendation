<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;

    protected $table="orders";
    protected $fillable=[
        "name",
        "last_name",
        "address",
        "email",
        "price",
        "phone_number",
        "user_id",
        "order_notes",
        "status",
        // "code",

    ];

    // public $timestamps =true;
}
