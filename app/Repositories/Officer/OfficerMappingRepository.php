<?php

namespace App\Repositories\Officer;

use App\Models\MWriter;
use App\Models\MWriterArea;

class OfficerMappingRepository implements OfficerMappingRepositoryInterface
{
    protected $officerModel;

    protected $mwriterAreaModel;

    public function __construct(MWriter $officerModel, MWriterArea $mwriterAreaModel)
    {
        $this->officerModel = $officerModel;
        $this->mwriterAreaModel = $mwriterAreaModel;
    }

     /**
      * Query all selected area data
      */
     public function getSelectedAreaByOfficerId(string $officerId): MWriterArea
     {
         return $this->mwriterAreaModel->findOrFail($officerId);
     }

    /**
     * Query insert mapping officer data
     */
    public function insertMappingOfficer(array $newDataMappingOfficer): MWriterArea
    {
        return $this->mwriterAreaModel->create($newDataMappingOfficer);
    }

    /**
     * Query delete mapping officer data
     */
    public function deleteMappingOfficer(string $mwriterAreaId): bool
    {
        return $this->mwriterAreaModel->findOrFail($mwriterAreaId)->delete();
    }
}
