<?php namespace User\Commands;

use Laracasts\Commander\CommandHandler;
use User\Exceptions\InvalidOrExpiredResetCode;
use User\Exceptions\UserNotFoundException;
use User\Repositories\AuthenticationRepository;
use User\Repositories\UserRepository;

class CompleteResetProcessCommandHandler implements CommandHandler
{
    protected $input;
    /**
     * @var UserRepository
     */
    private $user;
    /**
     * @var AuthenticationRepository
     */
    private $auth;

    public function __construct(UserRepository $user, AuthenticationRepository $auth)
    {
        $this->user = $user;
        $this->auth = $auth;
    }

    /**
     * Handle the command
     *
     * @param $command
     * @throws InvalidOrExpiredResetCode
     * @throws UserNotFoundException
     * @return mixed
     */
    public function handle($command)
    {
        $this->input = $command;

        $user = $this->findUser();

        if (!$this->auth->completeResetPassword($user, $this->input->code, $this->input->password)) {
            throw new InvalidOrExpiredResetCode;
        }

        return $user;
    }

    public function findUser()
    {
        $user = $this->user->find($this->input->userId);
        if ($user) {
            return $user;
        }

        throw new UserNotFoundException;
    }
}
