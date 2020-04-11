<?php

namespace Presentation\Http\Presenters\Users;

use Application\Results\Users\UpdateUserResultInterface;
use Application\Results\Users\UpdateUserResult;
use Domain\Entities\User;
use Presentation\Interfaces\UpdateUserPresenterInterface;

class UpdateUserPresenter implements UpdateUserPresenterInterface
{
    /**
     * @var UpdateUserResult
     */
    private $result;

    public function __construct(

    ) {

    }

    public function fromResult(UpdateUserResultInterface $result): UpdateUserPresenterInterface
    {
        $this->result = $result;
        return $this;
    }

    /**
     * Returns a JSON representation of current object
     *
     * @return string
     */
    public function toJson(): string
    {
        return json_encode($this->getData());
    }

    /**
     * Get data for current use case
     *
     * @return array
     */
    public function getData(): array
    {
        $user = $this->result->getUser();

        return [
            'id' => $user->getId(),
            'name' => $user->getName(),
            'email' => $user->getEmail(),
        ];
    }

}
