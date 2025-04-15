<?php

/*
PROBLEMA INTERESANTE
Buscar todas las palabras "E" exactamente "E", no dentro de otra palabra como "Excelente", jajaja el enunciado es epico

Consideraciones:
    - Es sensible a mayusculas: solo "E"
    - Solo cuenta cuando aparece como palabra suelta
    - Implementar una separacion por palabras
*/

function contarPalabraE($texto) {
    // Convertir en arreglo
    $palabras = explode(" ", $texto);

    $contador = 0;
    foreach ($palabras as $palabra) {
        // Limpiar posibles signos alrededor de la palabra
        $limpia = trim($palabra, ".,;:!¡?()\"'");

        if ($limpia === 'E') {
            $contador++;
        }
    }

    return $contador;
}

// ---------------------------
// Prueba
$cadena = "Esa E es la letra E. Pero en esta oracion, E no se debe contar si es parte de 'ESTA' o 'Excelente'. E";
/*
$cadena = "En la sala había silencio. De pronto, alguien gritó: E. Todos voltearon. Nadie sabía por qué lo había dicho. 
Unos segundos después, otro estudiante dijo también E, y luego otro más repitió: E. 
Aquel día, sin razón aparente, la letra E se convirtió en el centro de atención. 
No era una clase de lenguaje, ni un ejercicio de pronunciación. 
Simplemente, la palabra E, dicha sola, resonó varias veces. 
No contaron las veces que alguien dijo excelente, energía, esperanza o estelar, porque esas no cuentan. 
Solo E. Y así fueron pasando los minutos, hasta que al final, uno más se paró y gritó: ¡E!";*/


echo "Texto: $cadena\n";
echo "\n\nCantidad de 'E': " . contarPalabraE($cadena) . "\n";
