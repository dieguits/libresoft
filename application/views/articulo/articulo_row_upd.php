<td style="text-align: right; padding-right: 5px;">
  	<?php $hiddens = $articulo->idarticulo.' 
    <input type="hidden" id="id'.$articulo->idarticulo.'" value="'.$articulo->idarticulo.'" />
    <input type="hidden" id="codigo'.$articulo->idarticulo.'" name="codigo'.$articulo->idarticulo.'" value="'.$articulo->codigoarticulo.'" />
    <input type="hidden" id="nombre'.$articulo->idarticulo.'" value="'.$articulo->nombrearticulo.'" />
    <input type="hidden" id="autor'.$articulo->idarticulo.'" value="'.$articulo->autorarticulo.'" />
    <input type="hidden" id="tipo'.$articulo->idarticulo.'" value="'.$articulo->tipoarticulo.'" />
    <input type="hidden" id="nombretipo'.$articulo->idarticulo.'" value="'.$articulo->nombretipoarticulo.'" />
    <input type="hidden" id="valor'.$articulo->idarticulo.'" value="'.$articulo->valorarticulo.'" />
    <input type="hidden" id="valorventa'.$articulo->idarticulo.'" value="'.$articulo->valorarticuloventa.'" />
    ';
    echo $hiddens; ?>
</td>
<td style="text-align: right;">
    <?= $articulo->codigoarticulo; ?>
</td>
<td>
    <?= $articulo->nombrearticulo; ?>
</td>
<td>
    <?php echo $articulo->autorarticulo ?>
</td>
<td style="text-align: right;">
	<?= "$ ".$articulo->valorarticulo; ?>
</td>
<td style="text-align: right;">
	<?= "$ ".$articulo->valorarticuloventa; ?>
</td>
<td>
    <?php echo $articulo->nombretipoarticulo ?>
</td>
<td style="text-align: center;">
	<!--a class="btn btn-success" href="#" onclick="editar">
		<i class="icon-zoom-in icon-white"></i>  
		View                                            
	</a-->
	<?php echo '<a id="btnEditar'.$articulo->idarticulo.'" href="#" onmousedown="javascript:editarArticulo('.$articulo->idarticulo.');">' ?>
		<i class="icon-edit icon-white"></i>
		Editar
	</a>
<!--?php $atributo = array('class'=>'btn btn-info',
						'id'=>'btnEditar' 
	                   );
  //echo anchor('inicio/inicio/editar/'.$articulo->idarticulo.'', '<i class="icon-edit icon-white"></i> Editar', $atributo);
  //echo anchor('', '<i class="icon-edit icon-white"></i> Editar', $atributo);
? -->
</td>