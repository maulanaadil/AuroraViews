<?php

namespace App\Repositories\Regional;

use App\Models\Regional;

class RegionalRepository implements RegionalRepositoryInterface
{
    protected $regionalModel;

    public function __construct(Regional $regionalModel)
    {
        $this->regionalModel = $regionalModel;
    }

     /**
      * Query all selected regional data
      */
     public function getSelectedRegionalById(string $regionalId): Regional
     {
         return $this->regionalModel->findOrFail($regionalId);
     }
}
