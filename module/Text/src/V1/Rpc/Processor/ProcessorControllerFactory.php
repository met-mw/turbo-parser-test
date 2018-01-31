<?php
namespace Text\V1\Rpc\Processor;

use Text\Service\TextService;

class ProcessorControllerFactory
{
    public function __invoke($controllers)
    {
        $textService = $controllers->get(TextService::class);
        return new ProcessorController($textService);
    }
}
