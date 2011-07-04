Introduction
============

Sf2genGeneratorBundle contains web interface for SensioGeneratorBundle.
The interface is same as WebConfiguratorBundle.

Have a look!
============

The main menu:
<img src="https://github.com/RapotOR/Sf2genGeneratorBundle/raw/master/Resources/doc/generatorbundle_menu.jpg" width="995" alt="Screenshot" />

Generate your bundle:
<img src="https://github.com/RapotOR/Sf2genGeneratorBundle/raw/master/Resources/doc/generatorbundle_bundle.jpg" width="995" alt="Screenshot" />

Generate an entity; the bundle name is autocompleted based on activated bundles in the your application:
<img src="https://github.com/RapotOR/Sf2genGeneratorBundle/raw/master/Resources/doc/generatorbundle_entity_autocomplete.jpg" width="995" alt="Screenshot" />

Generate a form; the bundle name and the entity name are autocompleted based on activated bundles in the your application and available entities:
<img src="https://github.com/RapotOR/Sf2genGeneratorBundle/raw/master/Resources/doc/generatorbundle_entity_autocomplete.jpg" width="995" alt="Screenshot" />

Installation
============

  1. Add this bundle to your vendor/ dir:

        $ git submodule add git://github.com/sensio/SensioGeneratorBundle.git vendor/bundles/Sensio/Bundle/GeneratorBundle
        $ git submodule add git://github.com/RapotOR/Sf2genGeneratorBundle.git vendor/bundles/Sf2gen/Bundle/GeneratorBundle

  2. Add the Sf2gen and Sensio namespaces to your autoloader:

        // app/autoload.php
        $loader->registerNamespaces(array(
            'Sensio' => __DIR__.'/../vendor/bundles',
            'Sf2gen' => __DIR__.'/../vendor/bundles',
            // other namespaces
        ));

  3. Add this bundle to your application's kernel, in the debug section:

        // app/ApplicationKernel.php
        public function registerBundles()
        {
            $bundles = array(
                // all bundles            
            );

            if (in_array($this->getEnvironment(), array('dev', 'test'))) {
                // previous bundles like WebProfilerBundle
                $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
                $bundles[] = new Sf2gen\Bundle\GeneratorBundle\Sf2genGeneratorBundle();
            }

            return $bundles;
        }
          
  4. Add the following ressource to your routing_dev.yml:
        
        // app/config/routing_dev.php
        _generator:
            resource: "@Sf2genGeneratorBundle/Resources/config/routing.yml"
            prefix:   /_generator    

  5. You have to disable the firewall if you use the `security component`:

        # app/config/config.yml
        security:
            firewalls:
                generator:
                    pattern:    /_generator/.*
                    security:  false
