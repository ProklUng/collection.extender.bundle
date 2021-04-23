<?php

namespace Prokl\CollectionExtenderBundle\Tests\Extenders;

use Prokl\CollectionExtenderBundle\Services\Extenders\TransformKeys;
use Prokl\TestingTools\Base\BaseTestCase;

/**
 * Class TransformKeysTest
 * @package Tests\Services
 * @coversDefaultClass TransformKeys
 *
 * @since 17.09.2020
 */
class TransformKeysTest extends BaseTestCase
{
    /**
     * @var TransformKeys $obTestObject Тестируемый объект.
     */
    protected $obTestObject;

    /**
     * @inheritDoc
     */
    protected function setUp(): void
    {
        parent::setUp();

        $extender = new TransformKeys();
        $extender->registerMacro();
    }

    /**
     * TransformKeys.
     *
     * @dataProvider dataProviderFixtures
     *
     * @param $values
     *
     * @return void
     */
    public function testTransformKeys($values): void
    {
        $result = $this->collectPropertyPdf($values['fixture']);

        $this->assertEquals(
            $values['expected']->toArray(),
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
                        139 => collect([
                            'PROPERTY_PDF_VALUE' => 'value',
                            'b' => 'value',
                            'c' => 'value',
                        ]),

                        140 => collect([
                            'PROPERTY_PDF_VALUE' => 'value2',
                            'b' => 'value',
                            'c' => 'value',
                        ]),
                    ]),

                    'expected' => collect([
                        139 => collect([
                            'PDF' => 'value',
                            'b' => 'value',
                            'c' => 'value',
                        ]),

                        140 => collect([
                            'PDF' => 'value2',
                            'b' => 'value',
                            'c' => 'value',
                        ]),
                    ]),
                ],

                [
                    'fixture' => collect([
                        139 => collect([
                            'a' => 'value',
                            'b' => 'value',
                            'c' => 'value',
                        ]),

                        140 => collect([
                            'a' => 'value2',
                            'b' => 'value',
                            'c' => 'value',
                        ]),
                    ]),

                    'expected' => collect([
                        139 => collect([
                            'a' => 'value',
                            'b' => 'value',
                            'c' => 'value',
                        ]),

                        140 => collect([
                            'a' => 'value2',
                            'b' => 'value',
                            'c' => 'value',
                        ]),
                    ]),
                ],
            ],
        ];
    }

    /**
     * @param $collect
     *
     * @return mixed
     */
    private function collectPropertyPdf($collect)
    {
        return $collect->transformKeys(static function ($key) {

            $result = preg_match('/^PROPERTY_(.*)_VALUE'.'$/', $key, $matches);
            if (!$result) {
                return $key;
            }

            return $matches[1];
        });
    }
}
