<?php

namespace meedi\VideoBundle\Entity\Listener;


use Doctrine\ORM\Event\LifecycleEventArgs;

use meedi\VideoBundle\Entity\Video;
use meedi\VideoBundle\Component\VideoManager;

class VideoListener
{
        protected $lib;

        public function __construct(VideoManager $VideoProviderLib)
        {
                $this->lib = $VideoProviderLib;
        }

        public function setProvider(LifecycleEventArgs $args) 
        {
                $entity = $args->getEntity();

                if($entity instanceof Video)
                {
                        $name = $entity->getProvidername();
                        if($name != null)
                        {
                                $provider = $this->lib->getProviderClassFromName($name);
                                $entity->setProvider($provider);
                        }
                }
        }

        public function postLoad(LifecycleEventArgs $args)
        {
                $this->setProvider($args);
        }
}