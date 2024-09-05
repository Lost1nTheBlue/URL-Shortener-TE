<?php
    define("ROOT", __DIR__);
    require ROOT . '/internal/config/config.php';
    require_once VIEWS . '/index.tpl.php';
    require DB . '/Db.php';
    require INTERNAL . '/func.php';
    require INTERNAL .'/Service.php';
    require_once REP . '/IRepository.php';
    require REP . '/DbRepository.php';

    $db_config = require CONFIG . '/db.php';
    $db = (Db::getInstance())->getConnection($db_config);;
    $repository = new DbRepository($db);
    $service = new Service($repository);

    if (isset($_GET['code'])) {
        $url = $_GET['code'];
        $service->collectInformation($url);
        $service->redirectOnUrl($url);
    }
    else if (isset($_POST["url"]))
    {
        $url = $_POST["url"];
        $shortUrl = $service->createNewUrl($url);
        $shortUrl = $service->createNewUrl($url);
        ?><div class='short-url'>
        Short URL: <a href='index.php?code=<?= $shortUrl ?>'><?= $_SERVER['HTTP_HOST'] . '?' . 'code=' . $shortUrl ?></a>
        </div><?php
    }