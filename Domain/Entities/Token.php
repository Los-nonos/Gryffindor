<?php


namespace Domain\Entities;

use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * Class Token
 * @package Domain\Entities
 * @ORM\Entity
 * @ORM\Table(name="tokens")
 */
class Token
{
    const LENGTH = 32;
    const EXPIRATION_TIME = '-30minutes';

    /**
     * @var int
     */
    private $id;

    /**
     * @var User
     */
    private $user;

    /**
     * @var string
     */
    private string $hash;
    /**
     * @var DateTime
     */
    private $createdAt;
    /**
     * @var DateTime
     */
    private $updatedAt;

    public function __construct()
    {

    }

    public function setUser(User $user)
    {
        $this->user = $user;
    }

    public function getUser(): User {
        return $this->user;
    }

    public function setHash(string $hash): void
    {
        $this->hash = $hash;
    }

    public function setCreatedAt(DateTime $param)
    {
        $this->createdAt = $param;
    }

    public function getCreatedAt(): DateTime {
        return $this->createdAt;
    }

    public function setUpdatedAt(DateTime $param)
    {
        $this->updatedAt = $param;
    }

    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    public function isExpired(): bool
    {
        return ! intval($this->getCreatedAt()->format('U')) > strtotime(Token::EXPIRATION_TIME);
    }
}
