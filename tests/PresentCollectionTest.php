<?php

namespace Sushchyk\Presenters\Tests;

use Illuminate\Support\Collection;
use Sushchyk\Presenters\Tests\Models\User;
use Sushchyk\Presenters\Tests\Presenters\UserOptionPresenter;

class PresentCollectionTest extends TestCase
{
    /** @var  Collection $users */
    protected $usersCount = 3;

    /** @var  Collection $users */
    protected $users;

    public function setUp()
    {
        parent::setUp();
        $this->users = factory(User::class, $this->usersCount)->create();
    }

    /**
     * @test
     */
    public function it_transform_but_not_mutate_collection()
    {
        $presentedUsers = $this->users->present(UserOptionPresenter::class);

        $this->assertCollectionsHaveSameLength($presentedUsers, $this->users);

        for ($i = 0; $i < $this->usersCount; $i++) {
            $this->assertTrue(is_array($presentedUsers[$i]));
            $this->assertInstanceOf(User::class, $this->users[$i]);
        }
    }

    /**
     * @test
     */
    public function it_transform_and_mutate_collection()
    {
        $presentedUsers = $this->users->presentAndChange(UserOptionPresenter::class);

        $this->assertEquals($presentedUsers, $this->users);
    }

    protected function assertCollectionsHaveSameLength(Collection $firstCollection, Collection $secondCollection)
    {
        $this->assertEquals($firstCollection->count(), $secondCollection->count());
    }
}
