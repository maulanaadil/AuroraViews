<?php

namespace App\Repositories\RecordAnalytics;

interface RecordAnalyticsRepositoryInterface
{
    public function getRecordProgress(array $payload);

    public function getHublangRecordProgress(array $payload);

    public function getOfficeProgress(array $payload);

    public function getHublangOfficeProgress(array $payload);
}
