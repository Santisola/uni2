<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AlertaTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_alertas_returns_all_the_alertas()
    {
        $response = $this->get('/api/alertas');

        $response->assertStatus(200);
        $response->assertJsonCount(2);
        $this->assertEquals(1, $response[0]['id_alerta']);
    }

    public function test_ver_returns_one_alerta()
    {
        $response = $this->getJson('/api/alertas/1');

        $response->assertStatus(200);
        $response->assertJson(['id_alerta'=>1]);
        $this->assertEquals(1, $response['id_alerta']);
    }
}
