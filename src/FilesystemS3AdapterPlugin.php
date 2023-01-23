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

namespace Micro\Plugin\Filesystem\Adapter\Aws;

use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\ConfigurableInterface;
use Micro\Framework\Kernel\Plugin\DependencyProviderInterface;
use Micro\Framework\Kernel\Plugin\PluginConfigurationTrait;
use Micro\Framework\Kernel\Plugin\PluginDependedInterface;
use Micro\Plugin\Filesystem\Adapter\Aws\Business\Adapter\AdapterFactory;
use Micro\Plugin\Filesystem\Adapter\Aws\Configuration\FilesystemS3AdapterPluginConfigurationInterface;
use Micro\Plugin\Filesystem\Adapter\Aws\Decorator\AwsFilesystemFacadeDecorator;
use Micro\Plugin\Filesystem\Business\Adapter\AdapterFactoryInterface;
use Micro\Plugin\Filesystem\Business\FS\FsFactory;
use Micro\Plugin\Filesystem\Business\FS\FsFactoryInterface;
use Micro\Plugin\Filesystem\Facade\FilesystemFacadeInterface;
use Micro\Plugin\Filesystem\FilesystemPlugin;

/**
 * @method FilesystemS3AdapterPluginConfigurationInterface configuration()
 */
class FilesystemS3AdapterPlugin implements DependencyProviderInterface, ConfigurableInterface, PluginDependedInterface
{
    use PluginConfigurationTrait;

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

    public function getDependedPlugins(): iterable
    {
        return [
            FilesystemPlugin::class,
        ];
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
