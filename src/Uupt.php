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

    /**
     * Author:  曾鑫
     * 订单询价
     * @param      $data
     * @param bool $json
     * @return bool|mixed
     * @throws \Exception
     */
    public function getOrderPirce($data, $json = false)
    {
        $url = $this->getUrl().'/getorderprice.ashx';

        if(!array_key_exists('origin_id', $data) || $data['origin_id'] === ''){
            throw new \Exception('miss config: origin_id');
        }

        if(!array_key_exists('from_address', $data) || $data['from_address'] === ''){
            throw new \Exception('miss config: from_address');
        }

        if(!array_key_exists('to_address', $data) || $data['to_address'] === ''){
            throw new \Exception('miss config: to_address');
        }

        if(!array_key_exists('city_name', $data) || $data['city_name'] === ''){
            throw new \Exception('miss config: city_name');
        }

        if(!array_key_exists('send_type', $data) || $data['send_type'] === ''){
            throw new \Exception('miss config: send_type');
        }

        if(!array_key_exists('to_lat', $data) || $data['to_lat'] === ''){
            throw new \Exception('miss config: to_lat');
        }

        if(!array_key_exists('to_lng', $data) || $data['to_lng'] === ''){
            throw new \Exception('miss config: to_lng');
        }

        if(!array_key_exists('from_lat', $data) || $data['from_lat'] === ''){
            throw new \Exception('miss config: to_lng');
        }

        $data['appid']     = $this->getAppId();
        $data['timestamp'] = time();
        $data['openid']    = $this->getOpenId();
        $data['nonce_str'] = Tools::guid();
        $data['sign']      = Tools::sign($data, $this->getAppKey());

        return Tools::curl($url,'POST',$data);
    }
}