<?php

namespace App\Repositories\Officer;

use App\Models\Block;
use App\Models\MWriter;
use App\Models\MWriterArea;
use App\Models\Regional;

class OfficerMappingRepository implements OfficerMappingRepositoryInterface
{
    protected $officerModel;

    protected $mwriterAreaModel;

    protected $blockModel;

    protected $regionalModel;

    public function __construct(MWriter $officerModel, MWriterArea $mwriterAreaModel, Block $blockModel, Regional $regionalModel)
    {
        $this->officerModel = $officerModel;
        $this->mwriterAreaModel = $mwriterAreaModel;
        $this->blockModel = $blockModel;
        $this->regionalModel = $regionalModel;
    }

     /**
      * Query all selected regional data
      */
     public function getSelectedRegionalById(string $regionalId): Regional
     {
         return $this->regionalModel->findOrFail($regionalId);
     }

     /**
      * Query all selected block data
      */
     public function getSelectedBlocksById(string $blockId): Block
     {
         return $this->blockModel->findOrFail($blockId);
     }

     /**
      * Query all selected area data
      */
     public function getSelectedAreaByOfficerId(string $officerId): MWriterArea
     {
         return $this->mwriterAreaModel->findOrFail($officerId);
     }

    /**
     * Query selected block data by bulk id
     */
    public function getSelectedBlockByBulkId(array $bulkId): Block
    {
        return $this->blockModel->whereIn('block_id', $bulkId)->get();
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
