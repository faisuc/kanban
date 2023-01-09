<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Card;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CardFilterControllerTest extends TestCase
{
    use LazilyRefreshDatabase;

    /** @test */
    public function it_will_return_an_unauthorized_request_if_the_access_token_is_invalid()
    {
        $this->getJson('api/list-cards?access_token=12345')
            ->assertUnauthorized();
    }

    /** @test */
    public function it_can_filter_by_date()
    {
        $cards = Card::factory()
            ->count(10)
            ->create(['created_at' => '2023-01-01']);

        $anotherCards = Card::factory()
            ->count(3)
            ->create();

        $this->getJson('api/list-cards?access_token=' . config('app.access_token') . '&date=2023-01-01')
            ->assertJsonCount(10, 'data');
    }

    /** @test */
    public function it_can_filter_by_status()
    {
        $cards = Card::factory()
            ->count(16)
            ->create();

        $cards->each(function ($card) {
            $card->delete();
        });

        $this->getJson('api/list-cards?access_token=' . config('app.access_token') . '&status=1')
            ->assertJsonCount(0, 'data');
        
        $this->getJson('api/list-cards?access_token=' . config('app.access_token') . '&status=0')
            ->assertJsonCount(16, 'data');

        $cards->each(function ($card) {
            $card->restore();
        });

        $this->getJson('api/list-cards?access_token=' . config('app.access_token') . '&status=1')
            ->assertJsonCount(16, 'data');
    }
}
