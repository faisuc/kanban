<?php

namespace Tests\Feature\Http\Controllers\Api\V1;

use App\Models\Board;
use App\Models\Card;
use App\Models\Column;
use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class BoardControllerTest extends TestCase
{
    use LazilyRefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function it_will_return_the_current_logged_in_user_created_boards()
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $boards = Board::factory()
            ->count(10)
            ->for($user, 'owner')
            ->create();

        $this->getJson("api/v1/user/{$user->id}/boards", ['Accept' => 'application/json'])
            ->assertJsonCount(10, 'data')
            ->assertOk();
    }

    /** @test */
    public function it_can_create_a_new_user_board()
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $this->assertCount(0, $user->boards);

        $this->postJson("api/v1/boards", [
            'title' => 'New Board',
        ], ['Accept' => 'application/json'])
            ->assertCreated();

        $this->assertCount(1, $user->fresh()->boards);
    }

    /** @test */
    public function it_can_show_a_single_user_board_details_and_columns()
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $board = $user->boards()->create(['title' => 'Test Board']);
        $columns = Column::factory()
            ->count(20)
            ->for($board)
            ->has(Card::factory()->count(3))
            ->create();

        $this->getJson("api/v1/boards/{$board->id}")
            ->assertOk();
    }

    /** @test */
    public function it_can_update_a_user_board()
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $board = $user->boards()->create(['title' => 'New Board']);

        $this->patchJson("api/v1/boards/{$board->id}", ['title' => 'Updated New Board'])
            ->assertJson(function (AssertableJson $json) {
                $json->first(function ($json) {
                    $json->where('title', 'Updated New Board')
                        ->etc();
                })
                ->etc();
            })
            ->assertOk();
    }

    /** @test */
    public function it_can_delete_a_user_board()
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $board = $user->boards()->create(['title' => 'New Board']);

        $this->deleteJson("api/v1/boards/{$board->id}")
            ->assertOk();

        $this->assertFalse($board->exists());
    }
}
