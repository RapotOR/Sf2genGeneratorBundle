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
class Entity
{
    /**
     * @Assert\NotBlank
     */
    public $bundle;

    /**
     * @Assert\NotBlank
     */
    public $name;
    
    public $fields;

    /**
     * @Assert\Choice(callback="getConfigurationFormats")
     */    
    public $format;
    
    public $with_repository;

    public function __construct()
    {
        $this->format = 'annotation';
    }

    /**
     * @return array
     */
    static public function getConfigurationFormats()
    {
        return Bundle::getConfigurationFormats();
    }
}
