<?php


namespace Application\Services\Users;


interface UserServiceInterface
{

    public function findUserByUsernameOrFail($getUsername);
}
