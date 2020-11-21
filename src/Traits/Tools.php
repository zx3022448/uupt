<?php
/**
 * COPYRIGHT (C), Yun Shang. Co., Ltd.
 * Author:  曾鑫
 * Date:    2020/11/20 19:22
 * Desc:
 */

namespace Uupt\Traits;

class Tools
{
    /**
     * Author:  曾鑫
     * curl请求
     * @param string $url
     * @param array  $post_data
     * @param bool   $json
     * @return bool|mixed|string
     */
    public static function curl($url = '', $post_data = [], $json = false)
    {
        if (empty($url) || empty($post_data)) {
            return false;
        }

        $arr = [];
        foreach ($post_data as $key => $value) {
            $arr[] = $key.'='.$value;
        }

        $curlPost = implode('&', $arr);

        $postUrl = $url;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$postUrl);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
        $data = curl_exec($ch);
        curl_close($ch);

        if($json){
            return json_decode($data);
        }

        return $data;
    }
    /**
     * Author:  曾鑫
     * 生成guid
     * @return string
     */
    public static function guid()
    {
        if(function_exists('com_create_guid')){
            return com_create_guid();
        }else{
            mt_srand((double)microtime() * 10000);//optional for php 4.2.0 and up.
            $charid = strtoupper(md5(uniqid(rand(), true)));
            $hyphen = chr(45);// "-"
            $uuid   = substr($charid, 0, 8).$hyphen
                .substr($charid, 8, 4).$hyphen
                .substr($charid, 12, 4).$hyphen
                .substr($charid, 16, 4).$hyphen
                .substr($charid, 20, 12);
            return $uuid;
        }
    }

    /**
     * Author:  曾鑫
     * 生成sign
     * @param $data
     * @param $appKey
     * @return string
     */
    public static function sign($data, $appKey)
    {
        ksort($data);
        $arr = [];
        foreach($data as $key => $value){
            $arr[] = $key.'='.$value;
        }

        $arr[] = 'key='.$appKey;
        $str   = strtoupper(implode('&', $arr));
        return strtoupper(md5($str));
    }

    /**
     * Author:  曾鑫
     * 高德经纬度改百度经纬度
     * @param $lng 经度
     * @param $lat 纬度
     * @return mixed
     */
    public static function bd_encrypt($lng, $lat)
    {
        $x_pi  = 3.14159265358979324 * 3000.0 / 180.0;
        $x     = $lng;
        $y     = $lat;
        $z     = sqrt($x * $x + $y * $y) - 0.00002 * sin($y * $x_pi);
        $theta = atan2($y, $x) - 0.000003 * cos($x * $x_pi);

        $data['lng'] = $z * cos($theta) + 0.0065;
        $data['lat'] = $z * sin($theta) + 0.006;
        return $data;
    }

}