<?php
use QL\QueryList;

/**
 * 采集wiki百科中海贼王人物资料
 * QueryList 4
 */
class Qlist
{

    public function __construct()
    {

    }

    public function crawler()
    {
        $html = $this->_get('https://zh.wikipedia.org/wiki/%E5%B7%B4%E5%85%B6_(ONE_PIECE)');
        return $this->analysis($html);
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

        $table     = QueryList::html($html)->find('.infobox');
        $tableRows = $table->find('tr')->map(function ($row) {
            $result = array();
            $result['left'] = $row->find('th')->texts()->all();
            $result['right'] = $row->find('td')->texts()->all();
            return $result;
        });
        return $tableRows->all();
    }

}
