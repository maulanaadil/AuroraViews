<?php

namespace App\Services\Reason;

use App\Request\ReasonRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;

abstract class AbstractReasonService
{
    abstract public function getAllReason();

    abstract public function getReasonById(string $reasonId);

    abstract public function insertReason(ReasonRequest $reasonData);

    abstract public function updateReason(ReasonRequest $requestData, string $reasonId);
}
