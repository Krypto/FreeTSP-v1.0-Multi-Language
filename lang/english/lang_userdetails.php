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
**
** Language File:- userdetails.php
**/

$lang = array(
    #Buttons
    'btn_del_friend'                  => 'Remove from Friends',
    'btn_del_block'                   => 'Remove from Blocks',
    'btn_add_friend'                  => 'Add to Friends',
    'btn_add_block'                   => 'Add to Blocks',
    'btn_quick_ban'                   => 'Quick Ban',
    'btn_general'                     => 'General',
    'btn_torrents'                    => 'Torrents',
    'btn_info'                        => 'Info',
    'btn_snatch_list'                 => 'Snatch List',
    'btn_invited'                     => 'Invited Members',
    'btn_alter_ratio'                 => 'Alter Ratio',
    'btn_edit_user'                   => 'Edit User',
    'btn_reset_pass'                  => 'Reset Password',
    'btn_report_user'                 => 'Report User',
    'btn_send_msg'                    => 'Send Message',
    'btn_give_rep'                    => 'Give A Reputation Point',
    'btn_del_user'                    => 'Delete ',
    'btn_reset'                       => 'RESET',

    #Errors
    'err_bad_id'                      => 'Bad ID ',
    'err_no_userid'                   => 'No user with ID ',
    'err_pending'                     => 'This Member Is Still Pending!',
    'err_fail_reset_pass'             => 'Unable to RESET PASSWORD on this Account.',
    'err_pass_for'                    => 'The Password for ',
    'err_pass_reset_to'               => ' has been Reset to ',
    'err_pass_inform_user'            => ' please inform the member of this change.',

    #Forms
    'form_field_ratio_user'           => 'User Name',
    'form_field_ratio_uploaded'       => 'Uploaded',
    'form_field_ratio_downloaded'     => 'Downloaded',
    'form_field_ratio_select'         => 'Select Input Measure',
    'form_opt_ratio_mb'               => 'MBytes',
    'form_opt_ratio_gb'               => 'GBytes',
    'form_opt_ratio_tb'               => 'TBytes',
    'form_field_ratio_action'         => 'Action',
    'form_opt_ratio_add'              => 'Add',
    'form_opt_ratio_del'              => 'Remove',
    'form_opt_ratio_replace_ul'       => 'Replace Upload',
    'form_opt_ratio_replace_dl'       => 'Replace Download',
    'form_field_edit_title'           => 'Title',
    'form_field_edit_username'        => 'Username',
    'form_field_edit_email'           => 'Email',
    'form_field_edit_avatar'          => 'Avatar URL',
    'form_field_edit_info'            => 'Info URL',
    'form_field_edit_sig'             => 'Signature URL',
    'form_field_edit_donor'           => 'Donor',
    'form_field_opt_edit_yes'         => 'Yes',
    'form_field_opt_edit_no'          => 'No',
    'form_field_edit_class'           => 'Class',
    'form_field_edit_support'         => 'Support',
    'form_field_edit_sup_for'         => 'Support For',
    'form_field_opt_edit_non_sel'     => ' None Selected ',
    'form_field_edit_lang'            => 'Support Language',
    'form_field_edit_invite'          => 'Invite Rights',
    'form_field_edit_invites'         => 'Invites',
    'form_field_edit_comment'         => 'Comment',
    'form_field_edit_add_comm'        => 'Add Comment',
    'form_field_edit_warned'          => 'Warned',
    'form_field_edit_worn_for'        => 'Warn for ',
    'form_field_opt_edit_1week'       => '1 week',
    'form_field_opt_edit_2week'       => '2 weeks',
    'form_field_opt_edit_4week'       => '4 weeks',
    'form_field_opt_edit_8week'       => '8 weeks',
    'form_field_opt_edit_unlimited'   => 'Unlimited',
    'form_field_edit_ul_enabled'      => 'Upload Enabled',
    'form_field_edit_dl_enabled'      => 'Download Enabled',
    'form_field_edit_sb_enabled'      => 'Shoutbox Enabled',
    'form_field_edit_com_enabled'     => 'Comments Enabled',
    'form_field_edit_offer_enabled'   => 'Offer Comments Enabled',
    'form_field_edit_req_com_enabled' => 'Request Comments Enabled',
    'form_field_edit_forum_enabled'   => 'Forum Enabled',
    'form_field_edit_acc_enabled'     => 'Account Enabled',
    'form_field_edit_acc_parked'      => 'Account Parked',
    'form_field_edit_passkey'         => 'Passkey',
    'form_opt_reset_passkey'          => ' Reset Passkey',

    #Misc
    'img_alt_not_connected'           => 'Not Connected To Peers',
    'img_alt_rep'                     => 'Reputation',
    'img_alt_hide_show'               => 'Show/Hide',
    'title_details_for'               => 'Details for ',
    'writelog_pass_reset'             => 'Password Reset For ',
    'writelog_by'                     => ' by ',

    #Tables
    'table_snatch_cat'                => 'Category',
    'table_snatch_tor'                => 'Torrent',
    'table_snatch_up'                 => 'Uploaded',
    'table_snatch_rate'               => 'Rate',
    'table_snatch_down'               => 'Downloaded',
    'table_snatch_ratio'              => 'Ratio',
    'table_snatch_activity'           => 'Activity',
    'table_snatch_finished'           => 'Finished',
    'table_snatch_yes'                => 'Yes',
    'table_snatch_no'                 => 'No',
    'table_snatch_sl'                 => 'S / L',
    'table_snatch_up_down'            => 'Up / Down',
    'table_snatch_tor_size'           => 'Torrent Size',
    'table_snatch_client'             => 'Client',
    'table_snatch_inf'                => 'Inf.',
    'table_snatch_na'                 => 'N/A',
    'table_snatch_owner'              => 'Torrent Owner',
    'table_snatch_not_finished'       => 'Not Finished',
    'table_snatch_started'            => 'Started ',
    'table_snatch_completed'          => 'Completed ',
    'table_snatch_last_action'        => 'Last Action ',
    'table_snatch_to_go'              => ' still to go ',
    'table_snatch_time_dl'            => 'Time to Download ',
    'table_snatch_dl_at'              => ' DLed @ ',
    'table_snatch_total_seed'         => 'Total Seeding Time ',
    'table_snatch_up_at'              => ' ULed @ ',
    'table_snatch_dl_speed'           => 'Download Speed',
    'table_snatch_seeds'              => 'Seeds ',
    'table_snatch_leech'              => 'Leech ',
    'table_snatch_diff'               => 'Difference of ',
    'table_snatch_seeding'            => 'Seeding',
    'table_snatch_not_seeding'        => 'Not Seeding',
    'table_snatch_port'               => 'Port ',
    'table_snatch_connectable'        => 'Connectable ',
    'table_seed_cat'                  => 'Category',
    'table_seed_name'                 => 'Name',
    'table_seed_size'                 => 'Size',
    'table_seed_seeds'                => 'Se.',
    'table_seed_leech'                => 'Le.',
    'table_seed_ul'                   => 'Upl.',
    'table_seed_dl'                   => 'Downl.',
    'table_seed_ratio'                => 'Ratio',
    'table_seed_inf'                  => 'Inf.',
    'table_seed_hour'                 => 'Hour',
    'table_seed_hours'                => 'Hours',
    'table_up_cat'                    => 'Category',
    'table_up_name'                   => 'Name',
    'table_up_seeds'                  => 'Seeders',
    'table_up_leech'                  => 'Leechers',
    'table_general_na'                => 'N/A',
    'table_general_ago'               => ' ago',
    'table_general_never'             => 'Never',
    'table_general_online'            => 'Online',
    'table_general_offline'           => 'Offline',
    'table_general_yes'               => 'Yes',
    'table_general_no'                => 'No',
    'table_general_details'           => 'General Details',
    'table_general_joined'            => 'Join Date',
    'table_general_last_seen'         => 'Last Seen',
    'table_general_time_online'       => 'Time Online',
    'table_general_status'            => 'Status',
    'table_general_invited_by'        => 'Invited by',
    'table_general_email'             => 'Email',
    'table_general_address'           => 'Address',
    'table_general_give_rep'          => 'Give Reputation',
    'table_general_cur_rep'           => 'Current Reputation',
    'table_general_rep_points'        => 'Reputation Points : ',
    'table_general_title'             => 'Title',
    'table_general_class'             => 'Class',
    'table_general_fls'               => 'First Line Support',
    'table_general_forum_posts'       => 'Forum Posts',
    'table_torrents_details'          => 'Torrent Details',
    'table_torrents_port'             => 'Port',
    'table_torrents_client'           => 'Client',
    'table_torrents_connectable'      => 'Connectable',
    'table_torrents_uploaded'         => 'Uploaded',
    'table_torrents_downloaded'       => 'Downloaded',
    'table_torrents_ratio'            => 'Share Ratio',
    'table_torrents_comments'         => 'Torrent Comments',
    'table_torrents_flush'            => 'Flush',
    'table_torrents_flush1'           => 'Flush Ghost Torrents Now.',
    'table_torrents_flush2'           => '  (Use if Seeding / Leeching is shown wrong.)',
    'table_info_details'              => 'Information Details',
    'table_info_share_info'           => 'Members Shared Infomation',
    'table_info_signature'            => 'Signature',
    'table_snatched_details'          => 'Snatched Details',
    'table_snatched_uploaded'         => 'Uploaded Torrents',
    'table_snatched_seeding'          => 'Currently Seeding',
    'table_snatched_leeching'         => 'Currently Leeching',
    'table_snatched_recent'           => 'Recently Snatched',
    'table_snatched_status'           => 'Snatched Status',
    'table_ratio_details'             => 'Alter Ratio Details',
    'table_edit_user_details'         => 'Edit Members Details',
    'table_edit_user_warning'         => '(Arbitrary Duration)',
    'table_edit_user_until'           => 'Until ',
    'table_edit_user_to_go'           => ' to go',
    'table_edit_user_total_ban'       => 'Total Ban',
    'table_edit_user_advice'          => 'Seek Higher Staff Advice Before You Enable!',
    'table_edit_user_comment'         => 'Comment',
    'table_edit_user_disable'         => 'Disable For',
    'table_edit_del_user'             => 'Delete This Member',
    'table_invite_users'              => 'Invited Users',
    'table_invite_none'               => 'No Invitees yet.',
    'table_invite_username'           => 'Username',
    'table_invite_uploaded'           => 'Uploaded',
    'table_invite_downloaded'         => 'Downloaded',
    'table_invite_ratio'              => 'Ratio',
    'table_invite_status'             => 'Status',
    'table_invite_inf'                => 'Inf.',
    'table_invite_confirmed'          => 'Confirmed',
    'table_invite_pending'            => 'Pending',

    #Texts
    'text_acc_disabled'               => 'This Account has been Disabled',
    'text_pc_on'                      => 'My PC is On at Night.',
    'text_pc_off'                     => 'My PC is Off at Night.',
    'text_parked'                     => 'This Account is Parked.'
);

?>