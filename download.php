<?php

/**
**************************
** FreeTSP Version: 1.0 **
**************************
** http://www.freetsp.info
** https://github.com/Krypto/FreeTSP
** Licence Info: GPL
** Copyright (C) 2010 FreeTSP v1.0
** A bittorrent tracker source based on TBDev.net/tbsource/bytemonsoon.
** Project Leaders: Krypto, Fireknight.
**/
error_reporting(0);
require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'functions' . DIRECTORY_SEPARATOR . 'function_main.php');
require_once(FUNC_DIR . 'function_user.php');
require_once(FUNC_DIR . 'function_vfunctions.php');

db_connect();
logged_in();

if (!preg_match(':^/(\d{1,10})/(.+)\.torrent$:', $_SERVER['PATH_INFO'], $matches)) {
    httperr();
}

$id = intval(0 + $matches[1]);

if (!is_valid_id($id)) {
    httperr();
}

$res = $db->query("SELECT name, banned
                   FROM torrents
                   WHERE id = " . $id) or sqlerr(__FILE__, __LINE__);

$row = $res->fetch_assoc();

$fn = $torrent_dir . '/' . $id . '.torrent';

if (!$row || !is_file($fn) || !is_readable($fn)) {
    httperr();
}

if ($row['banned'] == 'yes' && get_user_class() < UC_MODERATOR) {
    if (!defined('IN_FTSP_ADMIN')) {
        ?>
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
             "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

        <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

            <title><?php if (isset($_GET['error'])) {
                echo security::html_safe($_GET['error']);
            }
            ?> Error</title>

            <link rel='stylesheet' type='text/css' href='/errors/error-style.css' />
        </head>
        <body>
            <div id='container'>
                <div align='center' style='padding-top:15px'><img src='/errors/error-images/alert.png' width='89' height='94' alt='404 Page Not Found' title='404 Page Not Found' /></div>
                <h1 class='title'>Error 404 - Page Not Found</h1>
                <p class='sub-title' align='center'>The page that you are looking for does not appear to exist on this site.</p>
                <p>If you typed the address of the page into the address bar of your browser, please check that you typed it in correctly.</p>
                <p>If you arrived at this page after you used an old Boomark or Favorite, the page in question has probably been moved. Try locating the page via the navigation menu and then updating your bookmark.</p>
            </div>
        </body>
        </html>

        <?php
    exit();
    }
}

$db->query("UPDATE torrents
           SET hits = hits + 1
           WHERE id = $id");

require_once(FUNC_DIR . 'function_benc.php');

if (strlen(user::$current['passkey']) != 32) {
    user::$current['passkey'] = md5(user::$current['username'] . get_date_time() . user::$current['passhash']);

    $db->query("UPDATE users
                SET passkey = " . user::$current['passkey'] . "
                WHERE id = " . user::$current['id']);
}

$dict = bdec_file($fn, (1024 * 1024));

$dict['value']['announce']['value'] = "$site_url/announce.php?passkey=" . user::$current['passkey'];
$dict['value']['announce']['string'] = strlen($dict['value']['announce']['value']) . ":" . $dict['value']['announce']['value'];
$dict['value']['announce']['strlen'] = strlen($dict['value']['announce']['string']);

header('Content-Disposition: attachment; filename="' . AddSlashes($torrent['filename']) . '"');
header("Content-Type: application/x-bittorrent");

print(benc($dict));

?>