
<?PHP

include 'conexion.php';
if(isset($_SESSION["articulo"])){
$consulta = mysqli_query($conexion,'SELECT
                                    producto.Producto_ID,
                                    producto.Nombre,
                                    producto.Foto,
                                    producto.Modelo,
                                    producto.Precio,
                                    producto.Cantidad
                                    FROM
                                    producto')
or die("Fallo la consulta");
$bool=false;
$actual=-1;

$cuenta=count($_SESSION["articulo"]);

$articulos=array_values(array_filter($_SESSION["articulo"]));
$cantidad=array_values(array_filter($_SESSION["cantidad"]));

$nfilas=mysqli_num_rows($consulta);
$Fila=mysqli_fetch_array($consulta);
if($cuenta!=0){
print "[";
    for ($k=0;$k<$cuenta;$k++){
    mysqli_data_seek($consulta, 0);
        for ($i=0;$i<$nfilas;$i++){
        if($Fila["Producto_ID"]==$articulos[$k]){
           print '{';
                              print '"ID":"'.$Fila["Producto_ID"].'",';
                              print '"Nombre":"'.$Fila["Nombre"].'",';
                              print '"Foto":"'.$Fila["Foto"].'",';
                              print '"Modelo":"'.$Fila["Modelo"].'",';
                              print '"Cantidad":"'.$cantidad[$k].'",';
                              print '"Total":"'.$_SESSION["total"].'",';
                              print '"Precio":"'.$Fila["Precio"].'"';
                              print "}";
                              if($k!=$cuenta-1){
                              print ",";
                              }
          break;
        }
        $Fila=mysqli_fetch_array($consulta);


}
}
print "]";
}else{
   print '{"Total":'.$_SESSION["total"].'}';

 }
mysqli_close($conexion);
}
?>







