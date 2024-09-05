<?php
    function dump($data)
    {
        echo "<pre>";
        var_dump($data);
        echo "</pre>";
    }

    function dd($data)
    {
        dump($data);
        die;
    }

    function generateShortUrl($length = 6) {
        return substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $length);
    }