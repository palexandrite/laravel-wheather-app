<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WheatherResponseTest extends TestCase
{
    /**
     * Test external api of the getting of wheather info.
     */
    public function test_external_api_return_info_about_wheather(): void
    {
        $response = $this->postJson('/api/ask-wheather', [
            'city' => 'London',
            'language' => 'ru',
            'measureSystem' => 'metric',
        ]);

        $response->assertStatus(200)->assertJsonStructure([
            'city',
            'temperature',
            'temperature.unit',
            'description',
            'wind.speed',
            'wind.direction',
            'pressure',
            'humidity'
        ]);
    }
}
