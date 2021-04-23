<?php

namespace Prokl\CollectionExtenderBundle\Tests\Extenders;

use Prokl\CollectionExtenderBundle\Services\Extenders\SortByExternalKeys;
use Prokl\TestingTools\Base\BaseTestCase;

/**
 * Class SortByExternalKeysTest
 * @package Tests\Services
 * @coversDefaultClass SortByExternalKeys
 *
 * @since 16.09.2020
 */
class SortByExternalKeysTest extends BaseTestCase
{
    /**
     * @var SortByExternalKeys $obTestObject Тестируемый объект.
     */
    protected $obTestObject;

    /**
     * @inheritDoc
     */
    protected function setUp(): void
    {
        parent::setUp();

        $extender = new SortByExternalKeys();
        $extender->registerMacro();
    }

    /**
     * SortByExternalKeys. Массив коллекций.
     *
     * @dataProvider dataProviderFixtures
     *
     * @param $values
     *
     * @return void
     */
    public function testSortByExternalKeys($values): void
    {
        $result = $values['fixture']->sortByExternalKeys($values['new_order_key']);

        $this->assertEquals(
            $values['expected'],
            $result->toArray(),
            'Неправильный ответ.'
        );
    }

    /**
     * SortByExternalKeys. На входе не массив с несуществующим ключом.
     *
     * @dataProvider dataProviderFixtures
     *
     * @param $values
     *
     * @return void
     */
    public function testSortByExternalKeysNotArrayEntryParams($values): void
    {
        $result = $values['fixture']->sortByExternalKeys(333);

        $this->assertEmpty(
            $result->toArray(),
            'Не пустой массив.'
        );
    }

    /**
     * SortByExternalKeys. На входе не массив с существующим ключом.
     *
     * @dataProvider dataProviderFixtures
     *
     * @param $values
     *
     * @return void
     */
    public function testSortByExternalKeysNotArrayEntryParamsExistKey($values): void
    {
        $result = $values['fixture']->sortByExternalKeys(999);

        $this->assertEquals(
            [
                ['TEST' => 4],
            ],
            $result->toArray(),
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
                    'fixture' => collect([
                        139 => collect(['TEST' => 1]),
                        140 => collect(['TEST' => 2]),
                        142 => collect(['TEST' => 3]),
                        999 => collect(['TEST' => 4]),
                    ]),

                    'new_order_key' => [
                        999,
                        142,
                        140,
                        139,
                    ],

                    'expected' => [
                        ['TEST' => 4],
                        ['TEST' => 3],
                        ['TEST' => 2],
                        ['TEST' => 1],
                    ],
                ],

                [
                    'fixture' => collect([
                        139 => collect(['TEST' => 1]),
                        140 => collect(['TEST' => 2]),
                        142 => collect(['TEST' => 3]),
                        999 => collect(['TEST' => 4]),
                    ]),

                    'new_order_key' => [
                        999,
                        142,
                        140,
                        555,
                    ],

                    'expected' => [
                        ['TEST' => 4],
                        ['TEST' => 3],
                        ['TEST' => 2],
                    ],
                ],

                [
                    'fixture' => collect([
                        139 => collect(['TEST' => 1]),
                        140 => collect(['TEST' => 2]),
                        142 => collect(['TEST' => 3]),
                        999 => collect(['TEST' => 4]),
                    ]),

                    'new_order_key' => [
                    ],

                    'expected' => [
                    ],
                ],
            ],
        ];
    }

}
