<!DOCTYPE html>
<html lang="en">
        <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CRUD PEQUEÑO</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>

    <?php
        //abrir base de datos
        $pdo_options[PDO::ATTR_ERRMODE]=PDO::ERRMODE_EXCEPTION;
        $conexion = new PDO('mysql:host=localhost;dbname=FINAL_0907_23_4766', 'root', '',$pdo_options);

        //metodos de la conexion
        $select = $conexion->query('SELECT Carnet, Nombre, Grado, Telefono From Alumno');

        if (isset($_POST['accion']) && $_POST['accion'] == 'Crear' ){
                $insert = $conexion-> prepare("INSERT INTO Alumno(Carnet, Nombre, Grado, Telefono) VALUES (:Carnet, :Nombre, :Grado, :Telefono)");
                $insert->bindValue('Carnet', $_POST['Carnet']);
                $insert->bindValue('Nombre', $_POST['Nombre']);
                $insert->bindValue('Grado', $_POST['Grado']);
                $insert->bindValue('Telefono', $_POST['Telefono']);
                $insert->execute();
            }
    ?>
    <nav class="barra-navegacion">
            <a href=""> CARNET</a>
            <a href=""> NOMBRE </a>
            <a href=""> GRADO</a>
            <a href=""> TELEFONO</a>
    </nav>
    <div class="contendor-lista-sql">
        <?php
                //para cada uno = foreach y fetchall obtener todo
            foreach($select->fetchAll() as $alumno){ ?>
            <div class="contenido">
                <?php echo $alumno['Carnet']?>
            </div>
            <div class="contenido">
                <?php echo $alumno['Nombre']?>
            </div>
            <div class="contenido">
                <?php echo $alumno['Grado']?>
            </div>
            <div class="contenido">
                <?php echo $alumno['Telefono']?>
            </div>
            
            <?php }?> 

    </div>

        <form method="POST">
                <input type="text" name="Carnet" placeholder="Ingresa tu Carnet"/>
                <input type="text" name="Nombre" placeholder="Ingresa tu Nombre"/>
                <input type="text" name="Grado" placeholder="Ingresa tu Grado"/>
                <input type="text" name="Telefono" placeholder="Ingresa tu Telefono"/>
                <input type="hidden" name="accion" value="Crear" />
                <button type="submit">Crear</button>
        </form>
    </body>
</html>