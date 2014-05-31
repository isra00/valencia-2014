<?php

error_reporting(E_ALL);
ini_set("display_errors", true);

/** @todo Eliminar este código duplicado con un init.php */
define('CONFIG_FILE', 'config.json');
define('CACHE_KEY',	'vlc2014-config');
define('EVENT_TIMEZONE', 	'Europe/Madrid');

/**
 * Genera un <select> con las opciones especificadas y un valor por defecto.
 * Soporta arrays anidados generando <optgroup />
 * 
 * @param string    $nombre         El nombre del select
 * @param array     $opciones       Valores que tomará el select, por ejemplo, 
 *                                  array('hombre' => 'Hombre', 'mujer'=>'Mujer');
 * @param mixed     $seleccionada   Opción seleccionada por defecto
 * @param array     $atributos      Atributos para el elemento <select>
 * @param boolean   $soloOptions    No devuelve la tag <select>
 * 
 * @return string   El HTML final
 * 
 * @todo            Añadir tests unitarios
 */
function form_select($nombre, $opciones, $seleccionada=null, $atributos=null, $primera_opcion=array('0'=>'Todos'), $soloOptions=false) {
    
    $seleccionada = (string) $seleccionada;
    
    $salida = '';
    
    if (!$soloOptions) {
        $salida .= '<select name="' . $nombre . '"';
        $salida .= ' id="' . str_replace('--', '-', str_replace(array('[', ']'), '-', $nombre)) . '"';
        if (is_array($atributos) && count($atributos)) {
            foreach ($atributos as $n => $valor) {
            	if (is_string($valor)) {
	                $salida .= ' ' . $n . '="' . $valor . '"';
	            }
            }
        }

        $salida .= ">\n";
    }
    
    //Primera opción
    if (is_array($primera_opcion)) {
        /** @todo Esto permite muchas "primeras opciones". ¿Es bueno o malo? */
        foreach ($primera_opcion as $i=>$v) {
            $salida .= '<option value="' . $i . '">' . $v . "</option>\n";
        }
    }
    
    foreach ($opciones as $c => $v) {

        if (is_array($v)) {
            $salida .= "<optgroup label=\"$c\">\n";
            foreach ($v as $subclave=>$subvalor) {
                $salida .= '<option value="' . $subvalor . '"';
                if ($subvalor == $seleccionada) $salida .= ' selected="selected"';
                $salida .= '>' . $subclave . "</option>\n";
            }
            $salida .= "</optgroup>\n";
        } else {
            $salida .= '<option value="' . $c . '"';
            if ($c == $seleccionada) $salida .= ' selected="selected"';
            $salida .= '>' . $v . '</option>';
        }
    }
    
    if (!$soloOptions) {
        $salida .= '</select>';
    }
    
    return $salida;
}

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

		case ($type == 'button' || $type == 'submit'):
			$output .= " value='$value'";
			foreach ($attributes as $key=>$val) {
				$output .= " $key=\"$val\"";
			}
			break;

		case 'select':
			return form_select($name, $attributes['options'], $value, $attributes, null);
	}

	$output .= ' />';

	return $output;
}

function write_message_reload()
{
	file_put_contents("message.json", json_encode(array(
		'id'		=> time() . (($_POST['message_id']) ? '-' . $_POST['message_id'] : ''),
		'action'	=>'reload'
	)));
}

