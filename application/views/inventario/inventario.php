<div>
  <ul class="breadcrumb">
    <li>
      <a href="#" id="btnAgregarInventario" onmousedown="javascript:agregarinventario();">Agregar</a>
    </li>
  </ul>
</div>

<div id="dlgSetInventario" title="Ingresar Inventario">
	<?php echo form_open('/inventario/inventario/redireccionar',array('id'=>'frmSetInventario')); ?>
		</br>
		<div class="ui-widget">
			<label class="control-label" for="codigoarticulo"> Referencia Articulo  </label>
        	<input id="codigoarticulo" name="codigoarticulo" value="" size="27" placeholder="Codigo Articulo">
        	<p id="validaref" hidden>*</p>
        </div>

        <div id="resultado" name="resultado" style="z-index: 150; position: absolute; background: #F90; font-size: 20px;"></div>        
        <input id="idinventario" name="idinventario" class="input-xlarge focused" type="hidden" value="-1" />
        </br>

        <label class="control-label" for="nombreTipoArticu"> Nombre Articulo  </label>
		<input id="nombreTipoarti" name="nombreTipoarti" size="30" type="text" value="" placeholder="Nombre Tipo Articulo" />
		<p id="validanom" hidden>*</p>
		<input id="idarticulo" name="idarticulo" type="hidden" value="" />

		</br></br>
		<label>Tipo Articulo </label>
		<input id="tipoarti" type="text" name="tipoarti" placeholder="Tipo Articulo" value="" readonly>
		
		</br></br>
        <label class="control-label" for="cantidad"> Cantidad  </label>
        <input id="cantidad" type="text" name="cantidad" value="" style="text-align: right;" placeholder="Cantidad" readonly>
        
        </br></br>
        <label>Costo </label>
        <input id="cantidadcosto" type="text" name="cantidadcosto" value="" readonly placeholder="$0.0" style="text-align: right;">

        </br></br>
        <label>Entrada </label>
        <input id="entrada" type="text" name="entrada" value="" placeholder="Entrada" style="text-align: right;">
        <p id="validaentra" hidden>*</p>

        </br></br>
        <label for="costoentrada">Costo </label>
        <input id="costoentrada" type="text" name="costoentrada" value="" style="text-align: right;" placeholder="$0.0">
        <p id="validacosto" hidden>*</p>

        </br></br>
        <label>Salidas </label>
        <input type="text" id="salida" name="salida" value="" placeholder="Salidas" readonly style="text-align: right;">

        </br></br>
        <label for="costosalida">Costo </label>
        <input id="costosalida" type="text" name="costosalida" value="" style="text-align: right;" placeholder="$0.0" readonly>
        </br></br>
        <div id="msgerror" style="display: none;"></div>

        </br></br>
		<div class="form-actions" style="text-align: right">
            <button id="btnGuardarTipo" type="submit" class="btn btn-primary">guardar</button>
		</div>
	<?php echo form_close(); ?>
</div>

<div class="box-content">
	<table id="tblArticulo" >
		<thead>
			<tr>
			    <th rowspan="2" style="text-align: center;">
			        FECHA
			    </th>
			    <th rowspan="2" style="text-align: center;">
			        REFERENCIA
			    </th>
			    <th rowspan="2" style="text-align: center;">
			        NOMBRE
			    </th>
			    <th rowspan="2" style="text-align: center;">
			        TIPO
			    </th>
			    <th colspan="3" style="text-align: center;">
			        ENTRADAS
			    </th>
			    <th colspan="3" style="text-align: center;">
			        SALIDAS
			    </th>
			    <th colspan="3" style="text-align: center;">
			        EXISTENCIA
			    </th>
			    <th rowspan="2" style="text-align: center;">
			        TOTAL
			    </th>
			    <!--th rowspan="2" style="text-align: center;">
			        ACCIONES
			    </th-->
			</tr>
			<tr>
			    <th style="text-align: center;">
					CANTIDAD
			    </th>
			    <th style="text-align: center;">
			        COSTO
			    </th>
			    <th style="text-align: center;">
			        VALOR VENTA
			    </th>
			    <th style="text-align: center;">
			        CANTIDAD
			    </th>
			    <th style="text-align: center;">
					COSTO
			    </th>
			    <th style="text-align: center;">
					COSTO VENTA
			    </th>
			    <th style="text-align: center;">
					CANTIDAD
			    </th>
			    <th style="text-align: center;">
			        COSTO
			    </th>
			    <th style="text-align: center;">
			        COSTO VENTA
			    </th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($inventarios->result() as $inve) { ?>
			
			<tr id="tr<?= $inve->id;?>" style="border-bottom: 1px dashed;">
				<td style="text-align: center;">
					<input id="idinventariotable" name="idinventariotable" type="hidden" value="<?= $inve->id; ?>">
					<?= date("d/M/Y", strtotime($inve->fecha)); ?>
				</td>
				<td style="text-align: right;">
					<?= $inve->codigo; ?>
				</td>
				<td style="text-align: left;">
					<?= $inve->nombre; ?>
				</td>
				<td style="text-align: left;">
					<?= $inve->nombretip; ?>
				</td>
				<td style="text-align: center;">
					<?= $inve->cantientra; ?>
				</td>
				<td style="text-align: right;">
					$<?= number_format($inve->valorentra, '0', ',', '.'); ?>
				</td>
				<td style="text-align: right;">
					$<?= number_format($inve->valorventa, '0', ',', '.'); ?>
				</td>
				<td style="text-align: center;">
					<?= $inve->ventacantidad; ?>
				</td>
				<td style="text-align: right;">
					$<?= number_format($inve->valor, '0', ',', '.'); ?>
				</td>
				<td style="text-align: right;">
					$<?= number_format($inve->ventavaloruni, '0', ',', '.'); ?>
				</td>
				<td style="text-align: center;">
					<?= $inve->cantidad; ?>
				</td>
				<td style="text-align: right;">
					$<?= number_format($inve->valor, '0', ',', '.'); ?>
				</td>
				<td style="text-align: right;">
					$<?= number_format($inve->valorventa, '0', ',', '.'); ?>
				</td>
				<td style="text-align: right;">
					$<?=  number_format($inve->valor * $inve->cantidad, '0', ',', '.'); ?>
				</td>
				<!--td style="text-align: center;">
					<a id="btnEditarInventarioID" href="" class="btn btn-info">
						<i class="icon-edit icon-white"></i>
						Editar
					</a>
				</td-->
			</tr>
		<?php } ?>
		
			
		</tbody>
	</table>
</div>