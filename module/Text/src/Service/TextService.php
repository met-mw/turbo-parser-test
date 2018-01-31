<?php
namespace Text\Service;

use Text\Helper\Processor;

class TextService
{
    /** @var Processor */
    private $textProcessor;

    /**
     * TextService constructor.
     * @param Processor $textProcessor
     */
    public function __construct(Processor $textProcessor)
    {
        $this->textProcessor = $textProcessor;
    }

    public function getProcessor()
    {
        return $this->textProcessor;
    }
}