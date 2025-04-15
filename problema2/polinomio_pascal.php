
<?php
/*
(n =0): 1
(n =1): 1 1
(n =2): 1 2 1
(n =3): 1 3 3 1
(n =4): 1 4 6 4 1
(n =5): 1 5 10 10 5 1
(n =6): 1 6 15 20 15 6 1
(n =7): 1 7 21 35 35 21 7 1
*/

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

/*
(𝑥+1)𝑛

(x+1)0 = 1
(x+1)1 = x+1
(x+1)2 = x2+2x+1
(x+1)3 = x3+3x2+3x+1
(x+1)4 = x4+4x3+6x2+4x+1
(x+1)5 = x5+5x4+10x3+10x2+5x+1
(x+1)6 = x6+6x5+15x4+20x3+15x2+6x+1
(x+1)7 = x7+7x6+21x5+35x4+35x3+21x2+7x+1
*/
// a) Mostrar el polinomio como cadena
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
$n = 2;
$x = 2;

$coef = generarCoeficientes($n);
echo "Coeficientes: " . implode(", ", $coef) . "\n";

$polinomio = mostrarPolinomio($coef);
echo "Polinomio: f(x) = $polinomio\n\n";

evaluarPolinomio($coef, $x);
