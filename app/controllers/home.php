<?php

class home extends eximpo {
    function index()
    {
        require_once  APPPATH."view/header.php";
        require_once  APPPATH."view/home.php";
        require_once  APPPATH."view/footer.php";
    }
}