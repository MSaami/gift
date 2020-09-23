<?php

namespace Tests\Feature;

use App\Models\Code;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompetitionTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUserCanSendCode()
    {
        $code = Code::factory()->create();

        $response = $this->postJson('/api/competitions', [
            'code' => $code->code,
            'mobile' => '09121234567'
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('winners', [
            'mobile' => '09121234567',
            'code_id' => $code->id
        ]);
    }

    public function testSendUnprocessableEntityResponseWhenCodeDoesNotExists()
    {
        $response = $this->postJson('/api/competitions', [
            'code' => 'DummyCode',
            'mobile' => '09121234567'
        ]);

        $response->assertStatus(422);
    }

    public function testSendBadRequestResponseWhenCodeNotActive()
    {
        $code = Code::factory()->create([
            'is_active' => false
        ]);

        $response = $this->postJson('/api/competitions', [
            'code' => $code->code,
            'mobile' => '09121234567'
        ]);

        $response->assertStatus(400)
            ->assertJson([
                'errors' => [
                    'message' => 'Code Not Valid'
                ]
            ]);
    }

    public function testSendBadRequestResponseWhenCodeHasFinished()
    {
        $code = Code::factory()->create([
            'remaining' => 0
        ]);

        $response = $this->postJson('/api/competitions', [
            'code' => $code->code,
            'mobile' => '09121234567'
        ]);

        $response->assertStatus(400)
            ->assertJson([
                'errors' => [
                    'message' => 'Code Not Valid'
                ]
            ]);
    }

    public function testSendBadRequestResponseWhenUserAlreadyWonTheCode()
    {
        $code = Code::factory()->create();

        $this->postJson('/api/competitions', [
            'code' => $code->code,
            'mobile' => '09121234567'
        ]);

        $response = $this->postJson('/api/competitions', [
            'code' => $code->code,
            'mobile' => '09121234567'
        ]);

        $response->assertStatus(400)
            ->assertJson([
                'errors' => [
                    'message' => 'The code already win by you'
                ]
            ]);
    }

}
