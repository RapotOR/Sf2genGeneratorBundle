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
 * Form for entity generating
 *
 * @author Cédric Lahouste <cedric.lahouste@gmail.com>
 */
class GenerateEntityType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('bundle', 'text')
            ->add('name', 'text')
            ->add('fields', 'collection', array(
                'label'         => 'Fields',
                'type'          => new Entity\FieldItemType(),
                'prototype'     => true,
                'allow_add'     => true,
                'allow_delete'  => true,
                'options'       => array('label' => '*')
            ))
            ->add('format', 'choice', array('choices' => Bundle::getConfigurationFormats()))
            ->add('with_repository', 'checkbox',array('required' => false))
        ;
    }
}