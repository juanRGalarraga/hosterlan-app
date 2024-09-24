<?php

namespace App\Logging;
use Illuminate\Log\Logger;
use Monolog\Formatter\LineFormatter;

class CustomizeFormatter {

    public function __invoke(Logger $logger): void
    {
        foreach ($logger->getHandlers() as $handler) {

            $handler->setFormatter(new LineFormatter(
                '[%datetime%] %channel%.%level_name%: %message% %context% %extra%' . PHP_EOL,
                'Y-m-d H:i:s',
                true,
                true,
                true
            ));

        }
    }

}