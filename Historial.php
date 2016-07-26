
<?php
    //Llama a la clase conexión y ejecuta el método conectar
    include("conexion.php");
    $link=conectar();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-type" charset="UTF-8">
    <link rel="stylesheet" href="css/frame.css">
    <link rel="stylesheet" href="css/mistilo.css">
    <title>Historial de Pendientes Realizados</title>
    <style>
        .mostrar
        {
            display: none;
        }
    </style>
    
</head>
<body>
    <header>
        <div class="grupo">
            <div  class="caja titulo" align="center">Historial de Pendientes Realizados</div>  
            <div class="caja contenido">
                <p>
                    Bienvenido
                </p>                
            </div>                      
        </div>
    </header>
<br><br>

<section>
            
        <div class="aplicaciones">
            
        <table border="1" cellspacing="1" cellpadding="1">
            <th class="cab" colspan="12">PENDIENTES REALIZADOS</th>
            <tr class="cab"> <td align ="center">CodPendiente</td> <td align="center">Pendiente</td> <td align="center">Fecha</td> </tr>
            <?php
            $result=mysqli_query($link,"select idpendiente,descripcion,horafecha from pendiente where horafecha is not null");
            while($row=mysqli_fetch_array($result))
                    {
                        printf("<tr class='lista'> <td align=center>%s</td> <td align=center>%s</td> <td align=center>%s</td> </tr>"
                            ,$row["idpendiente"],$row["descripcion"],$row["horafecha"]);
                    }
                          
            mysqli_free_result($result);
            ?>
        </table>
        </div>
    </section>
<a href="index.php"><input type="button" value="Atrás" name="submit" /></a>
</body>
</html>