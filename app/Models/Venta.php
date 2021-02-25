<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    public $table = 'ventas';

    protected $fillable = [
        'fecha', 'nombre', 'identificacion', 'correo', 'cantidad', 'servicio', 'zona', 'pdf', 'user_id',
    ];

    public function users(){
        return $this->belongsTo(User::class);
    }

}
