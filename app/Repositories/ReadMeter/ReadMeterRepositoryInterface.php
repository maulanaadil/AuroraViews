<?php

namespace App\Repositories\ReadMeter;

interface ReadMeterRepositoryInterface
{
    public function loadRatesMeter();

    public function getOfficeById(int $officeId);

    public function getInfoCustomer(array $payload);

    public function getPositionCustomer(array $payload);
}
