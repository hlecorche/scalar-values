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

namespace Ecommit\ScalarValues;

class ScalarValues
{
    public static function containsOnlyScalarValues(array $array): bool
    {
        foreach ($array as $child) {
            if (!\is_scalar($child)) {
                return false;
            }
        }

        return true;
    }

    public static function filterScalarValues(array $array): array
    {
        return array_filter($array, function ($child) {
            return \is_scalar($child);
        });
    }
}
