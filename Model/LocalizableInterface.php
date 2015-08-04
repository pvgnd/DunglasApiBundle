<?php

/*
 * This file is part of the DunglasApiBundle package.
 *
 * (c) Kévin Dunglas <dunglas@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Dunglas\ApiBundle\Model;

/**
 * Localizable Interface.
 *
 * @author Mikaël Labrut <labrut@gmail.com>
 */
interface LocalizableInterface
{
    /**
     * @param string $attributeName
     * @param string|array $attributeValue
     * @param string|null $locale
     */
    public function setLocalizableValue($attributeName, $attributeValue, $locale = null);

    /**
     * @param string $attributeName
     * @param string|null $locale
     * @return mixed
     */
    public function getLocalizableValue($attributeName, $locale = null);
}