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

namespace Micro\Plugin\Filesystem\Adapter\Aws\Decorator;

use League\Flysystem\FilesystemOperator;
use Micro\Plugin\Filesystem\Adapter\Aws\Configuration\FilesystemS3AdapterPluginConfigurationInterface;
use Micro\Plugin\Filesystem\Business\FS\FsFactoryInterface;
use Micro\Plugin\Filesystem\Configuration\FilesystemPluginConfigurationInterface;
use Micro\Plugin\Filesystem\Facade\FilesystemFacadeInterface;

class AwsFilesystemFacadeDecorator implements FilesystemFacadeInterface
{
    /**
     * @param FilesystemFacadeInterface              $filesystemFacade
     * @param FsFactoryInterface                     $fsFactory
     * @param FilesystemPluginConfigurationInterface $adapterConfiguration
     */
    public function __construct(
        private readonly FilesystemFacadeInterface $filesystemFacade,
        private readonly FsFactoryInterface $fsFactory,
        private readonly FilesystemPluginConfigurationInterface $adapterConfiguration
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function createFsOperator(string $adapterName = FilesystemPluginConfigurationInterface::ADAPTER_DEFAULT): FilesystemOperator
    {
        if (FilesystemS3AdapterPluginConfigurationInterface::ADAPTER_NAME !== $this->adapterConfiguration->getAdapterType($adapterName)) {
            return $this->filesystemFacade->createFsOperator($adapterName);
        }

        return $this->fsFactory->create($adapterName);
    }
}
