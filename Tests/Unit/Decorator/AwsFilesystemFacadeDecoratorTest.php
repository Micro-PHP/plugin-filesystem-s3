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

namespace Micro\Plugin\FilesystemAdapter\Aws\Tests\Unit\Decorator;

use Micro\Plugin\FilesystemAdapter\Aws\Configuration\FilesystemS3AdapterPluginConfigurationInterface;
use Micro\Plugin\FilesystemAdapter\Aws\Decorator\AwsFilesystemFacadeDecorator;
use Micro\Plugin\Filesystem\Business\FS\FsFactoryInterface;
use Micro\Plugin\Filesystem\Facade\FilesystemFacadeInterface;
use PHPUnit\Framework\TestCase;

class AwsFilesystemFacadeDecoratorTest extends TestCase
{
    public function testDecorator()
    {
        $decorated = $this->createMock(FilesystemFacadeInterface::class);
        $decorated
            ->expects($this->once())
            ->method('createFsOperator')
            ->with('test');

        $fsFactory = $this->createMock(FsFactoryInterface::class);
        $pluginCfg = $this->createMock(FilesystemS3AdapterPluginConfigurationInterface::class);
        $decorator = new AwsFilesystemFacadeDecorator($decorated, $fsFactory, $pluginCfg);

        $decorator->createFsOperator('test');
    }
}
