<?php
namespace minicore\lib;

class ControllerBase extends Base
{

    private $viewVars;
    public function assign($key,$value)
    {
        $this->viewVars[$key]=$value;
    }
    /**
     * 调用视图文件直接显示
     * @param unknown $path
     */
    public  function view($path = NULL)
    {
        if (is_null($path)) {
            // print_r(dirname());
            // echo '@',__FUNCTION__;
            $path=Mini::$Mini->getConfig('controllerNamespace');
             $baseDir=Mini::$Mini->getBaseDir();
             $filename= $baseDir.'\\'.  dirname($path).'\view\\'.Mini::$Mini->getAct().'.'.Mini::$Mini->getConfig('viewSuffix');
             if(file_exists($filename)) {
                 extract($this->viewVars);
                 include $filename; 
             }
        }
    }
}

