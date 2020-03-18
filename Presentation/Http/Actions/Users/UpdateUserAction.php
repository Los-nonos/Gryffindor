<?php

namespace Presentation\Http\Actions\Users;

use Illuminate\Http\Request;
use Presentation\Http\Adapters\Users\UpdateUserAdapter;
use Illuminate\Http\JsonResponse;
use Domain\CommandBus\CommandBusInterface;
use Presentation\Interfaces\UpdateUserPresenterInterface;

class UpdateUserAction {
    public function execute(Request $request) {
        
    }
}