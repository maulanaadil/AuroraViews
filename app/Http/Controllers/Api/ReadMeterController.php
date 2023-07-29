<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Request\ReadMeter\FormGetPositionCustomerRequest;
use App\Request\ReadMeter\FormReadMeterRequest;
use App\Request\ReadMeter\LimitGetInfoCustomerRequest;
use App\Services\ReadMeterService;

class ReadMeterController extends Controller
{
    protected $readMeterService;

    public function __construct(ReadMeterService $readMeterService)
    {
        $this->readMeterService = $readMeterService;
    }

   /**
    * Handle get read meter data by office id
    */
   public function getReadMeter(FormReadMeterRequest $requestData)
   {
       return $this->readMeterService->getReadMeter($requestData);
   }

   /**
    * Handle get info customer and limit the result by limit
    */
   public function getInfoCustomer(LimitGetInfoCustomerRequest $requestData)
   {
       return $this->readMeterService->getInfoCustomer($requestData);
   }

   /**
    * Handle get info position customer by customer code and bill mergeym
    */
   public function getPositionCustomer(FormGetPositionCustomerRequest $requestData)
   {
       return $this->readMeterService->getPositionCustomer($requestData);
   }
}
