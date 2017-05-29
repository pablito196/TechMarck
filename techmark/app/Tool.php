<?php
/**
 * Created by PhpStorm.
 * User: Gthusho-PC
 * Date: 2/2/2017
 * Time: 22:02
 */

namespace App;


 use Illuminate\Support\Facades\Auth;
 use Illuminate\Support\Facades\Config;

 class  Tool
{
     public static function brand($title = '',$url,$description){
         $brand = [
             'page'=>$title,
             'first'=>[
                 url('/'),
                 'Inicio'
             ],
             'second'=>[
                 $url,
                 $description
             ]
         ];
         return $brand;
     }
     public static function config(){
         $configuracion=ThemeConfiguration::get()->first();
         return $configuracion;
     }
     public static function setActive($position){
         $active=[];
         for($i = 0;$i<=5;$i++){
             if($i==$position){
                 $active[$i]='active';
             }else{
                 $active[$i]='';
             }
         }
         return $active;
     }
 public static function fechaCastellano ($fecha) {
         $fecha = substr($fecha, 0, 10);
         $numeroDia = date('d', strtotime($fecha));
         $dia = date('l', strtotime($fecha));
         $mes = date('F', strtotime($fecha));
         $anio = date('Y', strtotime($fecha));
         $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
         $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
         $nombredia = str_replace($dias_EN, $dias_ES, $dia);
         $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
         $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
         $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
         return $nombredia." ".$numeroDia." de ".$nombreMes." de ".$anio;
     }
     public static  function slug($url,$html=true) {
         $url = strtolower($url);
         $find = array('á', 'é', 'í', 'ó', 'ú', 'ñ');
         $repl = array('a', 'e', 'i', 'o', 'u', 'n');
         $url = str_replace ($find, $repl, $url);
         // Añaadimos los guiones
         $find = array(' ', '&', '\r\n', '\n', '+');
         $url = str_replace ($find, '-', $url);
         // Eliminamos y Reemplazamos demás caracteres especiales
         $find = array('/[^a-z0-9\-]/', '/[\-]+/', '/]*>/');
         $repl = array('', '-', '');
         $url = preg_replace ($find, $repl, $url);
         if($html)
         return $url.'.html';
         else return $url;
     }
     public static function getModeradorId(){
         $query = Rol::where('nombre',Config::get('RolChek.moderador'))->get()->first();
         return $query->id;
     }
     public static function acortarString($string, $length=NULL)
     {
         //Si no se especifica la longitud por defecto es 50
         if ($length == NULL)
             $length = 50;
         //Primero eliminamos las etiquetas html y luego cortamos el string
         $stringDisplay = substr(strip_tags($string), 0, $length);
         //Si el texto es mayor que la longitud se agrega puntos suspensivos
         if (strlen(strip_tags($string)) > $length)
             $stringDisplay .= ' ...';
         return $stringDisplay;
     }
     public static  function existe($query){
         if(count($query)>0)
             return true;
         else return false;
     }
     public static function strip_word_html($text, $allowed_tags = '')
     {
         mb_regex_encoding('UTF-8');
         //replace MS special characters first
         $search = array('/&lsquo;/u', '/&rsquo;/u', '/&ldquo;/u', '/&rdquo;/u', '/&mdash;/u');
         $replace = array('\'', '\'', '"', '"', '-');
         $text = preg_replace($search, $replace, $text);
         //make sure _all_ html entities are converted to the plain ascii equivalents - it appears
         //in some MS headers, some html entities are encoded and some aren't
         $text = html_entity_decode($text, ENT_QUOTES, 'UTF-8');
         //try to strip out any C style comments first, since these, embedded in html comments, seem to
         //prevent strip_tags from removing html comments (MS Word introduced combination)
         if(mb_stripos($text, '/*') !== FALSE){
             $text = mb_eregi_replace('#/\*.*?\*/#s', '', $text, 'm');
         }
         //introduce a space into any arithmetic expressions that could be caught by strip_tags so that they won't be
         //'<1' becomes '< 1'(note: somewhat application specific)
         $text = preg_replace(array('/<([0-9]+)/'), array('< $1'), $text);
         $text = strip_tags($text, $allowed_tags);
         //eliminate extraneous whitespace from start and end of line, or anywhere there are two or more spaces, convert it to one
         $text = preg_replace(array('/^\s\s+/', '/\s\s+$/', '/\s\s+/u'), array('', '', ' '), $text);
         //strip out inline css and simplify style tags
         $search = array('#<(strong|b)[^>]*>(.*?)</(strong|b)>#isu', '#<(em|i)[^>]*>(.*?)</(em|i)>#isu', '#<u[^>]*>(.*?)</u>#isu');
         $replace = array('<b>$2</b>', '<i>$2</i>', '<u>$1</u>');
         $text = preg_replace($search, $replace, $text);
         //on some of the ?newer MS Word exports, where you get conditionals of the form 'if gte mso 9', etc., it appears
         //that whatever is in one of the html comments prevents strip_tags from eradicating the html comment that contains
         //some MS Style Definitions - this last bit gets rid of any leftover comments */
         $num_matches = preg_match_all("/\<!--/u", $text, $matches);
         if($num_matches){
             $text = preg_replace('/\<!--(.)*--\>/isu', '', $text);
         }
         return $text;
     }
     public static function getRotulo(){
         $x = Enviados::where(\DB::raw("month(fecha)"),date("m"))->count();
         $last = Enviados::where(\DB::raw("month(fecha)"),date("m"))->max('index');
         if($x>$last)
            return "CAINCO-CH(".($x+1).") ".date("m")."/".date('Y');
         else
             return "CAINCO-CH(".($last+1).") ".date("m")."/".date('Y');
     }
     public static function getRotuloIndex(){
         $x = Enviados::where(\DB::raw("month(fecha)"),date("m"))->count();
         $last = Enviados::where(\DB::raw("month(fecha)"),date("m"))->max('index');
         if($x>$last)
             return $x+1;
         else
             return $last+1;
     }
     public static function setRotulo($index,$fecha){
         return "CAINCO-CH(".$index.") ".date("m",strtotime($fecha))."/".date('Y',strtotime($fecha));
     }
     public static function convertMoney($money){
         return number_format ( $money , 2 , "." , "," ).' Bs.';
     }
     public static function obtenerMesLiteral($mes){
         $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
         return $meses[$mes-1];
     }


 }