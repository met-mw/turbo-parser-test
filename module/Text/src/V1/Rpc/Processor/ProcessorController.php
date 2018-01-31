<?php
namespace Text\V1\Rpc\Processor;

use Text\Service\TextService;
use Zend\Mvc\Controller\AbstractActionController;
use ZF\ContentNegotiation\ViewModel;

class ProcessorController extends AbstractActionController
{
    /** @var TextService */
    private $textService;

    public function __construct(TextService $textService)
    {
        $this->textService = $textService;
    }

    public function getService()
    {
        return $this->textService;
    }

    public function processorAction()
    {
        $requestBody = $this->getRequest()->getContent();
        $requestBody = json_decode($requestBody, true);

        $errors = [];
        if (!$requestBody || !isset($requestBody['job'])) {
            $errors[] = 'Unknown job';
        }

        if (!isset($requestBody['job']['text'])) {
            $errors[] = 'Need text';
        }

        if (!isset($requestBody['job']['methods'])) {
            $errors[] = 'Need methods';
        }

        if (!empty($errors)) {
            return new ViewModel(['error' => $errors]);
        }

        // Никаких обработок не ставлю, т.к. в БД всё-равно ничего не складываем, инъекция неуместна
        $text = $requestBody['job']['text'];
        $methods = $requestBody['job']['methods'];

        return new ViewModel(['text' => $this->getService()->getProcessor()->process($text, $methods)]);
    }
}
