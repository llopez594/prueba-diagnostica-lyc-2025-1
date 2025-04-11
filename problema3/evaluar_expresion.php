<?php

function evaluarExpresion($expresion) {
    $expresion = trim($expresion);

    // Validar que los caracteresson validos
    if (!preg_match('~^[0-9eE+\-*/(). ]+$~', $expresion)) {
        return "Error: caracteres invalidos";
    }

    $expresion = str_replace("E", "e", $expresion);

    // evaluar
    try {
        // PHP entiende notacion cientifica en numeros (1e3, 5E-2)
        // asi que podemos usar directamente eval() si validamos antes
        $resultado = eval("return ($expresion);");
        return "Resultado: $resultado";
    } catch (Throwable $e) {
        return "Error al evaluar";
    }
}

// ---------------------------
// Prueba
$entrada = "(125E10 - 1e15)/5E-85 * 15.4";

echo "Expresion: $entrada\n";
echo evaluarExpresion($entrada) . "\n";
