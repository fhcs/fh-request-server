<?php


namespace Fh\RequestServer\Services;


use Fh\RequestServer\DataTransferObjects\DataTransferObject;

abstract class DataModelCommand implements Executable
{
    /**
     * @var DataTransferObject
     */
    protected $dataTransferObject;


    /**
     * @var string
     */
    protected $modelClass;

    /**
     * DataModelCommand constructor.
     * @param DataTransferObject $dataTransferObject
     * @param string $modelClass
     */
    public function __construct(DataTransferObject $dataTransferObject, string $modelClass)
    {
        $this->dataTransferObject = $dataTransferObject;

        if (!class_exists($modelClass)) {
            trigger_error("$this->modelClass is not exist!");
        }

        $this->modelClass = $modelClass;
    }

    /**
     * @param DataTransferObject $dto
     * @param string $modelClass
     * @return static
     */
    public static function make(DataTransferObject $dto, string $modelClass): self
    {
        return new static($dto, $modelClass);
    }
}
