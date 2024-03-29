<?php
/*
 * @Author: cclilshy jingnigg@gmail.com
 * @Date: 2023-03-18 17:14:37
 * @LastEditors: cclilshy jingnigg@gmail.com
 * Copyright (c) 2023 by user email: jingnigg@gmail.com, All Rights Reserved.
 */

declare(strict_types=1);

namespace Cclilshy\PRipple\Communication\Socket;

use Exception;

class SocketUnix
{
    /**
     * 创建一个自定义缓冲区大小的UNIX套接字
     *
     * @param string    $sockFile   套接字文件地址
     * @param bool|null $block
     * @param int|null  $bufferSize 默认缓冲区大小为8M
     * @return mixed
     * @throws \Exception
     */
    public static function create(string $sockFile, bool|null $block = true, int|null $bufferSize = 1024 * 1024): mixed
    {
        if (file_exists($sockFile)) {
            throw new Exception('无法创建Unix套接字,可能进程被占用');
        }
        $sock = socket_create(AF_UNIX, SOCK_STREAM, 0);
        if (!$sock) {
            throw new Exception('无法创建Unix套接字,可能进程被占用');
        }
        socket_set_option($sock, SOL_SOCKET, SO_SNDBUF, $bufferSize);
        socket_set_option($sock, SOL_SOCKET, SO_RCVBUF, $bufferSize);
        if (!socket_bind($sock, $sockFile)) {
            throw new Exception('无法绑定套接字,请查看目录权限:' . $sockFile);
        }
        if ($block === false) {
            socket_set_nonblock($sock);
        }
        socket_listen($sock);
        return $sock;
    }

    /**
     * @param string   $sockFile
     * @param int|null $bufferSize
     * @return mixed
     * @throws \Exception
     */
    public static function connect(string $sockFile, int|null $bufferSize = 1024 * 1024): mixed
    {
        $sock = socket_create(AF_UNIX, SOCK_STREAM, 0);
        socket_set_option($sock, SOL_SOCKET, SO_SNDBUF, $bufferSize);
        socket_set_option($sock, SOL_SOCKET, SO_RCVBUF, $bufferSize);
        $_ = @socket_connect($sock, $sockFile);
        if ($_) {
            return $sock;
        } else {
            throw new Exception("无法连接Unix套接字,可能服务器未启动");
        }
    }
}
