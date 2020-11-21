<?php
/**
 * COPYRIGHT (C), Yun Shang. Co., Ltd.
 * Author:  曾鑫
 * Date:    2020/11/20 20:00
 * Desc:
 */

require_once __DIR__.'/vendor/autoload.php';

use Uupt\Uupt;
use Uupt\Traits\Tools;

$from_lnglat = ['lng' => '113.000613', 'lat' => '28.174556'];
$to_lnglat   = ['lng' => '112.996851', 'lat' => '28.184188'];

$from_lnglat = Tools::bd_encrypt($from_lnglat['lng'],$from_lnglat['lat']);

$uu  = new Uupt([]);
$res = $uu->getOrderPirce([
    'origin_id'     => 'SP202011201755090089879',
    'from_address'  => '湖南省长沙市雨花区2076至高点1309',
    'from_lat'      => $from_lnglat['lat'],
    'from_lng'      => $from_lnglat['lng'],
    'to_address'    => '湖南省长沙市雨花区汇富中心A栋1421',
//    'to_usernote'   => '1421',
    'to_lat'        => $to_lnglat['lat'],
    'to_lng'        => $to_lnglat['lng'],
    'city_name'     => '长沙市',
    'goods_type'    => '其他',
    'send_type'     => '0',
]);

//$res = $uu->getCityList();

var_dump($res);