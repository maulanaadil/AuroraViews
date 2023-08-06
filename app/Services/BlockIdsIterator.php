<?php

namespace App\Iterators;

use App\Repositories\OfficerMapping\OfficerMappingRepositoryInterface;

class BlockIdsIterator implements \Iterator
{
    protected $officerMappingRepository;
    protected $selectedAreaByOfficerId;
    protected $position = 0;

    public function __construct(OfficerMappingRepositoryInterface $officerMappingRepository, $officerId)
    {
        $this->officerMappingRepository = $officerMappingRepository;
        $this->selectedAreaByOfficerId = $this->officerMappingRepository->getSelectedAreaByOfficerId($officerId);
    }

    public function rewind()
    {
        $this->position = 0;
    }

    public function current()
    {
        return $this->selectedAreaByOfficerId[$this->position]->blockId;
    }

    public function key()
    {
        return $this->position;
    }

    public function next()
    {
        $this->position++;
    }

    public function valid()
    {
        return isset($this->selectedAreaByOfficerId[$this->position]);
    }
}