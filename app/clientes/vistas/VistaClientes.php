<?php
require_once 'app/core/HelperVistas.php';
class VistaClientes
{
    public function listar($clientesObt)
    {
        echo "<form action='index.php' method='post' class='form-inline'>
                    <h4>Buscar</h4>
                    <div class='form-group'>
                            <label for='txtCadenaBusqueda'>Nombre</label>
                            <input type='text' id='txtCadenaBusqueda' name='txtCadenaBusqueda' placeholder='Ingrese su busqueda...' class='form-control' />
                            <input type='submit' value='Buscar' class='btn btn-default' />
                    </div>
		</form>
                <br />
           <div id='listadoclientes'>
            <table border='1' class='table table-bordered table-hover'>
                <tr>
                    <th>ID</th>
                    <th>Apellido y Nombre</th>
                    <th>DNI</th>
                    <th>Teléfono</th>
                    <th>Localidad</th>
                    <th></th>
                    <th></th>
                </tr>";
    while ($cliente=mysqli_fetch_array($clientesObt))
    {
      $id=$cliente['clientesid'];
      $nombre=$cliente['clientesnombre'];
      $dni=$cliente['clientesdni'];
      $telefono=$cliente['clientestelefono'];
      $enlaceEditar="index.php?seccion=clientes&accion=editar&id=$id";
      $enlaceEliminar="index.php?seccion=clientes&accion=eliminar&id=$id";
      $onclick='return confirm("¿Seguro que desea eliminar al cliente '.$nombre.'?")';
      //$fechaNac=date_create($cliente['jugadoresfechanac']);
      //$fechaNacimiento=date_format($fechaNac,'d/m/Y');
            echo "<tr>
                    <td>$id</td>
                    <td>$nombre</td>
                    <td>$dni</td>
                    <td>$telefono</td>";
            //también se puede concatenar de manera directa el elemento del array con el texto html
            //en vez de colocarlo en una variable y luego imprimir la variable
            echo "<td>".$cliente['localidadesnombre']."</td>
            <td><a href='$enlaceEditar' >Editar</a></td>
            <td><a href='$enlaceEliminar' onclick='$onclick'>Eliminar</a></td>
            </tr>";
    }
    echo "</table></div>";
    }

public function listarPorCadena($clientesObt)
    {
        echo "<table border='1' class='table table-bordered table-hover'>
                <tr>
                    <th>ID</th>
                    <th>Apellido y Nombre</th>
                    <th>DNI</th>
                    <th>Teléfono</th>
                    <th>Localidad</th>
                    <th></th>
                    <th></th>
                </tr>";
    while ($cliente=mysqli_fetch_array($clientesObt))
    {
      $id=$cliente['clientesid'];
      $nombre=$cliente['clientesnombre'];
      $dni=$cliente['clientesdni'];
      $telefono=$cliente['clientestelefono'];
      $enlaceEditar="index.php?seccion=clientes&accion=editar&id=$id";
      $enlaceEliminar="index.php?seccion=clientes&accion=eliminar&id=$id";
      $onclick='return confirm("¿Seguro que desea eliminar al cliente '.$nombre.'?")';
      //$fechaNac=date_create($cliente['jugadoresfechanac']);
      //$fechaNacimiento=date_format($fechaNac,'d/m/Y');
            echo "<tr>
                    <td>$id</td>
                    <td>$nombre</td>
                    <td>$dni</td>
                    <td>$telefono</td>";
            //también se puede concatenar de manera directa el elemento del array con el texto html
            //en vez de colocarlo en una variable y luego imprimir la variable
            echo "<td>".$cliente['localidadesnombre']."</td>
            <td><a href='$enlaceEditar' >Editar</a></td>
            <td><a href='$enlaceEliminar' onclick='$onclick'>Eliminar</a></td>
            </tr>";
    }
    echo "</table>";
    }    
    public function nuevo(){
        $formulario = file_get_contents('static/formularioclientes.html');
        $datosCliente=array('{clientesid}'=>'',
                        '{clientesnombre}'=>'',
                        '{clientesdni}'=>'',
                        '{clientesfechanacimiento}'=>'',
                        '{clientestelefono}'=>'',
                        '{contenidoCboLocalidad}'=> HelperVistas::obtenerContenidoCboLocalidades(0),
                        '{clientesfoto}'=>'silueta.png');
                        

        foreach ($datosCliente as $clave => $valor) {
          $formulario = str_replace($clave, $valor, $formulario);
        }
        print $formulario;
    }
    
    public function editar($registroEditado){
        $formulario = file_get_contents('static/formularioclientes.html');
        if ($registroEditado['clientesfoto']=="")
            $foto="silueta.png";
        else
            $foto=$registroEditado['clientesfoto'];
        
        $datosCliente=array('{clientesid}'=>$registroEditado['clientesid'],
                        '{clientesnombre}'=>$registroEditado['clientesnombre'],
                        '{clientesdni}'=>$registroEditado['clientesdni'],
                        '{clientesfechanacimiento}'=>$registroEditado['clientesfechanacimiento'],
                        '{clientestelefono}'=>$registroEditado['clientestelefono'],
                        '{contenidoCboLocalidad}'=> HelperVistas::obtenerContenidoCboLocalidades($registroEditado['clienteslocalidadesid']),
                        '{clientesfoto}'=>$foto);

        foreach ($datosCliente as $clave => $valor) {
          $formulario = str_replace($clave, $valor, $formulario);
        }
        print $formulario;
    }
}
