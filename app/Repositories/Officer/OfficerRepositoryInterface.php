<?php

namespace App\Repositories\Officer;

use App\Models\MWriter;
use Illuminate\Database\Eloquent\Collection;

interface OfficerRepositoryInterface
{
    public function getAllOfficer(): Collection;

    public function getOfficerById(string $officerId): MWriter;

    public function insertOfficer(array $newDataOfficer): MWriter;

    public function updateOfficer(array $newDataOfficer, string $officerId): MWriter;

    public function deleteOfficer(string $officerId): bool;
}
