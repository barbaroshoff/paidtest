<?php

namespace App\Repository;

use App\Contracts\UserTaxiRepositoryInterface;
use App\Models\UserTaxi;
use Illuminate\Cache\Repository;

class UserTaxiRepository implements UserTaxiRepositoryInterface
{
    public function save(UserTaxi $userTaxi): void
    {
        $userTaxi->save();
    }

    public function findById(int|string $id): ?UserTaxi
    {
        return UserTaxi::find($id);
    }
}
