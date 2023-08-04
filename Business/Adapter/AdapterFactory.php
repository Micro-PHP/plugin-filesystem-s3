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

namespace Micro\Plugin\FilesystemAdapter\Aws\Business\Adapter;

use Aws\S3\S3Client;
use League\Flysystem\AwsS3V3\AwsS3V3Adapter;
use League\Flysystem\FilesystemAdapter;
use Micro\Plugin\FilesystemAdapter\Aws\Configuration\Adapter\AwsS3AdapterConfigurationInterface;
use Micro\Plugin\Filesystem\Business\Adapter\AdapterFactoryInterface;
use Micro\Plugin\Filesystem\Configuration\Adapter\FilesystemAdapterConfigurationInterface;

class AdapterFactory implements AdapterFactoryInterface
{
    public function create(FilesystemAdapterConfigurationInterface $adapterConfiguration): FilesystemAdapter
    {
        if (!($adapterConfiguration instanceof AwsS3AdapterConfigurationInterface)) {
            throw new \InvalidArgumentException(sprintf('Adapter configuration should be instance of %s.', AwsS3AdapterConfigurationInterface::class));
        }

        // TODO:
        // validate ['required, min, max, pattern]
        // signature_version service retries

        $clientOptions = [
            'version' => $adapterConfiguration->getVersion(),
            'region' => $adapterConfiguration->getRegion(),
            'use_aws_shared_config_files' => $adapterConfiguration->isUseSharedConfigFile(),
            'use_path_style_endpoint' => true,
            'ua_append' => $adapterConfiguration->getUserAgentParameters(),
            'scheme' => $adapterConfiguration->getScheme(),
            'retries' => $adapterConfiguration->getRetries(),
            'endpoint' => $adapterConfiguration->getEndpoint(),
            'signature_version' => $adapterConfiguration->getSignatureVersion(),
            'validate' => $this->createValidateOptions($adapterConfiguration),
            'credentials' => [
                'key' => $adapterConfiguration->getKeyAccess(),
                'secret' => $adapterConfiguration->getKeySecret(),
            ],
        ];

        $client = new S3Client(array_filter($clientOptions));

        return new AwsS3V3Adapter(
            $client,
            $adapterConfiguration->getBucket(),
        );
    }

    /**
     * @param AwsS3AdapterConfigurationInterface $adapterConfiguration
     *
     * @return array<string|mixed>
     */
    protected function createValidateOptions(AwsS3AdapterConfigurationInterface $adapterConfiguration): array
    {
        $validateOptions = [
            'required' => $adapterConfiguration->getValidatorOptionRequired(),
            'min' => $adapterConfiguration->getValidatorOptionMin(),
            'max' => $adapterConfiguration->getValidatorOptionMax(),
            'pattern' => $adapterConfiguration->getValidatorOptionPattern(),
        ];

        return array_filter($validateOptions);
    }
}
