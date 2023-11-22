<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserTaxi;
use Illuminate\Support\Facades\DB;

class TaxiColorChangingService
{
    public static function canBuy(User $user, $priceChangeColor): ?string
    {
        if ($user->credit < $priceChangeColor) {
            return 'Not enough credit.';
        }

        return null;
    }

    public static function validateAndChange(User $user, UserTaxi $userTaxi)
    {
        return DB::transaction(function () use ($user, $userTaxi) {
            try {
                if ($userTaxi->trial_color) {
                    $validate = self::canBuy($user, 1000);
                    if ($validate !== null) {
                        return $validate;
                    }

                    UserService::decreaseCredits($user, 1000);
                } else {
                    $userTaxi->trial_color = 1;
                }

                $userTaxi->color = self::getNewColor($userTaxi->color);
                return $userTaxi->save();
            } catch (\Exception $e) {
                return false;
            }
        });
    }

    public static function getNewColor($color_id){

        $colorSequence = [1, 2, 3];
        $currentIndex = array_search($color_id, $colorSequence);
        $nextIndex = ($currentIndex + 1) % count($colorSequence);
        $nextColorId = $colorSequence[$nextIndex];

        return $nextColorId;
    }
}
