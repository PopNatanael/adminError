<?php

declare(strict_types=1);

namespace Frontend\User\FormData;

use Frontend\User\Entity\User;
use Frontend\User\Entity\UserRole;
use Frontend\User\Service\UserService;

/**
 * Class UserFormData
 * @package Frontend\User\FormData
 */
class UserFormData
{
    public ?string $identity = null;
    public ?string $firstName = null;
    public ?string $lastName = null;
    public ?string $status = null;
    public ?Year $year = null;
    public array $roles = [];

    /**
     * @return array
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

    /**
     * @param User|object $user
     */
    public function fromEntity(User $user)
    {
        /** @var UserRole $role */
        foreach ($user->getRoles() as $role) {
            $this->roles[] = $role->getUuid()->toString();
        }
        $this->firstName = $user->getDetail()->getFirstName();
        $this->lastName = $user->getDetail()->getLastName();
        $this->identity = $user->getIdentity();
        $this->status = $user->getStatus();
        $this->year = $user->getYear();
    }

    /**
     * @return array
     */
    public function getArrayCopy()
    {
        return [
            'identity' => $this->identity,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'status' => $this->status,
            'year' => $this->year,
            'roles' => $this->roles
        ];
    }
}
