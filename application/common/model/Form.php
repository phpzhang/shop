<?php
/**
 * tpshop
 * ============================================================================
 * 版权所有 2015-2027 深圳搜豹网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.tp-shop.cn
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和使用 .
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * Author: yhj
 * Date: 2018-10-25
 */
namespace app\common\model;

use think\Db;
use think\Model;

class Form extends Model
{


    public function getSubmitValueAttr($value, $data){

        echo '主分支修改的第一个版本';
        return  json_decode($value,true);
    }


}
