<?php

namespace App\Repositories\Block;

use App\Models\Block;

class BlockRepository implements BlockRepositoryInterface
{
    protected $blockModel;

    public function __construct(Block $blockModel)
    {
        $this->blockModel = $blockModel;
    }

     /**
      * Query all selected block data
      */
     public function getSelectedBlocksById(string $blockId): Block
     {
         return $this->blockModel->findOrFail($blockId);
     }

    /**
     * Query selected block data by bulk id
     */
    public function getSelectedBlockByBulkId(array $bulkId): Block
    {
        return $this->blockModel->whereIn('block_id', $bulkId)->get();
    }
}
