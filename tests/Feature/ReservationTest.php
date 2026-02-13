<?php

namespace Tests\Feature;

use App\Models\Restaurant;
use App\Models\User;
use App\Models\Availability;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReservationTest extends TestCase
{
    use RefreshDatabase;

    public function test_client_can_make_reservation()
    {
        $user = User::factory()->create(['role' => 'client']);
        $restaurant = Restaurant::factory()->create();
        
        Availability::create([
            'restaurant_id' => $restaurant->id,
            'date' => now()->addDay()->format('Y-m-d'),
            'start_time' => '12:00',
            'end_time' => '14:00',
            'capacity' => 10,
        ]);

        $response = $this->actingAs($user)->post(route('reservations.store', $restaurant), [
            'date' => now()->addDay()->format('Y-m-d'),
            'time' => '12:30',
            'number_of_guests' => 2,
            'notes' => 'Test reservation',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('reservations', [
            'user_id' => $user->id,
            'restaurant_id' => $restaurant->id,
            'number_of_guests' => 2,
        ]);
    }
}
