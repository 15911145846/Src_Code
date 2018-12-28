<?php
namespace Web;
use System\BaseService;

Class UserService extends BaseService{

	/**
	 * [getArticleInfo 整合朋友圈数据]
	 * @param  [type] $request [description]
	 * @return [type]          [description]
	 */
	public function getArticleInfo($request){
		$data = [];
		$ArticleInfo = $this->Web_User()->getArticleInfo($request);
		if (!empty($ArticleInfo)) {
			foreach ($ArticleInfo as $key => $value) {
				$request->article_id = $value['id'];
				$ArticleImgInfo = $this->Web_User()->getArticleImgInfo($request);
				$value['ArticleImgInfo'] = $ArticleImgInfo;
				$data[$key] = $value;
			}
		}
		return $data;
	}

}
