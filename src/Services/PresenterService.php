<?php

namespace Sushchyk\Presenters\Services;

class PresenterService implements PresenterServiceInterface
{
    public function presentObject($object, $presenterClassName)
    {
        return $this->transformSingleObject($object, $this->createPresenter($presenterClassName));
    }

    public function presentCollection($collection, $presentClassName)
    {
        return $this->presentCollectionOfObjects(false, $collection, $presentClassName);
    }

    public function transformCollection($collection, $presenterClassName)
    {
        return $this->presentCollectionOfObjects(true, $collection, $presenterClassName);
    }

    protected function createPresenter($presenterClassName)
    {
        if (class_exists($presenterClassName)) {
            return new $presenterClassName;
        }

        throw new \InvalidArgumentException("Class $presenterClassName not found.");
    }

    protected function presentCollectionOfObjects($modifyCollection, $collection, $presenterClassName)
    {
        $presenter = $this->createPresenter($presenterClassName);

        $methodToCall = $modifyCollection ? 'transform' : 'map';

        return $collection->{$methodToCall}(function ($item) use ($presenter) {
            return $this->transformSingleObject($item, $presenter);
        });
    }

    protected function transformSingleObject($model, $presenter)
    {
        return $presenter->present($model);
    }
}
