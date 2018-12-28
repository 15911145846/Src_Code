<?php
namespace Web;
use System\BaseModel;
use Illuminate\Database\Capsule\Manager as DB;

Class UserModel extends BaseModel{

	/**
	 * [getArticleInfo 获取文章数据]
	 * @param  [type] $request [description]
	 * @return [type]          [description]
	 */
	public function getArticleInfo($request){
		$info = objectToArray(DB::table($this->Article)
                ->where('state', '=', '1')
                ->get()
                ->toArray());
        return $info;
	}

	/**
	 * [getArticleImgInfo 获取文章图片数据]
	 * @param  [type] $request [description]
	 * @return [type]          [description]
	 */
	public function getArticleImgInfo($request){
		$info = objectToArray(DB::table($this->Img)
                ->where('article_id', '=', $request->article_id)
                ->get()
                ->toArray());
        return $info;
	}

}
