<?php

namespace Micro\Plugin\Filesystem\Adapter\Aws\Decorator;

use League\Flysystem\FilesystemOperator;
use Micro\Plugin\Filesystem\Adapter\Aws\Configuration\FilesystemS3AdapterPluginConfigurationInterface;
use Micro\Plugin\Filesystem\Business\FS\FsFactoryInterface;
use Micro\Plugin\Filesystem\Configuration\FilesystemPluginConfigurationInterface;
use Micro\Plugin\Filesystem\Facade\FilesystemFacadeInterface;

class AwsFilesystemFacadeDecorator implements FilesystemFacadeInterface
{
    /**
     * @param FilesystemFacadeInterface $filesystemFacade
     * @param FsFactoryInterface $fsFactory
     * @param FilesystemPluginConfigurationInterface $adapterConfiguration
     */
    public function __construct(
        private readonly FilesystemFacadeInterface $filesystemFacade,
        private readonly FsFactoryInterface $fsFactory,
        private readonly FilesystemPluginConfigurationInterface $adapterConfiguration
    )
    {
    }

    /**
     * {@inheritDoc}
     */
    public function createFsOperator(string $adapterName = FilesystemPluginConfigurationInterface::ADAPTER_DEFAULT): FilesystemOperator
    {
        if($this->adapterConfiguration->getAdapterType($adapterName) !== FilesystemS3AdapterPluginConfigurationInterface::ADAPTER_NAME) {
            return $this->filesystemFacade->createFsOperator($adapterName);
        }

        return $this->fsFactory->create($adapterName);
    }
}