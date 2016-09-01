<?php
namespace minicore\interfaces;

use minicore\config\ConfigBase;

interface MiniBase
{

    const version = '1.0';

    public function getVersion();

    public function setConfig($config);

    public function getConfig();
}

?>