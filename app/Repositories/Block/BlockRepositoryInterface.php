<?php

namespace App\Repositories\Block;

use App\Models\Block;

interface BlockRepositoryInterface
{
    public function getSelectedBlocksById(string $blockId);

    public function getSelectedBlockByBulkId(array $bulkId);
}
