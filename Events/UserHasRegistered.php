<?php namespace \User\Events;

class UserHasRegistered
{
    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }
}
