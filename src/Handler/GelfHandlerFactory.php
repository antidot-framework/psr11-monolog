<?php
declare(strict_types=1);

namespace WShafer\PSR11MonoLog\Handler;

use Gelf\PublisherInterface;
use Monolog\Handler\GelfHandler;
use Monolog\Logger;
use WShafer\PSR11MonoLog\ContainerAwareInterface;
use WShafer\PSR11MonoLog\Exception\MissingConfigException;
use WShafer\PSR11MonoLog\Exception\MissingServiceException;
use WShafer\PSR11MonoLog\FactoryInterface;
use WShafer\PSR11MonoLog\ServiceTrait;

class GelfHandlerFactory implements FactoryInterface, ContainerAwareInterface
{
    use ServiceTrait;

    public function __invoke(array $options)
    {
        $publisher = $this->getService($options['publisher'] ?? mull);
        $level     = (int)     ($options['level']     ?? Logger::DEBUG);
        $bubble    = (boolean) ($options['bubble']    ?? true);

        return new GelfHandler(
            $publisher,
            $level,
            $bubble
        );
    }
}
