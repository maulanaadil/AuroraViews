<?php

namespace App\Repositories\Reason;

use App\Models\Alasan;
use Illuminate\Database\Eloquent\Collection;

class ReasonRepository implements ReasonRepositoryInterface
{
    protected $reasonModel;

    public function __construct(Alasan $reasonModel)
    {
        $this->reasonModel = $reasonModel;
    }

    /**
     * Get all reason data
     */
    public function getAllReason(): Collection
    {
        return $this->reasonModel->all();
    }

    /**
     * Get reason data by Id
     */
    public function getReasonById(string $reasonId): Alasan
    {
        return $this->reasonModel->findOrFail($reasonId);
    }

    /**
     * Insert reason data
     */
    public function insertReason(array $newDataReason): Alasan
    {
        return $this->reasonModel->create($newDataReason);
    }

    /**
     * Update existing reason data
     */
    public function updateReason(array $newDataReason, string $reasonId): Alasan
    {
        $reason = $this->reasonModel->findOrFail($reasonId);
        $reason->update($newDataReason);

        return $reason;
    }

    /**
     * Delete existing reason data
     */
    public function deleteReason(string $reasonId): bool
    {
        $reason = $this->getReasonById($reasonId);

        return $reason->delete();
    }
}
