<?php namespace User\Commands;

use Illuminate\Support\Facades\Event;
use Laracasts\Commander\CommandHandler;
use User\Events\UserHasBegunResetProcess;
use User\Exceptions\UserNotFoundException;
use User\Repositories\AuthenticationRepository;
use User\Repositories\UserRepository;

class BeginResetProcessCommandHandler implements CommandHandler
{
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
     * @throws UserNotFoundException
     * @return mixed
     */
    public function handle($command)
    {
        $user = $this->findUser((array) $command);

        $code = $this->auth->createReminderCode($user);

        Event::fire('Modules.User.Events.UserHasBegunResetProcess', new UserHasBegunResetProcess($user, $code));
    }

    private function findUser($credentials)
    {
        $user = $this->user->findByCredentials((array) $credentials);
        if ($user) {
            return $user;
        }

        throw new UserNotFoundException();
    }
}
