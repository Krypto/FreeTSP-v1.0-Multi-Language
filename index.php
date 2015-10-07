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

if (filesize("functions/function_config.php") == 0)
{
    header("Location: install/index.php");

    exit;
}

require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'functions' . DIRECTORY_SEPARATOR . 'function_main.php');
require_once(FUNC_DIR . 'function_user.php');
require_once(FUNC_DIR . 'function_vfunctions.php');
require_once(FUNC_DIR . 'function_bbcode.php');

db_connect(true);
logged_in();

$lang = array_merge(load_language('index'),
                    load_language('shout'),
                    load_language('func_bbcode'),
                    load_language('global'));

//-- Start Cached Latest User - Credits Bigjoos --//
if (user::$current)
{
    if (($arr = $Memcache->get_value('new::user')) === false) {
        $r_new = $db->query("SELECT id, username
                            FROM users
                            ORDER BY id DESC
                            LIMIT 1 ") or sqlerr(__FILE__, __LINE__);

        $arr = $r_new->fetch_assoc();
        $Memcache->cache_value('new::user', $arr, 300);
    }

        $new_user = "&nbsp;<a href='$site_url/userdetails.php?id={$arr['id']}'>" . security::html_safe($arr['username']) . "</a>\n";

}
//-- End Cached Latest User --//

//-- Start Stats - Credits Bigjoos --//
if (($row = $Memcache->get_value('tracker::stats')) === false) {
    $stats = $db->query("SELECT *, seeders + leechers AS peers, seeders / leechers AS ratio, unconnectables / (seeders + leechers) AS ratiounconn
                        FROM stats
                        WHERE id = '1' LIMIT 1") or sqlerr(__FILE__, __LINE__);

    $row = $stats->fetch_assoc();
    $Memcache->cache_value('tracker::stats', $row, 300);
}

$seeders        = number_format($row['seeders']);
$leechers       = number_format($row['leechers']);
$registered     = number_format($row['regusers']);
$unverified     = number_format($row['unconusers']);
$torrents       = number_format($row['torrents']);
$torrentstoday  = number_format($row['torrentstoday']);
$ratiounconn    = $row['ratiounconn'];
$unconnectables = $row['unconnectables'];
$ratio          = round(($row['ratio'] * 100));
$peers          = number_format($row['peers']);
$numactive      = number_format($row['numactive']);
$donors         = number_format($row['donors']);
$forumposts     = number_format($row['forumposts']);
$forumtopics    = number_format($row['forumtopics']);
//-- End Stats --//

site_header();

/*
    ?>
    <span style='font-size : xx-small;'><?php echo $lang['text_welcome']?><span style='font-weight : bold;'><?php echo $new_user?></span>!</span><br /><br />
    <?php
*/

//-- Start Check For Pending Invited Members --//
if (($arr = $Memcache->get_value('invited::status::' . user::$current['id'])) === false) {
    $query = $db->query("SELECT status
                         FROM users
                         WHERE invitedby = " . sqlesc(user::$current['id'])) or sqlerr(__FILE__, __LINE__);

    $arr = $query->fetch_assoc();
    $Memcache->cache_value('invited::status::' . user::$current['id'], $arr, 14400);
}

if ($arr['status'] == 'pending')
{
    display_message_center("info",
                           "{$lang['err_invite_pending']}",
                           "{$lang['text_hi']}<strong>" . security::html_safe(user::$current['username']) . "</strong><br /><br />
                           {$lang['text_wait_conf']}<br /><br />
                           {$lang['text_click']}<a class='btn' href='invite.php'><strong>{$lang['text_here']}</strong></a>{$lang['text_conf_invite']}");
}
//-- Finish Check For Pending Invited Members --//

//-- Start Help Desk Alert Question --//
if (get_user_class() >= UC_MODERATOR)
{
	if (($problems = $Memcache->get_value('helpdesk::problems::count')) === false) {
        $resa = $db->query("SELECT COUNT(id) AS problems
                            FROM helpdesk
                            WHERE solved = 'no'");

        $arra     = $resa->fetch_assoc();
        $problems = (int)$arra['problems'];
        $Memcache->cache_value('helpdesk::problems::count', $problems, 7200);
    }

    if ($problems > 0)
    {
        display_message_center("info",
                               "{$lang['text_help_desk']}",
                               "{$lang['text_hi']}<strong>" . security::html_safe(user::$current['username']) . "</strong><br /><br />
                               {$lang['text_there']}" . ($problems == 1 ? $lang['text_is'] : $lang['text_are']) . " <strong>$problems{$lang['text_question']}".($problems == 1 ? '' : '' . $lang['text_post_s'] . '') . "</strong>{$lang['text_req_answer']}<br /><br />
                               {$lang['text_click']}<strong><a class='btn' href='controlpanel.php?fileaction=23&amp;action=problems'>{$lang['text_here']}</a></strong>{$lang['text_deal_with']}");
    }
}
//-- Finish Help Desk Alert Question --//

//-- Start Report Link --//
if (get_user_class() >= UC_MODERATOR)
{
	if (($num_reports = $Memcache->get_value('reports::count')) === false) {
        $res_reports = $db->query("SELECT COUNT(id)
                                   FROM reports
                                   WHERE delt_with = '0'");

        $arr_reports = $res_reports->fetch_row();
        $num_reports = (int)$arr_reports[0];
        $Memcache->cache_value('reports::count', $num_reports, 14400);
    }

    if ($num_reports > 0)
    {
        display_message_center("info",
                               "{$lang['text_reports']}",
                               "{$lang['text_hi']}<strong>" . security::html_safe(user::$current['username']) . "</strong><br /><br />
                               {$lang['text_there']}" . ($num_reports == 1 ? $lang['text_is'] : $lang['text_are']) . " <strong>$num_reports{$lang['text_report']}" . ($num_reports == 1 ? '' : '' . $lang['text_post_s'] . '') . "</strong>{$lang['text_dealt_with']}<br /><br />
                               {$lang['text_click']}<strong><a class='btn' href='controlpanel.php?fileaction=26'>{$lang['text_here']}</a></strong>{$lang['text_view_reports']}");
    }
}
//-- Finish Report Link --//

//-- Start Staff News --//
if (get_user_class() >= UC_MODERATOR)
{
    print("<h2>{$lang['text_staff_news']}</h2>");

    if (($staffnews2 = $Memcache->get_value('staff::news')) === false) {
        $res = $db->query("SELECT id, userid, added, body
                           FROM staffnews
                           WHERE added + ( 3600 *24 *45 ) > " . vars::$timestamp . "
                           ORDER BY added DESC
                           LIMIT 10") or sqlerr(__FILE__, __LINE__);

        while ($staffnews1 = $res->fetch_assoc()) {
            $staffnews2[] = $staffnews1;
        }
        $Memcache->cache_value('staff::news', $staffnews2, 43200);
    }

    if ($staffnews2)
    {
        print("<table border='1' width='100%' cellspacing='0' cellpadding='10'><tr><td class='text'>\n<ul>");

        foreach ($staffnews2
                 AS
                 $array)
        {
            print("<li>" . gmdate("Y-m-d", strtotime($array['added'])) . " - " . format_comment($array['body'], 0));

            print("</li>");
        }
        print("</ul></td></tr></table><br />");
    }
}
//-- Finish Staff News --//

//-- Start News --//
if (isset(user::$current))
{
    print("<h2>{$lang['text_news']}</h2>\n");
    print("<table class='main' border='0' width='100%' cellspacing='0' cellpadding='0'><tr><td class='embedded'>");

    if (($news2 = $Memcache->get_value('current::news')) === false) {
        $res = $db->query("SELECT id, userid, added, body
                           FROM news
                           WHERE added + ( 3600 *24 *45 ) > " . vars::$timestamp . "
                           ORDER BY added DESC
                           LIMIT 10") or sqlerr(__FILE__, __LINE__);

        while ($news1 = $res->fetch_assoc()) {
            $news2[] = $news1;
        }
        $Memcache->cache_value('current::news', $news2, 43200);
    }

    if ($news2)
    {
        print("<table border='1' width='100%' cellspacing='0' cellpadding='10'><tr><td class='text'>\n<ul>");

        foreach ($news2
                 AS
                 $array)
        {
            print("<li>" . gmdate("Y-m-d", strtotime($array['added'])) . " - " . format_comment($array['body'], 0));

            print("</li>");
        }
        print("</ul></td></tr></table>\n");
    }
}
//-- End News --//
?>

    <br/><h2><?php echo $lang['text_shoutbox']?></h2>
    <table border='1' width='100%' cellspacing='0' cellpadding='10'>
        <tr>
            <td>
                <?php

                require_once(ROOT_DIR . 'shout.php');

                if (user::$current)
                {
                ?>
            </td>
        </tr>
    </table>

    <script type="text/javascript" src="js/poll.core.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>

    <script type="text/javascript">$(document).ready(function () {
            loadpoll();
        });
    </script>

    <h2><?php echo $lang['text_poll']?></h2>

    <table border='1' width='100%' cellspacing='0' cellpadding='10'>
        <tr>
            <td align='center'>
                <div id='poll_container'>
                    <div id='loading_poll' style='display:none'></div>
                    <noscript>
                        <span style='font-weight : bold;'><?php echo $lang['err_js_req']?></span>
                    </noscript>
                </div>
                <br/>
            </td>
        </tr>
    </table>

<?php
}

//-- Start Stats --//
if (isset(user::$current))
{
    ?>
    <h2><?php echo $lang['text_stats']?></h2>
    <table border='1' width='100%' cellspacing='0' cellpadding='10'>
        <tr>
            <td align='center'>
                <table class='main' border='1' cellspacing='0' cellpadding='5'>
                    <tr>
                        <td class='rowhead'><?php echo $lang['table_registered']?></td>
                        <td class='rowhead' align='right'><?php echo $registered?>/<?php echo $max_users?></td>
                        <td class='rowhead'><?php echo $lang['table_online']?></td>
                        <td class='rowhead' align='right'><?php echo $numactive?></td>
                    </tr>
                    <tr>
                        <td class='rowhead'><?php echo $lang['table_unconf_user']?></td>
                        <td class='rowhead' align='right'><?php echo $unverified?></td>
                        <td class='rowhead'><?php echo $lang['table_donors']?></td>
                        <td class='rowhead' align='right'><?php echo $donors?></td>
                    </tr>
                    <tr>
                        <td colspan='4'></td>
                    </tr>
                    <tr>
                        <td class='rowhead'><?php echo $lang['table_topics']?></td>
                        <td class='rowhead' align='right'><?php echo $forumtopics?></td>
                        <td class='rowhead'><?php echo $lang['table_torrents']?></td>
                        <td class='rowhead' align='right'><?php echo $torrents?></td>
                    </tr>
                    <tr>
                        <td class='rowhead'><?php echo $lang['table_posts']?></td>
                        <td class='rowhead' align='right'><?php echo $forumposts?></td>
                        <td class='rowhead'><?php echo $lang['table_new_today']?></td>
                        <td class='rowhead' align='right'><?php echo $torrentstoday?></td>
                    </tr>
                    <tr>
                        <td colspan='4'></td>
                    </tr>
                    <tr>
                        <td class='rowhead'><?php echo $lang['table_peers']?></td>
                        <td class='rowhead' align='right'><?php echo $peers?></td>
                        <td class='rowhead'><?php echo $lang['table_uncon_peers']?></td>
                        <td class='rowhead' align='right'><?php echo $unconnectables?></td>
                    </tr>
                    <tr>
                        <td class='rowhead'><?php echo $lang['table_seeders']?></td>
                        <td class='rowhead' align='right'><?php echo $seeders?></td>
                        <td class='rowhead' align='right'><?php echo $lang['table_uncon_ratio']?></td>
                        <td class='rowhead' align='right'><?php echo round($ratiounconn * 100)?></td>
                    </tr>
                    <tr>
                        <td class='rowhead'><?php echo $lang['table_leechers']?></td>
                        <td class='rowhead' align='right'><?php echo $leechers?></td>
                        <td class='rowhead'><?php echo $lang['table_seed_leech']?></td>
                        <td class='rowhead' align='right'><?php echo $ratio?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <br/>
<?php
}
//-- End Stats ---//

//-- Start Users on Index - Credits Bigjoos --//
$active3 = "";
if (($active3 = $Memcache->get_value('online::users')) === false) {
    $dt      = sqlesc(get_date_time(gmtime() - 180));
    $active1 = $db->query("SELECT id, username, class, warned, enabled, added, donor
                           FROM users
                           WHERE last_access >= " . $dt . "
                           ORDER BY class DESC") or sqlerr(__FILE__, __LINE__);

    while ($active2 = $active1->fetch_assoc()) {
        $active3[] = $active2;
    }
    $Memcache->cache_value('online::users', $active3, 180);
}

$activeusers = "";

if (is_array($active3))
{
    foreach ($active3
             AS
             $arr)
    {
        if ($activeusers)
        {
            $activeusers .= ",\n";
        }

        $activeusers .= "" . format_username($arr) . "";
    }
}

$fh     = fopen(CACHE_DIR . "active.txt", "r");
$string = file_get_contents(CACHE_DIR . "active.txt");
$count  = preg_match_all('/username/', $string, $dummy);

if (!$activeusers)
{
    $activeusers = "{$lang['text_no_active']}";
}

?>
    <h2><?php echo $lang['text_active'], ($count), $lang['text_online']?></h2>
    <table border='1' width='100%' cellpadding='10' cellspacing='0'>
        <tr class='table'>
            <td class='text'><?php echo $activeusers?></td>
        </tr>
    </table>

<?php
//-- End Users on Index --//

//-- Cached Last24 by putyn --//
function last24hours()
{
    global $last24cache, $last24record, $lang;

    $last24cache   = CACHE_DIR  .  'last24/'.date('dmY')  .  '.txt';
    $last24record  = CACHE_DIR  .  'last24/last24record.txt';
    $_last24       = (file_exists($last24cache) ? unserialize(file_get_contents($last24cache)) : array());
    $_last24record = (file_exists($last24record) ? unserialize(file_get_contents($last24record)) : array('num' => 0,
                                                                                                         'date' => 0));

    if (!isset($_last24[user::$current['id']]) || empty($_last24[user::$current['id']]))
    {
        $_last24[user::$current['id']] = array(user::$current['username'],
                                         user::$current['class']);

        $_newcount = count($_last24);

        if (isset($_last24record['num']) && $_last24record['num'] < $_newcount)
        {
            $_last24record['num']  = $_newcount;
            $_last24record['date'] = time();

            file_put_contents($last24record, serialize($_last24record));
        }
        file_put_contents($last24cache, serialize($_last24));
    }
}

//-- Cached Last24 by putyn --//
function las24hours_display()
{
    global $last24cache, $last24record, $lang;

    $_last24       = (file_exists($last24cache) ? unserialize(file_get_contents($last24cache)) : array());
    $_last24record = (file_exists($last24record) ? unserialize(file_get_contents($last24record)) : array('num' => 0,
                                                                                                         'date' => 0));
    $txt = '';

    $str = file_get_contents(CACHE_DIR . 'last24/' . date('dmY') . '.txt');
    //$_matches = preg_match_all('/a:2/', $str, $dummy);

    if (!is_array($_last24))
    {
        $txt = "{$lang['text_no_record']}";
    }
    else
    {
        //$txt .= '<h2>Active Users in the Last 24hrs - ('.$_matches.') </h2>'
        $txt .= "<h2>{$lang['text_active_24']}</h2><table border='1' width='100%' cellpadding='10' cellspacing='0'><tr class='table'><td class='text'><span>";

        $c = count($_last24);
        $i = 0;

        foreach ($_last24
                 AS
                 $id => $username)
        {

            $txt .= "<a class='altlink_user' href='userdetails.php?id=$id'><span style='font-weight : bold; color : #" . get_user_class_color($username['1']) . "'>" . security::html_safe($username[0]) . "</span></a>" . (($c - 1) == $i ? '' : ',') . "\n";

            $i++;
        }

        $txt .= "</span></td></tr>";
        $txt .= "<tr class='table'><td class='rowhead' align='center'><span>{$lang['text_most_visited']}{$_last24record['num']}{$lang['text_members']}" . get_date_time($_last24record['date'], 'DATE') . "</span></td></tr></table><br />";
    }
    return $txt;
}

last24hours();
print las24hours_display();

if (isset(user::$current))
{
    ?>
    <h2><?php echo $lang['text_disclaimer']?></h2>
    <table border='1' width='100%' cellspacing='0' cellpadding='10'>
        <tr>
            <td align='center'>
                <span style='font-weight : bold;'><?php echo $lang['text_disclaimer_info']?><span class='disclaimer'><?php echo $site_name?></span>
                <?php echo $lang['text_disclaimer_info1']?></span>
            </td>
        </tr>
    </table>
<br/>

    </td></tr></table>

<?php

}

site_footer();

?>