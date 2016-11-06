<?php
namespace minicore\lib;

class ControllerBase extends Base
{

    private $css;

    private $js;

    private $viewVars;
    private $pageFunc;
    private $viewPath; 
    /**
     * @return the $css
     */
    public function getCss()
    {
        return $this->css;
    }
    
    /**
     * @return the $js
     */
    public function getJs()
    {
        return $this->js;
    }

    /**
     * @return the $viewVars
     */
    public function getViewVars()
    {
        return $this->viewVars;
    }

    public function __construct() 
    {
        if(method_exists(get_called_class(), 'initial')) {
           $this->initial();
        }
         //print_r( dirname(dirname(get_called_class())));
         $this->viewPath= dirname(dirname(get_called_class()));
         echo $this->viewPath; 
    }
    public function head()
    {
        while (list($key,$value)=each($this->css)) {
            echo '<!-----',$key,'----->
',
            '<link rel="stylesheet" href=" ',$value,'"/>
                ';
             
            
        }
    }
    public function body()
    {
         while (list($key,$value)=each($this->js)) {
            echo '<!-----',$key,'----->
',
            '<script type="application/javascript" src="',$value,'"></script>
                ';
    
         }
    }
    public function includeFile($path=null)
    {
        $file=Mini::$Mini->getViewPath().'//'.$path;
        include $file;
    }
    /**
     * 绑定变量
     * @param unknown $key
     * @param unknown $value
     */
    public function assign($key, $value)
    {
        $this->viewVars[$key] = $value;
    }

    /**
     * 调用视图文件直接显示
     * 
     * @param unknown $path            
     */
    public function view($path = NULL)
    {
        // exit;
        if (is_null($path)) {
            // print_r(dirname());
            // echo '@',__FUNCTION__;
            $baseDir = Mini::$Mini->getBaseDir();
            $actfile= Mini::$Mini->getAct() ;
            $filename = $baseDir . '\\' . $this->viewPath . '\view\\' . $actfile.'\\' .$actfile .'.' . Mini::$Mini->getConfig('viewSuffix');
           //var_dump('<pre>',debug_backtrace());
            if (file_exists($filename)) {
                extract($this->viewVars);
                $handle = fopen($filename, "rb");
                $contents = fread($handle, filesize($filename));
               echo strip_tags($contents  );exit;
            }
        } else {
          //  Rout::partial($path);
            /* extract($this->viewVars);
            $baseDir = Mini::$Mini->getBaseDir();
            $filename = $baseDir . '\\' . $this->viewPath . '\view\\' . $path.'.' . Mini::$Mini->getConfig('viewSuffix');echo $filename;
            include  $filename;exit; */
        }
    }

    /**
     * @param unknown $js注册当前页面js文件
     */
    public function registerJs($js)
    {
        if (is_array($js)) {
            while (list ($key, $value) = each($js)) {
                $this->js[$key] = $value;
            }
        } else {
            $this->js[key($js)] = $js;
        }
    }

    /**
     * @param unknown $cs注册当前页面css
     */
    public function registerCss($cs)
    {
        if (is_array($cs)) {
            while (list ($key, $value) = each($cs)) {
                $this->css[$key] = $value;
            }
        } else {
            $this->css[key($cs)] = $cs;
        }
    }
    
    public static function  widget($widget)
    {
        $path = Mini::$Mini->getConfig('controllerNamespace');
        $widgetObj=new dirname($path) . '\widget\\' .$widget();
        $widgetObj->run();
    }
}

