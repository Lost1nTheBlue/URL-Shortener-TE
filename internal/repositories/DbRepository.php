<?php

require ROOT . '/internal/config/config.php';
require_once DB . '/Db.php';
require_once REP . '/IRepository.php';
require_once INTERNAL . '/func.php';

class DbRepository implements Irepository
{
    private Db $connection;
    public function __construct(Db $connection)
    {
        $this->connection = $connection;   
    }
    public function generateUniqeShortUrl($length = 6){
        //Генерируем короткую ссылку
        $shortUrl = generateShortUrl();
        // Проверяем, существует ли уже эта ссылка
        $stmt = $this->connection->query("SELECT * FROM links WHERE short_code = '$shortUrl'")->find();
        while ($stmt->num_rows > 0) {
            $shortUrl = generateShortUrl(); // Генерируем новую ссылку, если текущая уже существует
            $stmt = $this->connection->query("SELECT * FROM links WHERE short_code = '$shortUrl'");
        }
        return $shortUrl;
    }

    public function addNewUrl($originalUrl, $shortUrl)
    {
        $this->connection->query("INSERT INTO links (original_url, short_code) VALUES (?, ?)", [$originalUrl, $shortUrl]);
    }

    public function selectUrl($shortUrl)
    {
        $stmt = $this->connection->query("SELECT original_url FROM links WHERE short_code = ?", [$shortUrl])->find();
        if (count($stmt) > 0) 
        {
            return $stmt['original_url'];
        }
        else
        {
            return null;
        }
    }

    public function setUserData($data)
    {
        $this->connection->query("INSERT INTO logs (short_url, Referrer, Ip, User_Agent) VALUES (?, ?, ?, ?)", $data);
    }

    public function getUrlLogs($url)
    {
        $stmt = $this->connection->query("SELECT * FROM logs WHERE short_url = ? ORDER BY id DESC LIMIT 20" , [$url])->findAll();
        return $stmt;
    }

}