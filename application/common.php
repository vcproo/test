<?php

use Firebase\JWT\JWT;

// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
/**
 * 创建 token
 * @param array $data 必填 自定义参数数组
 * @param integer $exp_time 必填 token过期时间 单位:秒 例子：7200=2小时
 * @param string $scopes 选填 token标识，请求接口的token
 * @return string
 */
 function createToken($data = "", $exp_time = 3600, $scopes = "")
{

    //JWT标准规定的声明，但不是必须填写的；
    //iss: jwt签发者
    //sub: jwt所面向的用户
    //aud: 接收jwt的一方
    //exp: jwt的过期时间，过期时间必须要大于签发时间
    //nbf: 定义在什么时间之前，某个时间点后才能访问
    //iat: jwt的签发时间
    //jti: jwt的唯一身份标识，主要用来作为一次性token。
    //公用信息
    try {
        $alg ="RS256";
        $key = '-----BEGIN PRIVATE KEY-----
MIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQC7dn2u4wSxw9x+
9SIG+n6z1iICGKOBoY4Gv67jUdiQ8ibTcR7AMTZAlbHmXzEVJJPcYFIRtQD3e03f
eecfcHdTTL+jwqx6mjkgaRyROsiFwm9pzNtXM9tgPbVGnxVq8InS8fprZNP2Bz2V
swytsvWwvl5cppDQmog1V5KzTpq4NeuDJL77zOqq8/55NbhDFh7Bhjg2RlSPu07F
w7HPzjcClmO0IXeD4FoNghOwBD4ZR78pMe369r/DYGhznfaacSrUh/LBeGMmdDam
Q+xW/nWBR66ohn71c7qhBqAm/qTYTerF7HPkLrlOz8JAAuxX0oBeO0DJCh5rA/fu
yz1XvkKBAgMBAAECggEABi2xlsIEtZcu/UA3DuPSqTq1hDwrp2obtD09FmDsMlrI
zM89pDf7AcXtRxp8E6ZQ+UJzcgH1NjLqLiNmarLaO/SbnFoeNSxAFcFhH6hAU6hE
48fMsuMSp+lgwCMeIZgr8rfm+QMpuUIj1XtBP7hWQK0FjyguPbHaK2fnfeFpWAjg
akDFEDkH19n/yjFPf/usAul6ubboX/oQL6OPvK854RQydb4CaIDKbzR7+CuLGzWk
Tr5WHrFlykSLIhPxjZq7EaCjcEg070Ojsm4qkFnvc5ENJWhkqFbNT+bshL6i4WoU
paO/Zr6ryoP1dgcoLfWtjzymmiiHsT54G87tQyx8wQKBgQDv4r896IyFAvK/WhX/
NftWPVApun3qvKbLaEQuHSng37KF9KYVgUjhdcfw4zXYB+q6P0JeLbUv9mkqQoMQ
F61J1BDVZQlSN44ghStRSTx1q1R7lg/0cpepWtq6JjHC9MKOrOiYeDy/EoAPcCUz
ZupjxCqe4/rGxLqK6c5MtYVsGwKBgQDIDj3DU/OW2vyMX3ezNX/C/tHVN1KYan6v
ufjzjNbCMGRlGnLU6Y+JqOwC9aJlRHmFV5uMXHvQydhDGJAKW2IjzcYooTd0jSvm
AKNkPKHJI6N4eDTfwfm9CuJd+6+IwcVtMpF7XQDY6OdnrDy/63jC5LTrCxa1TlOx
9uFRGIh9kwKBgQDoAj0GyljF+JEBI0btG6+nvAtBIJ7SHn2Pc5ulog0z8gb+6hyL
5guwC7NCNu6HrziFw9MTtU9tQPx7o/KQ6OVv50wUp/C49QRgTYwUxSlVgUxnbz6l
JQOsBzRPH8u3C/Tz+yXG+Vt/TYxP4h4ItfvyW/MA0+xivDjTS8h8hn+xiwKBgFz3
OT5m6eClnQzCZIa0Cs4bynjxv4Eyo/KXUpgjT71n7Y+KLejBLMHE7QAnE7NJkcsk
PhWI+MS6t7PeWzlk5ANNYZOJ75JK9CZrD4LKJkipNhMKkU+V/a8aurz/879yhINN
J4wTWQxzlu13fbeV/kVbMLO1MHVKk9w0pNohs3PfAoGAfHOJUKP/g0sqDVF+cJGX
c8b5Cd/6HqYKhE1uQeInzF/ziDDeW8JjD2nl5ZhboIFp6NEntiYYCufGotiOppHV
llkq/ZT6o2rZbnySOGUoJoHYkE4MmxO4qST6N9sHFV7WzYNnqW2Ju+pefI3r73Z6
uOZvCjaogbeiLyQUqi8Pw2c=
-----END PRIVATE KEY-----
';
        $time = time(); //当前时间
        $token['iss'] = 'admin'; //签发者 可选
        $token['iat'] = $time; //签发时间
        $token['nbf'] = $time+3; //(Not Before)：某个时间点后才能访问，比如设置time+30，表示当前时间30秒后才能使用
        if ($scopes) {
            $token['scopes'] = $scopes; //token标识，请求接口的token
        }
        if (!$exp_time) {
            $exp_time = 7200;//默认=2小时过期
        }
        $token['exp'] = $time + $exp_time; //token过期时间,这里设置2个小时
        if ($data) {
            $token['data'] = $data; //自定义参数
        }
        $json = JWT::encode($token, $key,$alg);
        //Header("HTTP/1.1 201 Created");
        //return json_encode($json); //返回给客户端token信息
        return $json; //返回给客户端token信息

    } catch (\Firebase\JWT\ExpiredException $e) {  //签名不正确
        $returndata['code'] = "104";//101=签名不正确
        $returndata['msg'] = $e->getMessage();
        $returndata['data'] = "";//返回的数据
        return json_encode($returndata); //返回信息
    } catch (Exception $e) {  //其他错误
        $returndata['code'] = "199";//199=签名不正确
        $returndata['msg'] = $e->getMessage();
        $returndata['data'] = "";//返回的数据
        return json_encode($returndata); //返回信息
    }
}
/**
 * 验证token是否有效,默认验证exp,nbf,iat时间
 * @param string $jwt 需要验证的token
 * @return string $msg 返回消息
 */
 function checkToken($jwt)
{
    $key = '-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAu3Z9ruMEscPcfvUiBvp+
s9YiAhijgaGOBr+u41HYkPIm03EewDE2QJWx5l8xFSST3GBSEbUA93tN33nnH3B3
U0y/o8Ksepo5IGkckTrIhcJvaczbVzPbYD21Rp8VavCJ0vH6a2TT9gc9lbMMrbL1
sL5eXKaQ0JqINVeSs06auDXrgyS++8zqqvP+eTW4QxYewYY4NkZUj7tOxcOxz843
ApZjtCF3g+BaDYITsAQ+GUe/KTHt+va/w2Boc532mnEq1IfywXhjJnQ2pkPsVv51
gUeuqIZ+9XO6oQagJv6k2E3qxexz5C65Ts/CQALsV9KAXjtAyQoeawP37ss9V75C
gQIDAQAB
-----END PUBLIC KEY-----
';
    try {
        JWT::$leeway = 60;//当前时间减去60，把时间留点余地
        $decoded = JWT::decode($jwt, $key, ['RS256']); //HS256方式，这里要和签发的时候对应
        $arr = (array)$decoded;
        $returndata['code'] = "200";//200=成功
        $returndata['msg'] = "成功";//
        $returndata['data'] = $arr;//返回的数据
        return json_encode($returndata); //返回信息

    } catch (\Firebase\JWT\SignatureInvalidException $e) {  //签名不正确
        //echo "2,";
        //echo $e->getMessage();
        $returndata['code'] = "101";//101=签名不正确
        $returndata['msg'] = $e->getMessage();
        $returndata['data'] = "";//返回的数据
        return json_encode($returndata); //返回信息
    } catch (\Firebase\JWT\BeforeValidException $e) {  // 签名在某个时间点之后才能用
        //echo "3,";
        //echo $e->getMessage();
        $returndata['code'] = "102";//102=签名不正确
        $returndata['msg'] = $e->getMessage();
        $returndata['data'] = "";//返回的数据
        return json_encode($returndata); //返回信息
    } catch (\Firebase\JWT\ExpiredException $e) {  // token过期
        //echo "4,";
        //echo $e->getMessage();
        $returndata['code'] = "103";//103=签名不正确
        $returndata['msg'] = $e->getMessage();
        $returndata['data'] = "";//返回的数据
        return json_encode($returndata); //返回信息
    } catch (Exception $e) {  //其他错误
        //echo "5,";
        //echo $e->getMessage();
        $returndata['code'] = "199";//199=签名不正确
        $returndata['msg'] = $e->getMessage();
        $returndata['data'] = "";//返回的数据
        return json_encode($returndata); //返回信息
    }
    //Firebase定义了多个 throw new，我们可以捕获多个catch来定义问题，catch加入自己的业务，比如token过期可以用当前Token刷新一个新Token
}