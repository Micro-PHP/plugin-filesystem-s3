<?php

namespace Micro\Plugin\Filesystem\Adapter\Aws\Configuration\Adapter;

use Micro\Plugin\Filesystem\Configuration\Adapter\FilesystemAdapterConfigurationInterface;

interface AwsS3AdapterConfigurationInterface extends FilesystemAdapterConfigurationInterface
{
    /**
     * @return string|null
     */
    public function getEndpoint(): null|string;

    /**
     * @return string
     */
    public function getKeyAccess(): string;

    /**
     * @return string
     */
    public function getKeySecret(): string;

    /**
     * @return string
     */
    public function getBucket(): string;

    /**
     * @return string|null
     */
    public function getService(): null|string;

    /**
     * @return string
     */
    public function getProfile(): string;

    /**
     * @return string
     */
    public function getRegion(): string;

    /**
     * @return int
     */
    public function getRetries(): int;

    /**
     * @return string
     */
    public function getScheme(): string;

    /**
     * @return string
     */
    public function getSignatureVersion(): string;

    /**
     * @return array
     */
    public function getUserAgentParameters(): array;

    /**
     * @return bool
     */
    public function isUseSharedConfigFile(): bool;

    /**
     * @return bool
     */
    public function isValidate(): bool;

    /**
     * @return bool
     */
    public function getValidatorOptionRequired(): bool;

    /**
     * @return int|null
     */
    public function getValidatorOptionMin(): null|int;

    /**
     * @return int|null
     */
    public function getValidatorOptionMax(): null|int;

    /**
     * @return string|null
     */
    public function getValidatorOptionPattern(): null|string;

    /**
     * @return string
     */
    public function getVersion(): string;


}