<?php

namespace Tests\Unit\Models;

use App\Models\Card;
use App\Models\Column;
use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class CardTest extends TestCase
{
    use LazilyRefreshDatabase;

    /** @test */
    public function it_belongs_to_an_owner()
    {
        $owner = User::factory()->create();
        $cards = Card::factory()
            ->count(3)
            ->for($owner, 'owner')
            ->create();
        
        foreach ($cards as $card) {
            $this->assertTrue($card->owner->is($owner));
        }
    }

    /** @test */
    public function it_belongs_to_a_column()
    {
        $column = Column::factory()->create();
        $cards = Card::factory()
            ->count(6)
            ->for($column)
            ->create();

        foreach ($cards as $card) {
            $this->assertTrue($card->column->is($column));
        }
    }
}
