<?php

namespace App\Repositories\Regional;

use App\Models\Regional;

interface RegionalRepositoryInterface
{
    public function getSelectedRegionalById(string $regionalId): Regional;
}
