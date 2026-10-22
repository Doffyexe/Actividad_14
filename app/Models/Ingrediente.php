<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class Ingrediente extends Model
{
    protected $table = 'ingredientes';
 
    protected $fillable = [
        'nombre',
    ];
 

    public function recetas()
    {
        return $this->belongsToMany(
            Receta::class,
            'ingredientes_asociados',
            'ingrediente_id',
            'receta_id'
        )
        ->withPivot('cantidad', 'unidad')
        ->withTimestamps();
    }
 

    public function ingredientesAsociados()
    {
        return $this->hasMany(Ingrediente_asociado::class, 'ingrediente_id');
    }

}