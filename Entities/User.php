<?php namespace User\Entities;

use Cartalyst\Sentry\Users\Eloquent\User as SentryUser;
use Laracasts\Presenter\PresentableTrait;

class User extends SentryUser
{
    use PresentableTrait;

    protected $fillable = [
        "email",
        "password",
        "permissions",
        "first_name",
        "last_name"
    ];

    protected $presenter = "User\\Presenters\\UserPresenter";
}
