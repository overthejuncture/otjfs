<?php

namespace Controllers;

class Index
{
    public static function json()
    {
        return response()->json(['checkKey' => 'checkValue']);
    }

    public function view()
    {
        return view('index/index', ['viewDataKey' => 'viewDataValue']);
    }

    public function test()
    {

    }
}
