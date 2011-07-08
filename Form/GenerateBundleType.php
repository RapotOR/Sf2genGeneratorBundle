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

use Symfony\Component\Form\FormBuilder;

use Sf2gen\Bundle\GeneratorBundle\Entity\Bundle;

/**
 * Form for Bundle generating
 *
 * @author Cédric Lahouste <cedric.lahouste@gmail.com>
 */
class GenerateBundleType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('namespace_vendor', 'text')
            ->add('namespace_bundle', 'text')
            ->add('bundle_name', 'text')
            ->add('dir', 'text')
            ->add('format', 'choice', array('choices' => Bundle::getConfigurationFormats()))
            ->add('structure', 'checkbox')
        ;
    }
}
