<?php
/**
 * COPYRIGHT (C), Yun Shang. Co., Ltd.
 * Author:  曾鑫
 * Date:    2020/11/20 17:37
 * Desc:
 */

namespace Uupt\core;

class Core
{
    protected $url    = 'http://openapi.test.uupt.com/v2_0/';
    protected $config = [
        'app_id'  => 'ccba8bd4a2d54a2fb6df97e87979f303',
        'app_key' => '2815a7a1f8e3405d81fd6263683ec4e7',
        'open_id' => '910a0dfd12bb4bc0acec147bcb1ae246',

    ];

    public function __construct(array $config, $is_test = false)
    {
        if($is_test){
            if(!array_key_exists('app_id', $config) || empty($config['app_id'])){
                throw new \Exception('miss config: app_id');
            }

            if(!array_key_exists('app_key', $config) || empty($config['app_key'])){
                throw new \Exception('miss config: app_key');
            }

            if(!array_key_exists('open_id', $config) || empty($config['open_id'])){
                throw new \Exception('miss config: open_id');
            }

            $this->config = $config;
            $this->url    = 'https://openapi.uupt.com/v2_0/';
        }
    }

    public function getAppId()
    {
        return $this->config['app_id'];
    }

    public function getAppKey()
    {
        return $this->config['app_key'];
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getOpenId()
    {
        return $this->config['open_id'];
    }

}