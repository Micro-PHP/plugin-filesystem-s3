<?php

namespace Micro\Plugin\Filesystem\Adapter\Aws;

use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\AbstractPlugin;
use Micro\Plugin\Filesystem\Adapter\Aws\Business\Adapter\AdapterFactory;
use Micro\Plugin\Filesystem\Adapter\Aws\Configuration\FilesystemS3AdapterPluginConfigurationInterface;
use Micro\Plugin\Filesystem\Adapter\Aws\Decorator\AwsFilesystemFacadeDecorator;
use Micro\Plugin\Filesystem\Business\Adapter\AdapterFactoryInterface;
use Micro\Plugin\Filesystem\Business\FS\FsFactory;
use Micro\Plugin\Filesystem\Business\FS\FsFactoryInterface;
use Micro\Plugin\Filesystem\Facade\FilesystemFacadeInterface;

/**
 * @method FilesystemS3AdapterPluginConfigurationInterface configuration()
 */
class FilesystemS3AdapterPlugin extends AbstractPlugin
{
    /**
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {
        $container->decorate(FilesystemFacadeInterface::class, function (
            FilesystemFacadeInterface $filesystemFacade
        ): FilesystemFacadeInterface {
            return $this->createAwsFacadeDecorator($filesystemFacade);
        });
    }

    /**
     * @return AdapterFactoryInterface
     */
    protected function createAdapterFactory(): AdapterFactoryInterface
    {
        return new AdapterFactory();
    }

    /**
     * @return FsFactoryInterface
     */
    protected function createFilesystemFactory(): FsFactoryInterface
    {
        return new FsFactory(
            $this->configuration(),
            $this->createAdapterFactory(),
        );
    }

    /**
     * @param FilesystemFacadeInterface $filesystemFacade
     *
     * @return FilesystemFacadeInterface
     */
    protected function createAwsFacadeDecorator(FilesystemFacadeInterface $filesystemFacade): FilesystemFacadeInterface
    {
        return new AwsFilesystemFacadeDecorator(
            $filesystemFacade,
            $this->createFilesystemFactory(),
            $this->configuration(),
        );
    }
}