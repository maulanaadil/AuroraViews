<?php

namespace App\Repositories\Reason;

use App\Models\Alasan;
use Illuminate\Database\Eloquent\Collection;

interface ReasonRepositoryInterface
{
    public function getAllReason(): Collection;

    public function getReasonById(string $reasonId): Alasan;

    public function insertReason(array $newDataReason): Alasan;

    public function updateReason(array $newDataReason, string $reasonId): Alasan;

    public function deleteReason(string $reasonId): bool;
}
