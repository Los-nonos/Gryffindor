<?php


namespace Application\Services\Customers;


use Application\Exceptions\EntityNotFoundException;
use Application\Services\Users\UserServiceInterface;
use Domain\Entities\Customer;
use Domain\Entities\User;
use Domain\Interfaces\Repositories\CustomerRepositoryInterface;

class CustomerService implements CustomerServiceInterface
{
    private CustomerRepositoryInterface $repository;
    private UserServiceInterface $userService;

    public function __construct(
        CustomerRepositoryInterface $repository,
        UserServiceInterface $userService
    )
    {
        $this->repository = $repository;
        $this->userService = $userService;
    }

    public function persist(Customer $customer): void
    {
        $this->repository->persist($customer);
    }

    /**
     * @param int $id
     * @return Customer
     * @throws EntityNotFoundException
     */
    public function findOneByIdOrFail(int $id): Customer
    {
        $customer = $this->repository->findOneById($id);

        if(!isset($customer))
        {
            throw new EntityNotFoundException("Customer with id $id not found");
        }

        return $customer;
    }

    /**
     * @param int $id
     * @return User
     * @throws EntityNotFoundException
     */
    public function findOneByUserIdOrFail(int $id): User
    {
        $user = $this->userService->findOneByIdOrFail($id);

        if(!$user->isCustomer())
        {
            throw new EntityNotFoundException("User with id: $id not has customer");
        }

        return $user;
    }

    public function update(): void
    {
        $this->repository->update();
    }

    public function findOneByEmailOrFail(string $email): User
    {
        $user = $this->userService->findOneByEmailOrFail($email);
    }
}
