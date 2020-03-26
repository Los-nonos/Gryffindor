<?php

declare(strict_types=1);

namespace Application\Results\Users;

use Domain\Entities\User;

interface UpdateUserResultInterface
{
    public function getUser(): User;

    public function setUser(User $user): void;
}
