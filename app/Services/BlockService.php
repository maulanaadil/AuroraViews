<?php

namespace App\Services;

use App\Repositories\Block\BlockRepository;
use App\Request\Block\SelectBlockByIdRequest;
use App\Response\ApiResponse;
use Exception;
use Illuminate\Http\Response;

class BlockService
{
    protected $blockRepository;

    public function __construct(BlockRepository $blockRepository)
    {
        $this->blockRepository = $blockRepository;
    }

   /**
    * Display the specified block.
    *
    * @return \Illuminate\Http\Response
    *
    * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
    * @throws \Exception
    */
   public function getSelectedBlocksById(SelectBlockByIdRequest $requestData)
   {
       try {
           return ApiResponse::toJson(
               'Data block berhasil diambil',
               Response::HTTP_OK,
               true,
               $this->blockRepository->getSelectedBlocksById($requestData['block_id']),
           );
       } catch (Exception $exception) {
           return ApiResponse::toJson(
               $exception->getMessage(),
               Response::HTTP_INTERNAL_SERVER_ERROR,
               false,
               null,
           );
       }
   }

    /**
     * Display the specified block.
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     * @throws \Exception
     */
    public function getSelectedBlockById(SelectBlockByIdRequest $requestData)
    {
        try {
            return ApiResponse::toJson(
                'Data block berhasil diambil',
                Response::HTTP_OK,
                true,
                $this->blockRepository->getSelectedBlockByBulkId($requestData->validated()),
            );
        } catch (Exception $exception) {
            return ApiResponse::toJson(
                $exception->getMessage(),
                Response::HTTP_INTERNAL_SERVER_ERROR,
                false,
                null,
            );
        }
    }
}
