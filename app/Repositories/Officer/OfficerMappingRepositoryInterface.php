<?php

namespace App\Repositories\Officer;

use App\Models\MWriterArea;

interface OfficerMappingRepositoryInterface
{
    public function getSelectedAreaByOfficerId(string $officerId);

    public function insertMappingOfficer(array $newDataMappingOfficer): MWriterArea;

    public function deleteMappingOfficer(string $mwriteAreaId): bool;
}
