<?php
Class RegistrationController
{
    public function actionIndex()
    {
        //Подключаем вид
        require_once(ROOT . '/views/registration/index.php');
        return true;
    }
    public function actionAdd()
    {
        if (($_SERVER['REQUEST_METHOD'] == "POST")) {
            if ((!empty($_POST['name_company'])) && (!empty($_POST['name_sotr'])) && (!empty($_POST['dolzn_sotr'])) && (!empty($_POST['email'])) && (!empty($_POST['tel'])) && (!empty($_POST['country'])) && (!empty($_POST['pass1'])) && (!empty($_POST['opisanie']))) {
                if ((filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) && (is_string($_POST['name_sotr'])) && (is_string($_POST['name_company'])) && (strlen($_POST['opisanie']) < 100) && (strlen($_POST['adress']) < 70) && (strlen($_POST['name_sotr']) < 30) && (strlen($_POST['dolzn_sotr']) < 50) && (strlen($_POST['country']) < 50)) {
                    $id = Registration::addCompany($_POST);
                    if ($id) {
                        $data["error"] = 0;
                        $data['msg'] = "Компания успешно добавлена";
                    }else{
                        $data["error"] = 1;
                        $data['msg'] = "Ошибка, обратитесь в службу поддержки";
                    }

                    header("Content-Type: application/json");
                    echo json_encode($data);
                    exit;
            } else {
                    $data["error"] = 1;
                    $data['msg'] = "Все поля должны быть заполнены";
                    header("Content-Type: application/json");
                    echo json_encode($data);
                    exit;
            }
            } else {
                header('HTTP/1.0 403 Forbidden');
            }

        }
        return true;
    }
}