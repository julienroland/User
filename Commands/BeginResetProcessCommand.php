<?php namespace User\Commands;

class BeginResetProcessCommand
{
    public $email;

    public function __construct($email)
    {
        $this->email = $email;
    }
}
