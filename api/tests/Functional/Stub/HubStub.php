<?php

namespace Purus\Tests\Functional\Stub;

use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Jwt\LcobucciFactory;
use Symfony\Component\Mercure\Jwt\StaticTokenProvider;
use Symfony\Component\Mercure\Jwt\TokenFactoryInterface;
use Symfony\Component\Mercure\Jwt\TokenProviderInterface;
use Symfony\Component\Mercure\Update;
use function Symfony\Component\DependencyInjection\Loader\Configurator\env;

class HubStub implements HubInterface
{
    public function publish(Update $update): string
    {
        return 'id';
    }

    public function getUrl(): string
    {
        return 'http://internal/.well-known/mercure';
    }

    public function getPublicUrl(): string
    {
        return 'http://internal/.well-known/mercure';
    }

    public function getProvider(): TokenProviderInterface
    {
        return new StaticTokenProvider(env('MERCURE_JWT_SECRET'));
    }

    public function getFactory(): ?TokenFactoryInterface
    {
        return new LcobucciFactory(env('MERCURE_JWT_SECRET'));
    }
}
