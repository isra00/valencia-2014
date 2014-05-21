<?php

define('CONFIG_FILE', 'config.json');
define('CACHE_KEY',	'vlc2014-config');

function generate_input($name, $value, $type, $attributes)
{
	$output = "<input name='$name' type='$type'";

	switch ($type)
	{
		case 'checkbox':
			if ($value)
			{
				$output .= " checked='checked'";
			}
			break;

		case 'text':
			$output .= " value='$value'";
			break;

		case 'button':
			$output .= " value='$value'";
			foreach ($attributes as $key=>$val) {
				$output .= " $key=\"$val\"";
			}

	}

	$output .= ' />';

	return $output;
}

$directives = array(
	'general_disable' => array(
		'description'	=> 'Desactivar todo el streaming',
		'type'			=> 'checkbox'
	),
	'force_meeting_finished' => array(
		'description'	=> 'Terminó el encuentro',
		'type'			=> 'checkbox'
	),
	'finish_now' => array(
		'description'	=> 'Terminar el encuentro ahora',
		'type'			=> 'button',
		'value'			=> 'Terminar ahora mismo (!)', 
		'attributes'	=> array(
			'type'		=> 'submit', 
			'contents'	=> 'Terminar ahora', 
			'class' 	=> 'btn btn-danger'
		),
	),
	'redevida' => array(
		'description'	=> 'Mostrar streaming de Rede Vida',
		'type'			=> 'checkbox'
	),
	'event_start' => array(
		'description'	=> 'Inicio del evento (hora local)',
		'type'			=> 'text'
	),
	'event_end' => array(
		'description'	=> 'Fin del evento (hora local)',
		'type'			=> 'text'
	),
	'livestream_event' => array(
		'description'	=> 'ID del evento en Livestream',
		'type'			=> 'text'
	),
);

$saved = false;

if (isset($_POST['sent']))
{

	$directives_to_store = array();

	foreach ($directives as $code=>$directive)
	{
		$value_to_store = null;

		if ('checkbox' == $directive['type'])
		{
			$value_to_store = !empty($_POST[$code]);
		}
		else
		{
			if (!empty($_POST[$code]))
			{
				$value_to_store = $_POST[$code];
			}
		}

		$directives_to_store[$code] = $value_to_store;
	}

	$json = json_encode($directives_to_store);
	$json = str_replace(array(',"', '{', '}', '":'), array(",\n\"", "{\n", "\n}", '": '), $json);
	$current_config = file_put_contents(CONFIG_FILE, $json);
	apc_clear_cache('user');
	$saved = true;
}

$current_config = json_decode(file_get_contents(CONFIG_FILE), true);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Streaming control</title>
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
	<style>
	h1 { margin: 1em 0 1em; }
	h4 small { display: block; }
	.red { color: red; }
	</style>
</head>
<body>
	<div class="container">
		<h1>Control do streaming</h1>

		<?php if ($saved) : ?>
		<div class="alert alert-success" onclick="this.style.display='none'">Cambios guardados correctamente</div>
		<?php endif ?>

		<form method="post" action="<?php echo $_SERVER['REQUEST_URI'] ?>">

			<table class="table">
			<?php foreach ($directives as $code=>$d) : ?>
				<tr>
					<td>
						<h4><?php echo $d['description'] ?><small><?php echo $code ?></small></h4>
					</td>
					<td>
						<?php echo generate_input($code, isset($d['value']) ? $d['value'] : $current_config[$code], $d['type'], $d['attributes']) ?>
					</td>
				</tr>
			<?php endforeach ?>
			</table>

			<div class="well text-center">
				<p><strong class="red">¡Verifica todas las opciones antes de guardar!</strong></p>
				<button type="submit" class="btn btn-primary btn-large" name="sent">Guardar</button>
			</div>

		</form>
	</div>
</body>
</html>