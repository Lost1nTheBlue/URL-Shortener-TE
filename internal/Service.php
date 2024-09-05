<?php

class Service
{
    private Irepository $repository;
    public function __construct(Irepository $repository)
    {
        $this->repository = $repository;
    }
    
    public function createNewUrl($originalUrl)
    {
        $shortUrl = $this->repository->generateUniqeShortUrl();
        $this->repository->addNewUrl($originalUrl, $shortUrl);
        return $shortUrl;
    }

    public function redirectOnUrl($shortUrl)
    {
        $url = $this->repository->selectUrl($shortUrl);
        if ($url != null){
            header("Location: $url");
            exit();
        }
        else{
            echo 'Url not found';
        }
    }

    public function collectInformation($shortUrl)
    {
        if(isset($_SERVER['REMOTE_ADDR'])){
            $user_ip = $_SERVER['REMOTE_ADDR'];
        }else if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $user_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $user_ip = $_SERVER['HTTP_CLIENT_IP'];
        } else {
            $user_ip = $_SERVER['REMOTE_ADDR'];
        }
        
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $referrer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : "{$_SERVER['DOCUMENT_ROOT']}/?code=$shortUrl";

        $user_data = [
            $shortUrl,
            $referrer,
            $user_ip,
            $user_agent,
        ];
        
        $this->repository->setUserData($user_data);
    }

    public function getInfoAboutUrl($url)
    {
        return $this->repository->getUrlLogs($url);
    }

}