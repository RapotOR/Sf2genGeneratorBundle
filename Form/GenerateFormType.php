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

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

use Sf2gen\Bundle\GeneratorBundle\Entity\Bundle;

/**
 * Form for Form generating
 *
 * @author Cédric Lahouste <cedric.lahouste@gmail.com>
 */
class GenerateFormType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('bundle_name', 'text')
            ->add('entity_name', 'text')
        ;
    }
}
