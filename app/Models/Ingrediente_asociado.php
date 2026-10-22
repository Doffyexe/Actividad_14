<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 

class Ingrediente_asociado extends Model
{
    protected $table = 'ingredientes_asociados';
 
    protected $fillable = [
        'receta_id',
        'ingrediente_id',
        'cantidad',
        'unidad',
    ];
 
    protected $casts = [
        'cantidad' => 'decimal:2',
    ];
 
    public function receta()
    {
        return $this->belongsTo(Receta::class, 'receta_id');
    }
 
    public function ingrediente()
    {
        return $this->belongsTo(Ingrediente::class, 'ingrediente_id');
    }
}