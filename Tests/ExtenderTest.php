<?php

namespace Prokl\CollectionExtenderBundle\Tests;

use Prokl\CollectionExtenderBundle\Services\Extender;
use Prokl\CollectionExtenderBundle\Services\Extenders\ExtenderCollectionInterface;
use Mockery;
use Prokl\TestingTools\Base\BaseTestCase;

/**
 * Class ExtenderTest
 * @package Tests\Services
 * @coversDefaultClass Extender
 *
 * @since 16.09.2020
 */
class ExtenderTest extends BaseTestCase
{
    /**
     * @var Extender $obTestObject Тестируемый объект.
     */
    protected $obTestObject;

    /**
     * Register. Проверяется - выполняется ли метод registerMacro.
     *
     * @dataProvider dataProviderExtenders
     *
     * @param $extender
     *
     * @return void
     */
    public function testRegister($extender) : void
    {
        $this->obTestObject = new Extender($extender);

        $this->assertTrue(
            true
        );
    }

    /**
     * Register. Проверяется - не выполняется метод registerMacro при пустых параметрах.
     *
     * @return void
     */
    public function testEmptyParameters() : void
    {
        $this->obTestObject = new Extender();

        $this->obTestObject->register();

        $this->assertTrue(
            true
        );
    }

    /**
     * Датапровайдер расширителей Collections.
     *
     * @return array
     */
    public function dataProviderExtenders() : array
    {
        return [
          [$this->getMockExtenderCollectionInterface()],
          [$this->getMockExtenderCollectionInterface()],
          [
              $this->getMockExtenderCollectionInterface(),
              $this->getMockExtenderCollectionInterface(),
              $this->getMockExtenderCollectionInterface(),
          ]
        ];
    }

    /**
     * Мок ExtenderCollectionInterface.
     *
     * @return mixed
     */
    private function getMockExtenderCollectionInterface()
    {
        return Mockery::mock(
            ExtenderCollectionInterface::class
        )
            ->shouldReceive('registerMacro')
            ->once()
            ->getMock();
    }
}
