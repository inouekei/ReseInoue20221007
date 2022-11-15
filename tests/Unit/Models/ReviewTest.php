<?php

namespace Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Customer;
use App\Models\Restaurant;
use App\Models\Reservation;
use App\Models\Review;

class ReviewTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        for ($i = 0; $i < 5; $i++){
            User::factory()->create();
            Customer::factory()->create();
        }
        Restaurant::factory()->count(5)->create();
        Reservation::factory()->count(5)->create();
        Review::factory()->count(5)->create();

        $count = Review::get()->count();    
        $this->assertEquals(5, $count);

        $firstRecordId = Review::first()->id;
        $lastRecordId = Review::all()->last()->id;
        $review = Review::find(rand($firstRecordId, $lastRecordId));
        $reviewReservationId = $review->reservation_id;
        $reviewScore = $review->score;
        $reviewComment = $review->comment;
        $this->assertDatabaseHas('reviews',[
            'reservation_id' => $reviewReservationId,
            'score' => $reviewScore,
            'comment' => $reviewComment
        ]);
        $review->delete();
        $this->assertDatabaseMissing('reviews',[
            'reservation_id' => $reviewReservationId,
            'score' => $reviewScore,
            'comment' => $reviewComment
        ]);
    }
}
