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
     * @return array<string, string>
     */
    public function getUserAgentParameters(): array;

    /**
     * @return bool
     */
    public function isUseSharedConfigFile(): bool;

    /**
     * @return bool
     */
    public function getValidatorOptionRequired(): bool;

    /**
     * @return int
     */
    public function getValidatorOptionMin(): int;

    /**
     * @return int
     */
    public function getValidatorOptionMax(): int;

    /**
     * @return string|null
     */
    public function getValidatorOptionPattern(): null|string;

    /**
     * @return string
     */
    public function getVersion(): string;
}
