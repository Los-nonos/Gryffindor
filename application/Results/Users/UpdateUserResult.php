<?php

declare(strict_types=1);

namespace Application\Results\Users;

use Domain\Entities\User;

class UpdateUserResult implements UpdateUserResultInterface
{
    /**
     * @var User $user
     */
    private $user;

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }
}
