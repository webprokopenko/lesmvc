<?php
class EquipmentSaleController
{
    public function actionIndex($page=1)
    {
        $page = intval($page);
        $equipment_all_list = Partners::getAllPartners($page);


        // Общее количетсво товаров (необходимо для постраничной навигации)
        $total = Partners::getTotalPartners();

        // Создаем объект Pagination - постраничная навигация
        $pagination = new Pagination($total, $page, Technology::SHOW_BY_DEFAULT, 'page-');

        //Подключаем вид
        require_once(ROOT.'/views/equipment/equipmentsale.php');

        return true;
    }

    public function actionAdd()
    {

        return true;
    }
}