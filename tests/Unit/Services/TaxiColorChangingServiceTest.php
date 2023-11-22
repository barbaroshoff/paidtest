<?php

namespace Tests\Unit\Services;

use App\Models\User;
use App\Models\UserTaxi;
use App\Services\TaxiColorChangingService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class TaxiColorChangingServiceTest extends TestCase
{

    public function testInsufficientCredit()
    {
        $user = User::factory()->create(['credit' => 500]);
        $userTaxi = UserTaxi::factory()->create(['user_id' => $user->id, 'trial_color' => 1]);

        $result = TaxiColorChangingService::validateAndChange($user, $userTaxi);

        $this->assertEquals('Not enough credit.', $result);
    }

    public function testChangeColorSuccessfully()
    {
        $user = User::factory()->create(['credit' => 1500]);
        $userTaxi = UserTaxi::factory()->create(['user_id' => $user->id, 'color' => 1]);

        $result = TaxiColorChangingService::validateAndChange($user, $userTaxi);

        $this->assertTrue($result);
        $this->assertNotEquals(1, $userTaxi->color);
    }

    public function testChangeColorWithTrialColorAndEnoughCredit()
    {
        $user = User::factory()->create(['credit' => 2000]);
        $userTaxi = UserTaxi::factory()->create(['user_id' => $user->id, 'trial_color' => 1]);

        $oldColor = $userTaxi->color;

        $result = TaxiColorChangingService::validateAndChange($user, $userTaxi);

        $this->assertTrue($result);
        $this->assertEquals(1, $userTaxi->trial_color);
        $this->assertNotEquals($oldColor, $userTaxi->color);
    }
}
