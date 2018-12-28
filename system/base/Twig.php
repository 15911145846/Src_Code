<?php
namespace System;

/**
 * 模板引擎
 * @author jzz
 */
class Twig extends \System\Singleton
{

    public $TwigObj;
    public $TwigConf;
    protected $app_info;
    protected $tpl_file;
    protected $tpl_param = [];

    public function __construct(){
        $this->TwigConf = Config::instance()->get('Twig');
    }

    /**
     * [with 参数传递]
     * @param  array  $param [description]
     * @return [type]        [description]
     */
    public function with($param = []){
        $this->tpl_param = !empty($this->tpl_param) ? $this->tpl_param : [];
        $this->tpl_param = array_merge($param, $this->tpl_param);
        return $this;
    }

    /**
     * [view 模板加载]
     * @param  string $templates [description]
     * @return [type]            [description]
     */
    public function view($templates = ''){
        $DebugInfo = debug_backtrace();
        $templates_suffix = !empty($this->TwigConf['templates_suffix']) ? $this->TwigConf['templates_suffix'] : '.phtml';
        $templates = !empty($DebugInfo[1]) ? $DebugInfo[1]['function'] : '';
        if (empty($templates)) {
            echo $templates;exit;
        }
        $this->app_info = $this->HandleAppData(debug_backtrace(),$templates);
        $this->tpl_file = $this->app_info['str'] . $templates_suffix;
        return $this;
    }

    /**
     * [load 模板渲染]
     * @return [type] [description]
     */
    public function load(){
        $this->TwigConf['templates_path'] = sprintf($this->TwigConf['templates_path'],$this->app_info['mod']);
        $loader = new \Twig_Loader_Filesystem($this->TwigConf['templates_path']);
		$this->TwigObj = new \Twig_Environment($loader, array(
		    'cache' => $this->TwigConf['compilation_cache'],
            'cache_dir' => $this->TwigConf['cache_dir'],
            'debug' => $this->TwigConf['debug'],
            'auto_reload' => $this->TwigConf['auto_reload'],
		));
        echo $this->TwigObj->render($this->tpl_file, $this->tpl_param);
    }

    /**
	 * [HandleAppData 处理应用路径信息]
	 * @param [type] $App_info [description]
	 * @author jzz
	 */
	public function HandleAppData($App_info,$action){
		$Info  = [];
		$base_path = str_replace('/public/../','',RootPath);
		$base_info = str_replace($base_path,'',$App_info['0']['file']);
		$app_info = array_filter(explode('/', $base_info));

		if (!empty($app_info['3'])) {
			unset($app_info['3']);
		}
		if (!empty($app_info['4'])) {
			$app_info['4'] = str_replace('Controller.php','',$app_info['4']);
		}
		if (!empty($app_info['1'])) {
			$Info['mod'] = $app_info['2'];
			$Info['con'] = $app_info['4'];
			$Info['str'] = $app_info['4'].DS.$action;
		}
		return $Info;
	}

}
