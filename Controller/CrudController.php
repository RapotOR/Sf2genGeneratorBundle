<?php

namespace Sf2gen\Bundle\GeneratorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;

//annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Sensio\Bundle\GeneratorBundle\Generator\DoctrineCrudGenerator;
use Sensio\Bundle\GeneratorBundle\Command\Validators;

use Sf2gen\Bundle\GeneratorBundle\Form\GenerateCrudType;
use Sf2gen\Bundle\GeneratorBundle\Entity\Crud;

use Symfony\Bundle\DoctrineBundle\Mapping\MetadataFactory;

/**
 * Controller for CRUD generating
 *
 * @author Cédric Lahouste <cedric.lahouste@gmail.com>
 */
class CrudController extends Controller
{   
    /**
     * @Route("/crud", name="_generator_crud")
     * @Template()
     */
    public function generateAction()
    {
        $request = $this->get('request');
        $crudEntity = new Crud();
        
        $form = $this->get('form.factory')->create(new GenerateCrudType(), $crudEntity);
        
        if ('POST' == $request->getMethod()) {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $bundle   = $this->get('kernel')->getBundle($crudEntity->bundle_name);
                $entityClass = $this->get('doctrine')->getEntityNamespace($crudEntity->bundle_name).'\\'.$crudEntity->entity_name;
                $metadata = $this->getEntityMetadata($entityClass);
                $route_prefix = $this->getEntityMetadata($entityClass);
                
                $generator = new DoctrineCrudGenerator($this->get('filesystem'), $this->get('kernel')->locateResource('@SensioGeneratorBundle/Resources/skeleton/crud'));
                $generator->generate($bundle, $crudEntity->entity_name, $metadata[0], $crudEntity->format, $crudEntity->route_prefix, $crudEntity->with_write_action);
                
                $request->getSession()->setFlash('notice', sprintf("CRUD based on entity '%s' has been generated.", $crudEntity->entity_name));
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