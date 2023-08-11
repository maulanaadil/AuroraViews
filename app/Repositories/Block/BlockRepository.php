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
     public function getSelectedBlocksById(string $blockId)
     {
         return $this->blockModel->where('block_id', $blockId)->firstOrFail();
     }

    /**
     * Query selected block data by bulk id
     */
    public function getSelectedBlockByBulkId(array $bulkId)
    {
        return $this->blockModel->whereIn('block_id', $bulkId)->get();
    }
}
