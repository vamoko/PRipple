<?php
/*
 * @Author: cclilshy jingnigg@gmail.com
 * @Date: 2023-03-21 20:32:14
 * @LastEditors: cclilshy jingnigg@gmail.com
 * Copyright (c) 2023 by user email: jingnigg@gmail.com, All Rights Reserved.
 */

namespace Cclilshy\PRipple\Service;

use Cclilshy\PRipple\Communication\Socket\Client;
use Cclilshy\PRipple\Dispatch\DataStandard\Build;
use Cclilshy\PRipple\Dispatch\DataStandard\Event;

interface ServiceStandard
{
    /**
     * 服务启动后执行
     *
     * @return void
     */
    public function initialize(): void;

    /**
     * 处理消息类型消息
     *
     * @param string $message
     * @return void
     */
    public function execMessage(string $message): void;

    /**
     * 处理原生消息包
     *
     * @param \Cclilshy\PRipple\Dispatch\DataStandard\Build $package
     * @return void
     */
    public function execPackage(Build $package): void;

    /**
     * 处理事件类型消息
     *
     * @param \Cclilshy\PRipple\Dispatch\DataStandard\Event $event
     * @return void
     */
    public function execEvent(Event $event): void;

    /**
     * 处理服务器报文
     *
     * @param string                                        $context
     * @param \Cclilshy\PRipple\Communication\Socket\Client $client
     * @return void
     */
    public function execOriginalContext(string $context, Client $client): void;
}