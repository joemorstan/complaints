<?php

class Paginator {

    public static function liActive($page, $topic, $orderBy, $order)
    {
        return '<li class="page-item active"><a class="page-link" href="'. URL . $topic .'/page/'. $page .'/'. $orderBy. '/'. $order. '">'. $page .'</a></li>';
    }

    public static function liNotActive($page, $topic, $orderBy, $order)
    {
        return '<li class="page-item"><a class="page-link" href="'. URL . $topic .'/page/'. $page .'/'. $orderBy. '/'. $order. '">'. $page .'</a></li>';
    }
}