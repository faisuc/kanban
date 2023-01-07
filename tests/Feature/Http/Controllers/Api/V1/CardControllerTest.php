<?php

namespace Tests\Feature\Http\Controllers\Api\V1;

use App\Models\Card;
use App\Models\Column;
use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CardControllerTest extends TestCase
{
    use LazilyRefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function it_can_create_a_new_card()
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $column = Column::factory()->create();

        $this->assertDatabaseEmpty('cards');

        $this->postJson("api/v1/cards",
            ['column_id' => $column->id, 'title' => 'New Card', 'description' => 'New Card Description'],
            ['Accept' => 'application/json']
        )->assertCreated();

        $this->assertDatabaseCount('cards', 1);
    }

    /** @test */
    public function it_can_update_a_card()
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $card = Card::factory()->create(['title' => 'New Card', 'description' => 'New Card Description']);

        $this->patchJson("api/v1/cards/{$card->id}", ['title' => 'Updated New Card', 'description' => 'Updated New Card Description'])
            ->assertJson(function (AssertableJson $json) {
                $json->first(function ($json) {
                    $json->where('title', 'Updated New Card')
                        ->where('description', 'Updated New Card Description')
                        ->etc();
                })
                ->etc();
            })
            ->assertOk();
    }

    /** @test */
    public function it_can_delete_a_card()
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $card = Card::factory()->create();

        $this->deleteJson("api/v1/cards/{$card->id}")
            ->assertOk();

        $this->assertFalse($card->exists());
    }
}
