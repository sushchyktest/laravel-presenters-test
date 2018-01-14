<?php

namespace Sushchyk\Presenters;

use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use Sushchyk\Presenters\Services\PresenterService;
use Sushchyk\Presenters\Services\PresenterServiceInterface;

class PresentersServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(PresenterServiceInterface::class, function () {
            return new PresenterService;
        });


        /**
         * Present collection by passed presenter, does not mutate collection.
         *
         * @param string $presenterClassName
         * @return Collection
         */
        Collection::macro('present', function ($presenterClassName) {
            return app()
                ->make(PresenterServiceInterface::class)
                ->presentCollection($this, $presenterClassName);
        });

        /**
         * Present collection by passed presenter, mutate collection.
         *
         * @param string $presenterClassName
         * @return Collection
         */
        Collection::macro('presentAndChange', function ($presenterClassName) {
            return app()
                ->make(PresenterServiceInterface::class)
                ->transformCollection($this, $presenterClassName);
        });
    }
}
