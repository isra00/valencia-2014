<?php

/* 
 * Init 
 */

// THINGS THAT YOU SHOULD CHANGE
define('DOMAIN', 			'www.neocatechumenaleiter.org'); // For Canonical meta tag (SEO)
define('ROOT', 				'/valencia-2014');
define('DEFAULT_LANGUAGE', 	'es');
define('EVENT_TIMEZONE', 	'Europe/Madrid'); // Valid PHP timezone (https://php.net/manual/en/timezones.php)
define('FB_ADMINS', 		'639761851'); // For Facebook OG meta tags
define('FB_IMAGE', 			'http://' . $_SERVER['SERVER_NAME'] . ROOT . '/img/thumb.jpg');

// No need to change this
define('CACHE_TTL',			120); //2 minutes
define('CACHE_KEY',			'vlc2014-config');
define('URL_SELF',			'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']);
define('CONFIG_FILE', 		'config.json');

if (!$config = apc_fetch(CACHE_KEY))
{
	$config = json_decode(file_get_contents(CONFIG_FILE), true);
	apc_store(CACHE_KEY, $config, CACHE_TTL);
}

date_default_timezone_set(EVENT_TIMEZONE);
$time_offset = intval((new DateTimeZone(EVENT_TIMEZONE))->getOffset(new DateTime($config['event_start'])));
define('TIME_OFFSET',		$time_offset / (-60)); // Offset (in minutes) from GMT for the local time of the event, inverted for matching JS style
define('MEETING_START',		strtotime($config['event_start']));
define('MEETING_END',		strtotime($config['event_end']));


/* 
 * Prepare view 
 */

$languages = array(
	'es' => array(
		'name'	=> 'Castellano',
		'code'	=> 'es_ES',
		'url'	=> '/encuentro-vocacional-camino-neocatecumenal-valencia-2014',
	),
	'pt' => array(
		'name'	=> 'Português',
		'code'	=> 'pt_BR',
		'url'	=> '/encontro-vocacional-caminho-neocatecumenal-valencia-2014'
	),
	'en' => array(
		'name'	=> 'English',
		'code'	=> 'en_US',
		'url'	=> '/vocational-encounter-neocatechumenal-way-valencia-2014'
	),
	'it' => array(
		'name'	=> 'Italiano',
		'code'	=> 'it_IT',
		'url'	=> '/incontro-vocazionale-cammino-neocatecumenale-valencia-2014'
	),
	'fr' => array(
		'name'	=> 'Français',
		'code'	=> 'fr_FR',
		'url'	=> '/rencontre-vocationelle-chemin-neocatechumenal-valence-2014'
	),
);

$current_lang = isset($_GET['lang']) ? $_GET['lang'] : DEFAULT_LANGUAGE;
$current_lang = in_array($current_lang, array_keys($languages)) ? $current_lang : DEFAULT_LANGUAGE;

//The default language acts as fallback
include_once "lang-" . DEFAULT_LANGUAGE . ".php";
include_once "lang-$current_lang.php";

header('X-UA-Compatible: IE=edge,chrome=1');
header("Content-Language: $current_lang");
header('Content-type: text/html;charset=UTF-8');

$show = array(
	'player' 		=> time() > MEETING_START && time() < MEETING_END && !$config['general_disable'],
	'not_yet'		=> (time() < MEETING_START),
	'finished'		=> time() > MEETING_END,
);

$time_offset_friendly = (TIME_OFFSET < 0 ? '+' : '') . intval(TIME_OFFSET * (-1) / 60);
$time_offset_friendly .= (abs(TIME_OFFSET) % 60 != 0) ? ":" . abs(TIME_OFFSET) % 60 : '';

include 'index.view.php';