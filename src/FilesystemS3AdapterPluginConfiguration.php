<?php

namespace Micro\Plugin\Filesystem\Adapter\Aws;

use Micro\Plugin\Filesystem\Adapter\Aws\Configuration\Adapter\AwsS3AdapterConfiguration;
use Micro\Plugin\Filesystem\Adapter\Aws\Configuration\FilesystemS3AdapterPluginConfigurationInterface;
use Micro\Plugin\Filesystem\Configuration\Adapter\FilesystemAdapterConfigurationInterface;
use Micro\Plugin\Filesystem\FilesystemPluginConfiguration;

class FilesystemS3AdapterPluginConfiguration extends FilesystemPluginConfiguration implements FilesystemS3AdapterPluginConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getAdapterConfiguration(string $adapterName): FilesystemAdapterConfigurationInterface
    {
        return new AwsS3AdapterConfiguration($this->configuration, $adapterName);
    }
}