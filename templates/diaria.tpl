<center>{img src="{$images['logo']}" alt="Logo DimeCuba" width="50%"}</center>
<p>Cada dia habrá disponible una recarga para la compra.</p>
<p>Gracias al esfuerzo y compromiso en hacer más amena la experiencia dentro de nuestra aplicación, traemos esta promocion que 
    estamos seguros será del agrado de todos, en asociación con DimeCuba.</p>
<h2>Recarga de 10CUC Promo DimeCuba</h2>
<center>
    {if $disponible}
        {button href="DIMECUBA RECARGA" caption="Comprar" desc="n:Ingrese sú número de telefono con 53 al inicio, verifique antes de enviar ya que no es posible cambiarlo*" popup="true" wait="true" color="green"}
    {else}
        <small><b>La recarga del dia se la llevo {link href="PERFIL @{$today[0]->user}" caption="@{$today[0]->user}"} a las {$today[0]->hora}</b></small>
    {/if}
    {space5}
    {button href="DIMECUBA" caption="Regresar al Inicio" color="green"}
</center>