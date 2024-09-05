<?php

interface Irepository
{
    public function generateUniqeShortUrl($length = 6);

    public function addNewUrl($originalUrl, $shortUrl);

    public function selectUrl($shortUrl);

    public function setUserData($data);

    public function getUrlLogs($url);
}