<?php
namespace TextTest\Helper;

use Text\Helper\Processor;
use Zend\Stdlib\ArrayUtils;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class ProcessorTest extends AbstractHttpControllerTestCase
{
    /** @var  Processor */
    protected $processor;

    public function setUp()
    {
        // The module configuration should still be applicable for tests.
        // You can override configuration here with test case specific values,
        // such as sample view templates, path stacks, module_listener_options,
        // etc.
        $configOverrides = [
            'module_listener_options' => [
                'config_cache_enabled' => false,
            ],
        ];

        $this->setApplicationConfig(ArrayUtils::merge(
            include __DIR__ . '/../../../../config/application.config.php',
            $configOverrides
        ));

        $this->processor = new Processor();

        parent::setUp();
    }

    public function testStripTags()
    {
        self::assertEquals('Test text', $this->processor->stripTags('Test <p>text</p>'), 'Tags not stripped');
    }

    public function testRemoveSpaces()
    {
        self::assertEquals('Testtext', $this->processor->removeSpaces('Test text'), 'Spaces not removed');
    }

    public function testReplaceSpacesToEol()
    {
        self::assertEquals('Test' . PHP_EOL . 'text', $this->processor->replaceSpacesToEol('Test text'), 'Filed EOL');
    }

    public function testHtmlspecialchars()
    {
        self::assertEquals('Test&amp;text', $this->processor->htmlspecialchars('Test&text'), 'Special chars filed');
    }

    public function testRemoveSymbols()
    {
        self::assertEquals('Testtext', $this->processor->removeSymbols('Test[.,/!@#$%&*()]text'), 'Symbols not removed');
    }

    public function testToNumber()
    {
        self::assertEquals('10', $this->processor->toNumber('Test 10 text'), 'Number not found');
    }

    public function testProcess()
    {
        self::assertEquals('10', $this->processor->process('Test 10 . <p>a</p> text', ['removeSymbols', 'stripTags', 'toNumber']), 'Process filed');
    }
}
