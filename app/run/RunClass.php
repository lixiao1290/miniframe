<?php
namespace app\run;

use minicore\lib\RequestServer;
use minicore\lib\MiniRouteManager;
use minicore\lib\RunClassAbstract;

class RunClass extends RunClassAbstract
{

    public function __construct()
    {
        if (true === (new MiniRouteManager($_SESSION['miniroute']['route']))->valid()) {
            RequestServer::runRout($_SESSION['miniroute']);
        } else {
            //RequestServer::runRout($_SESSION['miniroute']);
        }
    }
}

