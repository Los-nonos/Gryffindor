<?php


namespace Application\Services\Token;


use Domain\Entities\Token;
use Domain\Entities\User;

interface TokenLoginServiceInterface
{
    public function createToken(User $user): Token;

    public function persist(Token $token): void;

    public function exist(string $token);

    public function findOneByHashOrFail(string $tokenHash): Token;

    public function update();

    public function findOrCreateToken(User $user): Token;

    public function createTokenJWT($payload): string;

    public function decryptTokenJWT(string $hash): object;
}
