<?php
namespace Text\Factory\Service;

use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Text\Helper\Processor;
use Text\Service\TextService;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class TextServiceFactory
 */
class TextServiceFactory implements FactoryInterface
{
    /**
     * Create an object
     *
     * @param  ContainerInterface $container
     * @param  string $requestedName
     * @param  null|array $options
     * @return TextService
     * @throws ServiceNotFoundException if unable to resolve the service.
     * @throws ServiceNotCreatedException if an exception is raised when creating a service.
     * @throws ContainerException if any other error occurs
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $processor = new Processor();
        $service = new TextService($processor);

        return $service;
    }
}
