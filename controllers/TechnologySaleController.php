<?php
class TechnologySaleController
{
    public function actionIndex($page=1)
    {
        $page = intval($page);
        $technology_all_list = Technology::getAllTechnology($page,2);


        // Общее количетсво товаров (необходимо для постраничной навигации)
        $total = Technology::getTotalTechnology(2);

        // Создаем объект Pagination - постраничная навигация
        $pagination = new Pagination($total, $page, Technology::SHOW_BY_DEFAULT, 'page-');

        //Подключаем вид
        require_once(ROOT.'/views/technology/technologysale.php');

        return true;
    }
    public function actionAdd()
    {
        if (($_SERVER['REQUEST_METHOD'] == "POST") && ($_POST['token'] == $_SESSION['token'])) {
            if (filter_has_var(INPUT_POST, 'opisanie')) {
                if ((strlen(filter_input(INPUT_POST, 'opisanie')) < 200)&&(strlen(filter_input(INPUT_POST,'opisanie'))>10)) {
                    $id_company = $_SESSION['user_id'];
                    $opisanie = $_POST['opisanie'];
                    $date = date("Y-m-d");
                    $id_type_action = 2; //Тип объявления - 1-покупка 2-продажа

                    $data = Technology::insertTechnology($id_company, $opisanie, $date, $id_type_action);

                    header("Content-Type: application/json");
                    echo json_encode($data);
                    exit;
                } else {
                    $data["error"] = 1;
                    $data['msg'] = "Вы вводите некорректные данные";
                    header("Content-Type: application/json");
                    echo json_encode($data);
                    exit;
                }
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
        return true;
    }
}