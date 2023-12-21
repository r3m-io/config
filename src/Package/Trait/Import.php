<?php
namespace Package\R3m\Io\Config\Trait;

use R3m\Io\App;

use R3m\Io\Module\Core;
use R3m\Io\Module\File;

use R3m\Io\Node\Model\Node;

use Exception;
trait Import {

    public function role_system(): void
    {
        $object = $this->object();
        $node = new Node($object);
        $node->role_system_create('r3m_io/config');
    }

    /**
     * @throws Exception
     */
    public function config_email(): void
    {
        $object = $this->object();
        $options = App::options($object);
        $class = 'System.Config.Email';
        $options->url = $object->config('project.dir.vendor') .
            'r3m_io/config/Data/' .
            $class .
            $object->config('extension.json')
        ;
        $node = new Node($object);
        $response = $node->import($class, $node->role_system(), $options);
        $this->stats($class, $response);
    }

    /**
     * @throws Exception
     */
    public function config_framework(): void
    {
        $object = $this->object();
        $options = App::options($object);
        $class = 'System.Config.Framework';
        $options->url = $object->config('project.dir.vendor') .
            'r3m_io/config/Data/' .
            $class .
            $object->config('extension.json')
        ;
        $node = new Node($object);
        $response = $node->import($class, $node->role_system(), $options);
        $this->stats($class, $response);
    }

    /**
     * @throws Exception
     */
    public function config_ramdisk(): void
    {
        $object = $this->object();
        $options = App::options($object);
        $class = 'System.Config.Ramdisk';
        $options->url = $object->config('project.dir.vendor') .
            'r3m_io/config/Data/' .
            $class .
            $object->config('extension.json')
        ;
        $node = new Node($object);
        $response = $node->import($class, $node->role_system(), $options);
        $this->stats($class, $response);
        $response = $node->record($class, $node->role_system(), []);
        if(
            $response &&
            is_array($response) &&
            array_key_exists('node', $response) &&
            property_exists($response['node'], 'uuid')
        ){
            $uuid = Core::uuid();
            $patch = (object) [
                'uuid' => $response['node']->uuid,
                'name' => $uuid,
                'url' => $object->config('framework.dir.temp') . $uuid . $object->config('ds')
            ];
            $response = $node->patch($class, $node->role_system(), $patch, []);
        }
    }

    /**
     * @throws Exception
     */
    public function config_response(): void
    {
        $object = $this->object();
        $options = App::options($object);
        $class = 'System.Config.Response';
        $options->url = $object->config('project.dir.vendor') .
            'r3m_io/config/Data/' .
            $class .
            $object->config('extension.json')
        ;
        $node = new Node($object);
        $response = $node->import($class, $node->role_system(), $options);
        $this->stats($class, $response);
    }

    /**
     * @throws Exception
     */
    public function config_service(): void
    {
        $object = $this->object();
        $options = App::options($object);
        $class = 'System.Config.Service';
        $options->url = $object->config('project.dir.vendor') .
            'r3m_io/config/Data/' .
            $class .
            $object->config('extension.json')
        ;
        $node = new Node($object);
        $response = $node->import($class, $node->role_system(), $options);
        $this->stats($class, $response);
    }

    /**
     * @throws Exception
     */
    public function config(): void
    {
        $object = $this->object();
        $options = App::options($object);
        $class = 'System.Config';
        $options->url = $object->config('project.dir.vendor') .
            'r3m_io/config/Data/' .
            $class .
            $object->config('extension.json')
        ;
        $node = new Node($object);
        $response = $node->import($class, $node->role_system(), $options);
        $this->stats($class, $response);
    }

    public function stats($class, $response): void
    {
        if (
            $response &&
            array_key_exists('create', $response) &&
            array_key_exists('put', $response) &&
            array_key_exists('patch', $response) &&
            array_key_exists('commit', $response) &&
            array_key_exists('speed', $response['commit']) &&
            array_key_exists('item_per_second', $response)
        ) {
            $total = $response['create'] + $response['put'] + $response['patch'];
            if ($total === 1) {
                echo 'Imported ' .
                    $total .
                    ' (create: ' .
                    $response['create'] .
                    ', put: ' .
                    $response['put'] .
                    ', patch: ' .
                    $response['patch'] .
                    ') item (' .
                    $class .
                    ') at ' .
                    $response['item_per_second'] .
                    ' items/sec (' .
                    $response['commit']['speed'] . ')' .
                    PHP_EOL;
            } else {
                echo 'Imported ' .
                    $total .
                    ' (create: ' .
                    $response['create'] .
                    ', put: ' .
                    $response['put'] .
                    ', patch: ' .
                    $response['patch'] .
                    ') items (' .
                    $class .
                    ') at ' .
                    $response['item_per_second'] .
                    ' items/sec (' .
                    $response['commit']['speed'] . ')' .
                    PHP_EOL;
            }
        }
    }
}