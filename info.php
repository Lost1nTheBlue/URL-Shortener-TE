<?php
    if (isset($_GET['code'])){
        define("ROOT", __DIR__);
        require ROOT . '/internal/config/config.php';
        require DB . '/Db.php';
        require INTERNAL . '/func.php';
        require INTERNAL .'/Service.php';
        require_once REP . '/IRepository.php';
        require REP . '/DbRepository.php';

        $url = $_GET['code'];
        $db_config = require CONFIG . '/db.php';
        $db = (Db::getInstance())->getConnection($db_config);;
        $repository = new DbRepository($db);
        $service = new Service($repository);

        $logs = $service->getInfoAboutUrl($url);

        require_once VIEWS . '/info.tpl.php';
    }