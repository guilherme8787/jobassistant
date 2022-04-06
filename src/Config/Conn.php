<?php

namespace App\Config;

class Conn
{
    public function link()
    {
        $link = mysqli_connect("localhost", "root", "", "jobassistant");
        if ($link->connect_errno) {
            echo $link->connect_error . 'N deu';
            return 0;
        } else {
            return $link;
        }
    }

    public function getQuery($link, $sql)
    {
        if ($result = $link->query($sql)) {
            return $result;
        }
    }

    public function queryIn($link, $sql)
    {
        if ($link->query($sql) === true) {
            return true;
        } else {
            return false;
        }
    }

    public function closeCon()
    {
        $link->close;
    }
}
