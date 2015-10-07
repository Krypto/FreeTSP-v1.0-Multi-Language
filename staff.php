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

require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'functions' . DIRECTORY_SEPARATOR . 'function_main.php');
require_once(FUNC_DIR . 'function_user.php');
require_once(FUNC_DIR . 'function_vfunctions.php');
require_once(FUNC_DIR . 'function_bbcode.php');

db_connect();
logged_in();

$lang = array_merge(load_language('staff'),
                    load_language('global'),
                    load_language('func_bbcode'));

site_header("{$lang['title_staff']}", false);

//-- Get Current Datetime --//
$dt = gmtime() - 60;
$dt = sqlesc(get_date_time($dt));

//-- Search User Database For Moderators And Above And Display In Alphabetical Order --//
$res = $db->query("SELECT id, username, class, last_access
                   FROM users
                   WHERE class >= " . UC_UPLOADER . "
                   ORDER BY username") or sqlerr();

while ($arr = $res->fetch_assoc()) {
        $staff_class[$arr['class']] = $staff_class[$arr['class']] . "
        <tr>
            <td class='std' align='center' width='33%'>
                <a href='userdetails.php?id=" . (int)$arr['id'] . "'><strong><font color='#" . get_user_class_color($arr['class']) . "'>" . security::html_safe($arr['username']) . "</font></strong></a>
            </td>
            <td class='std' align='center' width='33%'> " . ("'{$arr['last_access']}'" > $dt ? "
                <img src='{$image_dir}online.png' width='32' height='32' border='0' alt='{$lang['img_alt_online']}' title='{$lang['img_alt_online']}' />" : "
                <img src='{$image_dir}offline.png' width='32' height='32' border='0' alt='{$lang['img_alt_offline']}' title='{$lang['img_alt_offline']}' />") . "
            </td>" . "
            <td class='std' align='center' width='33%'>
                <a href='sendmessage.php?receiver=" . (int)$arr['id'] . "'>
                    <input type='submit' class='btn' value='{$lang['btn_pm']}' />
                </a>
            </td>
        </tr>";
}

$support_msg = ("{$lang['text_fls_msg1']}<br />
                 {$lang['text_fls_msg2']}<br />
                 {$lang['text_fls_msg3']}<br /><br />");

?>

<div align='center'>
    <span style='text-align : center; font-size : small;'>
        <?php echo $lang['text_msg1']?><span style='font-weight : bold;'><?php echo $site_name?>.</span><br />
        <?php echo $lang['text_msg2']?><br />
        <?php echo $lang['text_msg3']?><br />
        <?php echo $lang['text_msg4']?>
    </span>
</div>

<div id='featured' align='center'>
    <br />
    <ul>
           <li><a href='#fragment-0'></a></li>
           <li><a class='btn' href='#fragment-1'><?php echo $lang['btn_fls']?></a></li>
           <li><a class='btn' href='#fragment-2'><?php echo $lang['btn_uploader']?></a></li>
           <li><a class='btn' href='#fragment-3'><?php echo $lang['btn_mods']?></a></li>
           <li><a class='btn' href='#fragment-4'><?php echo $lang['btn_admin']?></a></li>
           <li><a class='btn' href='#fragment-5'><?php echo $lang['btn_sysop']?></a></li>
           <li><a class='btn' href='#fragment-6'><?php echo $lang['btn_manager']?></a></li>
    </ul>

    <div class='ui-tabs-panel' id='fragment-1'>
        <table class='coltable' width='81%'>
            <tr>
              <td class='std' align='center' colspan='3'><h2><?php echo $lang['table_fls']?></h2><?php echo $support_msg?></td>
            </tr>
        </table>
                    <?php

                    $dt        = gmtime() - 60;
                    $dt        = sqlesc(get_date_time($dt));
                    $firstline = '';

                    $q = $db->query("SELECT users.id, username, email, last_access, country, status, support, supportfor, countries.flagpic, countries.name, support_lang, class
                                    FROM users
                                    LEFT JOIN countries ON countries.id = users.country
                                    WHERE support = 'yes'
                                    AND status = 'confirmed'
                                    ORDER BY username
                                    LIMIT 20") or sqlerr();

                    while ($a = $q->fetch_assoc())
                    {
                        $country   = "<img src='{$image_dir}flag/{$a['flagpic']}' width='32' height='20' border='0' alt='" . security::html_safe($a['name']) . "' title='" . security::html_safe($a['name']) . "' style='margin-left : 8pt' />";

                        $firstline .= "<tr>
                                        <td class='rowhead'>
                                            <a href='userdetails.php?id={$a['id']}'><strong><font color='#" . get_user_class_color($a['class']) . "'>&nbsp;" . security::html_safe($a['username']) . "</font></strong></a>
                                        </td>

                                    <td class='rowhead' align='center'>" . ("'{$a['last_access']}'" > $dt ? "
                                        <img src='{$image_dir}online.png' width='32' height='32' border='0' alt='{$lang['img_alt_online']}' title='{$lang['img_alt_online']}' />" : "
                                        <img src='{$image_dir}offline.png' width='32' height='32' border='0' alt='{$lang['img_alt_offline']}' title='{$lang['img_alt_offline']}' />") . "
                                    </td>

                                    <td class='rowhead' align='center'>
                                        <a href='sendmessage.php?receiver={$a['id']}'>" . "<input type='submit' class='btn' value='{$lang['btn_pm']}' /></a>
                                    </td>
                                    <td class='rowhead'>&nbsp;" . security::html_safe($a['support_lang']) . "</td>
                                    <td class='rowhead' align='center'>$country</td>
                                    <td class='rowhead'>&nbsp;" . security::html_safe($a['supportfor']) . "</td>
                                    </tr>";
                    }

                    echo("<table cellspacing='0' width='81%'>
                            <tr>
                                <td class='colhead' width='30'>&nbsp;<b>{$lang['table_username']}</b></td>
                                <td class='colhead' width='5' align='center'><b>{$lang['table_status']}</b></td>
                                <td class='colhead' width='5' align='center'><b>{$lang['table_contact']}</b></td>
                                <td class='colhead' width='85'>&nbsp;<b>{$lang['table_lang']}</b></td>
                                <td class='colhead' width='40' align='center'><b>{$lang['table_country']}</b></td>
                                <td class='colhead' width='200'>&nbsp;<b>{$lang['table_support']}</b></td>
                            </tr>
                             $firstline
                        </table>");
                    ?>
     </div>

    <div class='ui-tabs-panel' id='fragment-2'>
        <table class='coltable' width='81%'>
            <tr>
                <td class='std' align='center' colspan='3'><h2><?php echo $lang['table_uploader']?></h2></td>
                </tr>
                    <?php echo $staff_class[UC_UPLOADER]?>
        </table>
     </div>

    <div class='ui-tabs-panel' id='fragment-3'>
        <table class='coltable' width='81%'>
            <tr>
                <td class='std' align='center' colspan='3'><h2><?php echo $lang['table_mods']?></h2></td>
            </tr>
                <?php echo $staff_class[UC_MODERATOR]?>
        </table>
    </div>

    <div class='ui-tabs-panel' id='fragment-4'>
        <table class='coltable' width='81%'>
            <tr>
                <td class='std' align='center' colspan='3'><h2><?php echo $lang['table_admin']?></h2></td>
            </tr>
                <?php echo $staff_class[UC_ADMINISTRATOR]?>
        </table>
    </div>

    <div class='ui-tabs-panel' id='fragment-5'>
        <table class='coltable' width='81%'>
            <tr>
                <td class='std' align='center' colspan='3'><h2><?php echo $lang['table_sysop']?></h2></td>
            </tr>
                <?php echo $staff_class[UC_SYSOP]?>
        </table>
    </div>

    <div class='ui-tabs-panel' id='fragment-6'>
        <table class='coltable' width='81%'>
            <tr>
                <td class='std' align='center' colspan='3'><h2><?php echo $lang['table_manager']?></h2></td>
            </tr>
                <?php echo $staff_class[UC_MANAGER]?>
        </table>
    </div>

</div>

<script type="text/javascript" src="js/jquery-1.8.2.js" ></script>
<script type="text/javascript" src="js/jquery-ui-1.9.0.custom.min.js" ></script>

<script type="text/javascript">
    $(document).ready(function()
    {
        $("#featured").tabs({fx:{opacity: "toggle"}}).tabs("rotate", 5000, true);
    });
</script>

<?php

site_footer();

?>