<?php
use QL\QueryList;

class Qlist
{

    public function __construct()
    {

    }

    public function test()
    {
        $html = $this->_get('https://zh.wikipedia.org/wiki/%E8%92%99%E5%85%B6%C2%B7D%C2%B7%E9%AD%AF%E5%A4%AB');
        return $this->analysis($html);
        // return urlencode($this->_get('https://www.baidu.com'));

        // return $this->analysis();
    }

    private function _get($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        //通过代理访问需要额外添加的参数项
        curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 0);
        curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5_HOSTNAME);
        curl_setopt($ch, CURLOPT_PROXY, "127.0.0.1");
        curl_setopt($ch, CURLOPT_PROXYPORT, "1080");

        $result = curl_exec($ch);
        if ($result === false) {
            var_dump(curl_error($ch));
            curl_close($ch);
            exit();
        }
        curl_close($ch);

        return $result;
    }

    private function analysis($html)
    {
        $data = QueryList::Query($html, array(
            // 'test' => array('.infobox', 'html'),
            'test' => array('.infobox', 'html'),
        ))->data;
        return $data;
    }

}
