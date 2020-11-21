<?php
/**
 * COPYRIGHT (C), Yun Shang. Co., Ltd.
 * Author:  曾鑫
 * Date:    2020/11/20 19:17
 * Desc:
 */

namespace Uupt;

use Uupt\Core\Core;
use Uupt\Traits\Tools;

class Uupt extends Core
{
    public function __construct(array $config = [])
    {
        parent::__construct($config);
    }

    private function curl($data, $url)
    {
        $url               = $this->getUrl().$url;
        $data['appid']     = $this->getAppId();
        $data['timestamp'] = time();
        $data['openid']    = $this->getOpenId();
        $data['nonce_str'] = Tools::guid();
        $data['sign']      = Tools::sign($data, $this->getAppKey());

        return Tools::curl($url, 'POST', $data);
    }

    /**
     * Author:  曾鑫
     * 订单询价
     * @param      $data
     * @param bool $json
     * @return bool|mixed
     * @throws \Exception
     */
    public function getOrderPirce($data)
    {
        if(!array_key_exists('origin_id', $data) || $data['origin_id'] === ''){
            throw new \Exception('缺少参数: origin_id');
        }

        if(!array_key_exists('from_address', $data) || $data['from_address'] === ''){
            throw new \Exception('缺少参数: from_address');
        }

        if(!array_key_exists('to_address', $data) || $data['to_address'] === ''){
            throw new \Exception('缺少参数: to_address');
        }

        if(!array_key_exists('city_name', $data) || $data['city_name'] === ''){
            throw new \Exception('缺少参数: city_name');
        }

        if(!array_key_exists('send_type', $data) || $data['send_type'] === ''){
            throw new \Exception('缺少参数: send_type');
        }

        if(!array_key_exists('to_lat', $data) || $data['to_lat'] === ''){
            throw new \Exception('缺少参数: to_lat');
        }

        if(!array_key_exists('to_lng', $data) || $data['to_lng'] === ''){
            throw new \Exception('缺少参数: to_lng');
        }

        if(!array_key_exists('from_lat', $data) || $data['from_lat'] === ''){
            throw new \Exception('缺少参数: to_lng');
        }

        return $this->curl($data, '/getorderprice.ashx');
    }

    /**
     * Author:  曾鑫
     * 发布订单
     * @param array $data
     * @return bool|mixed|string
     * @throws \Exception
     */
    public function addOrder(array $data)
    {
        if(!array_key_exists('price_token', $data) || $data['price_token'] === ''){
            throw new \Exception('缺少参数:price_token');
        }

        if(!array_key_exists('order_price', $data) || $data['order_price'] === ''){
            throw new \Exception('缺少参数:order_price');
        }

        if(!array_key_exists('balance_paymoney', $data) || $data['balance_paymoney'] === ''){
            throw new \Exception('缺少参数:balance_paymoney');
        }

        if(!array_key_exists('receiver', $data) || $data['receiver'] === ''){
            throw new \Exception('缺少参数:receiver');
        }

        if(!array_key_exists('receiver_phone', $data) || $data['receiver_phone'] === ''){
            throw new \Exception('缺少参数:receiver_phone');
        }

        if(!array_key_exists('push_type', $data) || $data['push_type'] === ''){
            throw new \Exception('缺少参数:push_type');
        }

        if(!array_key_exists('special_type', $data) || $data['special_type'] === ''){
            throw new \Exception('缺少参数:special_type');
        }

        if(!array_key_exists('callme_withtake', $data) || $data['callme_withtake'] === ''){
            throw new \Exception('缺少参数:callme_withtake');
        }

        return $this->curl($data, 'addorder.ashx');
    }

    /**
     * Author:  曾鑫
     * 取消订单
     * @param array $data
     * @return bool|mixed|string
     * @throws \Exception
     */
    public function cancelOrder(array $data)
    {
        if((!array_key_exists('order_code', $data) || $data['order_code'] === '') || (!array_key_exists('origin_id', $data) || $data['origin_id'] === '')){
            throw new \Exception('缺少参数:order_code 或者 origin_id');
        }

        return $this->curl($data, 'cancelorder.ashx');
    }

    /**
     * Author:  曾鑫
     * 获取余额详情
     * @return bool|mixed|string
     */
    public function getBalanceDetail()
    {
        return $this->curl([], 'getbalancedetail.ashx');
    }

    /**
     * Author:  曾鑫
     * 获取订单详情
     * @param array $data
     * @return bool|mixed|string
     * @throws \Exception
     */
    public function getOrderDetail(array $data)
    {
        if((!array_key_exists('order_code', $data) || $data['order_code'] === '') || (!array_key_exists('origin_id', $data) || $data['origin_id'] === '')){
            throw new \Exception('缺少参数:order_code 或者 origin_id');
        }

        return $this->curl($data, 'getorderdetail.ashx');
    }

    /**
     * Author:  曾鑫
     * 获取城市列表
     * @return bool|mixed|string
     */
    public function getCityList()
    {
        return $this->curl([], 'getcitylist.ashx');
    }
}