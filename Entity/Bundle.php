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
 * Bundle entity
 *
 * @author Cédric Lahouste <cedric.lahouste@gmail.com>
 */
class Bundle
{
    /**
     * @Assert\NotBlank
     */
    public $namespace_vendor;

    /**
     * @Assert\NotBlank
     */
    public $namespace_bundle;
    
    /**
     * @Assert\NotBlank
     */    
    public $bundle_name;

    /**
     * @Assert\NotBlank
     */    
    public $dir;

    /**
     * @Assert\Choice(callback="getConfigurationFormats")
     */    
    public $format;
    
    public $structure;

    public function __construct()
    {
        $this->dir = 'src';
        $this->format = 'annotation';
    }

    /**
     * @return array
     */
    static public function getConfigurationFormats()
    {
        return array(
            'xml' => 'xml', 
            'yml' => 'yml', 
            'php' => 'php', 
            'annotation' => 'annotation'
        );
    }
}
