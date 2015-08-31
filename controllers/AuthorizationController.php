<?php
Class AuthorizationController
{
    public function actionAuthoriz()
    {
        if (($_SERVER['REQUEST_METHOD'] == "POST")) {
            if((!empty($_POST['login']))&&(!empty($_POST['pass']))){
                $data = Authorization::authoriz($_POST['login'],$_POST['pass']);
                if($data){
                    $_SESSION['user_id']=$data['id_company'];
                    $data['error']=0;
                    $data['msg']='Вы успешно авторизовались';
                }else{
                    $data['error']=1;
                    $data['msg']='Вы ввели неверный логин или пароль';
                }
                header("Content-Type: application/json");
                echo json_encode($data);
                exit;
            }else{
                $data["error"]=1;
                $data['msg']="Все поля должны быть заполнены";
                header("Content-Type: application/json");
                echo json_encode($data);
                exit;
            }
        }else {
            header('HTTP/1.0 403 Forbidden');
        }
        return true;
    }

    public function actionLogout(){
        session_destroy();
        header("Location: /");
    }
}