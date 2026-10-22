<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class Receta extends Model
{
    protected $table = 'recetas';
 
    protected $fillable = [
        'titulo',
        'numero_porciones',
        'instrucciones',
    ];
 
    protected $casts = [
        'numero_porciones' => 'integer',
    ];
 

    public function ingredientes()
    {
        return $this->belongsToMany(
            Ingrediente::class,
            'ingredientes_asociados',
            'receta_id',
            'ingrediente_id'
        )
        ->withPivot('cantidad', 'unidad')
        ->withTimestamps();
    }

    public function ingredientesAsociados()
    {
        return $this->hasMany(Ingrediente_asociado::class, 'receta_id');
    }
 
   
    public function agregarIngrediente(Ingrediente $ingrediente, float $cantidad, string $unidad): void
    {
        $this->ingredientes()->attach($ingrediente->id, [
            'cantidad' => $cantidad,
            'unidad'   => $unidad,
        ]);
    }
}