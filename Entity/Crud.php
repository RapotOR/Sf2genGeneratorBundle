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
 * Crud entity
 *
 * @author Cédric Lahouste <cedric.lahouste@gmail.com>
 */
class Crud
{
    /**
     * @Assert\NotBlank
     */    
    public $bundle_name;

    /**
     * @Assert\NotBlank
     */    
    public $entity_name;
    
    /**
     * @Assert\NotBlank
     */        
    public $route_prefix; 
       
    public $with_write_action;    
    
    /**
     * @Assert\Choice(callback="getConfigurationFormats")
     */    
    public $format;
    
    public function __construct()
    {
        $this->format = 'yml';
    }

    /**
     * @return array
     */
    static public function getConfigurationFormats()
    {
        return Bundle::getConfigurationFormats();
    }   
}
