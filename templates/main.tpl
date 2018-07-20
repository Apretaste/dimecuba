<center>{img src="{$images['logo']}" alt="Logo DimeCuba" width="50%"}</center>
<p>DimeCuba tiene los mejores precios del mercado para llamar y mandar SMS a Cuba, y todos los meses ofrece promociones especiales para que tu familia no deje de recargarte.</p>
<p>Con la ayuda de DimeCuba, les ofrecemos <b>una recarga Cubacel al día</b>. El primero que entre podrá disfrutarla <b>por un valor de §40 creditos</b>. Si no la obtienes hoy, mañana estará disponible.</p>
<p>Déjale saber a tu familia afuera que use DimeCuba, comunícate con mejor calidad y menor precio, y ayúdanos a seguir trayendo recargas diarias para nuestros usuarios.</p>
{space5}
<center>
    {if $disponible}
        {button href="DIMECUBA RECARGAR" caption="Comprar" desc="n:Ingrese sú número de telefono con 53 al inicio, verifique antes de enviar ya que no es posible cambiarlo*" popup="true" wait="true" color="green"}
    {else}
        <small><b>La recarga del dia se la llevo {link href="PERFIL @{$today[0]->user}" caption="@{$today[0]->user}"} a las {$today[0]->hora}</b></small>
        {space5}
    {/if}
    {button href="DIMECUBA ANTERIORES" caption="Anteriores" color="grey"}
</center>