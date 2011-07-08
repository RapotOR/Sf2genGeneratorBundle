<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sf2gen\Bundle\GeneratorBundle\Form;

use Symfony\Component\Form\AbstractType as BaseAbstractType;

/**
 * Abstract Form because getName() was removed from original AbstractType
 *
 * @author Cédric Lahouste <cedric.lahouste@gmail.com>
 */
abstract class AbstractType extends BaseAbstractType
{
    public function getName()
    {
        preg_match('/\\\\(\w+?)(Form)?(Type)?$/i', get_class($this), $matches);
        return strtolower($matches[1]);
    }
}