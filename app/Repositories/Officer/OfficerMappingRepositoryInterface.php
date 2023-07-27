<?php

namespace App\Repositories\Officer;

use App\Models\Block;
use App\Models\MWriterArea;
use App\Models\Regional;

interface OfficerMappingRepositoryInterface
{
    public function getSelectedRegionalById(string $regionalId): Regional;

    public function getSelectedBlocksById(string $blockId): Block;

    public function getSelectedAreaByOfficerId(string $officerId): MWriterArea;

    public function getSelectedBlockByBulkId(array $bulkId): Block;

    public function insertMappingOfficer(array $newDataMappingOfficer): MWriterArea;

    public function deleteMappingOfficer(string $mwriteAreaId): bool;
}
