<div class="item-titulo">FICHA TECNICA</div>

<table class="item-tabla">
    <tr>
        <td class="item-tabla-titulo">Objeto de Contratación</td>
        <td>{$item.objeto_contracion}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Fecha Publicación</td>
        <td>{$item.fecha_publicacion|date_format:'%d/%m/%Y'}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Tipo de Contratación</td>
        <td>{$item.tipo_contratacion}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Modalidad</td>
        <td>{$item.modalidad}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Estado</td>
        <td>{$item.estado}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Codigo Interno</td>
        <td>{$item.codigo_interno}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Proponente</td>
        <td>{$item.proponente}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Proponente Telefono/Celular</td>
        <td>{$item.proponente_telefono}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Proponente Correo Electronico</td>
        <td>{$item.proponente_email}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Contrato Código</td>
        <td>{$item.contrato_codigo}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Fecha Suscripción</td>
        <td>{$item.fecha_suscripcion|date_format:'%d/%m/%Y'}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Fecha Fin</td>
        <td>{$item.fecha_fin|date_format:'%d/%m/%Y'}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Monto</td>
        <td>{$item.monto}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Pago Total</td>
        <td>{$item.pago_total}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Pago Parcial</td>
        <td>{$item.pago_parcial}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Pago Pendiente</td>
        <td>{$item.pago_pendiente}</td>
    </tr>
    <tr>
        <td class="item-tabla-titulo">Observaciones</td>
        <td>{$item.observaciones}</td>
    </tr>
</table>

<table class="item-tabla">
    <tr>
        <td colspan=3" class="item-tabla-titulo txtCenter">PAGOS</td>
    </tr>
    <tr>
        <td class="item-tabla-header">Fecha</td>
        <td class="item-tabla-header">Monto</td>
        <td class="item-tabla-header">Descripción</td>
    </tr>
    {foreach from=$item.pago item=row key=idx}
        <tr>
            <td align="center">{$row.fecha|date_format:'%d/%m/%Y'}</td>
            <td align="center">{$row.monto|escape:"html"}</td>
            <td>{$row.descripcion|escape:"html"}</td>
        </tr>
    {/foreach}
</table>
<table class="item-tabla">
    <tr>
        <td colspan=3" class="item-tabla-titulo txtCenter">DOCUMENTOS ADJUNTOS</td>
    </tr>
    <tr>
        <td class="item-tabla-header">Descripción</td>
        <td class="item-tabla-header">Documento</td>
        <td class="item-tabla-header">Tamaño</td>
    </tr>
    {foreach from=$item.adjunto item=row key=idx}
        <tr>
            <td>{$row.descripcion|escape:"html"}</td>
            <td align="center">{$row.attached_name|escape:"html"}</td>
            <td align="center">{$row.attached_size|escape:"html"}</td>
        </tr>
    {/foreach}
</table>