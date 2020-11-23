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
     * @param string $method
     * @param array  $data
     * @param string $type
     * @param bool   $format
     * @return bool|mixed|string
     */
    public static function curl($url = '', $method = 'GET', $data = [], $type = 'form', $format = true)
    {
        if($type == 'json'){
            $header = 'content-type: application/json; charset=utf-8';
        }else{
            $header = 'content-type: multipart/form-data; charset=utf-8';
        }
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => "",
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_CUSTOMREQUEST  => $method,
            CURLOPT_POSTFIELDS     => $data,
            CURLOPT_HTTPHEADER     => array(
                "cache-control: no-cache",
                $header
            ),
        ));
        $response = curl_exec($curl);
        $err      = curl_error($curl);
        curl_close($curl);
        if($format == false){
            return $response;
        }
        if($err){
            $info = $err;
        }else{
            $info = json_decode($response, true);
        }
        return $info;
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
     * 校验回调数据
     * @param $data
     * @param $appKey
     * @return bool
     */
    public static function checkCallbackParam($data, $appKey)
    {
        $sign = $data['sign'];
        unset($data['sign']);
        unset($data['return_msg']);

        $check_sign = self::sign($data, $appKey);
        return $check_sign === $sign;
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