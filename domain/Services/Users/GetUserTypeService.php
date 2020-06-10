<?php


namespace Domain\Services\Users;


use Domain\Entities\User;
use Domain\Interfaces\Services\GetUserTypeServiceInterface;

class GetUserTypeService implements GetUserTypeServiceInterface
{
    const USER_ADMIN = 0;
    const USER_CUSTOMER = 1;

    /**
     * Return the user Type, can be one or more
     * @param User $user
     * @return array
     */
    public function handle(User $user) : array
    {
        $userTypes = [];

        if($user->isAdmin()) {
            array_push($userTypes, $user->getAdmin()->getRole());
        }

        if($user->isCustomer()) {
            array_push($userTypes, 'customer');
        }

        if($user->isEmployee()) {
            $userRoles = $user->getEmployee()->getRole();

            foreach ($userRoles as $userRole) {
                array_push($userTypes, $userRole);
            }
        }

        return $userTypes;
    }
}
