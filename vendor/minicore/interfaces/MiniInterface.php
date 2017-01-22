<?php
namespace minicore\interfaces;

use minicore\config\ConfigBase;

interface MiniInterface
{

    const version = '1.0';

    public function getVersion();

    public function setConfig($key,$value);

    public function getConfig($key);
}

?>