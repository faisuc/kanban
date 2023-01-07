<?php

namespace Tests\Unit\Models;

use App\Models\Board;
use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use LazilyRefreshDatabase;

    /** @test */
    public function it_can_have_many_boards()
    {
        $owner = User::factory()->create();
        $boards = Board::factory()
            ->count(3)
            ->for($owner, 'owner')
            ->create();
            
        $this->assertCount(3, $owner->boards);
    }
}
