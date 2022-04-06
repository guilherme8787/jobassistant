<?php 

namespace App;

use App\Config\Conn;

class DataManager {

    public function post($data){
        $erro = false;

        $arr = [
            'assuntoTxt',
            'emailEmpresa',
        ];

        foreach($arr as $field){
            if(!isset($data[$field])){
                $erro = true;
            }

            if(isset($data[$field])){
                if(empty($data[$field])){
                    $erro = true;
                }
            }
        }

        if($erro){
            return false;
        } else {
            $con = new Conn;
            $link = $con->link();
            $sql = "INSERT INTO vagas (email, assunto) VALUES ('".$data['emailEmpresa']."', '".$data['assuntoTxt']."');";
            return $con->queryIn($link, $sql);
        }

    }

    public function get($filter = null){
        $con = new Conn;
        $link = $con->link();
        if($filter == null){
            $sql = "SELECT * FROM  vagas ORDER BY id DESC";
        } else {
            if(is_array($filter)){
                foreach($filter as $index => $val){
                    $where[] = "$index = '$val'";
                }
                $where = implode(' and ', $where);
                $sql = "SELECT * FROM  vagas WHERE $where ORDER BY id DESC";
            }
        }
        return $con->getQuery($link, $sql);
    }

    public function marcaEnvio($email){
        $con = new Conn;
        $link = $con->link();
        $sql = "UPDATE vagas SET enviado = 1 WHERE email = '".$email."';";
        return $con->queryIn($link, $sql);
    }

}