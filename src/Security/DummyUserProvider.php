<?php
declare(strict_types=1);

namespace App\Security;

use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

/**
 * Class DummyUserProvider
 * Package App\Security
 */
class DummyUserProvider implements UserProviderInterface
{

    /**
     * Loads the user for the given username.
     *
     * This method must throw UsernameNotFoundException if the user is not
     * found.
     *
     * @return UserInterface
     *
     * @throws UsernameNotFoundException if the user is not found
     */
    public function loadUserByUsername(string $username)
    {
        return new User($username, md5($username), ['ROLE_USER']);
    }

    /**
     * Refreshes the user.
     *
     * It is up to the implementation to decide if the user data should be
     * totally reloaded (e.g. from the database), or if the UserInterface
     * object can just be merged into some internal array of users / identity
     * map.
     *
     * @return UserInterface
     *
     * @throws UnsupportedUserException  if the user is not supported
     * @throws UsernameNotFoundException if the user is not found
     */
    public function refreshUser(UserInterface $user)
    {
        return new User($user->getUsername(), md5($user->getPassword()), $user->getRoles());
    }

    /**
     * Whether this provider supports the given user class.
     *
     * @return bool
     */
    public function supportsClass(string $class)
    {
        return 'Symfony\Component\Security\Core\User\User' === $class;
    }
}
