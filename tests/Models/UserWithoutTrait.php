<?php

namespace Sushchyk\Presenters\Tests\Models;

use Illuminate\Database\Eloquent\Model;
use Sushchyk\Presenters\Presentable;

class UserWithoutTrait extends Model
{
    protected $table = 'users';
}
