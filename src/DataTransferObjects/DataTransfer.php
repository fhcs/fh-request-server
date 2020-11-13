<?php


namespace Fh\RequestServer\DataTransferObjects;


interface DataTransfer
{
    public static function make(array $data);
}
