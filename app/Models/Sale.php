<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $fillable = [
        'date', 'name', 'identification', 'email', 'amount', 'service', 'zone', 'user_id',
    ];

    public function users(){
        return $this->belongsTo(User::class);
    }

}
