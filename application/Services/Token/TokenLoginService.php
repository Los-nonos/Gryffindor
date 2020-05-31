<?php


namespace Application\Services\Token;


use App\Exceptions\Forbidden;
use Application\Exceptions\EntityNotFoundException;
use Application\Services\Token\TokenLoginServiceInterface;
use Domain\Entities\Token;
use Domain\Entities\User;
use Domain\Interfaces\Repositories\TokenRepositoryInterface;
use Firebase\JWT\JWT;

class TokenLoginService implements TokenLoginServiceInterface
{
    private GenerateRandomTokenService $createRandomTokenService;
    private TokenRepositoryInterface $tokenRepository;

    public function __construct(
        GenerateRandomTokenService $createRandomTokenService,
        TokenRepositoryInterface $tokenRepository
    )
    {
        $this->createRandomTokenService = $createRandomTokenService;
        $this->tokenRepository = $tokenRepository;
    }

    public function createToken(User $user): Token
    {
        $token = new Token();

        $token->setUser($user);

        $token->setHash($this->createRandomTokenService->generate(Token::LENGTH));

        $token->setCreatedAt(new \DateTime("now"));

        $token->setUpdatedAt(new \DateTime("now"));

        $this->tokenRepository->persist($token);

        return $token;
    }

    /**
     * @param string|null $hash
     * @return Token
     * @throws EntityNotFoundException
     */
    public function findOneByHashOrFail(?string $hash): Token
    {
        $token = $this->tokenRepository->findOneByHash($hash);

        if(!$token) {
            throw new EntityNotFoundException("Token hash not found");
        }

        return $token;
    }

    public function exist(string $hash): bool
    {
        return $this->tokenRepository->exist($hash);
    }

    public function persist(Token $token): void
    {
        $this->tokenRepository->persist($token);
        $this->update();
    }

    public function update()
    {
        $this->tokenRepository->update();
    }

    public function findOrCreateToken(User $user): Token
    {
        $token = $this->findOneByUserIdOrFail($user->getId());

        if(!$token) {
            $token = $this->createToken($user);
        }

        return $token;
    }

    public function createTokenJWT($payload): string
    {
        $key = env('JWT_SECRET', "pepito123");
        return JWT::encode($payload, $key);
    }

    /**
     * @param string $hash
     * @return object
     * @throws Forbidden
     */
    public function decryptTokenJWT(string $hash): object
    {
        $key = env('JWT_SECRET', "pepito123");
        $decrypted = JWT::decode($hash, $key, array('HS256'));

        if(!$decrypted) {
            throw new Forbidden("Token invalid");
        }

        return $decrypted;
    }

    /**
     * @param int $userId
     * @return Token
     * @throws EntityNotFoundException
     */
    public function findOneByUserIdOrFail(int $userId): Token
    {
        $token = $this->tokenRepository->findOneByUserId($userId);

        if(!$token) {
            throw new EntityNotFoundException("Token not found");
        }

        return $token;
    }
}
