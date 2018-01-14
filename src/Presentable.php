<?php

namespace Sushchyk\Presenters;

use Sushchyk\Presenters\Services\PresenterServiceInterface;

trait Presentable
{
    /**
     * Present object.
     *
     * @param string $presenterClassName
     * @return mixed
     */
    public function present($presenterClassName)
    {
        return app(PresenterServiceInterface::class)->presentObject($this, $presenterClassName);
    }
}
