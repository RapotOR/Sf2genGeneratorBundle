<?php

namespace Sf2gen\Bundle\GeneratorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Finder\Finder;

//annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Sensio\Bundle\GeneratorBundle\Generator\DoctrineEntityGenerator;
use Sensio\Bundle\GeneratorBundle\Command\Validators;

use Sf2gen\Bundle\GeneratorBundle\Form\GenerateEntityType;
use Sf2gen\Bundle\GeneratorBundle\Entity\Entity;

/**
 * Controller for entity generating
 *
 * @author Cédric Lahouste <cedric.lahouste@gmail.com>
 */
class EntityController extends Controller
{   
    /**
     * @Route("/entity", name="_generator_entity")
     * @Template()
     */
    public function generateAction()
    {
        $request = $this->get('request');
        $entity = new Entity();
        
        $form = $this->get('form.factory')->create(new GenerateEntityType(), $entity);
        
        if ('POST' == $request->getMethod()) {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $fields = array();
                foreach($entity->fields as $field){
                    $fields[ $field->fieldName ] = array('fieldName' => $field->fieldName, 'type' => $field->type);
                    if($field->type == 'string')
                        $fields[ $field->fieldName ]['length'] = $field->length;
                }
                $generator = new DoctrineEntityGenerator($this->get('filesystem'), $this->get('doctrine'));
                $generator->generate(
                    $this->get('kernel')->getBundle($entity->bundle), 
                    $entity->name, 
                    $entity->format, 
                    $fields,
                    $entity->with_repository
                );
                
                $request->getSession()->setFlash('notice', sprintf("Your entity '%s' has been generated.",$entity->name));
                return new RedirectResponse($this->generateUrl('_generator'));
            }
        }
        
        return array(
            'form' => $form->createView()
        );
    }
}