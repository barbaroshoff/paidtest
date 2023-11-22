<?php

namespace App\Contracts;

use App\Models\UserTaxi;

interface UserTaxiRepositoryInterface
{
    public function save(UserTaxi $user): void;

    public function findById(string $id): ?UserTaxi;

}
