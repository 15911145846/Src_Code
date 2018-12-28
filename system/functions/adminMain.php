<?php 

/*
 * 获取后台菜单列表
 * @param $thisAction 当前操作
 * @return Html
 */
function getAdminMenuList($thisAction = ""){
    $menu = new \App\Admin\Menu\Models\Menu();
    $role = new \App\Admin\Manage\Models\Role();
    $adminInfo = \Illuminate\Support\Facades\Session::get("adminInfo");
    $menuAuthObj = $role->getRoleMenuIdArr($adminInfo->role_id);
    $menuIdArr = array();
    foreach ($menuAuthObj as $data) {
        $menuIdArr[] = $data->menu_id;
    }

    $list = $menu->getFirstMenu(2);
    $str = '<ul class="layui-nav layui-nav-tree"  lay-filter="loadding">';
    foreach ($list as $data) {
        $twoMenuList = $menu->getTwoMenu($data->id, 2);
        if (!count($twoMenuList)) {
            //判断一级菜单是否有权限查看
            if (in_array($data->id, $menuIdArr)) { //判断是否有权限访问此菜单
                if ($data->url == $thisAction) {
                    $str .= '<li class="layui-nav-item layui-this">';
                } else {
                    $str .= '<li class="layui-nav-item">';
                }
                $str .= '<a class="" href="' . adminurl($data->url) . '"><i class="iconfont">'.htmlspecialchars_decode($data->icon_class).'</i> ' . $data->title . '</a>';
                $str .= '</li>';
            }
        } else {
            $strChild = "";
            $thisChild = false;
            foreach ($twoMenuList as $value) {
                if (in_array($value->id, $menuIdArr)) { //判断是否有权限访问此菜单
                    if ($value->url == $thisAction) {
                        $strChild .= '<dd class="layui-this"><a href="' . adminurl($value->url) . '"><i class="iconfont">'.htmlspecialchars_decode($value->icon_class).'</i> ' . $value->title . '</a></dd>';
                        $thisChild = true;
                    } else {
                        $strChild .= '<dd><a href="' . adminurl($value->url) . '"><i class="iconfont">'.htmlspecialchars_decode($value->icon_class).'</i> ' . $value->title . '</a></dd>';
                    }
                }
            }
            if ($strChild != "") { //判断此二级菜单下是否有子菜单
                if ($thisChild) {
                    $str .= '<li class="layui-nav-item layui-nav-itemed">';
                } else {
                    $str .= '<li class="layui-nav-item">';
                }
                $str .= '<a class="" href="javascript:;"><i class="iconfont">'.htmlspecialchars_decode($data->icon_class).'</i> ' . $data->title . '</a>';
                $str .= '<dl class="layui-nav-child">';
                $str .= $strChild;
                $str .= '</dl>';
                $str .= '</li>';
            }
        }
    }
    $str .= '</ul>';
    echo $str;
}