
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
    <title>Lista de Tareas Pendientes por Realizar</title>
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
            <div  class="caja titulo" align="center">SISTEMA DE PENDIENTES</div>  
            <div class="caja contenido">
                <p>
                    Bienvenido
                </p>                
            </div>                      
        </div>
    </header>
<br><br>

<section>
        <table>
                <form action="index.php"method="post">
                        <td>Nuevo Pendiente:</td>
                        <td><input type="text" name="txttarea" size="10"/></td>
                        <td><input type="submit" name="accion" value="Grabar"/></td>
                    </tr>
                        
                    </tr>
                </form>
        </table>
            
            <br />
            
        <div class="aplicaciones">
            
<?php
            	
if(isset($_POST['accion']))
{
    
    $tarea=$_POST['txttarea'];
    $tarea = strtoupper($tarea);
    $tarea = trim($tarea); 

    
    if ($tarea=="")
    {
        
        echo 'Ingrese tarea pendiente';

    }
    else
    {
    
        $codtarea=1;
        $exc1=mysqli_query($link,"select * from pendiente where descripcion='$tarea'");
        //echo 'Hola: ' . $tarea; //el punto concatena
        $res1=mysqli_fetch_array($exc1);
        
        if ($res1[0]=="")
        {

            $exc2=mysqli_query($link,"select * from pendiente");

            while ($temp=mysqli_fetch_array($exc2)) //hallar el codtarea
            {
                if ($codtarea<=$temp[0])
                {
                    $codtarea=$codtarea+1;
                }
                else
                {
                    break;
                }
            }
            $inserta="insert into pendiente (idpendiente,descripcion) values ($codtarea,\"$tarea\")";
            //echo $inserta;
            mysqli_query($link,$inserta);
            mysqli_free_result($exc1);
            mysqli_free_result($exc2);
        }
        else
        {

            echo 'Pendiente ya existe';

        }
    }

}

?>


        <table border="1" cellspacing="1" cellpadding="1">
            <th class="cab" colspan="12">LISTA DE PENDIENTES</th>
            <tr class="cab"> <td align ="center">CodPendiente</td> <td align="center">Pendiente</td></tr>
            <?php
            $result=mysqli_query($link,"select idpendiente,descripcion from pendiente where horafecha is null");
            while($row=mysqli_fetch_array($result))
                    {
                        printf("<tr class='lista'> <td align=center>%s</td> <td align=center>%s</td> </tr>"
                            ,$row["idpendiente"],$row["descripcion"]);
                    }
                          
            mysqli_free_result($result);
            ?>
        </table>
        </div>
    </section>
 <!-------------------------------------------------------------------------------------------------------------------------------------->
<section>
        <table>
                <form action="index.php"method="post">
                        <td>Pendiente Realizado:</td>
                        <td><input type="text" name="idtarearealizada" size="10"/></td>
                        <td><input type="submit" name="realiza" value="Registra hora"/></td>
                    </tr>
                        
                    </tr>
                </form>
        </table>
            
            <br />
            
        <div class="aplicaciones">
            
<?php
                
if(isset($_POST['realiza']))
{
    
    $codtarea=$_POST['idtarearealizada'];
    
    if ($codtarea=="")
    {
        
        echo 'Ingrese un código de tarea';

    }
    else
    {
    
        $exc1=mysqli_query($link,"select * from pendiente where idpendiente='$codtarea'");
        $res1=mysqli_fetch_array($exc1);
        
        if ($res1[0]=="")
        {

           echo 'Pendiente inexistente. Ingrese código de pendiente.';

        }
        else
        {

            if ($res1[2]<>"")
                {
                    echo 'El pendiente ya fue finalizado';
                }
            else
            {

                $actualiza="update pendiente set horafecha=current_timestamp() where idpendiente=$codtarea";
                //echo $actualiza;
                mysqli_query($link,$actualiza);





            }

        }
    }

}

?>


        
        </div>
    </section>
<a href="Historial.php"><input type="button" value="Historial" name="submit" /></a>
</body>
</html>