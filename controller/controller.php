<?php

require('model/model.php');

function index(){
    require('view/viewIndex.php');
}

function blog(){
    require('view/viewBlog.php');
}

function auth(){
    require('view/viewAuth.php');
}

function error(){
    require('view/viewError.php');
}