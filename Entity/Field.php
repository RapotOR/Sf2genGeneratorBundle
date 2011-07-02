<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sf2gen\Bundle\GeneratorBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * 'Entity' entity
 *
 * @author Cédric Lahouste <cedric.lahouste@gmail.com>
 */
class Field
{
    /**
     * @Assert\NotBlank
     */
    public $fieldName;

    /**
     * @Assert\Choice(callback="getFieldTypes")
     */    
    public $type;
    
    public $length;

    public function __construct()
    {
        $this->type = 'string';
        $this->length = 255;
    }

    /**
     * @return array
     */
    static public function getFieldTypes()
    {
        return array(
            'array'     => 'array', 
            'object'    => 'object', 
            'boolean'   => 'boolean', 
            'integer'   => 'integer',
            'bigint'    => 'bigint',
            'string'    => 'string',
            'text'      => 'text',
            'datetime'  => 'datetime',
            'time'      => 'time',
            'date'      => 'date',
            'decimal'   => 'decimal',
            'float'     => 'float',
        );
    }
}