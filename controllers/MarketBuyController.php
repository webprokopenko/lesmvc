<?php
class MarketBuyController
{
    public function actionIndex($page=1)
    {
        $page = intval($page);


        $market_all_list = Market::getMarketByAction($page,1);


        // Общее количетсво товаров (необходимо для постраничной навигации)
        $total = Market::getTotalMarket(1);

        // Создаем объект Pagination - постраничная навигация
        $pagination = new Pagination($total, $page, Market::SHOW_BY_DEFAULT, 'page-');

        //Подключаем вид
        require_once(ROOT.'/views/market/marketbuy.php');

        return true;
    }

    public function actionAdd()
    {
        if (($_SERVER['REQUEST_METHOD'] == "POST") && ($_POST['token']==$_SESSION['token'])) {
            if((!empty($_POST['category_prod']))&&(!empty($_POST['country_proish']))&&(!empty($_POST['cena']))&&(!empty($_POST['col_vo']))){
                if((is_numeric ($_POST['category_prod']))&&(is_numeric ($_POST['country_proish']))&&(is_numeric ($_POST['cena']))&&(is_numeric ($_POST['col_vo']))){

                    $id_company = $_SESSION['user_id'];
                    $id_prod_category = $_POST['category_prod'];
                    $id_country_proish = $_POST['country_proish'];
                    $cena = substr($_POST['cena'],0,6);
                    $col_vo = substr($_POST['col_vo'],0,4);
                    $data_actuality = date("Y-m-d");
                    $id_type_action = 1; //Тип объявления - 1-покупка 2-продажа

                    $data = Market::insertMarket($id_company, $id_prod_category, $id_country_proish, $cena, $col_vo, $data_actuality, $id_type_action);

                    header("Content-Type: application/json");
                    echo json_encode($data);
                    exit;
                }
                else{
                    $data["error"]=1;
                    $data['msg']="В поле цена и количество должны быть только числа";
                    header("Content-Type: application/json");
                    echo json_encode($data);
                    exit;
                }

            }
            else {
                $data["error"]=1;
                $data['msg']="Все поля должны быть заполнены";
                header("Content-Type: application/json");
                echo json_encode($data);
                exit;
            }
        }else {
            $data["error"]=1;
            $data['msg']="Не нужно взламывать наш сайт";
            header("Content-Type: application/json");
            echo json_encode($data);
            exit;
            //header('HTTP/1.0 403 Forbidden');
        }

        return true;
    }
}