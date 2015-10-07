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
** Language File:- modtask.php
**/

$lang = array(
    #Errors
    'err_bad_id'                            => 'Bad User ID.',
    'err_same_class'                        => 'You Cannot Edit Someone Of The Same Or Higher Class..  Action Logged',
    'err_user_error'                        => 'User Error',
    'err_try_again'                         => 'Please Try Again',
    'err_bad_class'                         => 'Bad Class',
    'err_inv_id'                            => 'Invalid ID',

    #Misc
    'stafflog_was'                          => ' Was ',
    'stafflog_from'                         => ' From ',
    'stafflog_to'                           => ' To ',
    'stafflog_by'                           => ' By ',
    'stafflog_invite_enabled'               => 'Invite Rights Have Been Enabled By ',
    'stafflog_invite_disabled'              => 'Invite Rights Have Been Disabled By ',
    'stafflog_invite_change'                => 'Invite Amount Changed To ',
    'stafflog_warn_removed'                 => 'Warning Removed By ',
    'stafflog_warn_reason'                  => 'warned Until Further Notice. Reason ',
    'stafflog_warn_for'                     => 'Warned For ',
    'stafflog_reason'                       => 'reason: ',
    'stafflog_donor_removed'                => 'Donor Status Removed By ',
    'stafflog_donor_added_by'               => 'Donor Status Added By ',
    'stafflog_donor_status_for'             => 'Donator Status Set For ',
    'stafflog_sig_changed'                  => 'Signature Changed To ',
    'stafflog_account_enabled'              => 'Account Has Been Enabled By ',
    'stafflog_account_disabled'             => 'Account Has Been Disabled By ',
    'stafflog_account_parked'               => 'Account Has Been Parked By',
    'stafflog_account_unparked'             => 'Account Has Been Un-parked By',
    'stafflog_forum_enabled'                => 'Forum Permissions Enabled By',
    'stafflog_forum_disabled'               => 'Forum Permissions Disabled Until Further Notice. Reason ',
    'stafflog_forum_disabled_time'          => 'Forum Permissions Disabled For ',
    'stafflog_title'                        => 'Custom Title Changed To ',
    'stafflog_username'                     => 'Username Changed To ',
    'stafflog_email'                        => 'Email Changed To ',
    'stafflog_info'                         => 'Info Changed To ',
    'stafflog_passkey'                      => 'Passkey ',
    'stafflog_passkey_reset'                => ' Reset To ',
    'stafflog_upload_enabled'               => 'Upload Permission - Enabled By',
    'stafflog_upload_disabled'              => 'Upload Permission - Disable Until Further Notice By',
    'stafflog_upload_disabled_for'          => 'Upload Permission - Disable For',
    'stafflog_download_enabled'             => 'Download Permission - Enabled By',
    'stafflog_download_disabled'            => 'Download Permission - Disabled Until Further Notice BY',
    'stafflog_download_disabled_for'        => 'Download Disabled For',
    'stafflog_shoutbox_enabled'             => 'Shoutbox Permission - Enabled By',
    'stafflog_shoutbox_disabled'            => 'Shoutbox Permission - Disabled Until Further Notice By',
    'stafflog_shoutbox_disabled_for'        => 'Shoutbox Permission - Disabled For',
    'stafflog_comments_enabled'             => 'Torrent Comments Permission - Enabled By',
    'stafflog_comments_disabled'            => 'Torrent Comments Permission - Disabled Until Further Notice By',
    'stafflog_comments_disabled_for'        => 'Torrent Comments Permission - Disabled For',
    'stafflog_offer_comment_enabled'        => 'Offer Comments Permission - Enabled by',
    'stafflog_offer_comment_disabled'       => 'Offer Comments Permission - Disabled Until Further Notice By',
    'stafflog_offer_comment_disabled_for'   => 'Offer Comments Permission - Disabled For',
    'stafflog_request_comment_enabled'      => 'Request Comments Permission - Enabled By',
    'stafflog_request_comment_disabled'     => 'Request Comments Permission - Disabled Until Further Notice By',
    'stafflog_request_comment_disabled_for' => 'Request Comments Permission - Disabled For',
    'stafflog_avatar_changed'               => 'Avatar Changed From',
    'stafflog_promote_fls'                  => 'Promoted To FLS By',
    'stafflog_demote_fls'                   => 'Demoted From FLS By',
    'msg_class_subject'                     => 'User Class Change',
    'msg_to'                                => ' To ',
    'msg_by'                                => ' bY ',
    'msg_you_have'                          => 'You Have Been ',
    'msg_can_invite'                        => 'Your Invite Rights Have Been Given Back By ',
    'msg_can_invite1 '                      => 'You Can Invite Users Again.',
    'msg_invite_subject'                    => 'Invite Rights',
    'msg_invite_removed'                    => 'Your Invite Rights Have Been Removed By ',
    'msg_bad_user'                          => ' Probably Because You Invited A Bad User.',
    'msg_warn_removed'                      => 'Your Warning Has Been Removed By ',
    'msg_warn_subject'                      => 'Warning',
    'msg_warn_by'                           => 'You Have Received A Rules Warning From ',
    'msg_reason'                            => 'Reason: ',
    'msg_you_have_rcvd'                     => 'You Have Received A',
    'msg_rules_warn'                        => 'Rules Warning From ',
    'msg_donor_expired'                     => 'Your Donator Status Has Expired.',
    'msg_donor_status'                      => 'You Have Received Donor Status From ',
    'msg_donor_length'                      => 'You Have Received Donor Status For ',
    'msg_from'                              => ' From ',
    'msg_forum_enabled'                     => 'Your Forum Privilege Has Been Returned To You.',
    'msg_be_careful'                        => 'Please Be More Careful In The Future.',
    'msg_forum_status'                      => 'Your Forum Status',
    'msg_forum_disabled'                    => 'Your Forum Privilage Has Been Removed - Until Further Notice.',
    'msg_contact_staff'                     => 'Please Contact A Member Of Staff To Try To Resolve This Issue',
    'msg_forum_removed_time'                => 'Your Forum Privilage Has Been Removed For ',
    'msg_upload_enabled'                    => 'Your Upload Privilege Has Been Returned To You.',
    'msg_upload_careful'                    => 'Please Be More Careful In The Future.',
    'msg_upload_status'                     => 'Your Upload Status',
    'msg_upload_disabled'                   => 'Your Upload Privilage Has Been Removed - Until Further Notice. ',
    'msg_upload_dur'                        => 'your Upload Privilage Has Been Removed For',
    'msg_download_enabled'                  => 'Your Download Privilege Has Been Returned To You.',
    'msg_download_status'                   => 'your Download Status',
    'msg_download_disabled'                 => 'Your Download Privilage Has Been Removed - Until Further Notice.',
    'msg_download_dur'                      => 'your Download Privilage Has Been Removed For',
    'msg_shoutbox_enabled'                  => 'Your Shoutbox Privilege Has Been Returned To You.',
    'msg_shoutbox_status'                   => 'Your Shoutbox Status',
    'msg_shoutbox_disabled'                 => 'Your Shoutbox Privilage Has Been Removed - Until Further Notice. ',
    'msg_shoutbox_dur'                      => 'Your Shoutbox Privilage Has Been Removed For',
    'msg_comments_enabled'                  => 'Your Torrent Comment Privilege Has Been Returned To You.',
    'msg_comments_status'                   => 'Your Torrent Comment Status',
    'msg_comments_disabled'                 => 'Your Torrent Comment Privilage Has Been Removed - Until Further Notice.',
    'msg_comments_disabled_for'             => 'Your Torrent Comment Privilage Has Been Removed For',
    'msg_offer_comment_enabled'             => 'Your Offer Comment Privilege Has Been Returned To You.',
    'msg_offer_comment_status'              => 'Your Offer Comment Status',
    'msg_offer_comment_disabled'            => 'Your Offer Comment Privilage Has Been Removed - Until Further Notice.',
    'msg_offer_comment_disabled_for'        => 'Your Offer Comment Privilage Has Been Removed For',
    'msg_request_comment_enabled'           => 'Your Request Comment Privilege Has Been Returned To You.',
    'msg_request_comment_status'            => 'Your Request Comment Status',
    'msg_request_comment_disabled'          => 'Your Request Comment Privilage Has Been Removed - Until Further Notice.',
    'msg_request_comment_disabled_for'      => 'Your Request Comment Privilage Has Been Removed For',
    'msg_request_comment_status'            => 'Your Request Comment Status',
    'msg_promoted_fls'                      => 'You Have Been Added To First Line Support By ',
    'msg_demoted_fls'                       => 'You Have Been Removed From First Line Support By ',
    'msg_demote_fls'                        => 'Probably Because You Were Inactive Or Asked To Be Removed.',

    #Texts
    'text_promoted'                         => 'Promoted',
    'text_demoted'                          => 'Demoted',
    'text_invite_enabled'                   => ' Invite Rights Enabled By ',
    'text_invite_disabled'                  => ' Invite Rights Disabled By ',
    'text_invite_change'                    => ' Invite Amount Changed From ',
    'text_to'                               => ' To ',
    'text_by'                               => ' By ',
    'text_warn_removed'                     => 'Warning Removed By ',
    'text_warn_by'                          => ' Warned By ',
    'text_reason'                           => 'Reason: ',
    'text_week'                             => ' Week',
    'text_s'                                => 's', //-- This is to make the above plural so Week / Weeks --//
    'text_warn_for'                         => 'Warned For ',
    'text_donor_removed'                    => 'Donor Status Removed',
    'text_donor_added'                      => 'Donor Status Added By ',
    'text_donor_set_by'                     => 'Donor Status Set By ',
    'text_donor_set_for'                    => 'Donator Status Set For ',
    'text_sig_changed'                      => 'Signature Changed To ',
    'text_account_enabled'                  => 'Account Enabled By ',
    'text_account_disabled'                 => 'Account Disabled By ',
    'text_account_parked'                   => 'Account Parked By ',
    'text_account_unparked'                 => 'Account Un-Parked By ',
    'text_forum_enabled'                    => 'Forum Permission - Enabled By ',
    'text_forum_disabled'                   => 'Forum Disabled By',
    'text_forum_disabled_time'              => 'Forum Disabled For ',
    'text_title'                            => 'Custom Title Changed To ',
    'text_from'                             => ' From ',
    'text_username'                         => 'Username Changed To ',
    'text_email'                            => 'Email Changed To ',
    'text_info'                             => 'Info Changed To ',
    'text_passkey'                          => 'Passkey ',
    'text_passkey_reset'                    => ' Reset To ',
    'text_upload_enabled'                   => 'Upload Permission - Enabled By ',
    'text_upload_disabled'                  => 'Upload Disabled By',
    'text_upload_disabled_for'              => 'Upload Disabled For',
    'text_download_enabled'                 => 'Download Permission - Enabled By ',
    'text_download_disabled'                => 'Download Disabled By',
    'text_download_disabled_for'            => 'Download Disabled For ',
    'text_shoutbox_enabled'                 => 'Shoutbox Permission - Enabled By',
    'text_shoutbox_disabled'                => 'Shoutbox Disabled By',
    'text_shoutbox_disabled_for'            => 'Shoutbox Disabled For',
    'text_comments_enabled'                 => 'Torrent Comments Permission - Enabled By ',
    'text_comments_disabled'                => 'Torrent Comments Disabled By',
    'text_comments_disabled_for'            => 'Torrent Comments Disabled For',
    'text_offer_comment_enabled'            => 'Offer Comments Permission - Enabled By ',
    'text_offer_comment_disabled'           => 'Offer Comments Disabled By',
    'text_offer_comment_disabled_for'       => 'Offer Comments Disabled For',
    'text_request_comment_enabled'          => 'Request Comments Permission - Enabled By ',
    'text_request_comment_disabled'         => 'Request Comments Disabled By',
    'text_request_comment_disabled_for'     => 'Request Comments Disabled For',
    'text_avatar_changed'                   => 'Avatar Changed From',
    'text_promoted_fls'                     => 'Promoted To FLS By ',
    'text_demote_fls'                       => 'Demoted From FLS By '
);

?>