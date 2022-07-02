<?php
require_once("class/class.php");

$con = new Login();
$con = $con->ConfiguracionPorId();
$simbolo = "<strong>".$con[0]['simbolo']."</strong>";
?>

<?php if (isset($_GET['CargaMesas'])): ?>
<div class="table-responsive">    
    <!-- Nav tabs -->
    <ul class="nav nav-tabs customtab" role="tablist">
    <?php
    $sala = new Login();
    $sala = $sala->ListarSalas();
    if($sala==""){ echo "";      
    } else {
    $a=1;
    for ($i = 0; $i < sizeof($sala); $i++) { ?>
    <?php if ($i === 0): ?>
        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#v<?php echo $sala[$i]['codsala'];?>" role="tab"><span class="hidden-sm-up"><i class="mdi mdi-sale"></i></span> <span class="hidden-xs-down"><?php echo $sala[$i]['nomsala'];?></span></a>
    <?php else: ?>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#v<?php echo $sala[$i]['codsala'];?>" role="tab"><span class="hidden-sm-up"><i class="mdi mdi-sale"></i></span> <span class="hidden-xs-down"><?php echo $sala[$i]['nomsala'];?></span></a>
    <?php endif; ?>
        </li>
    <?php } } ?>   
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
    <?php
    $sala = new Login();
    $sala = $sala->ListarSalas();
    if($sala==""){ echo "";      
    } else {
    for ($i = 0; $i < sizeof($sala); $i++) { ?>
    <?php if ($i === 0): ?>
        <div class="tab-pane active" id="v<?php echo $sala[$i]['codsala'];?>" role="tabpanel">
    <?php else: ?>
        <div class="tab-pane" id="v<?php echo $sala[$i]['codsala'];?>" role="tabpanel">
    <?php endif; ?>
    <?php $codigo_sala = $sala[$i]['codsala']; ?>

        <div class="p-4" id="listMesas">

        <?php
        $mesa = new Login();
        $mesa = $mesa->ListarMesas();
        if($mesa==""){ echo "";      
        } else {
        for ($ii = 0; $ii < sizeof($mesa); $ii++) { ?>
        <?php if ($mesa[$ii]['codsala'] == $codigo_sala) { ?>
            <li style="display:inline;float: left; margin-right: 4px;">
                <div class="users-list-name codMesa" title="<?php echo $mesa[$ii]['nommesa']; ?>" style="cursor:pointer;" onclick="RecibeMesa('<?php echo encrypt($mesa[$ii]['codmesa']); ?>')">
                    <div id="<?php echo $mesa[$ii]['nommesa']; ?>" style="width: 110px;height: 110px;-moz-border-radius: 50%;-webkit-border-radius: 50%;border-radius: 50%;background:<?php if ($mesa[$ii]['statusmesa'] == '0') { ?>#5cb85c;<?php } ?>red" class="miMesa"><img src="fotos/mesa.png" style="display:inline;margin:24px;float:left;width:68px;height:50px;"></div>
                    <center><strong><?php echo $mesa[$ii]['nommesa']; ?></strong></center><br>
                </div>
            </li>
        <?php } } } ?>

        </div>
        </div>
        <?php } } ?>
    </div>
    <!-- Tab panes -->
</div>
<?php endif; ?>



