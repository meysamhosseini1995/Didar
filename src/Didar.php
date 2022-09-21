<?php

namespace MeysamHosseini\Didar;


class Didar
{
    protected $api_key;


    public function __construct($token)
    {
        $this->api_key = $token;
    }


    public function getToken()
    {
        return $this->api_key;
    }




}