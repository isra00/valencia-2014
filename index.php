<?php

/* 
 * Init 
 */

// THINGS THAT YOU SHOULD CHANGE

define('DOMAIN', 			'www.neocatechumenaleiter.org'); // For Canonical meta tag (SEO)
define('ROOT', 				'/valencia-2014');
define('DEFAULT_LANGUAGE', 	'es');
define('EVENT_START', 		'2014-06-01 16:31:00');
define('EVENT_END', 		'2014-06-01 19:30:00');
define('EVENT_TIMEZONE', 	'Europe/Madrid'); // Valid PHP timezone (https://php.net/manual/en/timezones.php)
define('LIVESTREAM_EVENT', 	'2248210');
define('FB_ADMINS', 		'100003576128882'); // For Facebook OG meta tags
define('FB_IMAGE', 			'http://' . $_SERVER['SERVER_NAME'] . ROOT . '/img/thumb.jpg');

// No need to change this
date_default_timezone_set(EVENT_TIMEZONE);
$time_offset = intval((new DateTimeZone(EVENT_TIMEZONE))->getOffset(new DateTime(EVENT_START)));
define('TIME_OFFSET',		$time_offset / (-60)); // Offset (in minutes) from GMT for the local time of the event, inverted for matching JS style
define('CACHE_TTL',			120); //2 minutes
define('CACHE_KEY',			'vlc2014-config');
define('URL_SELF',			'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']);
define('DO_NOT_TRACK', 		(isset($_SERVER['HTTP_DNT']) && $_SERVER['HTTP_DNT'] == 1));
define('CONFIG_FILE', 		'config.json');

/*
 * Load config 
 */

if (!$config = apc_fetch(CACHE_KEY))
{
	$default_config = array(
		'general_disable'			=> false,
		'force_meeting_finished'	=> false,
		'redevida'					=> false,
		'event_start'				=> EVENT_START,
		'event_end'					=> EVENT_END,
		'livestream_event'			=> LIVESTREAM_EVENT
	);
	$config = json_decode(file_get_contents(CONFIG_FILE), true);
	$config = array_merge($default_config, $config); //Override default configs	

	apc_store(CACHE_KEY, $config, CACHE_TTL);
}

define('MEETING_START',	strtotime($config['event_start']));
define('MEETING_END',	strtotime($config['event_end']));


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
		'url'	=> '/encontro-vocacional-jovens-caminho-neocatecumenal'
	),
	'en' => array(
		'name'	=> 'English',
		'code'	=> 'en_US',
		'url'	=> '/youth-vocational-encounter-neocatechumenal-way'
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
	'player' 		=> !$config['general_disable'] && !$config['force_meeting_finished'],
	'not_yet'		=> (time() < MEETING_START) && !$config['force_meeting_finished'],
	'finished'		=> time() > MEETING_END || $config['force_meeting_finished'],
	'redevida'		=> $config['redevida'],
);

$show['streaming_now'] = time() > MEETING_START && time() < MEETING_END && $show['player'];

$time_offset_friendly = (TIME_OFFSET < 0 ? '+' : '') . intval(TIME_OFFSET * (-1) / 60);
$time_offset_friendly .= (abs(TIME_OFFSET) % 60 != 0) ? ":" . abs(TIME_OFFSET) % 60 : '';

include 'index.view.php';