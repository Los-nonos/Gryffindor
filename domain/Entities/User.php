<?php

declare(strict_types=1);

namespace Domain\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Exception;
use function Sodium\add;

class User
{
    /**
     * @var int
     */
    private int $id;
    /**
     * @var string
     */
    private string $name;
    /**
     * @var string
     */
    private string $surname;
    /**
     * @var string
     */
    private string $username;
    /**
     * @var string
     */
    private string $email;
    /**
     * @var string
     */
    private string $password;
    /**
     * @var bool
     */
    private bool $isActive;
    /**
     * @var Employee|null
     * @ORM\OneToOne(targetEntity="Employee")
     */
    private $employee;

    /**
     * @var Customer
     * @ORM\OneToOne(targetEntity="Customer")
     */
    private $customer;

    /**
     * @var Admin
     * @ORM\OneToOne(targetEntity="Admin")
     */
    private $admin;

    /**
     * Activity constructor.
     *
     * @throws Exception
     */
    public function __construct()
    {
        $this->isActive = true;
    }

    /**
     * @return string $name
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string $name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @return string $email
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string $password
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->isActive;
    }

    /**
     * @param bool $isActive
     */
    public function setIsActive(bool $isActive): void
    {
        $this->isActive = $isActive;
    }

    /**
     * @param Employee $employee
     */
    public function setEmployee(Employee $employee) {
        $this->employee = $employee;
    }

    /**
     * @return Employee|null
     */
    public function getEmployee(): ?Employee
    {
        return $this->employee;
    }

    /**
     * @return bool
     */
    public function isEmployee(): bool
    {
        return isset($this->employee);
    }

    /**
     * @param Customer $customer
     */
    public function setCustomer(Customer $customer)
    {
        $this->customer = $customer;
    }

    /**
     * @return Customer|null
     */
    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    /**
     * @return bool
     */
    public function isCustomer(): bool
    {
        return isset($this->customer);
    }

    /**
     * @return Admin
     */
    public function getAdmin(): Admin
    {
        return $this->admin;
    }

    /**
     * @param Admin $admin
     */
    public function setAdmin(Admin $admin): void
    {
        $this->admin = $admin;
    }

    public function isAdmin(): bool
    {
        return isset($this->admin);
    }
}
