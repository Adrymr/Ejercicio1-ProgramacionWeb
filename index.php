<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de empleados</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
</head>

<body>
    <h2>Registro de empleados</h2><br>

    <div class="div">
        <div class="main-div">
            <div class="form-cont">
                <form action="#" method="post">
                    <label for="txtNombre" class="etiqueta">Nombre</label><br>
                    <input type="text" name="txtNombre" id="nombre" required><br>
            
                    <label for="txtApellido" class="etiqueta" >Apellido</label><br>
                    <input type="text" name="txtApellido" id="apellido" required><br>
            
                    <label for="txtEdad" class="etiqueta">Edad</label><br>
                    <input type="number" name="txtEdad" id="edad" min="18" max="65" required><br>

                    <hr>
            
                    <label for="btnGenero" class="etiqueta">Genero</label><br>
                    <input type="radio" name="btnGenero" value="Femenino" class="input2"> Femenino 
                    <input type="radio" name="btnGenero" value="Masculino" class="input2"> Masculino 
                    <input type="radio" name="btnGenero" value="Otro" class="input2"> Otro<br>
            
                    <hr>

                    <label for="btnEstadoCivil" class="etiqueta">Estado Civil</label><br>
                    <input type="radio" name="btnEstadoC" value="Soltero(a)" class="input2"> Soltero(a)
                    <input type="radio" name="btnEstadoC" value="Casado(a)" class="input2"> Casado(a)<br>
                    <input type="radio" name="btnEstadoC" value="Viudo(a)" class="input2"> Viudo(a)
                    <input type="radio" name="btnEstadoC" value="Divorciado(a)" class="input2"> Divorciado(a)<br>

                    <hr>
            
                    <label for="rangeSueldo" class="etiqueta">Sueldo</label><br>

                    <input type="range" min="800" max="3000" name="rangeSueldo" id="rangeSueldo" class="input2">
                    
                    <br>
                    
                    <div class="btn-cont">
                        <input type="submit" name="btn" value="Registrar" class="btn-registrar" onclick="alert('Registro creado con exito!')">
                    </div>
            
                </form>
            </div>
        </div>

    </div>
    
<?php

include "empleado.php";
$_SESSION['listaEmpleados'] = array();

session_start();

if (isset($_POST['btn'])){
    if (isset($_POST['txtNombre']) && !empty ($_POST['txtNombre']) && isset($_POST['txtApellido']) && !empty ($_POST['txtApellido']) && isset($_POST['txtEdad']) && !empty ($_POST['txtEdad']) && isset($_POST['btnGenero'])  && !empty ($_POST['btnGenero']) && isset($_POST['btnEstadoC'])  && !empty ($_POST['btnEstadoC']) && isset($_POST['rangeSueldo']) && !empty ($_POST['rangeSueldo'])){

        $empleadoNuevo = new empleado();
        
        $empleadoNuevo->setNombre($_POST['txtNombre']);
        $empleadoNuevo->setApellido($_POST['txtApellido']);
        $empleadoNuevo->setEdad($_POST['txtEdad']);
        $empleadoNuevo->setGenero($_POST['btnGenero']);
        $empleadoNuevo->setEstadoCivil($_POST['btnEstadoC']);
        $empleadoNuevo->setSueldo($_POST['rangeSueldo']);

        array_push($_SESSION['listaEmpleados'], $empleadoNuevo);


        echo "<br>";
        echo "<h2>Estadisticas</h2>";

        estadisticas();

    }else{
        echo "no sirvio un carajo :(";
    }
} 

function estadisticas(){
    $totalEmpleadosFem = 0;
    $totalHombresCasados = 0;
    $totalMujeresViudas = 0;
    $EdadPromedioHombres = 0;
    $totalHombres = 0;
    $promedio = 0;

    $indice = count($_SESSION['listaEmpleados']);

     //condicion para determinar empleados femeninos

    if(isset($_SESSION['listaEmpleados'])){

        for ($i=0; $i<$indice; $i++){

            if($_SESSION['listaEmpleados'][$i]->getGenero() == "Femenino"){
                $totalEmpleadosFem++;
            }
        }
        echo "<p>Total de empleados femeninos:  " . $totalEmpleadosFem . "</p>";

    }else{
        echo "no funciona :(";
    }

    //condicion para determinar empleados masculino casados con sueldo mayor a 2500

    if(isset($_SESSION['listaEmpleados'])){
        for ($i=0; $i<$indice; $i++){
            if($_SESSION['listaEmpleados'][$i]->getGenero() == "Masculino" && $_SESSION['listaEmpleados'][$i]->getEstadoCivil() == "Casado(a)" && $_SESSION['listaEmpleados'][$i]->getSueldo() > "2500"){
                $totalHombresCasados++;
            }
        }

        echo "<p>Total de empleados masculinos casados con sueldo mayor a 2500:  " . $totalHombresCasados . "</p";

    }else{
        echo "no funciona :(";
    }

    //total de mujeres viudas con sueldo mayor a 1000

    if(isset($_SESSION['listaEmpleados'])){
        for ($i=0; $i<$indice; $i++){
            if($_SESSION['listaEmpleados'][$i]->getGenero() == "Femenino" && $_SESSION['listaEmpleados'][$i]->getEstadoCivil() == "Viudo(a)" && $_SESSION['listaEmpleados'][$i]->getSueldo() > "1000"){
                $totalMujeresViudas++;
            }
        }

        echo "<br><p>Total de empleados femeninos viudas con sueldo mayor a 1000:  " . $totalMujeresViudas . "</p>";

    }else{
        echo "no funciona :(";
    }

    //edad promedio de los hombres

    if(isset($_SESSION['listaEmpleados'])){
        for ($i=0; $i<$indice; $i++){
            if($_SESSION['listaEmpleados'][$i]->getGenero() == "Masculino"){

                $EdadPromedioHombres += $_SESSION['listaEmpleados'][$i]->getEdad();
                $totalHombres++;
            }
        }

        if($totalHombres != 0) {
            $promedio = $EdadPromedioHombres / $totalHombres;
            echo "<p>Promedio de edades de empleados hombres:  " . $promedio . "</p>";
        }else{
            echo "<br><p>No hay empleados hombres registrados</p>" ;
        }

    }else{
        echo "no funciona :(";
    }
    
}

?>
        
</body>
</html>