<?php if (isset($_GET['CargaProductos'])): ?>
<div class="table-responsive">
  <!-- Nav tabs -->
  <ul class="nav nav-tabs customtab" role="tablist">
    <?php
    $categoria = new Login();
    $categoria = $categoria->ListarCategorias();
    if($categoria==""){ echo "";      
    } else {
    $a=1;
    for ($i = 0; $i < sizeof($categoria); $i++) { ?>
    <?php if ($i === 0): ?>
        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#v<?php echo $categoria[$i]['codcategoria'];?>" role="tab"><span class="hidden-sm-up"><i class="mdi mdi-sale"></i></span> <span class="hidden-xs-down"><?php echo $categoria[$i]['nomcategoria'];?></span></a>
    <?php else: ?>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#v<?php echo $categoria[$i]['codcategoria'];?>" role="tab"><span class="hidden-sm-up"><i class="mdi mdi-sale"></i></span> <span class="hidden-xs-down"><?php echo $categoria[$i]['nomcategoria'];?></span></a>
    <?php endif; ?>
        </li>
    <?php } } ?>   
    </ul><br>

    <!-- Tab panes -->
    <div class="tab-content">
    <?php
    $categoria = new Login();
    $categoria = $categoria->ListarCategorias();
    if($categoria==""){ echo "";      
    } else {
    for ($i = 0; $i < sizeof($categoria); $i++) { ?>
    <?php if ($i === 0): ?>
        <div class="tab-pane active" id="v<?php echo $categoria[$i]['codcategoria'];?>" role="tabpanel">
    <?php else: ?>
        <div class="tab-pane" id="v<?php echo $categoria[$i]['codcategoria'];?>" role="tabpanel">
    <?php endif; ?>
    <?php $codigo_cate = $categoria[$i]['codcategoria']; ?>

        <div class="row">

        <?php
        $producto = new Login();
        $producto = $producto->ListarProductosModal();

        $monedap = new Login();
        $cambio = $monedap->MonedaProductoId(); 

        if($producto==""){

                echo "<div class='alert alert-danger'>";
                echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
                echo "<center><span class='fa fa-info-circle'></span> NO EXISTEN PRODUCTOS REGISTRADOS ACTUALMENTE</center>";
                echo "</div>";    

        } else {

        for ($ii = 0; $ii < sizeof($producto); $ii++) {

        if ($producto[$ii]['codcategoria'] == $codigo_cate && $producto[$ii]['existencia'] > 0) { ?>
            <div class="mb" ng-click="afterClick()" ng-repeat="product in ::getFavouriteProducts()" 

            OnClick="DoAction('<?php echo $producto[$ii]['codproducto']; ?>','<?php echo $producto[$ii]['producto']; ?>','<?php echo $producto[$ii]['codcategoria']; ?>','<?php echo $producto[$ii]['nomcategoria']; ?>','<?php echo $producto[$ii]['preciocompra']; ?>','<?php echo $producto[$ii]['precioventa']; ?>','<?php echo $producto[$ii]['descproducto']; ?>','<?php echo $producto[$ii]['ivaproducto']; ?>','<?php echo $producto[$ii]['existencia']; ?>','<?php echo $precioconiva = ( $producto[$ii]['ivaproducto'] == 'SI' ? $producto[$ii]['precioventa'] : "0.00"); ?>');">
             <div class="darkblue-panel pn" title="<?php echo $producto[$ii]['producto'].' | CATEGORIA: ('.$producto[$ii]['nomcategoria'].')';?>">
            <div class="darkblue-header">
                <a class="text-white"><?php echo getSubString($producto[$ii]['producto'],14);?></a>
            </div>
            <?php if (file_exists("./fotos/productos/".$producto[$ii]["codproducto"].".jpg")){

            echo "<img src='fotos/productos/".$producto[$ii]['codproducto'].".jpg?' style='width:216px;height:140px;'>"; 

                } else {

            echo "<img src='fotos/producto.png' style='width:180px;height:140px;'>";  } ?>
            <a class="text-white"> <?php echo $simbolo.$producto[$ii]['precioventa'];?></a>
            <h5><i class="fa fa-bars"></i> <?php echo $producto[$ii]['existencia'];?></h5><br>
                </div><br>
            </div>
            <?php } } } ?>

        </div>
        </div>
        <?php } } ?>

    </div>
    <!-- Tab panes -->   
</div>
<?php endif; ?>








