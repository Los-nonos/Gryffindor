<?php


namespace Domain\Entities;


use Domain\Enums\EmployeeRoles;

class Employee
{
    /**
     * @var int
     *
     */
    private int $id;

    /**
     * @var string
     */
    private string $role;

    public function __construct(string $role)
    {
        $this->role = $role;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return array
     */
    public function getRole(): array
    {
        return json_decode($this->role);
    }

    /**
     * Setting roles from array the roles matching to EmployeeRoles enum
     * ¡Warning: all roles are removed before setting roles!
     * @param array $roles
     */
    public function setRoles(array $roles): void
    {
        $this->role = "";

        foreach($roles as $role) {
            if ($role == EmployeeRoles::SALES) {
                $this->setSalesRole();
            } elseif ($role == EmployeeRoles::PURCHASES) {
                $this->setPurchaseRole();
            } elseif ($role == EmployeeRoles::DEPOSITS) {
                $this->setDepositRole();
            } elseif ($role == EmployeeRoles::TREASURY) {
                $this->setTreasuryRole();
            } elseif ($role == EmployeeRoles::ACCOUNTING) {
                $this->setAccountingRole();
            } elseif ($role == EmployeeRoles::FINANCE) {
                $this->setFinanceRole();
            } elseif ($role == EmployeeRoles::RRHH) {
                $this->setRRHHRole();
            }
        }
    }

    private function setSalesRole(): void
    {
        $this->role = $this->addRole(EmployeeRoles::SALES);
    }

    private function setPurchaseRole(): void
    {
        $this->role = $this->addRole(EmployeeRoles::PURCHASES);
    }

    private function setDepositRole(): void
    {
        $this->role = $this->addRole(EmployeeRoles::DEPOSITS);
    }

    private function setTreasuryRole(): void
    {
        $this->role = $this->addRole(EmployeeRoles::TREASURY);
    }

    private function setAccountingRole(): void
    {
        $this->role = $this->addRole(EmployeeRoles::ACCOUNTING);
    }

    private function setFinanceRole(): void
    {
        $this->role = $this->addRole(EmployeeRoles::FINANCE);
    }

    private function setRRHHRole(): void
    {
        $this->role = $this->addRole(EmployeeRoles::RRHH);
    }

    private function addRole(string $role): string
    {
        $roles = json_decode($this->role);
        $roles = array_push($roles, $role);

        return json_encode($roles);
    }
}
