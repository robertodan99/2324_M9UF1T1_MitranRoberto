<!DOCTYPE html>
<html>
<head>
    <title>Calculadora PHP con POO</title>
    <!-- Función JavaScript para alternar la visibilidad de 'numero2Field' -->
    <script>
        function toggleNumero2Field() {
            // Obtener la operación seleccionada en el menú desplegable
            var operacion = document.getElementById("operacion").value;
            // Obtener el elemento 'numero2Field'
            var numero2Field = document.getElementById("numero2Field");

        // Comprobar la operación seleccionada y alternar la visibilidad en consecuencia
            if (operacion === "concatenar" || operacion === "reemplazar" || operacion === "factorial") {
                numero2Field.style.display = "none";// Ocultar 'numero2Field'
            } else {
                numero2Field.style.display = "block";// Mostrar 'numero2Field'
            }
        }
    </script>
</head>
<body>
    
    <h1>Calculadora con POO en PHP</h1>
    <!-- Formulario para entrada y cálculo con la función 'toggleNumero2Field' -->
    <form method="POST" onsubmit="toggleNumero2Field()">
        <input type="text" name="numero1" placeholder="Número 1" required>
        <select name="operacion" id="operacion">
            <option value="suma">Suma</option>
            <option value="resta">Resta</option>
            <option value="multiplicacion">Multiplicación</option>
            <option value="division">División</option>
            <option value="concatenar">Concatenar</option>
            <option value="factorial">Factorial</option>
            <option value="reemplazar">Reemplazar</option>
        </select>
        <div id="numero2Field">
            <input type="text" name="numero2" placeholder="Número 2">
            </div>
         <!-- Campos adicionales para la operación 'reemplazar' -->
        <input type="text" name="buscar" placeholder="Buscar (solo para Reemplazar)">
        <input type="text" name="reemplazar" placeholder="Reemplazar (solo para Reemplazar)">
        <input type="submit" name="calcular" value="Calcular">
       </form>
       
       <!-- Mostrar el resultado del cálculo -->
       <div id="resultado">
      
      

<?php
// Definición de la clase Calculadora
class Calculadora {
    private $numero1;
    private $numero2;
    private $operacion;
 // Constructor de la clase
    public function __construct($num1, $num2, ) {
        $this->numero1 = $num1;
        $this->numero2 = $num2;
        }



    public function construct($num1, $num2) {
        $this->numero1 = $num1;
        $this->numero2 = $num2;
    }
     // Operaciones de la calculadora
    public function suma() {
        return $this->numero1 + $this->numero2;
    }
    
    public function resta() {
        return $this->numero1 - $this->numero2;
    }
    
    public function multiplicacion() {
        return $this->numero1 * $this->numero2;
    }
    
    public function division() {
        if ($this->numero2 != 0) {
            return $this->numero1 / $this->numero2;
        } else {
            return "Error: División por cero";
        }
    }

    public function concatenar() {
        return $this->numero1 . $this->numero2;
    }

    public function factorial($numero) {
        if ($numero < 0) {
            return "Error: Factorial de un número negativo no está definido.";
        } elseif ($numero == 0 || $numero == 1) {
            return 1;
        } else {
            return $numero * $this->factorial($numero - 1);
        }
    }

    public function reemplazar($buscar, $reemplazar) {
        return str_replace($buscar, $reemplazar, $this->numero1);
    }
}

session_start();

// Inicializar el historial si no existe.
if (!isset($_SESSION['historial'])) {
    $_SESSION['historial'] = array();
}

if (isset($_POST['calcular'])){
    $numero1 = $_POST['numero1'];
    $numero2 = $_POST['numero2'];
    $operacion = $_POST['operacion'];
    
    $calculadora = new Calculadora($numero1, $numero2);
if(isset($_POST['calcular'])){
    $numero1 = $_POST['numero1'];
    $numero2 = $_POST['numero2'];
    $operacion = $_POST['operacion'];
    
    $calculadora = new Calculadora($numero1, $numero2);
}
    
    switch($operacion){
        case 'suma':
            $resultado = $calculadora->suma();
            break;
        case 'resta':
            $resultado = $calculadora->resta();
            break;
        case 'multiplicacion':
            $resultado = $calculadora->multiplicacion();
            break;
        case 'division':
            $resultado = $calculadora->division();
            break;
        case 'concatenar':
            $resultado = $calculadora->concatenar();
            break;
        case 'factorial':
            $resultado = $calculadora->factorial($numero1);
            break;
        case 'reemplazar':
            $buscar = $_POST['buscar'];
            $reemplazar = $_POST['reemplazar'];
            $resultado = $calculadora->reemplazar($buscar, $reemplazar);
            break;
        default:
            $resultado = "Operación no válida";
            break;
        }

        $_SESSION['historial'][] = array('operacion' => $operacion, 'resultado' => $resultado);
    echo "Resultado: $resultado";
    }
    if (isset($_POST['clear_historial'])) {
        $_SESSION['historial'] = array();
    }
?>
 </div>  

<div id="historial">
    <h2>Historial de Resultados</h2>
    <table>
        <thead>
            <tr>
                <th>Operación</th>
                <th>Resultado</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Mostrar el historial de resultados.
            foreach ($_SESSION['historial'] as $registro) {
                echo '<tr>';
                echo '<td>' . $registro['operacion'] . '</td>';
                echo '<td>' . $registro['resultado'] . '</td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
    <!-- Formulario para limpiar el historial -->
    <form method="POST">
            <input type="submit" name="clear_historial" value="Limpiar Historial">
        </form>
</div>




</div>  
    
</body>
</html>