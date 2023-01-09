<?php

namespace Tests\Feature\Http\Controllers\Api\V1;

use App\Models\Card;
use App\Models\Column;
use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class MoveCardControllerTest extends TestCase
{
    use LazilyRefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function it_can_move_a_card()
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);
        
        $firstColumn = Column::factory()->create();
        $secondColumn = Column::factory()->create();

        $card = Card::factory()->for($firstColumn)->create();

        $this->assertEquals($firstColumn->id, $card->column_id);

        $this->patchJson("api/v1/cards/{$card->id}/move" , ['column_id' => $secondColumn->id, 'position' => 2])
            ->assertOk();

        $this->assertEquals($secondColumn->id, $card->fresh()->column_id);
    }
}
