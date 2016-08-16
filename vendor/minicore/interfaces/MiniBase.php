<?php
namespace minicore\interfaces;

interface  MiniBase
{
    const version='1.0';
    public function  getVersion();
    public function setConfig();
    public function getConfig();
}

?>