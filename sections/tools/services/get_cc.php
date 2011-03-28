<?
if(isset($_SERVER['http_if_modified_since'])) {
	header("Status: 304 Not Modified");
	die();
}

header('Expires: '.date('D, d-M-Y H:i:s \U\T\C',time()+3600*24*120)); //120 days
header('Last-Modified: '.date('D, d-M-Y H:i:s \U\T\C',time()));

if(!check_perms('users_view_ips')) { die('Access denied.'); }

if (empty($_GET['ip'])) {
	die("Invalid IP");
}

$DB->query("SELECT Code FROM geoip_country WHERE ".ip2long($_GET['ip'])." BETWEEN StartIP AND EndIP LIMIT 1");
list($CC) = $DB->next_record();
die($CC);

