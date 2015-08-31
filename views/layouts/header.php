<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Каталог | ForestTrade</title>
    <meta name="description" content="Каталог ForestTrade. Купить, продать лес, найти инвестора, найти партнера">
    <meta name="keywords" content="ForestTrade Forest Trade Купить лес, продать лес, найти инвестора, найти партнера, купить кругляк, продать кругляк, купить доску">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/apple-touch-icon-60x60.png">
    <link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="/manifest.json">

    <link rel="stylesheet" href="/template/bower/normalize.css/normalize.css" />
    <!--    Подключаем qtip css для qtip2.js - всплывающие подсказки-->
    <link rel="stylesheet" href="/template/bower/qtip2/jquery.qtip.min.css"/>


    <link rel="stylesheet" href="/template/css/style.css" />


    <!--[if lt IE 9]>
    <script src="/template/js/selectivizr.js"></script>
    <script src="/template/bower/html5shiv/dist/html5shiv.js"></script>
    <![endif]-->

</head>
<div class="page page_sidebar_left page-catalog">
<header class="header">
    <div class="top__user-info">
        <?if(!isset($_SESSION['user_id'])):?>
            <div class="f_left clearfix">
                <span><a href="#" id="avtorization">Вход</a></span>
                <div class="presentation">
                    <a class="top__link" href="https://docs.google.com/presentation/d/14mT6LAxRZeAdbwnfgEFCFdffkbyyo4PCwThnTLcNEuc/htmlpresent" target="_blank">посмотрите нашу презентацию</a>
                </div>
            </div>
            <div class="f_right clearfix">
                <span><a href="/registration/" id="registration">Регистрация</a></span>
            </div>
        <?endif;?>
        <?if(isset($_SESSION['user_id'])):?>
            <div class="f_left clearfix">
                <span>Здравствуйте  <?=Common::getUsernameById($_SESSION['user_id'])?></span>
                <div class="presentation">
                    <a class="top__link" href="https://docs.google.com/presentation/d/14mT6LAxRZeAdbwnfgEFCFdffkbyyo4PCwThnTLcNEuc/htmlpresent" target="_blank">посмотрите нашу презентацию</a>
                </div>
            </div>
            <div class="f_right clearfix">
                <span><a href="/logout/" id="exit">Выход</a></span>
            </div>
        <?endif;?>
    </div>
    <div class="page__container">
        <div class="header__logo-container">
            <div class="header__logo logo">
                <a href="#" class="logo__link"><img src="/template/img/ft_logo1.png" alt="FOREST TRADE LTD" class="logo__img">
                    <span class="logo__text">Diamant Pivden LTD</span>
                </a>
            </div>
            <div class="header__contacts">
                <a href="tel:+380933559999" class="header__phone">
                    <span class="header__phone-prefix">+3(8093)</span>
                    <span class="header__phone-number">355 99 99</span>
                </a>
                <a href="mailto:liweitaoshi@gmail.com" class="header__email">liweitaoshi@gmail.com</a>
            </div>
        </div>

        <nav class="header__menu">
            <ul class="menu list">
                <li class='list__item menu__item'><a href='/marketbuy/' id='' class='menu__link'>Купить лес</a></li>
                <li class='list__item menu__item'><a href='/marketsale/' id='' class='menu__link'>Продать лес</a></li>
                <li class='list__item menu__item'><a href='/investors/' id='' class='menu__link'>Найти инвестора</a></li>
                <li class='list__item menu__item'><a href='/partners/' id='' class='menu__link'>Найти партнера</a></li>
                <li class='list__item menu__item'><a href='/technologybuy/' id='' class='menu__link'>Купть технологию</a></li>
                <li class='list__item menu__item'><a href='/technologysale/' id='' class='menu__link'>Продать технологию</a></li>


            </ul>
        </nav>
    </div>
</header>
<!-- Начало окна авторизации -->
<div class="popup_add_prog" id="modal">
    <div class="popup_prog_header">
        <button type="button" class="close" id="close"></button>
        <div class="prog_header_text">
            Авторизация
        </div>
    </div>
    <div class="popup_prog_body">
        <div class="popup__msg">
        </div>
        <form action="/" class="form"  id="avtorization_send"  method="post">
            <label for="email" class="prog_span">Логин</label>
            <input type="email" class="prog_input" placeholder="Введите Email" name="login" id="login" qtip-position="left" qtip-content="Вы не ввели логин">
            <label for="pass" class="prog_span">Пароль</label>
            <input type="password" class="prog_input" placeholder="Введите пароль" name="pass" id="pass" qtip-position="left" qtip-content="Вы не ввели пароль">
            <div class="prog_row">
                <button type="submit" class="btn">Вход</button>
            </div>
        </form>
    </div>
</div>
<!-- конец окна авторизации -->