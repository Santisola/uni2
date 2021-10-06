<?php

namespace Tests\Unit;

use App\Http\Controllers\AlertasController;
use App\Models\Alerta;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;

class AlertaTest extends TestCase
{
    /**
     * Test that .
     *
     * @return void
     */
    public function test_alerta_returns_all_the_alertas()
    {
        $alertas = Alerta::all();

        $this->assertCount(2, $alertas);
        $this->assertInstanceOf(Collection::class, $alertas);
        $this->assertInstanceOf(Alerta::class, $alertas[0]);
        $this->assertEquals(1, $alertas[0]->id_alerta);
    }

    public function test_alerta_controller_returns_json_alerta()
    {
        $alertas = (new AlertasController)->ver(1);

        $this->assertJson($alertas);
    }
}
