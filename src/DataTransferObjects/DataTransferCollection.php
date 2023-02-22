<?php


namespace Fh\RequestServer\DataTransferObjects;


use Illuminate\Support\Collection;
use Illuminate\Support\Str;

abstract class DataTransferCollection extends DataTransferObject implements \Countable, \IteratorAggregate
{
    /**
     * @var string
     */
    public string $collects;

    /**
     * @var Collection
     */
    public Collection $collection;

    /**
     * DataTransferCollection constructor.
     * @param array|null $parameters
     */
    public function __construct(?array $parameters = [])
    {
        parent::__construct([]);
        $this->collectData($parameters);
    }

    /**
     * @param mixed $resource
     * @return Collection
     */
    protected function collectData($resource): Collection
    {
        if (is_null($resource)) {
            $resource = new Collection();
        }

        if (is_array($resource)) {
            $resource = new Collection($resource);
        }

        $collects = $this->collects();

        $this->collection = $collects && !$resource->first() instanceof $collects
            ? $resource->mapInto($collects)
            : $resource->toBase();

        return $this->collection;
    }

    /**
     * @return string|null
     */
    protected function collects(): ?string
    {
        if ($this->collects) {
            return $this->collects;
        }

        if (Str::endsWith(class_basename($this), 'Collection') &&
            class_exists($class = Str::replaceLast('Collection', '', get_class($this)))) {
            return $class;
        }

        return null;
    }

    public function getIterator()
    {
        return $this->collection->getIterator();
    }

    public function count(): int
    {
        return $this->collection->count();
    }

    public function toArray(): array
    {
        return $this->collection->toArray();
    }
}
