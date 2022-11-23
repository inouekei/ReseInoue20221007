<?php

namespace Tests\Unit\Models;

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
     * A basic unit test example.
     *
     * @return void
     */
    public function testAcceptRegistrations()
    {
        for ($i = 0; $i < 5; $i++){
            User::factory()->create();
            Customer::factory()->create();
        }
        Restaurant::factory()->count(5)->create();
        Reservation::factory()->count(5)->create();
        $reviews = Review::factory()->count(5)->make();
        foreach($reviews as $review){
            repeat:
            try {
                $review->save();
            } catch (\Illuminate\Database\QueryException $e) {
                $review = Review::factory()->make();
                goto repeat;
            }
        }

        $count = Review::get()->count();    
        $this->assertEquals(5, $count);

        $firstRecordId = Review::first()->id;
        $lastRecordId = Review::all()->last()->id;
        do {
            $review = Review::find(rand($firstRecordId, $lastRecordId));
        }
        while ($review === null);
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

    public function testRejectRegistrations()
    {
        for ($i = 0; $i < 5; $i++){
            User::factory()->create();
            Customer::factory()->create();
        }
        Restaurant::factory()->count(5)->create();
        Reservation::factory()->count(5)->create();
        $reviews = Review::factory()->count(5)->make();
        foreach($reviews as $review){
            repeat:
            try {
                $review->save();
            } catch (\Illuminate\Database\QueryException $e) {
                $review = Review::factory()->make();
                goto repeat;
            }
        }

        $firstReviewId = Review::first()->id;
        $lastReviewId = Review::all()->last()->id;
        do {
            $review = Review::find(rand($firstReviewId, $lastReviewId));
        }
        while ($review === null);
        $lastReservationId = Reservation::all()->last()->id;

        $validData = [
            'reservation_id' => $review->reservation_id,
            'score' => $review->score,
            'comment' => $review->comment,
        ];
        $datas = [];
        array_push($datas, array_replace($validData, [
            'reservation_id' => null,
        ]));
        array_push($datas, array_replace($validData, [
            'reservation_id' => $lastReservationId + 1,
        ]));
        array_push($datas, array_replace($validData, [
            'score' => null,
        ]));
        array_push($datas, array_replace($validData, [
            'score' => -1,
        ]));
        array_push($datas, array_replace($validData, [
            'score' => 300,
        ]));
        array_push($datas, array_replace($validData, [
            'comment' => "12345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890"
        ]));
        
        foreach ($datas as $data) {
                try{
                $review->fill($data)->update();
            }catch(\Exception $e){
            }
            $this->assertDatabaseMissing('reviews',$data);
        }
    }
}
