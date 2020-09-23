<?php

namespace Tests\Feature;

use App\Models\Code;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CodeTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCodeIndex()
    {
        Code::factory()->count(20)->create();

        $response = $this->getJson('/api/codes');

        $response->assertStatus(200);

        $data = json_decode($response->content(), true);

        $this->assertArrayHasKey('data', $data);

        $this->assertArrayHasKey('meta', $data);

        $response->assertJsonPath('meta.total', 20);
    }

    public function testUpdateCode()
    {
        $code = Code::factory()->create();

        $response = $this->putJson(
            '/api/codes/' . $code->id,
            ['code' => 'DummyCode', 'remaining' => $code->remaining]
        );

        $response->assertStatus(200);

        $code->refresh();

        $this->assertEquals('DummyCode', $code->code);
    }

    public function testStoreCode()
    {
        $response = $this->postJson(
            '/api/codes',
            ['code' => 'TestCode', 'remaining' => 1200]
        );

        $response->assertStatus(201);

        $code = Code::firstWhere('code', 'TestCode');

        $this->assertDatabaseHas('codes', [
            'code' => 'TestCode',
        ]);
    }
}
