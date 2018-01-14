<?php

namespace Sushchyk\Presenters\Tests;

use Error;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Sushchyk\Presenters\Services\PresenterService;
use Sushchyk\Presenters\Tests\Models\User;
use Sushchyk\Presenters\Tests\Presenters\Presenter;
use Sushchyk\Presenters\Tests\Presenters\PresenterWithoutPresentMethod;

/**
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class PresenterServiceTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    /** @var  PresenterService */
    protected $presenterService;

    public function setUp()
    {
        parent::setUp();
        $this->presenterService = new PresenterService();
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    protected function getCollectionRange($len)
    {
        return collect(range(0, $len - 1));
    }

    protected function getFilledCollection($value, $len)
    {
        return collect(array_fill(0, $len, $value));
    }

    protected function mockPresenter($len, $returnedValue)
    {
        Mockery::mock('overload:' . Presenter::class)
               ->shouldReceive('present')
               ->times($len)
               ->andReturn($returnedValue);
    }

    /** @test */
    public function it_presents_collection()
    {
        $collectionLen = 5;
        $originalCollection = $this->getCollectionRange($collectionLen);
        $valuePresenterShouldReturns = 25;

        $this->mockPresenter($collectionLen, $valuePresenterShouldReturns);

        $presentedColection = $this->presenterService
            ->presentCollection($originalCollection, Presenter::class);


        $this->assertEquals(
            $presentedColection,
            $this->getFilledCollection($valuePresenterShouldReturns, $collectionLen)
        );

        $this->assertNotEquals($presentedColection, $originalCollection);
    }

    /** @test */
    public function it_transforms_collection()
    {
        $collectionLen = 3;
        $originalCollection = $this->getCollectionRange($collectionLen);
        $valuePresenterShouldReturns = 5;

        $this->mockPresenter($collectionLen, $valuePresenterShouldReturns);

        $presentedColection = $this
            ->presenterService
            ->transformCollection(collect($originalCollection), Presenter::class);

        $this->assertEquals(
            $presentedColection,
            $this->getFilledCollection($valuePresenterShouldReturns, $collectionLen)
        );

        $this->assertNotEquals($presentedColection, $originalCollection);
    }

    /** @test */
    public function it_presents_model()
    {
        $userPresentation = [
            'id'    => 1,
            'title' => 'Test title'
        ];

        $user = factory(User::class)->create();
        $this->mockPresenter(1, $userPresentation);
        $actualUserPresentation = $this->presenterService->presentObject($user, Presenter::class);
        $this->assertEquals($userPresentation, $actualUserPresentation);
    }

    /** @test */
    public function it_returns_intance_of_presenter()
    {
        $presenter = invokeMethod($this->presenterService, 'createPresenter', [Presenter::class]);
        $this->assertInstanceOf(Presenter::class, $presenter);
    }

    /** @test */
    public function it_returns_class_not_found_error()
    {
        $this->expectException(\InvalidArgumentException::class);
        invokeMethod($this->presenterService, 'createPresenter', ['NonExistingClass']);
    }

    /** @test */
    public function it_returns_method_not_exists_error()
    {
        $user = factory(User::class)->create();
        $this->expectException(Error::class);
        invokeMethod($this->presenterService, 'transformSingleObject', [$user, new PresenterWithoutPresentMethod]);
    }
}
