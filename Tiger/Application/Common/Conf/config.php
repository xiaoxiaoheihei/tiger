<?php
return array(
    	//'配置项'=>'配置值'
    	'DB_DEPLOY_TYPE' => 0, // 数据库部署方式 0 集中式（单一服务器） 1 分布式（主从服务器）
        'DB_TYPE' => 'mongo', // 数据库类型
        // 'DB_HOST' => '127.0.0.1',
        'DB_HOST' => '47.90.23.150', // 服务器地址
        'DB_NAME' => 'crawlerdb', // 数据库名
        'DB_USER' => '', // 用户名
        'DB_PWD' => '', // 密码
        'DB_PORT' => '27017', // 端口
        'DB_PREFIX' => '', // 数据库表前缀
);