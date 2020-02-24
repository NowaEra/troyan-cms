<?php

namespace App\Model;

use Symfony\Component\Security\Core\User\UserInterface;

class DummyUser implements UserInterface
{
    /** @var string */
    private $username;

    /** @var string */
    private $password;

    /** @var array|string[] */
    private $roles;

    /**
     * DummyUser constructor.
     *
     * @param string         $username
     * @param string         $password
     * @param array|string[] $roles
     */
    public function __construct(string $username, string $password, array $roles = ['ROLE_USER'])
    {
        $this->username = $username;
        $this->password = $password;
        $this->roles    = $roles;
    }

    /**
     * Returns the roles granted to the user.
     *
     *     public function getRoles()
     *     {
     *         return ['ROLE_USER'];
     *     }
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return string[] The user roles
     */
    public function getRoles(): array
    {
        return $this->roles ?? [ 'ROLE_USER' ];
    }

    /**
     * Returns the password used to authenticate the user.
     *
     * This should be the encoded password. On authentication, a plain-text
     * password will be salted, encoded, and then compared to this value.
     *
     * @return string|null The encoded password if any
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
}
