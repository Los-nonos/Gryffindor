<?php

declare(strict_types=1);

namespace Presentation\Http\Actions\Users;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Presentation\Http\Adapters\Users\UpdateUserAdapter;
use Domain\CommandBus\CommandBusInterface;
use Presentation\Interfaces\UpdateUserPresenterInterface;
use const Presentation\Http\Enums\HTTP_CODES;

/**
 * @OA\Server(url="http://localhost")
 */

class UpdateUserAction
{
    /**
     * @OA\Tag(
     *     name="User Endpoints",
     *     description="Operations about Users"
     * ),
     * @OA\Put(
     *     path="/api/user",
     *     summary="Edit a base user",
     *     tags={"User Endpoints"},
     *     @OA\RequestBody(
     *         description="Input data format",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 required={"id", "name", "email", "password"},
     *                 @OA\Property(
     *                     property="id",
     *                     description="An existing user ID",
     *                     type="integer",
     *                 ),
     *                 @OA\Property(
     *                     property="name",
     *                     description="The User Name",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="email",
     *                     description="The User Email",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     description="The user password",
     *                     type="string",
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="The requested user was succesfully edited and updated to the database.",
     *         @OA\MediaType(
     *                     mediaType="application/json",
     *                     @OA\Schema(
     *                         @OA\Property(
     *                             property="id",
     *                             type="integer",
     *                             description="The user ID"
     *                         ),
     *                         @OA\Property(
     *                             property="name",
     *                             type="string",
     *                             description="The organization name"
     *                         ),
     *                         @OA\Property(
     *                             property="email",
     *                             type="string",
     *                             description="The organization name"
     *                         )
     *                     )
     *                )
     *     ),
     *     @OA\Response(
     *         response="412",
     *         description="Invalid Body Exception. A wrong parameter was found on the Requested Body."
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="No handled error."
     *     )
     * )
     */

    /**
     * @var UpdateUserAdapter $editUserAdapter
     */
    private UpdateUserAdapter $updateUserAdapter;

    /**
     * @var CommandBusInterface $commandBus
     */
    private CommandBusInterface $commandBus;

    /**
     * @var UpdateUserPresenterInterface $presenter
     */
    private UpdateUserPresenterInterface $presenter;

    /**
     * CreateUserAction constructor.
     * @param UpdateUserAdapter $updateUserAdapter
     * @param CommandBusInterface $commandBus
     * @param UpdateUserPresenterInterface $presenter
     */
    public function __construct(
        UpdateUserAdapter $updateUserAdapter,
        CommandBusInterface $commandBus,
        UpdateUserPresenterInterface $presenter
    ) {
        $this->updateUserAdapter = $updateUserAdapter;
        $this->commandBus = $commandBus;
        $this->presenter = $presenter;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function execute(Request $request)
    {
        $updateUserCommand = $this->updateUserAdapter->adapt($request);

        $result = $this->commandBus->handle($updateUserCommand);

        return new JsonResponse(
            $this->presenter->fromResult($result)->getData(),
            HTTP_CODES['CREATED']
        );
    }
}
