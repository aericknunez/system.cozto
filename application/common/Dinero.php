<?php
class Dinero{

public static function DineroEscrito($cantidad) {

	$cant = number_format($cantidad,2,'.',','); // establezco dos decimales al numero
	$decimales =  substr($cant, -2);
	$numero =  substr($cant, 0, -3);

		if($decimales == "00"){
		return ucfirst(self::convertir($numero) . " Dolares exactos"); 
		} else {
		return ucfirst(self::convertir($numero) . " " . $decimales . "/100 Dolares"); 	
		}


  
}




public static function basico($numero) {
	$valor = array ('uno','dos','tres','cuatro','cinco','seis','siete','ocho',
	'nueve','diez', 'once', 'doce','trece','catorce','quince','dieciséis','diecisiete','dieciocho','diecinueve','veinte','vientiuno','veintidós','veintitrés','veinticuatro','veinticinco',
	'veintiséis','veintisiete','veintiocho','veintinueve');
	return $valor[$numero - 1];
}

public static function decenas($n) {
$decenas = array (30=>'treinta',40=>'cuarenta',50=>'cincuenta',60=>'sesenta',
70=>'setenta',80=>'ochenta',90=>'noventa');
	if( $n <= 29) return self::basico($n);
	$x = $n % 10;
	if ( $x == 0 ) {
	return $decenas[$n];
	} else return $decenas[$n - $x].' y '. self::basico($x);
}

public static function centenas($n) {
$cientos = array (100 =>'cien',200 =>'doscientos',300=>'trecientos',
400=>'cuatrocientos', 500=>'quinientos',600=>'seiscientos',
700=>'setecientos',800=>'ochocientos', 900 =>'novecientos');
if( $n >= 100) {
	if ( $n % 100 == 0 ) {
	return $cientos[$n];
	} else {
	$u = (int) substr($n,0,1);
	$d = (int) substr($n,1,2);
	return (($u == 1)?'ciento':$cientos[$u*100]).' '.self::decenas($d);
	}
	} else return self::decenas($n);
}

public static function miles($n) {
	if($n > 999) {
	if( $n == 1000) {
		return 'mil';
	}
		else {
		$l = strlen($n);
		$c = (int)substr($n,0,$l-3);
		$x = (int)substr($n,-3);
		if($c == 1) {$cadena = 'mil '.self::centenas($x);}
		else if($x != 0) {$cadena = self::centenas($c).' mil '.self::centenas($x);}
		else $cadena = self::centenas($c). ' mil';
		return $cadena;
		}
		} else { 
			return self::centenas($n);
			}
	}

public static function millones($n) {
	if($n == 1000000) {
		return 'un millón';
	}
		else {
		$l = strlen($n);
		$c = (int)substr($n,0,$l-6);
		$x = (int)substr($n,-6);
			if($c == 1) {
			$cadena = ' millón ';
			} else {
			$cadena = ' millones ';
			}
		return self::miles($c).$cadena.(($x > 0)?self::miles($x):'');
		}
}


public static function convertir($n) {
		switch (true) {
		case ( $n >= 1 && $n <= 29) : return self::basico($n); break;
		case ( $n >= 30 && $n < 100) : return self::decenas($n); break;
		case ( $n >= 100 && $n < 1000) : return self::centenas($n); break;
		case ($n >= 1000 && $n <= 999999): return self::miles($n); break;
		case ($n >= 1000000): return self::millones($n);
		}
}




} // clase
?>