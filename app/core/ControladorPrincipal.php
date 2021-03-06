<?php
require_once("app/clientes/controladores/ControladorClientes.php");
require_once("app/localidades/controladores/ControladorLocalidades.php");
require_once("app/productos/controladores/ControladorProductos.php");
//require_once("app/rubros/controladores/ControladorRubros.php");

class ControladorPrincipal{
    //es el método más importante porque evalua las variables que llegan en 
    //la URL y a partir del valor de esas variables, crea una instancia de el
    //controlador del módulo o sección que corresponda, además analizará tanto
    //la variable "seccion" como la variable "accion" para llamar a los 
    //métodos correspondientes. Ej: ?seccion=clientes&accion=nuevo
    //instancia al ControladorCliente y llama al método nuevoCliente
    //$controladorClientes=new ControladorClientes();
    //$controladorClientes->nuevoCliente(); 
    public static function index(){
        echo "<div class='container'><br/>
            <h1>HeladeriaWeb - V 0.0.1</h1>
              <p>4to año 2017.</p>
              ";
        //si existe la variable "seccion"
        if (isset($_REQUEST['seccion']))
        {
                switch ($_REQUEST['seccion']) {
                        case 'productos':  //si vale "productos"
                                $controladorProductos=new ControladorProductos();
                                break;

                        case 'clientes':  //si vale "clientes"
                                $controladorClientes=new ControladorClientes();
                                break;

                        case 'rubros':  //si vale "rubros"
                                $controladorRubros=new ControladorRubros();
                                break;
                        case 'localidades':  //si vale "localidades"
                                $controladorLocalidades=new ControladorLocalidades();
                                break;                                    

                }
        }
        echo "</div>";
    }
    
    //crea el menú principal de la aplicación web, permitiendo el acceso a los
    //diferentes módulos (clientes, productos)
    public static function enlaces(){
        echo "<nav class='navbar navbar-default' role='navigation'> 
                  <div class='navbar-header'>
                    <button type='button' class='navbar-toggle' data-toggle='collapse'
                            data-target='.navbar-ex1-collapse'>
                      <span class='sr-only'>Desplegar navegación</span>
                      <span class='icon-bar'></span>
                      <span class='icon-bar'></span>
                      <span class='icon-bar'></span>
                    </button>
                    
                    <a class='navbar-brand' href='#'></a>
                    <img src='static/imgs/logo.png' />
                    
                  </div>
                  <div class='collapse navbar-collapse navbar-ex1-collapse'>
                    <ul class='nav navbar-nav navbar-right'> 
                        <li class='dropdown'> 
                            <a class='dropdown-toggle' href='#' data-toggle='dropdown' >Productos <b class='caret'></b></a> 
                            <ul class='dropdown-menu'> 
                                <li><a href='index.php?seccion=productos'>Listado</a></li> 
                                <li><a href='index.php?seccion=productos&accion=nuevoProducto'>Nuevo</a></li> 
                            </ul> 
                        </li> 
                        <li class='dropdown'> 
                            <a class='dropdown-toggle' href='#' data-toggle='dropdown' >Clientes <b class='caret'></b></a> 
                            <ul class='dropdown-menu'> 
                                <li><a href='index.php?seccion=clientes'>Listado</a></li> 
                                <li><a href='index.php?seccion=clientes&accion=nuevoCliente'>Nuevo</a></li> 
                            </ul> 
                        </li>
                        <li class='dropdown'> 
                            <a class='dropdown-toggle' href='#' data-toggle='dropdown' >Rubros <b class='caret'></b></a> 
                            <ul class='dropdown-menu'> 
                                <li><a href='index.php?seccion=rubros'>Listado</a></li> 
                                <li><a href='index.php?seccion=rubros&accion=nuevoRubro'>Nuevo</a></li> 
                            </ul> 
                        </li> 
                        <li class='dropdown'> 
                            <a class='dropdown-toggle' href='#' data-toggle='dropdown' >Localidades <b class='caret'></b></a> 
                            <ul class='dropdown-menu'> 
                                <li><a href='index.php?seccion=localidades'>Listado</a></li> 
                                <li><a href='index.php?seccion=localidades&accion=nuevoLocalidad'>Nuevo</a></li> 
                            </ul> 
                        </li>
                    </ul>
                    </div>
                </nav>";

    }

    //arma el encabezado de las páginas Html, title, head, insertando el 
    //código CSS, javascript (bootstrap,Jquery)
    public static function encabezadoHtml(){
            session_start();
            echo "<!DOCTYPE html>
                    <html lang='es'>
                        <head>
                            <meta http-equiv='Content-type' content='text/html;charset=utf-8' />
                            <meta name='viewport' content='width=device-width, initial-scale=1.0'> 
                            <link href='static/css/bootstrap.css' rel='stylesheet'>
                            <link href='static/css/fileinput.css' media='all' rel='stylesheet' type='text/css'/>                            
                            <script src='static/js/jquery.js'></script> 
                            <script src='static/js/bootstrap.js'></script>
                            <script src='static/js/fileinput.js' type='text/javascript'></script>
                            <script src='static/js/es.js' type='text/javascript'></script>                            
                            <script src='static/js/codigo.js' type='text/javascript'></script>
                        </head>
                        <body>";

    }
    public static function chequeoLogin()
    {
        if (!isset($_SESSION['usuario']))
        {
            if (isset($_REQUEST['txtUsuario']))
            {
                if (($_REQUEST['txtUsuario']=="admin")&&($_REQUEST['txtPassword']=="1234"))
                {
                    $_SESSION['usuario']="admin";
                    return true;
                }
                else
                {
                    ControladorPrincipal::login();
                    return false;
                }
            }
            else
            {
                ControladorPrincipal::login();
                return false;
            }
        }
        else
            return true;
    }
    
    private static function login()
    {
        echo "<div class='container'><form action='index.php' method='post' >
                    <h4>Inicio de sesión:</h4>
                    <div class='form-group'>
                            <label for='txtUsuario'>Usuario</label>
                            <input type='text' id='txtUsuario' name='txtUsuario' placeholder='Ingrese el usuario...' class='form-control' />
                            <label for='txtPassword'>Contraseña</label>
                            <input type='password' id='txtPassword' name='txtPassword' placeholder='Ingrese la contraseña...' class='form-control' />
                            <input type='submit' value='Iniciar sesión' class='btn btn-default' />
                    </div>
		</form></div>";
    }
}

