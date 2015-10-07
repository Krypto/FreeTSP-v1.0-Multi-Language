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
require_once(CLASS_DIR . 'class.IP.php');

/* Standard variables that will be of much use instead of using functions to get them all the time wasting CPU */
vars::init();
class vars {
	public static $ip = '';
	public static $ip2 = NULL;
	public static $packed_ip = '';
	public static $ip_type = 0;

	public static $realip = '';
	public static $realip2 = NULL;
	public static $packed_realip = '';
	public static $realip_type = 0;

	public static $timestamp = 0;
	public static $ssl = false;

	public static $base_url = '';

	public static function init() {
		self::$timestamp = time();
		self::$ssl = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on';

		if (isset($_SERVER['REMOTE_ADDR'])) {
			self::$realip = $_SERVER['REMOTE_ADDR'];
			self::$packed_realip = ip::type(self::$realip, self::$realip_type, self::$realip2);
			if (!self::$packed_realip)
				die('IP Address Error');

			self::$ip	= ip::get_ip();
			self::$packed_ip = ip::type(self::$ip, self::$ip_type, self::$ip2);

			if (isset($_SERVER['HTTP_HOST'])) {
				$hosts = explode(':', $_SERVER['HTTP_HOST']);
				$num = count($hosts) - 1;
				if ($hosts[$num] == $_SERVER['SERVER_PORT'])
					unset($hosts[$num]);

				$host = implode(':', $hosts);
			}
			else
				$host = $_SERVER['SERVER_ADDR'];

			$port = self::$ssl ? ($_SERVER['SERVER_PORT'] == 443 ? 0 : $_SERVER['SERVER_PORT']) : ($_SERVER['SERVER_PORT'] == 80 ? 0 : $_SERVER['SERVER_PORT']);

			self::$base_url = 'http'.(self::$ssl ? 's' : '').'://'.$host.($port ? ':'.$port : '');
		}
	}
}

?>