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

namespace Micro\Plugin\FilesystemAdapter\Aws\Configuration\Adapter;

use Micro\Plugin\Filesystem\Configuration\Adapter\AbstractFilesystemAdapterConfiguration;

class AwsS3AdapterConfiguration extends AbstractFilesystemAdapterConfiguration implements AwsS3AdapterConfigurationInterface
{
    public const CFG_BUCKET = 'MICRO_FS_%s_BUCKET';
    public const CFG_REGION = 'MICRO_FS_%s_REGION';
    public const CFG_RETRIES = 'MICRO_FS_%s_RETRIES';
    public const CFG_SCHEME = 'MICRO_FS_%s_SCHEME';
    public const CFG_SIGNATURE_VERSION = 'MICRO_FS_%s_SIGNATURE_VERSION';
    public const CFG_IS_USE_SHARED_CONFIG = 'MICRO_FS_%s_IS_USE_SHARED_CONFIG';
    public const CFG_VALIDATOR_OPT_REQUIRED = 'MICRO_FS_%s_VALIDATE_REQUIRED';
    public const CFG_VALIDATOR_OPT_MIN = 'MICRO_FS_%s_VALIDATE_MIN';
    public const CFG_VALIDATOR_OPT_MAX = 'MICRO_FS_%s_VALIDATE_MAX';
    public const CFG_VALIDATOR_OPT_PATTERN = 'MICRO_FS_%s_VALIDATE_PATTERN';
    public const CFG_VERSION = 'MICRO_FS_%s_VERSION';
    public const CFG_KEY_SECRET = 'MICRO_FS_%s_KEY_SECRET';
    public const CFG_KEY_ACCESS = 'MICRO_FS_%s_KEY_ACCESS';
    public const CFG_ENDPOINT = 'MICRO_FS_%s_ENDPOINT';

    public function getEndpoint(): null|string
    {
        return $this->get(self::CFG_ENDPOINT);
    }

    public function getRegion(): string
    {
        return (string) $this->get(self::CFG_REGION, null, false);
    }

    public function getRetries(): int
    {
        return (int) $this->get(self::CFG_RETRIES, 3);
    }

    public function getScheme(): string
    {
        return (string) $this->get(self::CFG_SCHEME, 'https');
    }

    public function getSignatureVersion(): string
    {
        return (string) $this->get(self::CFG_SIGNATURE_VERSION, 'v4');
    }

    public function getUserAgentParameters(): array
    {
        return [];
    }

    public function isUseSharedConfigFile(): bool
    {
        return (bool) $this->get(self::CFG_IS_USE_SHARED_CONFIG, true);
    }

    public function getValidatorOptionRequired(): bool
    {
        return (bool) $this->get(self::CFG_VALIDATOR_OPT_REQUIRED, false);
    }

    public function getValidatorOptionMin(): int
    {
        return (int) $this->get(self::CFG_VALIDATOR_OPT_MIN, 0);
    }

    public function getValidatorOptionMax(): int
    {
        return (int) $this->get(self::CFG_VALIDATOR_OPT_MAX, 0);
    }

    public function getValidatorOptionPattern(): null|string
    {
        return $this->get(self::CFG_VALIDATOR_OPT_PATTERN);
    }

    public function getVersion(): string
    {
        return $this->get(self::CFG_VERSION, 'latest', false);
    }

    public function getBucket(): string
    {
        return $this->get(self::CFG_BUCKET, null, false);
    }

    public function getKeyAccess(): string
    {
        return $this->get(self::CFG_KEY_ACCESS, null, false);
    }

    public function getKeySecret(): string
    {
        return $this->get(self::CFG_KEY_SECRET, null, false);
    }
}
