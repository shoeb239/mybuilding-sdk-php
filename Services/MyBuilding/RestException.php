<?php

class Services_MyBuilding_RestException
    extends Exception
{
    protected $status;
    protected $info;

    public function __construct($status, $message, $code = 0, $info = '')
    {
        $this->status = $status;
        $this->info = $info;
        parent::__construct($message, $code, null);
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getInfo()
    {
        return $this->info;
    }
}
