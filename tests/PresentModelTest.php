<?php

namespace Sushchyk\Presenters\Tests;

use BadMethodCallException;
use Carbon\Carbon;
use Sushchyk\Presenters\Tests\Models\UserWithoutTrait;
use Sushchyk\Presenters\Tests\Presenters\UserFullInfoPresenter;
use Sushchyk\Presenters\Tests\Models\User;

class PresentModelTest extends TestCase
{
    /** @test */
    public function it_return_presentation_of_model()
    {
        $user = factory(User::class)->create();

        $userFullInfo = $user->present(UserFullInfoPresenter::class);

        $this->assertTrue(is_array($userFullInfo));

        $this->assertCount(3, $userFullInfo);

        $this->assertEquals($userFullInfo['id'], $user->id);
        $this->assertEquals($userFullInfo['username'], $user->username);
        $this->assertEquals($userFullInfo['birth_date'], $user->birth_date);
    }

    /** @test */
    public function it_returns_error_when_model_has_no_trait()
    {
        $this->expectException(BadMethodCallException::class);

        (new UserWithoutTrait)->present(UserFullInfoPresenter::class);
    }
}
