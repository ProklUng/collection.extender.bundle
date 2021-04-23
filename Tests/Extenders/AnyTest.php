<?php

namespace Prokl\CollectionExtenderBundle\Tests\Extenders;

use Prokl\CollectionExtenderBundle\Services\Extenders\Any;
use Prokl\TestingTools\Base\BaseTestCase;

/**
 * Class AnyTest
 * @package Tests\Services
 * @coversDefaultClass Any
 *
 * @since 21.09.2020
 * @since 24.09.2020 Исправление ошибок в фикстурах.
 */
class AnyTest extends BaseTestCase
{
    /**
     * @inheritDoc
     */
    protected function setUp(): void
    {
        parent::setUp();

        $extender = new Any();
        $extender->registerMacro();
    }

    /**
     * Any.
     *
     * @dataProvider dataProviderFixtures
     *
     * @param $values
     *
     * @return void
     */
    public function testAny($values): void
    {
        $result = collect($values['fixture'])->any(
            $values['closure']
        );

        $this->assertSame(
            $values['expected'],
            $result
        );
    }

    /**
     * Датапровайдер расширителей Collections.
     *
     * ПРИМЕР расширенного dataProvider.
     *
     * @return array
     */
    public function dataProviderFixtures(): array
    {
        return [
            [
                'active_user_y' => [
                    'expected' => true,
                    'closure' => static function ($user) {
                        return $user['active'] === 'Y';
                    },
                    'fixture' => collect([
                        'user' => [
                            'active' => 'Y',
                            'id' => 222,
                        ],
                    ]),
                ],
            ],

            [
                'active_user_y2' => [
                    'expected' => true,
                    'closure' => static function ($user) {
                        return $user['active'] === 'Y';
                    },
                    'fixture' => collect([
                        'user' =>
                            [
                                'active' => 'Y',
                                'id' => 222,
                            ],

                    ]),
                ],
            ],

            [
                'active_user_n' => [
                    'expected' => false,
                    'closure' => static function ($user) {
                        return $user['active'] === 'Y';
                    },
                    'fixture' => collect([
                        'user' => [
                            'active' => 'N',
                            'id' => 444,
                        ],
                    ]),
                ],
            ],

            [
                'active_user_y_but_return_true' => [
                    'expected' => true,
                    'closure' => static function ($user) {
                        return $user['active'] === 'N';
                    },
                    'fixture' => collect(
                        [
                            'user' => [
                                'active' => 'N',
                                'id' => 444,
                            ],
                        ]),
                ],
            ],
        ];
    }

}
