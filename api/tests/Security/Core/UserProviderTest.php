<?php

namespace Purus\Tests\Security\Core;

use PHPUnit\Framework\MockObject\MockObject;
use Purus\Contracts\Security\UserInterface;
use Purus\Contracts\Security\UserRepositoryInterface;
use Purus\Entity\User;
use Purus\Security\Core\UserProvider;
use PHPUnit\Framework\TestCase;

class UserProviderTest extends TestCase
{
    private MockObject $users;

    private UserProvider $sut;

    public function setUp(): void
    {
        $this->users = $this->createMock(UserRepositoryInterface::class);
        $this->sut = new UserProvider($this->users);
    }

    public function testLoadByIdentifier(): void
    {
        $users = $this->users;
        $sut = $this->sut;
        $newUser = $this->createMock(UserInterface::class);

        $users->expects($this->once())
            ->method('findByEmail')
            ->willReturn(null);
        $users->expects($this->once())
            ->method('create')
            ->willReturn($newUser);
        $users->expects($this->once())
            ->method('store')
            ->with($newUser);

        $newUser->expects($this->once())
            ->method('setEmail')
            ->with($email = 'email@example.com');
        $newUser->expects($this->once())
            ->method('setFullName')
            ->with($fullName = 'User Full Name');

        $this->assertSame($newUser, $sut->loadUserByIdentifier($email, ['full_name'=> $fullName]));
    }

    public function testRefreshUser(): void
    {
        $sut = $this->sut;
        $users = $this->users;
        $user = $this->createMock(UserInterface::class);

        $users->expects($this->once())
            ->method('refresh')
            ->with($user);

        $sut->refreshUser($user);
    }

    public function testSupportsClass(): void
    {
        $this->assertTrue($this->sut->supportsClass(User::class));
    }
}
