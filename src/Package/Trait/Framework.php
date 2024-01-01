<?php
namespace Package\R3m\Io\Config\Trait;

use R3m\Io\App;

use R3m\Io\Module\Core;
use R3m\Io\Module\File;

use R3m\Io\Node\Model\Node;

use Exception;
trait Framework {


    /**
     * @throws Exception
     */
    public function environment($environment=''): void
    {
        $object = $this->object();
        $package = $object->request('package');
        if($package){
            $options = App::options($object);
            switch (strtolower($environment)){
                case 'development' :
                    ddd($options);
                break;
                default:
                    ddd($options);
                break;
}
            /*
            $class = 'System.Config.Framework';
            $options->url = $object->config('project.dir.vendor') .
                $package . '/Data/' .
                $class .
                $object->config('extension.json')
            ;
            $node = new Node($object);
            $response = $node->import($class, $node->role_system(), $options);
            $node->stats($class, $response);
            */
        }

    }

}