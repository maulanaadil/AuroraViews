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
   public function getReadMeter(FormReadMeterRequest $request)
   {
       return $this->readMeterService->getReadMeter($request);
   }

   /**
    * Handle get info customer and limit the result by limit
    */
   public function getInfoCustomer(LimitGetInfoCustomerRequest $request)
   {
       return $this->readMeterService->getInfoCustomer($request);
   }

   /**
    * Handle get info position customer by customer code and bill mergeym
    */
   public function getPositionCustomer(FormGetPositionCustomerRequest $request)
   {
       return $this->readMeterService->getPositionCustomer($request);
   }
}
