<?php

namespace Sf2gen\Bundle\GeneratorBundle\Form\Entity;

use Sf2gen\Bundle\GeneratorBundle\Form\AbstractType;

use Symfony\Component\Form\FormBuilder;

use Sf2gen\Bundle\GeneratorBundle\Entity\Field;

class FieldItemType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('fieldName', 'text')
            ->add('type', 'choice', array('choices' => Field::getFieldTypes()))
            ;
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Sf2gen\Bundle\GeneratorBundle\Entity\Field',
        );
    }
}