<?php

namespace Prokl\CollectionExtenderBundle\Tests\Extenders;

use Prokl\CollectionExtenderBundle\Services\Extenders\Recursive;
use Illuminate\Support\Collection;
use Prokl\TestingTools\Base\BaseTestCase;

/**
 * Class RecursiveTest
 * @package Tests\Services
 * @coversDefaultClass Recursive
 *
 * @since 18.09.2020
 */
class RecursiveTest extends BaseTestCase
{
    /**
     * @var Recursive $obTestObject Тестируемый объект.
     */
    protected $obTestObject;

    /**
     * Recursive.
     *
     * @dataProvider dataProviderFixtures
     *
     * @param $values
     *
     * @return void
     */
    public function testRecursive($values): void
    {
        $collection = collect($values['fixture']);

        $result = $collection->recursive();

        $this->assertInstanceOf(
            Collection::class,
            $result[0]->get('nested'),
            'Неправильный ответ.'
        );
    }

    /**
     * Датапровайдер расширителей Collections.
     *
     * @return array
     */
    public function dataProviderFixtures(): array
    {
        return [
            [
                [
                    'fixture' => [
                        [
                            'PROPERTY_PDF_VALUE' => 'value',
                            'b' => 'value',
                            'c' => 'value',
                            'nested' => [
                                'test' => 'test',
                            ],

                            [
                                'PROPERTY_PDF_VALUE' => 'value2',
                                'b' => 'value',
                                'c' => 'value',
                            ],
                        ],
                    ],
                ],
            ],
        ];
    }
}
