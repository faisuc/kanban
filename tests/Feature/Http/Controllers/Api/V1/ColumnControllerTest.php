<?php

namespace Tests\Feature\Http\Controllers\Api\V1;

use App\Models\Board;
use App\Models\Column;
use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ColumnControllerTest extends TestCase
{
    use LazilyRefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function it_can_create_a_new_board_column()
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $board = Board::factory()->create();

        $this->assertCount(0, $board->columns);

        $this->postJson("api/v1/columns", ['board_id' => $board->id, 'title' => 'New Column'], ['Accept' => 'application/json'])
            ->assertCreated();

        $this->assertCount(1, $board->fresh()->columns);
    }

    /** @test */
    public function it_can_update_a_column()
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $column = Column::factory()->create(['title' => 'New Column']);

        $this->patchJson("api/v1/columns/{$column->id}", ['title' => 'Updated New Column'])
            ->assertJson(function (AssertableJson $json) {
                $json->first(function ($json) {
                    $json->where('title', 'Updated New Column')
                        ->etc();
                })
                ->etc();
            })
            ->assertOk();
    }

    /** @test */
    public function it_can_delete_a_column()
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $column = Column::factory()->create();

        $this->deleteJson("api/v1/columns/{$column->id}")
            ->assertOk();

        $this->assertFalse($column->exists());
    }
}
