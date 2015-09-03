<?php

require_once(ROOT."/views/layouts/header.php");?>
<div class="page__wrapper">
    <div class="page__container">
        <div class="page__row clearfix">
            <ul class="breadcrumbs list">
                <li class="list__item breadcrumbs__item">
                    <a href="/" class="breadcrumbs__link">Главная</a>
                </li>
                <li class="list__item breadcrumbs__item">
                    Оборудование
                </li>
                <li class="list__item breadcrumbs__item">
                    Продажа
                </li>
            </ul>
            <div class="pagination">
                <ul class="pagination__list list">
                    <?php echo $pagination->get(); ?>
                </ul>
            </div>
        </div>
        <div class="page__row page__middle clearfix">
            <main class="content page__region">
                <section class="content__block">
                    <?if(empty($_SESSION['user_id'])):?>
                        <div class="join_us">
                            <h3>Хотите БЕСПЛАТНО оставлять свои объявления на нашем сайте - <a href="/registration/">регистрируйтесь</a></h3>
                        </div>
                    <?endif;?>
                    <?if(!empty($_SESSION['user_id'])):?>
                        <div class="add_obj">
                            <a href="#" id="add_equipment_buy" class="add_obj-item">
                                Добавить объявление о покупке оборудования<br>
                            </a>
                        </div>
                    <?endif;?>
                    <ul class="catalog catalog_style_grid list">
                        <?php foreach($equipment_all_list as $market_list): ?>
                            <li class='list__item catalog-item'>
                                <div class='catalog-item__img-wrapper'>
                                    <?if(($market_list['foto']!=NULL)&&(file_exists("uploads/{$market_list['foto']}"))):?>
                                        <img src="/uploads/<?=$market_list['foto']?>" class='catalog-item__img' alt='Фото оборудования'>
                                    <?else:?>
                                        <img src='/template/img/no_photo.jpg' class='catalog-item__img' alt='Фото оборудования'>
                                    <?endif;?>
                                </div>
                                <div class='catalog-item__body'>
                                    <div class='catalog-item__name'>
                                        <a href='#' class='catalog-item__link'><?=$market_list['name_company'];?></a>
                                    </div>
                                    <div class='catalog-item__specs'>
                                        <div class='field'>
                                            <div class='field__name'>
                                                Тип объявления
                                            </div>
                                            <div class='field__value'>
                                                <?if($market_list['id_type_action']==1):?>
                                                    Купит
                                                <?endif;?>
                                                <?if($market_list['id_type_action']==2):?>
                                                    Продаст
                                                <?endif;?>
                                            </div>
                                        </div>
                                        <div class='field'>
                                            <div class='field__name'>Цена</div>
                                            <div class='field__value'><?=$market_list['cena']?> грн.</div>
                                        </div>
                                        <div class='field'>
                                            <div class='field__name'>Дата</div>
                                            <div class='field__value'><?=$market_list['data_actuality']?></div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach;?>
                    </ul>
                    <?php echo $pagination->get(); ?>
                </section>
                <section class="content__block page-description">
                    <h2 class="content__block__header page-description__header">Пара слов о компании ForestTrade</h2>
                    <div class="page-description__body">
                        <p>Мы с 2001 года занимаемся экспортом леса. У нас в команде работают только профессионалы. Мы лучшие на рынке леснической продукции включая такие страны как Украина,Китай.</p>
                        <p>На данном сайте вы можете ознакомиться с нашей продукцией, а также оставить свои объявления. Присоединяйтесь к команде профессионалов. Будьте вместе с лучшими</p>
                    </div>
                </section>
            </main>
            <? require_once("/views/layouts/menu.php") ?>
        </div>
    </div>
    <div class="to-top" id="to-top">Наверх</div>
</div>
<?php require_once(ROOT."/views/layouts/footer.php");?>
<?php if($_SESSION['user_id']):?>
    <!-- Начало окна добавления продажи -->
    <div class="popup_add_prog" id="modal_equipment_buy">
        <div class="popup_prog_header">
            <button type="button" class="close" id="close"></button>
            <div class="prog_header_text">
                Добавить объявление о покупке оборудования
            </div>
        </div>
        <div class="popup_prog_body">
            <div class="popup__msg-sale">
            </div>
            <form action="/equipmentbuy/add/" class="form"  id="market_equipment_send"  method="post" enctype="multipart/form-data">
                <label for="company" class="prog_span">Компания: <b><?=Market::getCompanyNameById($_SESSION['user_id'])?></b></label>
                <label class="prog_span">Категория объявления: <b>Оборудование - Продажа</b></label>
                <label for="nazvanie" class="prog_span">Название:</label>
                <input type="text" class="prog_input" placeholder="Введите название оборудования" name="nazvanie" id="nazvanie" qtip-position="left" qtip-content="Вы не ввели название оборудования">
                <label for="model" class="prog_span">Модель:</label>
                <input type="text" class="prog_input" placeholder="Введите модель оборудования" name="model" id="model" qtip-position="left" qtip-content="Вы не ввели модель оборудования">
                <label for="model" class="prog_span">Фото оборудования:</label>
                <input type="file" name="foto_equipment" id="foto_equipment"/>
                <input type="hidden" id="filename" name="filename" value=""/>
                <div class="download_img" id="download_img"></div>
                <label for="status_equipment" class="prog_span">Состояние оборудования:</label>
                <select class="select catalog-style__select" name="status_equipment" id="status_equipment">
                    <?echo Equipment::getListStatusEquipment();?>
                </select>
                <label for="cena" class="prog_span">Цена</label>
                <input type="text" class="prog_input" placeholder="Введите цену" name="cena" id="cena" qtip-position="left" qtip-content="Вы не ввели цену">

                <input type="hidden" name="token" id="token" value="<?=Common::token()?>"/>
                <div class="prog_row">
                    <button type="submit" class="btn">Добавить объявление о продаже</button>
                </div>
            </form>
        </div>
    </div>
    <!-- конец окна добавления продажи -->
<?php endif; ?>
<script src="/template/js/add_equipment_buy.js"></script>
<script src="/template/bower/jquery-file-upload/js/vendor/jquery.ui.widget.js"></script>
<script src="/template/bower/jquery-file-upload/js/jquery.iframe-transport.js"></script>
<script src="/template/bower/jquery-file-upload/js/jquery.fileupload.js"></script>
<script>
    $("#main").removeClass("catalog-nav__trigger_active catalog-nav__link catalog-nav__link_active").addClass("catalog-nav__trigger catalog-nav__link");
    $("#equipment").addClass("catalog-nav__trigger_active catalog-nav__link catalog-nav__link_active");
    $("#equipment_ul").addClass("catalog-nav__subnav_opened");
    $("#main_ul").removeClass("catalog-nav__subnav_opened");
</script>
