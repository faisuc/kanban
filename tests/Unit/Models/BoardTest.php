<?php

namespace Tests\Unit\Models;

use App\Models\Board;
use App\Models\Column;
use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class BoardTest extends TestCase
{
    use LazilyRefreshDatabase;

    /** @test */
    public function it_belongs_to_an_owner()
    {
        $owner = User::factory()->create();
        $boards = Board::factory()
            ->count(3)
            ->for($owner, 'owner')
            ->create();
        
        foreach ($boards as $board) {
            $this->assertTrue($board->owner->is($owner));
        }
    }

    /** @test */
    public function it_can_have_many_columns()
    {
        $board = Board::factory()
            ->has(Column::factory()->count(10))
            ->create();

        $this->assertCount(10, $board->columns);
    }
}
