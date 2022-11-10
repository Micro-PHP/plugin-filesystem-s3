<?php

namespace Micro\Plugin\Filesystem\Adapter\Aws\Configuration;

use Micro\Plugin\Filesystem\Configuration\FilesystemPluginConfigurationInterface;

interface FilesystemS3AdapterPluginConfigurationInterface extends FilesystemPluginConfigurationInterface
{
    public const ADAPTER_NAME = 'aws_s3';
}