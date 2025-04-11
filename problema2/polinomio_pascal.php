
<?php

//a) genere los coeficientes del polinomio (x+1)n
function generarCoeficientes($n) {
    $triangulo = [];

    for ($i = 0; $i <= $n; $i++) {
        $triangulo[$i] = [];

        for ($j = 0; $j <= $i; $j++) {
            if ($j === 0 || $j === $i) {
                $triangulo[$i][$j] = 1;
            } else {
                $triangulo[$i][$j] = $triangulo[$i - 1][$j - 1] + $triangulo[$i - 1][$j];
            }
        }
    }

    return $triangulo[$n];
}

// a) muestre el resultado de polinomio
function mostrarPolinomio($coeficientes) {
    $n = count($coeficientes) - 1;
    $terminos = [];

    foreach ($coeficientes as $i => $coef) {
        $exponente = $n - $i;
        if ($coef == 0) continue;

        if ($exponente == 0) {
            $terminos[] = $coef;
        } elseif ($exponente == 1) {
            $terminos[] = ($coef == 1 ? "" : $coef) . "x";
        } else {
            $terminos[] = ($coef == 1 ? "" : $coef) . "x^" . $exponente;
        }
    }

    return implode(" + ", $terminos);
}

// b) muestre por pasos el cálculo para x dado f(x) = (x+1)^n
function evaluarPolinomio($coeficientes, $x) {
    $n = count($coeficientes) - 1;
    $resultado = 0;

    echo "Evaluando f(x) = (x+1)^$n para x = $x\n";

    foreach ($coeficientes as $i => $coef) {
        $exponente = $n - $i;
        $potencia = pow($x, $exponente);
        $valor = $coef * $potencia;
        $resultado += $valor;

        echo "{$coef} * ($x^$exponente) = $valor\n";
    }

    echo "Resultado final: $resultado\n";
}

// ---------------------------
// Prueba con n = 4 y x = 2
$n = 4;
$x = 2;

$coef = generarCoeficientes($n);
echo "Coeficientes: " . implode(", ", $coef) . "\n";

$polinomio = mostrarPolinomio($coef);
echo "Polinomio: f(x) = $polinomio\n\n";

evaluarPolinomio($coef, $x);
