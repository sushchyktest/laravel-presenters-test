asdasdasdasd

# Laravel Presenters  [![Build Status](https://travis-ci.org/sushchyktest/laravel-presenters-test.svg?branch=master)](https://travis-ci.org/sushchyktest/laravel-presenters-test)
asdasd
Easy creation of presenters for models in Laravel 5

Inspired by [laracasts/presenter](https://github.com/laracasts/Presenter)

## Install 

Install the package via Composer:

```
composer require sushchyk/laravel-presenters:^1.*
```

For Laravel <5.5 you should add  `Sushchyk\LaravelPresenters\MacroServiceProvider` service provider to your config/app.php:

## UsageTest

### Collections
```
namespace App\Presenters;

use App\User;

class UserOptionPresenters 
{
    public function present(User $user) 
    {
        return [
            'id' => $user->id,
            'title' => $user->username
        ];
    }
}
```
```
$users = User::all()->present(UserOptionPresenter::class);
return response()->json([
    'users' => $users->present(UserOptionPresenter::class)
]);
```
