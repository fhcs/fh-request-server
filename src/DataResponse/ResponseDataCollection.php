<?php


namespace Fh\RequestServer\DataResponse;


use Fh\RequestServer\DataTransferObjects\DataTransferObject;
use Illuminate\Contracts\Support\Responsable;

class ResponseDataCollection extends DataTransferObject implements Responsable
{
    /**
     * @var mixed
     */
    public $collection;

    /**
     * @var int
     */
    public int $status = 200;

    /**
     * @inheritDoc
     */
    public function toResponse($request)
    {
        return response()->json(
            $this->collection->toArray(),
            $this->status
        );
    }
}
