<?php

namespace Tests\Unit\Models;

use App\Models\Board;
use App\Models\Card;
use App\Models\Column;
use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class ColumnTest extends TestCase
{
    use LazilyRefreshDatabase;

    /** @test */
    public function it_belongs_to_an_owner()
    {
        $user = User::factory()->create();
        $columns = Column::factory()
            ->count(3)
            ->for($user, 'owner')
            ->create();

        foreach ($columns as $column) {
            $this->assertTrue($column->owner->is($user));
        }
    }

    /** @test */
    public function it_belongs_to_a_board()
    {
        $board = Board::factory()->create();
        $columns = Column::factory()
            ->count(5)
            ->for($board)
            ->create();

        foreach ($columns as $column) {
            $this->assertTrue($column->board->is($board));
        }
    }

    /** @test */
    public function it_can_have_many_cards()
    {
        $column = Column::factory()->create();
        $cards = Card::factory()
            ->count(3)
            ->for($column)
            ->create();

        $this->assertCount(3, $column->cards);
    }
}
