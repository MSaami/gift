<?php

namespace Tests\Feature;

use App\Models\Code;
use App\Models\Winner;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WinnerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testWinnerIndex()
    {
        $this->createCodeWithWinner();

        $response = $this->getJson('/api/winners');

        $response->assertStatus(200);

        $data = json_decode($response->content(), true);

        $this->assertArrayHasKey('data', $data);

        $this->assertArrayHasKey('meta', $data);

        $response->assertJsonPath('meta.total', 400);
    }

    public function testWinnerIndexFilterByCode()
    {
        $codes = $this->createCodeWithWinner();

        $response = $this->getJson('/api/winners?code=' . $codes->first()->code);

        $response->assertStatus(200);

        $data = json_decode($response->content(), true);

        $this->assertArrayHasKey('data', $data);

        $this->assertArrayHasKey('meta', $data);

        $response->assertJsonPath('meta.total', 200);

    }

    private function createCodeWithWinner()
    {
        return Code::factory()->count(2)->create()->each(function ($code){
            Winner::factory()->count(200)->create([
                'code_id' => $code->id
            ]);
        });
    }
}
