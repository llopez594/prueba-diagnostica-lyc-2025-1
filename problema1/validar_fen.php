<?php

/*
CASOS A VALIDAR EN EL ALGORITMO:
    - 6 partes separadas por espacio
    - Tablero con 8 filas válidas
    - Turno 'w' o 'b'
    - Enroque con letras válidas o '-'
    - Al paso: '-' o casilla válida
    - Números válidos
*/


function validarFEN($cadena) {
    // Separar la cadena FEN en partes
    $partes = explode(" ", trim($cadena));

    if (count($partes) != 6) {
        return false;
    }

    list($tablero, $turno, $enroque, $alPaso, $medioMov, $numJugada) = $partes;

    // Validar que el tablero tenga 8 filas separadas por "/"
    $filas = explode("/", $tablero);
    if (count($filas) != 8) {
        return false;
    }

    // Validar turno
    if ($turno != 'w' && $turno != 'b') {
        return false;
    }

    // Validar cada fila
    foreach ($filas as $fila) {
        $sumaCasillas = 0;
        $letras = str_split($fila);

        foreach ($letras as $simbolo) {
            if (is_numeric($simbolo)) {
                $sumaCasillas += intval($simbolo);
            } elseif (in_array($simbolo, ['p','n','b','r','q','k','P','N','B','R','Q','K'])) {
                $sumaCasillas += 1;
            } else {
                // un posible carácter no válido
                return false; 
            }
        }

        if ($sumaCasillas != 8) {
            return false;
        }
    }

    // Validar enroque (puede ser "-", o combinación de K, Q, k, q)
    if ($enroque != '-') {
        for ($i = 0; $i < strlen($enroque); $i++) {
            if (!in_array($enroque[$i], ['K','Q','k','q'])) {
                return false;
            }
        }
    }

    // Validar al paso
    if ($alPaso != '-') {
        $columna = substr($alPaso, 0, 1); // letra x
        $fila = substr($alPaso, 1, 1); // numero y

        if (!in_array($columna, ['a','b','c','d','e','f','g','h']) || !in_array($fila, ['3', '6'])) {
            return false;
        }
    }

    // Validar medio movimiento (debe ser número >= 0)
    if (!is_numeric($medioMov) || intval($medioMov) < 0) {
        return false;
    }

    // Validar número de jugada (debe ser número >= 1)
    if (!is_numeric($numJugada) || intval($numJugada) < 1) {
        return false;
    }

    return true;
}

// Prueba
$ejemplo = "rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w KQkq - 0 1";
// $ejemplo = "rnbqkbnr/pppppppp/8/8/4P3/8/PPPP1PPP/RNBQKBNR b KQkq e3 0 1";
// $ejemplo = "rnbqk1nr/pp2bppp/4p3/2pp4/4P3/2N2N2/PPP2PPP/R1BQKB1R w KQkq c6 0 5";

if (validarFEN($ejemplo)) {
    echo "Cadena FEN válida.\n";
} else {
    echo "Cadena FEN inválida.\n";
}
