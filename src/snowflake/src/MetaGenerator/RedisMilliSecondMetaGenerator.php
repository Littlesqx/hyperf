<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace Hyperf\Snowflake\MetaGenerator;

use Hyperf\Contract\ConfigInterface;
use Hyperf\Snowflake\ConfigurationInterface;

class RedisMilliSecondMetaGenerator extends RedisMetaGenerator
{
    public function __construct(ConfigurationInterface $configuration, int $beginTimestamp = self::DEFAULT_BEGIN_SECOND, ConfigInterface $config)
    {
        parent::__construct($configuration, $beginTimestamp * 1000, $config);
    }

    public function getTimestamp(): int
    {
        return intval(microtime(true) * 1000);
    }

    public function getNextTimestamp(): int
    {
        $timestamp = $this->getTimestamp();
        while ($timestamp <= $this->lastTimestamp) {
            $timestamp = $this->getTimestamp();
        }

        return $timestamp;
    }
}
