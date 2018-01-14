<?php

namespace Sushchyk\Presenters\Tests\Presenters;

use Sushchyk\Presenters\Tests\Models\User;

class UserFullInfoPresenter
{
    public function present(User $user)
    {
        return [
            'id' => $user->id,
            'username' => $user->username,
            'birth_date' => $user->birth_date
        ];
    }
}
