<?php

namespace Sf2gen\Bundle\GeneratorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

//annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Sensio\Bundle\GeneratorBundle\Generator\BundleGenerator;
use Sensio\Bundle\GeneratorBundle\Command\Validators;

use Sf2gen\Bundle\GeneratorBundle\Form\GenerateBundleType;
use Sf2gen\Bundle\GeneratorBundle\Entity\Bundle;

/**
 * Controller for bundle generating
 *
 * @author Cédric Lahouste <cedric.lahouste@gmail.com>
 */
class BundleController extends Controller
{   
    /**
     * @Route("/bundle", name="_generator_bundle")
     * @Template()
     */
    public function generateAction()
    {
        $request = $this->get('request');
        $bundle = new Bundle();
        
        $form = $this->get('form.factory')->create(new GenerateBundleType(), $bundle);
        
        if ('POST' == $request->getMethod()) {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $namespace = $bundle->namespace_vendor . "\\" . $bundle->namespace_bundle; 
                $dir = '/' === substr($bundle->dir, -1, 1) ? $bundle->dir : $bundle->dir.'/';
                if (!$this->get('filesystem')->isAbsolutePath($dir)) {
                    $dir = dirname($this->get('kernel')->getRootDir()).'/'.$dir;
                }
                
                $generator = new BundleGenerator($this->get('filesystem'), $this->get('kernel')->locateResource('@SensioGeneratorBundle/Resources/skeleton/bundle'));
                $generator->generate($namespace, $bundle->bundle_name, $dir, $bundle->format, $bundle->structure);
                
                $request->getSession()->setFlash('notice','Your bundle has been generated.');
                return new RedirectResponse($this->generateUrl('_generator'));
            }
        }
        
        return array(
            'form' => $form->createView()
        );
    }
    
    
    /**
     * @Route("/bundle/list.{_format}", name="_generator_bundles", requirements={"_format" = "json"}, defaults={"_format" = "json"})
     */
    public function listAction()
    {        
        $request = $this->get('request');
        $bundles = array_keys($this->get('kernel')->getBundles());
        $term = $request->query->get('term');
        
        $list = array();
        foreach($bundles as $bundle)
            if(substr(strtolower($bundle),0,strlen($term)) == strtolower($term))
                $list[] = $bundle;
        
        return new Response(json_encode($list));
    }
}