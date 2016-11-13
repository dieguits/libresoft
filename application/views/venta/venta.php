<div id="dlgpagar" name="dlgpagar" title="Realizar Venta">
	<?php echo form_open('/venta/venta/pagar', array('id'=>'frmSetVenta')); ?>
		
		</br>
		<label for="totalventa">Total : $</label>
        <label id="totalventa" name="totalventa"></label>
        </br></br>

        <label for="pago">Pago: </label>
        <input id="pago" name="pago" style="text-align: right;" type="text" value="" onkeyup="calcularVueltos();" autocomplete="off">
        </br></br>

        <label for="cambio">Cambio: $</label>
        <label id="cambio">$ 0.0</label>

        <div style="text-align: right; margin-top: 20px;">
        	<input type="submit" value="vender">
        	<!-- onmouseup="window.print();" -->
        </div>

	<?php echo form_close(); ?>
</div>
<input type="hidden" id="prueba" value="0">
<div id="tablaArticulos" style="min-height: 400px;">
	<div style="text-align: right;">
		<a href="#" onclick="vamoscancelar()" style="text-decoration: none; color: red; padding-right: 10px;">Cancelar Venta</a>
	</div>
	<?php echo form_open('/venta/venta/agregarProducto', array('id'=>'frmAgregarProducto')); ?>
	<table id="tblArticulo">
		<thead>
			<tr>
				<th style="text-align: center; width: 15%;">
					REFERENCIA
				</th>
				<th style="text-align: center; width: 15%;">
					CANTIDAD
				</th>
				<th style="text-align: center; width: 55%;">
					ARTICULO
				</th>
				<th style="text-align: center; width: 15%;">
					VALOR
				</th>
				<!--th style="text-align: center; width: 15%;">
					
				</th-->
			</tr>
		</thead>
		<tbody>
			<tr id="idreferencia1">
				<td>
					<div class="ui-widget">
						<input type="hidden" id="idd_1" name="idd_1" value="-1">
						<input type="text" id="referencia1" value="">
					</div>
				</td>
				<td>
					<input type="text" id="cantidad1" value="">
				</td>
				<td>
					<label id="articulo1"></label>
				</td>
				<td>
					<label id="valor1"></label>
				</td>
				<!--td-->
					<!--a id="elimiarProducto1" type="submit" onclick="hacerAlgo()" href="" style="font-color: red;">X</a-->
					<!--input id="elimiarProducto1" type="button" onclick="hacerAlgo()" value="X" style="font-color: red;"-->
				<!--/td-->
			</tr>
		</tbody>
	</table>
	<?php echo form_close(); ?>
</div>

<div style="text-align: right; padding-right: 26px;">
	Sub Total: <label id="sbtotal">$000</label>
	</br>
	Total: $<label id="total">000</label>
</div>

<div style="text-align: right;">
	<input type="submit" id="guardar" value="vender" onclick="vender();">
</div>
<!-- <?php echo base_url();?>files/pdfs/test.pdf -->
<iframe id="vamosimprimir" name="vamosimprimir"  frameborder="0" src='' style="padding-top: 1px;">
</iframe>