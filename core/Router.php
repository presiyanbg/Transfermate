<?php
session_start();

class Router
{
    public static function navigate()
    {
        Pager::load();
    }
}