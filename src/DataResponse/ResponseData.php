<?php


namespace Fh\RequestServer\DataResponse;


use Fh\RequestServer\DataTransferObjects\DataTransferObject;
use Illuminate\Contracts\Support\Responsable;

class ResponseData extends DataTransferObject implements Responsable
{
    /**
     * @var int
     */
    public $status = 200;

    /**
     * @var mixed
     */
    public $data;

    /**
     * @inheritDoc
     */
    public function toResponse($request)
    {
        return response()->json(
            $this->data->toArray(),
            $this->status
        );
    }
}
