<?php
namespace minicore\lib;

use minicore\config\ConfigBase;
use minicore\traits\SingleInstance;
use minicore\helper\Db;
use Composer\Autoload\ComposerStaticInit344e82d8c2bfce44cf961e58b48d128c;
use minicore\helper\DbContainer;
use minicore\interfaces\MiniInterface;

class Mini extends MiniBase  
{

    


    private  $controller;

    private $act;

    private $baseDir;

    private $controllerStance;
    private $viewPath;
    private $module;
    /**
     * @return the $module
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * @param field_type $module
     */
    public function setModule($module)
    {
         $this->module = $module;
    }

    /**
     * @return the $viewPath
     */
    public function getViewPath()
    {
        return $this->viewPath;
    }

    /**
     * @param field_type $viewPath
     */
    public function setViewPath($viewPath)
    {
        $this->viewPath = $viewPath;
    }

    /**
     * @return the $controllerStance
     */
    public function getControllerStance()
    {
        return $this->controllerStance;
    }

    public $appPath;
    /**
     * @return the $appPath
     */
    public function getAppPath()
    {
        return $this->appPath;
    }
    
    /**
     * @param field_type $appPath
     */
    public function setAppPath($appPath)
    {
        $this->appPath = $appPath;
    }
    /**
     * @param field_type $controllerStance
     */
    public function setControllerStance($controllerStance)
    {
        $this->controllerStance = $controllerStance;
    }

    /**
     *
     * @return the $controller
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     *
     * @return the $act
     */
    public function getAct()
    {
        return $this->act;
    }

    /**
     *
     * @param field_type $controller            
     */
    public function setController($controller)
    {
        $this->controller = $controller;
    }

    /**
     *
     * @param field_type $act            
     */
    public function setAct($act)
    {
        $this->act = $act;
    }

    /**
     *
     * @return the $baseDir
     */
    public function getBaseDir()
    {
        return $this->baseDir;
    }

    /**
     *
     * @param field_type $baseDir            
     */
    public function setBaseDir($baseDir)
    {
        $this->baseDir = $baseDir;
    }

    
    use SingleInstance;

    /* 导入单例模式trait */
    function __clone()
    {
         
    }

   
    public function getExtention($key=null) 
    { 
        if($key) {
            return @$this->config['extentions'][$key]?:null;
        }
    }
    
    

    public function run()
    {
        if (1 == $this->config['executeMode']) {
            RequestServer::miniObjInitStatic();
        	$path=RequestServer::analyzeUrl();
        	$routArr=RequestServer::generatRoute($path); 
        	$_SESSION['miniroute']=$routArr;
        	call_user_func(Mini::$app->getConfig('app')['runClass']);
        	//RequestServer::runRout($routArr);
              
        }
    }

    public function __construct($config = null)
    {
        
        if (is_null($config)) {
            $this->config = include dirname(__FILE__) . '/../config/Config.php';
        } else {
            $this->setConfig($config);
        }
        self::$app = $this;
        $pos=strpos(__DIR__, 'vendor')-1;
        $baseDir=substr(__DIR__, 0,$pos);
        $this->setBaseDir($baseDir);
        //
        $path = $this->getConfig('controllerNamespace');
        $appPath=$baseDir.'\\'.dirname($path);
        $this->setAppPath($appPath);
        $viewPath=$appPath.'\\'.'view';
        $this->setViewPath($viewPath);
         
    }

    public function getRout()
    {}

    public function setRout()
    {}
}

