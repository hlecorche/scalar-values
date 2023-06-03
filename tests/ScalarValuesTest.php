<?php

declare(strict_types=1);

/*
 * This file is part of the scalar-values package.
 *
 * (c) E-commit <contact@e-commit.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ecommit\ScalarValues\Tests;

use Ecommit\ScalarValues\ScalarValues;
use PHPUnit\Framework\TestCase;

class ScalarValuesTest extends TestCase
{
    /**
     * @dataProvider getTestContainsOnlyScalarValuesProdiver
     */
    public function testContainsOnlyScalarValues(array $input, bool $expected): void
    {
        $this->assertEquals(
            $expected,
            ScalarValues::containsOnlyScalarValues($input)
        );
    }

    public function getTestContainsOnlyScalarValuesProdiver(): array
    {
        // Colonne 1: Input
        // Colonne 2: Expected result

        return [
            [[], true],
            [['value1', null, 'value3'], false],
            [['value1', '', 'value3'], true],
            [['value1', true, 'value3'], true],
            [['value1', new \stdClass(), 'value3'], false],
            [['value1', [], 'value3'], false],
            [['value1', ['value2'], 'value3'], false],
            [['value1', [1], 'value3'], false],
            [['value1', 1, 'value3'], true],
            [['value1', 'value2', 'value3'], true],
        ];
    }

    /**
     * @dataProvider getNotArrayInputProdiver
     */
    public function testContainsOnlyScalarValuesInputError($input): void
    {
        $this->expectException(\TypeError::class);
        ScalarValues::containsOnlyScalarValues($input);
    }

    public function getNotArrayInputProdiver(): array
    {
        return [
            [null],
            ['value'],
            [1],
            [true],
            [new \stdClass()],
        ];
    }

    /**
     * @dataProvider getTestFilterScalarValuesProdiver
     */
    public function testFilterScalarValues(array $input, array $expected): void
    {
        $this->assertEquals(
            $expected,
            ScalarValues::filterScalarValues($input)
        );
    }

    public function getTestFilterScalarValuesProdiver(): array
    {
        // Colonne 1: Input
        // Colonne 2: Expected result

        return [
            [[], []],
            [['value1', null, 'value3'], [0 => 'value1', 2 => 'value3']],
            [['value1', '', 'value3'], ['value1', 1 => '', 'value3']],
            [['value1', true, 'value3'], [0 => 'value1', 1 => true, 2 => 'value3']],
            [['value1', new \stdClass(), 'value3'], [0 => 'value1', 2 => 'value3']],
            [['value1', [], 'value3'], [0 => 'value1', 2 => 'value3']],
            [['value1', ['value2'], 'value3'], [0 => 'value1', 2 => 'value3']],
            [['value1', [1], 'value3'], [0 => 'value1', 2 => 'value3']],
            [['value1', 1, 'value3'], [0 => 'value1', 1 => 1, 2 => 'value3']],
            [['value1', 'value2', 'value3'], [0 => 'value1', 1 => 'value2', 2 => 'value3']],
        ];
    }

    /**
     * @dataProvider getNotArrayInputProdiver
     */
    public function testFilterScalarValuesInputError($input): void
    {
        $this->expectException(\TypeError::class);
        ScalarValues::filterScalarValues($input);
    }
}
