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
    protected $app_id = '748455d88e0f4227aa0cbf4abaf3b64c';
    protected $app_key = '5e8ca9c409234183bfdf2bff369c57bf';
    protected $open_id = '0e4ef4c93bb44cd5bda5611c8d4954e1';
    protected $url;

    public function __construct(array $config)
    {
//        if (!array_key_exists('app_id', $config) || empty($config['app_id'])) {
//            throw new \Exception('miss config: app_id');
//        }
//        if (!array_key_exists('app_key', $config) || empty($config['app_key'])) {
//            throw new \Exception('miss config: app_key');
//        }
//
//        $this->app_id = $config['app_id'];
//        $this->app_key = $config['app_key'];
        $this->url = 'https://openapi.uupt.com/v2_0';
    }

    public function getAppId()
    {
        return $this->app_id;
    }

    public function getAppKey()
    {
        return $this->app_key;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getOpenId()
    {
        return $this->open_id;
    }

}