<?php 
############################ MUESTRA PRODUCTOS FAVORITOS ###########################
if (isset($_GET['Muestra_Favoritos'])) { 

$favoritos = new Login();
$favoritos = $favoritos->ListarProductosFavoritos();
$x=1;

echo $status = ( $favoritos[0]["codproducto"] == '' ? '' : '<label class="control-label"><h4>Productos Favoritos: </h4></label><br>');

if($favoritos==""){

echo "";      

} else {

for($i=0;$i<sizeof($favoritos);$i++){  ?>

<button type="button" class="button ng-scope" 
style="font-size:8px;border-radius:5px;width:69px; height:50px;cursor:pointer;"

ert-add-pending-addition="" ng-click="afterClick()" ng-repeat="product in ::getFavouriteProducts()" OnClick="DoAction('<?php echo $favoritos[$i]['codproducto']; ?>','<?php echo $favoritos[$i]['producto']; ?>','<?php echo $favoritos[$i]['codcategoria']; ?>','<?php echo $precioconiva = ( $favoritos[$i]['ivaproducto'] == 'SI' ? $favoritos[$i]['preciocompra'] : "0.00"); ?>','<?php echo $favoritos[$i]['preciocompra']; ?>','<?php echo $favoritos[$i]['precioventa']; ?>','<?php echo $favoritos[$i]['ivaproducto']; ?>','<?php echo $favoritos[$i]['existencia']; ?>');" title="<?php echo $favoritos[$i]['producto'];?>">

<?php if (file_exists("./fotos/".$favoritos[$i]["codproducto"].".jpg")){

echo "<img src='./fotos/".$favoritos[$i]['codproducto'].".jpg?' alt='x' style='border-radius:4px;width:40px;height:35px;'>"; 
}else{
echo "<img src='./fotos/producto.png' alt='x' style='border-radius:4px;width:40px;height:35px;'>";  
} ?>

<span class="product-label ng-binding "><?php echo getSubString($favoritos[$i]['producto'], 8);?></span>
</button>

<?php  if($x==8){ echo "<div class='clearfix'></div>"; $x=0; } $x++; } }

echo $status = ( $favoritos[0]["codproducto"] == '' ? '' : '<hr>'); ?>

<?php  }
############################ MUESTRA PRODUCTOS FAVORITOS ###########################
?>






<?php 
############################ MUESTRA PEDIDOS EN DELIVERY ###########################
if (isset($_GET['Muestra_Delivery'])) { 

$tra = new Login(); ?>


<div id="div"><div class="table-responsive" data-pattern="priority-columns">
              <table id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                                             <thead>
                                             <tr role="row">
                              <th>N&deg;</th>
                              <th>Datos de Cliente</th>
                              <th>Platillos</th>
<?php if($_SESSION["acceso"] != 'repartidor'){ ?><th>Nombres de Repartidor</th><?php } ?>
                              <th>Status</th>
                              <th>Procesar</th>
                          </tr>
                                             </thead>
                                             <tbody>
<?php 
$a=1;
$mostrador = new Login();
$reg = $mostrador->ListarDelivery();

if($reg==""){

echo "";      

} else {

for($i=0;$i<sizeof($reg);$i++){  
?>
                                           <tr role="row" class="odd">
                                <td class="sorting_1" tabindex="0"><?php echo $a++; ?></td>
<td><abbr title="<?php echo $cliente = ( $reg[$i]['cliente'] == '0' ? "<span class='label label-warning'> SIN ASIGNAR</span>" : $reg[$i]['nomcliente']); ?>"> <?php echo $reg[$i]['cedcliente']; ?></abbr></td>
<td><?php echo "<span style='font-size:12px;'><strong>".$reg[$i]['detalles']."</strong></span>"; ?></td>

<?php if($_SESSION["acceso"] != 'repartidor'){ ?><td><?php echo $reg[$i]['nombres']; ?></td><?php } ?>

<td><?php if($reg[$i]['entregado']== '0') { echo "<span class='label label-success'><i class='fa fa-check'></i> ENTREGADA</span>"; } else { echo "<span class='label label-danger'><i class='fa fa-times'></i> PENDIENTE</span>"; } ?></td>
                <td>
<a class="btn btn-success btn-xs" data-placement="left" title="Ver Cliente" data-original-title="" data-href="#" data-toggle="modal" data-target="#panel-modal" data-backdrop="static" data-keyboard="false" onClick="VerCliente('<?php echo base64_encode($reg[$i]["codcliente"]); ?>')"><i class="fa fa-user"></i></a>

<a class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="left" title="" data-original-title="Procesar Entrega" onClick="ProcesarDelivery('<?php echo base64_encode($reg[$i]["codventa"]) ?>','<?php echo base64_encode("PROCESARENTREGA") ?>')"><i class="fa fa-motorcycle"></i></a>

<a href="reportepdf?codventa=<?php echo base64_encode($reg[$i]['codventa']); ?>&tipo=<?php echo base64_encode("TICKET") ?>" target="_black" rel="noopener noreferrer" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="left" title="" data-original-title="Ticket de Venta"><i class="fa fa-print"></i></a>
</td>
                                           </tr>
                                           <?php } } ?>
                                           </tbody>
</table></div></div>

<?php  } 
############################ MUESTRA PEDIDOS EN DELIVERY ###########################
?>



    <!--Scrolling-tabs JavaScript -->
    <script src="assets/js/jquery.scrolling-tabs.js"></script>
    <script src="assets/js/st-demo.js"></script>