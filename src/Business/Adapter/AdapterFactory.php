<?php

namespace Micro\Plugin\Filesystem\Adapter\Aws\Business\Adapter;

use Aws\S3\S3Client;
use League\Flysystem\AwsS3V3\AwsS3V3Adapter;
use League\Flysystem\FilesystemAdapter;
use Micro\Plugin\Filesystem\Adapter\Aws\Configuration\Adapter\AwsS3AdapterConfigurationInterface;
use Micro\Plugin\Filesystem\Business\Adapter\AdapterFactoryInterface;
use Micro\Plugin\Filesystem\Configuration\Adapter\FilesystemAdapterConfigurationInterface;

class AdapterFactory implements AdapterFactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function create(FilesystemAdapterConfigurationInterface $adapterConfiguration): FilesystemAdapter
    {
        if(!($adapterConfiguration instanceof AwsS3AdapterConfigurationInterface)) {
            throw new \LogicException(
                sprintf('Adapter configuration should be instance of %s.', AwsS3AdapterConfigurationInterface::class)
            );
        }
        // TODO:
        //validate ['required, min, max, pattern]
        // signature_version service retries

        $clientOptions = [
            'version'   => $adapterConfiguration->getVersion(),
            'region'    => $adapterConfiguration->getRegion(),
            'use_aws_shared_config_files' => $adapterConfiguration->isUseSharedConfigFile(),
            'use_path_style_endpoint'   => true,
            'ua_append' => $adapterConfiguration->getUserAgentParameters(),
            'scheme'    => $adapterConfiguration->getScheme(),
            'credentials'   => [
                'key' => $adapterConfiguration->getKeyAccess(),
                'secret' => $adapterConfiguration->getKeySecret(),
            ]
        ];

        $endpoint = $adapterConfiguration->getEndpoint();
        if($endpoint !== null) {
            $clientOptions['endpoint'] = $endpoint;
        }

        $client = new S3Client($clientOptions);

        return new AwsS3V3Adapter(
            $client,
            $adapterConfiguration->getBucket(),
        );
    }
}