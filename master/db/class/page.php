<?php
    class Page{
        function getPage($url){
            $getURL = $url;
            $getURL = explode("/",$getURL);
            $getPage = explode("?", end($getURL));
            $getPage = explode(".",reset($getPage));
            return reset($getPage);
        }
    }