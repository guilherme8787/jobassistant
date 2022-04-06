<?php
ini_set('max_execution_time', 0);
header('Content-type: application/json');

require_once 'vendor/autoload.php';

use App\MailManager;
use App\DataManager;

class MailDispatch {

    public static function sendingMails(){
        $dataManager = new DataManager;
        $result = $dataManager->get(['enviado' => 0]);
        $rows = mysqli_num_rows($result);
        if($rows > 0){
            while($row = mysqli_fetch_array($result)){
                $data = ['assunto' => $row['assunto'], 'email' => $row['email']];
                MailManager::sendMail($data);
                $dataManager->marcaEnvio($row['email']);
                sleep(20);
            }
        }
    }

    public static function standaloneSendingById($id){
        $dataManager = new DataManager;
        $result = $dataManager->get(['id' => $id]);
        $rows = mysqli_num_rows($result);
        if($rows > 0){
            while($row = mysqli_fetch_array($result)){
                $data = ['assunto' => $row['assunto'], 'email' => $row['email']];
                MailManager::sendMail($data);
                $dataManager->marcaEnvio($row['email']);
            }
        }
    }

}

if($_SERVER['REQUEST_METHOD'] === 'GET'){
    if(isset($_GET['send'])){
        if($_GET['send'] == 'one'){
            if(isset($_GET['id'])){
                MailDispatch::standaloneSendingById($_GET['id']);
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false]);
            }
        }
        if($_GET['send'] == 'all'){
            MailDispatch::sendingMails();
            echo json_encode(['success' => true]);
        }
    } else {
        echo json_encode(['success' => false]);
    }
}


