<?php

/*
 * This file is part of the Symfony framework.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Sf2gen\Bundle\GeneratorBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Sf2genGeneratorBundle.
 *
 * @author Cedric Lahouste <cedric.lahouste@gmail.com>
 */
class Sf2genGeneratorBundle extends Bundle
{
    public function getParent()
    {
        return 'SensioGeneratorBundle';
    }
}