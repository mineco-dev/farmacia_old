<form action="solicitud_transferir.php?id_documento=<? print $id_documento;?>" method="post" name="frm_transferir">
    <input name="btn_transferir" type="submit" class="btransferir" id="btn_transferir" value="Transferir">
</form>

<form action="solicitud_seguimiento.php?id_documento=<? print $id_documento;?>" method="post" name="frm_seguimiento">
    <input name="btn_seguimiento" type="submit" class="bseguimiento" id="btn_transferir" value="Observaciones">
</form>
<form action="solicitud_adjunto.php?id_documento=<? print $id_documento;?>" method="post" name="frm_adjunto">
    <input name="btn_seguimiento" type="submit" class="badjuntos" id="btn_transferir" value="Adjuntos">
</form>
<!--<form action="solicitud_finalizar.php?id_documento=<? print $id_documento;?>" method="post" name="frm_finalizar">
    <input name="btn_fin" type="submit" class="bfinalizar" id="btn_finalizar" value="finalizar Solicitud">
</form>
-->