$directives = array(
	'general_disable'	=> array(
		'description'	=> '<span class="glyphicon glyphicon-ban-circle"></span> Desactivar todo el streaming (incluye recarga)',
		'type'			=> 'checkbox'
	),
	'event_start'		=> array(
		'description'	=> 'Inicio del evento (hora local)',
		'type'			=> 'text'
	),
	'event_end'			=> array(
		'description'	=> 'Fin del evento (hora local)',
		'type'			=> 'text'
	),
	'finish_now'		=> array(
		'description'	=> '<span class="glyphicon glyphicon-off"></span> Terminar el encuentro ahora (incluye recarga)',
		'type'			=> 'submit',
		'value'			=> 'Terminar ahora mismo (!)', 
		'attributes'	=> array(
			'type'		=> 'submit', 
			'class' 	=> 'btn btn-danger'
		),
	),
	'message_id'		=> array(
		'description'	=> 'Identificador del mensaje',
		'type'			=> 'text',
	),
	'send_reload'		=> array(
		'description'	=> '<span class="glyphicon glyphicon-refresh"></span> Hacer que los clientes recarguen la página',
		'type'			=> 'submit',
		'value'			=> 'Ordenar recarga (!)',
		'attributes'	=> array(
			'type'		=> 'submit', 
			'class' 	=> 'btn btn-warning'
		),
	),
	'remove_message'	=> array(
		'description'	=> '<span class="glyphicon glyphicon-volume-off"></span> Eliminar mensaje actual',
		'type'			=> 'submit',
		'value'			=> 'Eliminar mensaje enviado',
		'attributes'	=> array(
			'type'		=> 'submit', 
			'class' 	=> 'btn btn-warning'
		),
	),
	'livestream_event'	=> array(
		'description'	=> 'ID del evento en Livestream',
		'type'			=> 'text'
	),
	'external_url'			=> array(
		'description'	=> 'URL externa del evento',
		'type'			=> 'text',
	),
	/** @todo Validar: no se puede elegir redirect si el campo external_url es inválido o vacío */
	'player'			=> array(
		'description'	=> 'Reproductor',
		'type'			=> 'select',
		'attributes'	=> array( 'options' => array(
			'livestream'	=> 'Livestream',
			'redirect'		=> 'Externo (redirección)',
			'mediterraneo'	=> 'MediterraneoTV'	
		) )
	),
	'enable_messages'	=> array(
		'description'	=> '<span class="glyphicon glyphicon-transfer"></span> Activar mensajes',
		'type'			=> 'checkbox'
	),
);

$current_config = json_decode(file_get_contents(CONFIG_FILE), true);

$save = false;
$error_date = false;

if (!empty($_POST))
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

		// Buttons are not directives to store
		if (false == in_array($code, array('finish_now', 'send_reload', 'remove_message')))
		{
			$directives_to_store[$code] = $value_to_store;
		}
	}

	$save = true;

	if (isset($_POST['finish_now']))
	{
		// Form validation
		if (strtotime($directives_to_store['event_start']) > time())
		{
			$error_date = true;
			$save = false;
		}
		else
		{
			write_message_reload();
			$directives_to_store['event_end'] = date('Y-m-d H:i:s');
		}
	}

	$general_disable_changes = $current_config['general_disable'] != $directives_to_store['general_disable'];

	if (isset($_POST['send_reload']) || $general_disable_changes || $directives_to_store['enable_messages'] == false)
	{
		write_message_reload();
	}

	if (isset($_POST['remove_message']))
	{
		file_put_contents("message.json", "");
		$directives_to_store['message_id'] = '';
	}

	if ($save)
	{
		$json = json_encode($directives_to_store);
		$json = str_replace(array(',"', '{', '}', '":'), array(",\n\"", "{\n", "\n}", '": '), $json);
		file_put_contents(CONFIG_FILE, $json);
		apc_clear_cache('user');
		$current_config = $directives_to_store;
	}
}

$message = file_get_contents("message.json");

if (empty($message))
{
	$message = 'No hay mensaje activo';
}
else
{
	$message = "<pre>$message</pre>"
			 . "enviado: " . date('Y-m-d H:i:s', intval(json_decode($message, true)['id']));
}

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
		<h1>Control del streaming</h1>

		<div class="panel panel-default">
			<table class="table">
				<tr><th>Hora del servidor</th><td><?php echo date('Y-m-d H:i:s') . ' (' . EVENT_TIMEZONE . ')' ?></td></tr>
				<tr><th>Mensaje actual</th><td><?php echo $message ?></td></tr>
			</table>
		</div>

		<?php if ($save) : ?>
		<div class="alert alert-success" onclick="this.style.display='none'">Cambios guardados correctamente</div>
		<?php endif ?>

		<?php if ($error_date) : ?>
		<div class="alert alert-danger" onclick="this.style.display='none'">¡No se puede terminar antes de haber empezado!</div>
		<?php endif ?>

		<form method="post" action="<?php echo $_SERVER['REQUEST_URI'] ?>">
			<table class="table">
			<?php foreach ($directives as $code=>$d) : ?>
				<tr>
					<td>
						<h4><?php echo $d['description'] ?><small><?php echo $code ?></small></h4>
					</td>
					<td>
						<?php echo generate_input($code, isset($d['value']) ? $d['value'] : $current_config[$code], $d['type'], (isset($d['attributes']) ? $d['attributes'] : null)) ?>
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