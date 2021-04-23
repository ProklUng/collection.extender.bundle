<?php

namespace Tests\Extenders;

use Prokl\CollectionExtenderBundle\Services\Extenders\FilterByField;
use Prokl\TestingTools\Base\BaseTestCase;

/**
 * Class FilterByFieldTest
 * @package Tests\Extenders
 * @coversDefaultClass FilterByField
 *
 * @since 25.09.2020
 */
class FilterByFieldTest extends BaseTestCase
{
    /**
     * @var FilterByField $obTestObject Тестируемый объект.
     */
    protected $obTestObject;

    /**
     * @inheritDoc
     */
    protected function setUp(): void
    {
        parent::setUp();

        $extender = new FilterByField();
        $extender->registerMacro();
    }

    /**
     * Ключи.
     *
     * @dataProvider dataProviderFixtures
     *
     * @param $values
     *
     * @return void
     */
    public function testArrayHasSearchedKey($values): void
    {
        $result = $values['fixture']->filterField($values['field'], $values['value']);

        $this->assertSame(
            $values['expected'],
            $result->toArray(),
            'Error '.$values['key'].' - '.$values['value']
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
            'ok' => [
                [
                    'fixture' => collect([
                        [
                            'user' => 'fake',
                            'data' => [1, 2, 3],
                        ],

                        [
                            'user' => 'John Dow',
                            'data' => [1, 2, 3],
                        ],

                    ]),

                    'field' => 'user',
                    'value' => 'fake',

                    'expected' => [
                        [
                            'user' => 'fake',
                            'data' => [1, 2, 3],
                        ],
                    ],
                ],
            ],

            'value_not_exist' => [
                [
                    'fixture' => collect([
                        [
                            'user' => 'fake',
                            'data' => [1, 2, 3],
                        ],

                        [
                            'user' => 'John Dow',
                            'data' => [1, 2, 3],
                        ],

                    ]),

                    'field' => 'user',
                    'value' => 'roads',

                    'expected' => [],
                ],
            ],
            'field_not_exist' => [
                [
                    'fixture' => collect([
                        [
                            'user' => 'fake',
                            'data' => [1, 2, 3],
                        ],

                        [
                            'user' => 'John Dow',
                            'data' => [1, 2, 3],
                        ],

                    ]),

                    'field' => 'fake_field',
                    'value' => 'fake',

                    'expected' => [],
                ],
            ],

            'null_value' => [
                [
                    'fixture' => collect([
                        [
                            'user' => 'fake',
                            'data' => [1, 2, 3],
                        ],

                        [
                            'user' => 'John Dow',
                            'data' => [1, 2, 3],
                        ],

                    ]),

                    'field' => 'fake_field',
                    'value' => null,

                    'expected' => [],
                ],
            ],
        ];
    }
}
