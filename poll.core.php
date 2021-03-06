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

$lang = array_merge(load_language('pollcore'),
                    load_language('func_bbcode'));

$do     = (isset($_POST['action']) ? htmlspecialchars($_POST['action']) : '');
$choice = (isset($_POST['choice']) ? intval(0 + $_POST['choice']) : 0);
$pollId = (isset($_POST['pollId']) ? intval(0 + $_POST['pollId']) : 0);
$userId = 0 + user::$current['id'];

if ($do == 'load')
{
    //-- Check To See If User Voted :) --//
    $r_check = $db->query("SELECT p.id, p.added, p.question, pa.selection, pa.userid
                          FROM polls AS p
                          LEFT JOIN pollanswers AS pa ON p.id = pa.pollid
                          AND pa.userid = $userId
                          ORDER BY p.id DESC
                          LIMIT 1") or sqlerr();

    $ar_check = $r_check->fetch_assoc();

    if ($r_check->num_rows == 1)
    {
        $r_op = $db->query("SELECT *
                           FROM polls
                           WHERE id = " . (int)$ar_check['id']) or sqlerr();

        $a_op = $r_op->fetch_assoc();

        for ($i = 0;
             $i < 20;
             $i++)
        {
            if (!empty($a_op["option$i"]))

            {
                $options[$i] = format_comment($a_op["option$i"]);
            }
        }

        if (get_user_class() >= UC_SYSOP)
        {
            $modop = "<a href='controlpanel.php?fileaction=16&amp;action=delete&pollid={$ar_check['id']}&returnto=/index.php'><img src='{$image_dir}delete.png' width='16' height='16' border='0' alt='{$lang['img_alt_delete']}' title='{$lang['img_alt_delete']}' style='border : none vertical-align : middle;' /></a>&nbsp;";

            $modop .= "<a href='controlpanel.php?fileaction=15&amp;action=edit&pollid={$ar_check['id']}&returnto=/index.php'><img src='{$image_dir}edit.png' width='16' height='16' border='0' alt='{$lang['img_alt_edit']}' title='{$lang['img_alt_edit']}' style='border : none vertical-align : middle;' /></a>";
        }

        if ($ar_check['userid'] == NULL)
        {
            print("<div id='poll_title'>" . format_comment($ar_check['question']) . "&nbsp;$modop&nbsp;</div>");

            foreach ($options
                     AS
                     $op_id => $op_val)
            {
                print("<div align='left'><input type='radio' onclick='addvote($op_id)' name='choices' id='opt_$op_id' value='$op_id' /><label for='opt_$op_id'>&nbsp;$op_val</label></div>\n");
            }

            print("<div align='left'><input type='radio' name='choices' id='opt_255' value='255' onclick='addvote(255)' /><label for='opt_255'>&nbsp;{$lang['text_blank']}</label></div>\n");

            print("<input type='hidden' name='choice' id='choice' value='' />");
            print("<input type='hidden' name='pollId' id='pollId' value='" . (int)$ar_check['id'] . "' />");
            print("<div align='center'><input type='button' class='btn' id='vote_b' value='{$lang['btn_vote']}' onclick='vote();' style='display:none;' /></div>");
        }
        else
        {
            $r = $db->query("SELECT count(id) AS count , selection
                            FROM pollanswers
                            WHERE pollid = " . (int)$ar_check['id'] . "
                            AND selection < 20
                            GROUP BY selection") or sqlerr();

            while ($a = $r->fetch_assoc())
            {
                $total += $a['count'];
                $votes[$a['selection']] = intval(0 + $a['count']);
            }

            foreach ($options
                     AS
                     $k => $op)
            {
                $results[] = array(0 + $votes[$k],
                                   $op);
            }

            function srt($a, $b)
            {
                if ($a[0] > $b[0])
                {
                    return -1;
                }
                if ($a[0] < $b[0])
                {
                    return 1;
                }
                return 0;
            }

            usort($results, srt);

            print("<div class='poll' id='poll_title'>" . format_comment($ar_check['question']) . "&nbsp;$modop&nbsp;</div>\n");

            print("<table class='results' border='0' width='100%' id='results' cellspacing='0' cellpadding='2' style='border : none'>");

            $i = 0;

            foreach ($results
                     AS
                     $result)
            {
                print("<tr>
                        <td align='left' width='40%' style='border : none;'>{$result[1]}</td>
                        <td class='std' align='left' width='60%' valing='middle'>
                        <div class='bar" . ($i == 0 ? "max" : "") . "' id='poll_result' name='" . ($result[0] / $total * 100) . "'>&nbsp;</div></td>
                        <td class='std'>&nbsp;<span style='font-weight : bold;'>" . number_format(($result[0] / $total * 100), 2) . "%</span></td>
                    </tr>\n");



                $i++;
            }


            print("</table>");
            print("<div class='poll' align='center'><span style='font-weight : bold;'>{$lang['text_votes']}</span> : $total</div>");
        }
    }
    else
    {
        print("{$lang['text_no_polls']}");
    }
}
elseif ($do == "vote")
{
    if ($pollId == 0)
    {
        print(json_encode(array("status" => 0,
                                "msg"    => "{$lang['text_not_good']}")));
    }

    else
    {
        $check = misc::mysqli_result($db->query("SELECT count(id)
                                         FROM pollanswers
                                         WHERE pollid = $pollId
                                         AND userid = $userId"), 0);

        if ($check == 0)
        {
            $db->query("INSERT INTO pollanswers
                       VALUES(0, $pollId, $userId, $choice)") or die($db->error);

            if ($db->affected_rows != 1)
            {
                print(json_encode(array("status" => 0,
                                        "msg"    => "{$lang['text_error']}")));
            }
            else
            {
                print(json_encode(array("status" => 1)));
            }
        }
        else
        {
            print(json_encode(array("status" => 0,
                                    "msg"    => "{$lang['text_dupe']}")));
        }
    }
}

?>