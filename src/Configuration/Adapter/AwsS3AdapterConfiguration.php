<?php

namespace Micro\Plugin\Filesystem\Adapter\Aws\Configuration\Adapter;

use Micro\Plugin\Filesystem\Configuration\Adapter\AbstractFilesystemAdapterConfiguration;

class AwsS3AdapterConfiguration extends AbstractFilesystemAdapterConfiguration implements AwsS3AdapterConfigurationInterface
{
    public const CFG_SERVICE = 'MICRO_FS_%s_SERVICE';
    public const CFG_BUCKET = 'MICRO_FS_%s_BUCKET';
    public const CFG_PROFILE = 'MICRO_FS_%s_PROFILE';
    public const CFG_REGION = 'MICRO_FS_%s_REGION';
    public const CFG_RETRIES = 'MICRO_FS_%s_RETRIES';
    public const CFG_SCHEME = 'MICRO_FS_%s_SCHEME';
    public const CFG_SIGNATURE_VERSION = 'MICRO_FS_%s_SIGNATURE_VERSION';
    public const CFG_IS_USE_SHARED_CONFIG = 'MICRO_FS_%s_IS_USE_SHARED_CONFIG';
    public const CFG_VALIDATE = 'MICRO_FS_%s_IS_VALIDATE';
    public const CFG_VALIDATOR_OPT_REQUIRED = 'MICRO_FS_%s_VALIDATE_REQUIRED';
    public const CFG_VALIDATOR_OPT_MIN = 'MICRO_FS_%s_VALIDATE_MIN';
    public const CFG_VALIDATOR_OPT_MAX = 'MICRO_FS_%s_VALIDATE_MAX';
    public const CFG_VALIDATOR_OPT_PATTERN = 'MICRO_FS_%s_VALIDATE_PATTERN';
    public const CFG_VERSION = 'MICRO_FS_%s_VERSION';
    public const CFG_KEY_SECRET = 'MICRO_FS_%s_KEY_SECRET';
    public const CFG_KEY_ACCESS = 'MICRO_FS_%s_KEY_ACCESS';
    public const CFG_ENDPOINT = 'MICRO_FS_%s_ENDPOINT';

    /**
     * {@inheritDoc}
     */
    public function getEndpoint(): null|string
    {
        return $this->get(self::CFG_ENDPOINT);
    }

    /**
     * {@inheritDoc}
     */
    public function getService(): null|string
    {
        return $this->get(self::CFG_SERVICE);
    }

    /**
     * {@inheritDoc}
     */
    public function getProfile(): string
    {
        return (string) $this->get(self::CFG_PROFILE);
    }

    /**
     * {@inheritDoc}
     */
    public function getRegion(): string
    {
        return (string) $this->get(self::CFG_REGION);
    }

    /**
     * {@inheritDoc}
     */
    public function getRetries(): int
    {
        return (int) $this->get(self::CFG_RETRIES, 0);
    }

    /**
     * {@inheritDoc}
     */
    public function getScheme(): string
    {
        return (string) $this->get(self::CFG_SCHEME, 'https');
    }

    /**
     * {@inheritDoc}
     */
    public function getSignatureVersion(): string
    {
        return (string) $this->get(self::CFG_SIGNATURE_VERSION);
    }

    /**
     * {@inheritDoc}
     */
    public function getUserAgentParameters(): array
    {
        return [];
    }

    /**
     * {@inheritDoc}
     */
    public function isUseSharedConfigFile(): bool
    {
        return (bool) $this->get(self::CFG_IS_USE_SHARED_CONFIG, true);
    }

    /**
     * {@inheritDoc}
     */
    public function isValidate(): bool
    {
        return (bool) $this->get(self::CFG_VALIDATE, false);
    }

    /**
     * {@inheritDoc}
     */
    public function getValidatorOptionRequired(): bool
    {
        return (bool) $this->get(self::CFG_VALIDATOR_OPT_REQUIRED, false);
    }

    /**
     * {@inheritDoc}
     */
    public function getValidatorOptionMin(): null|int
    {
        $value = $this->get(self::CFG_VALIDATOR_OPT_MIN);
        if($value !== null) {
            return (int) $value;
        }

        return null;
    }

    /**
     * {@inheritDoc}
     */
    public function getValidatorOptionMax(): null|int
    {
        $value = $this->get(self::CFG_VALIDATOR_OPT_MAX);
        if($value !== null) {
            return (int) $value;
        }

        return null;
    }

    /**
     * {@inheritDoc}
     */
    public function getValidatorOptionPattern(): null|string
    {
        return $this->get(self::CFG_VALIDATOR_OPT_PATTERN);
    }

    /**
     * {@inheritDoc}
     */
    public function getVersion(): string
    {
         return $this->get(self::CFG_VERSION);
    }

    /**
     * {@inheritDoc}
     */
    public function getBucket(): string
    {
        return $this->get(self::CFG_BUCKET, null, false);
    }

    /**
     * {@inheritDoc}
     */
    public function getKeyAccess(): string
    {
        return $this->get(self::CFG_KEY_ACCESS, null, false);
    }

    /**
     * {@inheritDoc}
     */
    public function getKeySecret(): string
    {
        return $this->get(self::CFG_KEY_SECRET, null, false);
    }
}