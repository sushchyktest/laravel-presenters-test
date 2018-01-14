<?php

namespace Sushchyk\Presenters\Services;

use Illuminate\Support\Collection;

interface PresenterServiceInterface
{
    /**
     * @param $object
     * @param string $presenterClassName
     * @return mixed
     * @internal param mixed $model
     */
    public function presentObject($object, $presenterClassName);

    /**
     * @Collection $collection
     * @string $presenterClassName
     * @return mixed
     */
    public function presentCollection($collection, $presenterClassName);

    /**
     * @Collection $collection
     * @string $presenterClassName
     * @return mixed
     */
    public function transformCollection($collection, $presenterClassName);
}
