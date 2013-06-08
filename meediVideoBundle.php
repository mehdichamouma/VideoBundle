<?php

namespace meedi\VideoBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

use meedi\VideoBundle\DependencyInjection\ProviderCompilerPass;

class meediVideoBundle extends Bundle
{
     public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new ProviderCompilerPass());
    }
}
