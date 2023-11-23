<?php

namespace Package\R3m\Io\Config\Output\Filter\System;

use R3m\Io\App;
use R3m\Io\Config;

use R3m\Io\Module\Core;
use R3m\Io\Module\Controller;
use R3m\Io\Module\Data;
use R3m\Io\Module\Dir;
use R3m\Io\Module\File;

use Exception;

use R3m\Io\Exception\LocateException;
use R3m\Io\Exception\ObjectException;
use R3m\Io\Exception\UrlEmptyException;
use R3m\Io\Exception\UrlNotExistException;

class Server extends Controller {
    const DIR = __DIR__ . '/';

    public static function url(App $object, $response=null){
        ddd($response);
        return $response;
    }
}