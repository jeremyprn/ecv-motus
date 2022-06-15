<?php

declare(strict_types=1);

namespace App\Infra\Memory;

class DbSelector
{
    public static function getConnector(): ConnectorInterface
    {
        if (APP_ENV === 'dev') {
            return new WordsJson();
        }

        throw new \LogicException('db system not found');
    }
}
