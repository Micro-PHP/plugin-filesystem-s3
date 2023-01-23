<?php

declare(strict_types=1);

/*
 *  This file is part of the Micro framework package.
 *
 *  (c) Stanislau Komar <kost@micro-php.net>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace Micro\Plugin\Filesystem\Adapter\Aws\Test\Unit\Business\Adapter;

use Micro\Plugin\Filesystem\Adapter\Aws\Business\Adapter\AdapterFactory;
use Micro\Plugin\Filesystem\Configuration\Adapter\FilesystemAdapterConfigurationInterface;
use PHPUnit\Framework\TestCase;

class AdapterFactoryTest extends TestCase
{
    public function testCreateWithInvalidConfig()
    {
        $adapterFactory = new AdapterFactory();
        $this->expectException(\InvalidArgumentException::class);
        $adapterFactory->create($this->createMock(FilesystemAdapterConfigurationInterface::class));
    }
}
