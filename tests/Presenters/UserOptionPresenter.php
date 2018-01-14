<?php

namespace Sushchyk\Presenters\Tests\Presenters;

use Sushchyk\Presenters\Tests\Models\User;

class UserOptionPresenter
{
    public function present(User $user)
    {
        return [
            'id' => $user->id,
            'title' => $user->username
        ];
    }
}
