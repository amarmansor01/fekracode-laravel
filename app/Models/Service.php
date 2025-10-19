<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class Service extends Model
{
    protected $fillable = ['name','price','description','image'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}

