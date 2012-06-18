<?php
namespace Desymfony\Sandbox;

require_once __DIR__.'/../../vendor/autoload.php';

// Objeto básico de prueba (equivalente a una entidad de Symfony2/Doctrine2)
$oferta = new \StdClass();
$oferta->titulo = "Lorem Ipsum Dolor Sit Amet";
$oferta->descripcion = "Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat.";
$oferta->id = 3;
$oferta->gestor = "José García";

$loader = new \Twig_Loader_Filesystem(__DIR__.'/../Resources/views');
$twig = new \Twig_Environment($loader, array());

// Se permiten todas las etiquetas salvo {% include %} y {% render %}
$etiquetas = array_diff(array_keys($twig->getTags()), array('include', 'render'));
// Sólo se permiten los filtros |upper, |lower y |escape
$filtros = array('upper', 'lower', 'escape');
// Sólo se permite el uso del método getFilters() para objetos de tipo Twig_Environment
$metodos = array(
    'Twig_Environment' => array('getFilters')
);
// Sólo se permite el acceso a las siguientes propiedades de los siguientes objetos
// Así, el sandbox se puede utilizar como ACL sencilla para restringir el acceso a
// métodos y propiedades de objetos
$propiedades = array(
    'Twig_Template' => array('env'),
    'StdClass'      => array('titulo', 'descripcion'),
);
// Sólo se permite el uso de la función dump() de Twig
$funciones = array('dump');

// Crear una nueva política de seguridad
$policy  = new \Twig_Sandbox_SecurityPolicy($etiquetas, $filtros, $metodos, $propiedades, $funciones);

// Activar la política de seguridad a través de la extensión sandbox
// Si el segundo parámetro es `true`, todo el contenido de las plantillas se considera
// potencialmente inseguro y se le aplica la política de seguridad.
// Si el segundo parámetro es `false`, sólo se aplican las restricciones de seguridad
// al código encerrado por la etiqueta {% sandbox %} {% sandbox %} ... {% endsandbox %}
$sandbox = new \Twig_Extension_Sandbox($policy, true);
$twig->addExtension($sandbox);

try {
    echo $twig->render('sandbox.twig', array('oferta' => $oferta));
} catch(\Twig_Sandbox_SecurityError $e) {
    echo "La plantilla utiliza elementos prohibidos.\n";
    echo $e->getMessage();
}