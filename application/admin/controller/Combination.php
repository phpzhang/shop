<?php
/**
 * tpshop
 * ============================================================================
 * 版权所有 2015-2027 深圳搜豹网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.tp-shop.cn
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和使用 .
 * 不允许对程序代码以任何形式任何目的的再发布。
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ============================================================================
 * Author: 当燃
 * 拼团控制器
 * Date: 2016-06-09
 */

namespace app\admin\controller;

use app\admin\logic\OrderLogic;
use app\common\model\Order;
use app\common\model\SpecGoodsPrice;
use app\common\model\TeamActivity;
use app\common\model\TeamFollow;
use app\common\model\TeamFound;
use think\Loader;
use think\Db;
use think\Page;

class Combination extends Base
{
    public function index()
    {
        header("Content-type: text/html; charset=utf-8");
exit("商业用途必须购买正版,使用盗版将追究法律责任");
    }

    /**
     * 搭配购详情
     * @return mixed
     */
    public function info()
    {
        $combination_id = input('combination_id');
        $combination['start_time'] = $this->begin;
        $combination['end_time'] = $this->end;
        if ($combination_id) {
            $Combination = new \app\common\model\Combination();
            $combination = $Combination->where(['combination_id' => $combination_id])->find();
            if (empty($combination)) {
                $this->error('非法操作');
            }
        }
        $this->assign('combination', $combination);
        return $this->fetch();
    }

    /**
     * 保存
     * @throws \think\Exception
     */
    public function save()
    {
        header("Content-type: text/html; charset=utf-8");
exit("商业用途必须购买正版,使用盗版将追究法律责任");
    }

    /**
     * 删除搭配购
     */
    public function delete()
    {
        $combination_id = input('combination_id/d');
        if(empty($combination_id)){
            $this->ajaxReturn(['status' => 0, 'msg' => '参数错误', 'result' => '']);
        }

        $goods_id_arr = Db::name('combination_goods')->where('combination_id', $combination_id)->column('goods_id');
        if($goods_id_arr){
            Db::name('goods')->where('goods_id','in', $goods_id_arr)->update(['prom_id'=>0,'prom_type'=>0]);
        }
        $item_id_arr = Db::name('combination_goods')->where('combination_id', $combination_id)->where('item_id','>',0)->column('item_id');
        if(count($item_id_arr)>0){
            Db::name('spec_goods_price')->where('item_id','in', $item_id_arr)->update(['prom_id'=>0,'prom_type'=>0]);
        }
        $row = Db::name('combination')->where('combination_id', $combination_id)->delete();
        Db::name('combination_goods')->where('combination_id', $combination_id)->delete();
        if ($row !== false) {
            $this->ajaxReturn(['status' => 1, 'msg' => '删除成功', 'result' => '']);
        } else {
            $this->ajaxReturn(['status' => 0, 'msg' => '删除失败', 'result' => '']);
        }
    }

}
