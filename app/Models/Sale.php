<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $fillable = [
        'date', 'name', 'identification', 'email', 'quantity', 'service_id'
    ];

    public function service(){
        return $this->belongsTo(Service::class);
    }

    public function salesUsers() {
        return $this->belongsToMany(User::class, 'sale_user')
            ->withPivot('total')
            ->withPivot('description')
            ->withPivot('sale_id')
            ->withPivot('user_id')
            ->withTimestamps();
    }

}
