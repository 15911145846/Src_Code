<?php
namespace System\Org;
use OSS\OssClient;
use OSS\Core\OssException;
use System\Config;

Class AliyunOSS{

	private $OssObj;
	private $Conf = [];

	public function __construct($ConfInfo = []){
		$this->Conf = Config::instance()->get('aliyunoss');
		$this->Conf = array_merge($this->Conf,$ConfInfo);
		$this->OssObj = New OssClient($this->Conf['OSS_ACCESS_ID'], $this->Conf['OSS_ACCESS_KEY'], $this->Conf['OSS_ENDPOINT'], false);
	}

	/**
	 * [ossUpPic 上传文件]
	 * @param  [type]  $fFiles     [文件域]
	 * @param  [type]  $n          [上传的路径目录]
	 * @param  [type]  $bucketName [文件桶名]
	 * @param  [type]  $web        [访问地址 ]
	 * @param  integer $isThumb    [是否缩略图]
	 * @return [type]              [array]
	 */
	private function ossUpPic($fFiles, $n, $bucketName, $web, $isThumb = 0){
		$data = [];
	    $fType = $fFiles['type'];
	    $back = array(
	        'code'=>0,
	        'msg'=>'',
	    );
	    if(!in_array($fType, $this->Conf['oss_exts'])){
	        $back['msg'] = '文件格式不正确';
	        return $back;
	    }
	    $fSize = $fFiles['size'];
	    if($fSize > $this->Conf['oss_maxSize']){
	        $back['msg'] = '文件超过了1M';
	        return $back;
	    }

	    $fname = $fFiles['name'];
	    $ext = substr($fname,stripos($fname,'.'));

	    $fup_n = $fFiles['tmp_name'];
	    $file_n = time().'_'.rand(100,999);
	    $object = $n."/".$file_n.$ext;//目标文件名


	    $this->OssObj->uploadFile($bucketName, $object, $fup_n);
	    if($isThumb==1){
	        // 图片缩放，参考https://help.aliyun.com/document_detail/44688.html?spm=5176.doc32174.6.481.RScf0S
	        $back['thumb']= $web.$object."?x-oss-process=image/resize,h_300,w_300";
	    }
	    $data['code'] = 1;
	    $data['bucketName'] = $bucketName;
	    $data['path'] = $object;
	    return $data;
	}

	/**
	 * [upPic 上传文件]
	 * @param  [type] $FilesInfo [文件资源名称]
	 * @param  [type] $DirName [文件夹名称]
	 * @return [type]            [array]
	 */
	public function upPic($FilesInfo,$DirName = 's'){
		if (empty($FilesInfo)) {
			return ['msg' => "资源错误"];
		}
	    //oss上传
	    $bucketName = $this->Conf['OSS_TEST_BUCKET'];
	    $web = $this->Conf['OSS_WEB_SITE'];
	    //图片
	    // $fFiles = $_FILES['pic_1'];
	    $rs = $this->ossUpPic($FilesInfo,$DirName,$bucketName,$web,0);

	    if($rs['code']==1){
	        // //图片
	        // $img = $rs['msg'];
	        // //如返回里面有缩略图：
	        // $thumb = $rs['thumb'];
	        return $rs;
	    } else {
	        return $rs;
	    }
	}

	/**
	 * [getObject 获取文件内容]
	 * @param  string $FileName   [文件名称]
	 * @param  string $bucketName [文件桶名]
	 * @return [type]             [description]
	 */
	public function getObject($FileName = '',$bucketName = ''){
		$file_name = !empty($_GET['name']) ? $_GET['name'] : '1524218506_403.png';
		$object = "{$FileName}";
		$bucketName = $this->Conf['OSS_TEST_BUCKET'];
		try{
	        $content = $this->OssObj->getObject($bucketName, $object);
	    } catch(OssException $e) {
	        return $e->getMessage();
	    }
	    return $content;
	}

}
