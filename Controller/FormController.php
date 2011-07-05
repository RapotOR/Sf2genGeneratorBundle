<?php

namespace Sf2gen\Bundle\GeneratorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;

//annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Sensio\Bundle\GeneratorBundle\Generator\DoctrineFormGenerator;
use Sensio\Bundle\GeneratorBundle\Command\Validators;

use Sf2gen\Bundle\GeneratorBundle\Form\GenerateFormType;
use Sf2gen\Bundle\GeneratorBundle\Entity\Form;

use Symfony\Bundle\DoctrineBundle\Mapping\MetadataFactory;

/**
 * Controller for form generating
 *
 * @author Cédric Lahouste <cedric.lahouste@gmail.com>
 */
class FormController extends Controller
{   
    /**
     * @Route("/form", name="_generator_form")
     * @Template()
     */
    public function generateAction()
    {
        $request = $this->get('request');
        $formEntity = new Form();
        
        $form = $this->get('form.factory')->create(new GenerateFormType(), $formEntity);
        
        if ('POST' == $request->getMethod()) {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $bundle   = $this->get('kernel')->getBundle($formEntity->bundle_name);
                $entityClass = $this->get('doctrine')->getEntityNamespace($formEntity->bundle_name).'\\'.$formEntity->entity_name;
                $metadata = $this->getEntityMetadata($entityClass);
                
                $generator = new DoctrineFormGenerator($this->get('filesystem'), $this->get('kernel')->locateResource('@SensioGeneratorBundle/Resources/skeleton/form'));
                $generator->generate($bundle, $formEntity->entity_name, $metadata[0]);
                
                $request->getSession()->setFlash('notice', sprintf("Your form based on entity '%s' has been generated.", $formEntity->entity_name));
                return new RedirectResponse($this->generateUrl('_generator'));
            }
        }
        
        return array(
            'form' => $form->createView()
        );
    }
    
    protected function getEntityMetadata($entity)
    {
        $factory = new MetadataFactory($this->get('doctrine'));

        return $factory->getClassMetadata($entity)->getMetadata();
    }    
}