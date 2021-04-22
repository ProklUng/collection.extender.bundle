<?php

namespace Prokl\CollectionExtenderBundle\Tests\Extenders;

use Prokl\CollectionExtenderBundle\Services\Extenders\Contains;
use Prokl\TestingTools\Base\BaseTestCase;

/**
 * Class RecursiveTest
 * @package Tests\Services
 * @coversDefaultClass Contains
 *
 * @since 20.09.2020
 */
class ContainsTest extends BaseTestCase
{
    /**
     * @var Contains $obTestObject Тестируемый объект.
     */
    protected $obTestObject;

    /**
     * ContainsAll.
     *
     * @dataProvider dataProviderContainsAll
     *
     * @param $values
     *
     * @return void
     */
    public function testContainsAll($values): void
    {
        $collection = collect([1, 2, 3]);

        $result = $collection->containsAll($values['fixture']);

        $this->assertSame(
            $values['expected'],
            $result,
            'Неправильный ответ.'
        );
    }

    /**
     * ContainsAny.
     *
     * @dataProvider dataProviderContainsAny
     *
     * @param $values
     *
     * @return void
     */
    public function testContainsAny($values): void
    {
        $collection = collect([1, 2, 3]);

        $result = $collection->containsAny($values['fixture']);

        $this->assertSame(
            $values['expected'],
            $result,
            'Неправильный ответ.'
        );
    }

    /**
     * ContainsAny.
     *
     * @dataProvider dataProviderHasAny
     *
     * @param $values
     *
     * @return void
     */
    public function testHasAny($values): void
    {
        $collection = collect(['name' => 'john doe', 'age' => 32]);

        $result = $collection->hasAny($values['fixture']);

        $this->assertSame(
            $values['expected'],
            $result,
            'Неправильный ответ.'
        );
    }

    /**
     * Датапровайдер макроса ContainsAll.
     *
     * @return array
     */
    public function dataProviderContainsAll(): array
    {
        return [
            [
                [
                    'expected' => true,
                    'fixture' => [1, 2],
                ],
            ],

            [
                [
                    'expected' => true,
                    'fixture' => collect([1, 2]),
                ],
            ],

            [
                [
                    'expected' => true,
                    'fixture' => [3, 2],
                ],
            ],

            [
                [
                    'expected' => false,
                    'fixture' => [4, 2],
                ],
            ],

            [
                [
                    'expected' => false,
                    'fixture' => collect([4, 2]),
                ],
            ],
        ];
    }

    /**
     * Датапровайдер макроса ContainsAny.
     *
     * @return array
     */
    public function dataProviderContainsAny(): array
    {
        return [
            [
                [
                    'expected' => true,
                    'fixture' => [1, 2],
                ],
            ],

            [
                [
                    'expected' => true,
                    'fixture' => collect([1, 2]),
                ],
            ],

            [
                [
                    'expected' => true,
                    'fixture' => [1, 4],
                ],
            ],

            [
                [
                    'expected' => false,
                    'fixture' => [14, 12],
                ],
            ],

            [
                [
                    'expected' => false,
                    'fixture' => collect([14, 12]),
                ],
            ],
        ];
    }

    /**
     * Датапровайдер макроса HasAny.
     *
     * @return array
     */
    public function dataProviderHasAny(): array
    {
        return [
            [
                [
                    'expected' => true,
                    'fixture' => ['name', 'firstName', 'lastName', 'test'],
                ],
            ],

            [
                [
                    'expected' => true,
                    'fixture' => collect(['name', 'firstName', 'lastName', 'test']),
                ],
            ],

            [
                [
                    'expected' => false,
                    'fixture' => ['no', 'yes', 'xdo', 'test'],
                ],
            ],

            [
                [
                    'expected' => false,
                    'fixture' => collect(['no', 'yes', 'xdo', 'test']),
                ],
            ],
        ];
    }
}
