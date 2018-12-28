<?php
namespace Web;
use System\Curl;
use System\Twig;
use System\BaseController;
use Illuminate\Http\Request;
use Classlib\FormCheck;
use System\Org\AliyunOSS;

/**
 * 多萌商城
 */
Class IndexController extends BaseController{

	/**
	 * [_init 初始化]
	 * @return [type] [description]
	 */
	public function _init(){

		$this->AliyunOSS = new AliyunOSS();
		$this->curlObj = new Curl();
		$this->FormCheck = new FormCheck();
		$this->twig = Twig::instance();

	}

	/**
	 * [index 首页]
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	public function index(Request $request){

		$data = UserService::instance()->getArticleInfo($request);
		$this->twig
			->view()
			->with(['data' => $data])
			->load();

	}

}
