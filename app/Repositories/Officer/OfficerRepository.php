<?php

namespace App\Repositories\Officer;

use App\Models\MWriter;
use Illuminate\Database\Eloquent\Collection;

class OfficerRepository implements OfficerRepositoryInterface
{
    protected $officerModel;

    public function __construct(MWriter $officerModel)
    {
        $this->officerModel = $officerModel;
    }

    /**
     * Get all officer data
     */
    public function getAllOfficer(): Collection
    {
        return $this->officerModel->all();
    }

    /**
     * Get officer data by Id
     */
    public function getOfficerById(string $officerId): MWriter
    {
        return $this->officerModel->where('writer_id', $officerId)->firstOrFail();
    }

    /**
     * Insert officer data
     */
    public function insertOfficer(array $newDataOfficer): MWriter
    {
        return $this->officerModel->create($newDataOfficer);
    }

    /**
     * Update existing officer data
     */
    public function updateOfficer(array $newDataOfficer, string $officerId): MWriter
    {
        $officer = $this->officerModel->findOrFail($officerId);
        $officer->update($newDataOfficer);

        return $officer;
    }

    /**
     * Delete existing officer data
     */
    public function deleteOfficer(string $officerId): bool
    {
        $officer = $this->getOfficerById($officerId);

        return $officer->delete();
    }
}
