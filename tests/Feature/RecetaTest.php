<?php

namespace Tests\Feature;

use App\Models\Ingrediente;
use App\Models\Receta;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RecetaTest extends TestCase
{
    use RefreshDatabase;


    public function test_se_puede_instanciar_una_receta(): void
    {
    
        $receta = new Receta();
        $receta->titulo = 'Gallo pinto';
        $receta->numero_porciones = 4;
        $receta->instrucciones = 'Sofreír la cebolla y mezclar con el arroz y los frijoles.';
        $receta->save();

     
        $arroz = Ingrediente::create(['nombre' => 'Arroz']);
        $frijoles = Ingrediente::create(['nombre' => 'Frijoles']);

       
        $receta->agregarIngrediente($arroz, 2, 'tazas');
        $receta->agregarIngrediente($frijoles, 1.5, 'tazas');

     
        $this->assertInstanceOf(Receta::class, $receta);
        $this->assertEquals('Gallo pinto', $receta->titulo);
        $this->assertCount(2, $receta->ingredientes);

        $this->assertDatabaseHas('recetas', [
            'titulo' => 'Gallo pinto',
            'numero_porciones' => 4,
        ]);

        $this->assertDatabaseHas('ingredientes_asociados', [
            'receta_id' => $receta->id,
            'ingrediente_id' => $arroz->id,
            'cantidad' => 2,
            'unidad' => 'tazas',
        ]);
    }
}