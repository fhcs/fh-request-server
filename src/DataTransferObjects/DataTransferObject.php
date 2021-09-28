<?php


namespace Fh\RequestServer\DataTransferObjects;


use Illuminate\Contracts\Support\Arrayable;

abstract class DataTransferObject implements Arrayable
{
    /**
     * DataTransferObject constructor.
     * @param array $parameters
     */
    public function __construct(array $parameters = [])
    {
        if (!empty($parameters)) {
            $parameters = method_exists($this, 'mapData') ? $this->mapData($parameters) : $parameters;

            foreach ($parameters as $field => $value) {
                $this->{$field} = $value;
                unset($parameters[$field]);
            }
        }
    }

    /**
     * @param array $data
     * @return static
     */
    public static function make(array $data): self
    {
        return new static($data);
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $data = [];

        $class = new \ReflectionObject($this);
        $properties = $class->getProperties(\ReflectionProperty::IS_PUBLIC);

        foreach ($properties as $property) {
            if ($property->isStatic()) {
                continue;
            }
            $data[$property->getName()] = $property->getValue($this);
        }

        return $data;
    }
}
