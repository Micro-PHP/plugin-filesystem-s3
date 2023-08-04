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

namespace Micro\Plugin\FilesystemAdapter\Aws;

use Micro\Plugin\FilesystemAdapter\Aws\Configuration\Adapter\AwsS3AdapterConfiguration;
use Micro\Plugin\FilesystemAdapter\Aws\Configuration\FilesystemS3AdapterPluginConfigurationInterface;
use Micro\Plugin\Filesystem\Configuration\Adapter\FilesystemAdapterConfigurationInterface;
use Micro\Plugin\Filesystem\FilesystemPluginConfiguration;

class FilesystemS3AdapterPluginConfiguration extends FilesystemPluginConfiguration implements FilesystemS3AdapterPluginConfigurationInterface
{
    public function getAdapterConfiguration(string $adapterName): FilesystemAdapterConfigurationInterface
    {
        return new AwsS3AdapterConfiguration($this->configuration, $adapterName);
    }
}
