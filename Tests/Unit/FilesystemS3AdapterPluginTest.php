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

namespace Micro\Plugin\FilesystemAdapter\Aws\Tests\Unit;

use League\Flysystem\FilesystemOperator;
use Micro\Framework\KernelApp\AppKernel;
use Micro\Plugin\FilesystemAdapter\Aws\FilesystemS3AdapterPlugin;
use Micro\Plugin\Filesystem\Facade\FilesystemFacadeInterface;
use PHPUnit\Framework\TestCase;

class FilesystemS3AdapterPluginTest extends TestCase
{
    public function testPlugin()
    {
        $kernel = new AppKernel(
            [
                'MICRO_FS_DEFAULT_TYPE' => 'aws_s3',
                'MICRO_FS_DEFAULT_KEY_ACCESS' => 'access-key',
                'MICRO_FS_DEFAULT_KEY_SECRET' => 'secret-key',
                'MICRO_FS_DEFAULT_REGION' => 'us-west',
                'MICRO_FS_DEFAULT_BUCKET' => 'test-bucket',
            ],
            [
                FilesystemS3AdapterPlugin::class,
            ]
        );

        $kernel->run();
        /** @var FilesystemFacadeInterface $facade */
        $facade = $kernel->container()->get(FilesystemFacadeInterface::class);
        $operator = $facade->createFsOperator('default');

        $this->assertInstanceOf(FilesystemOperator::class, $operator);
    }
}
