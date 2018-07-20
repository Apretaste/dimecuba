<h1>Mis recargas</h1>
{if isset($recargas[0])}
<table width="100%" border="1">
    <tr>
        <th width="40%" align="left">Fecha</th>
        <th width="40%" align="left">Numero</th>
        <th width="20%" align="left">Precio</th>
    </tr>
    {foreach $recargas as $recarga}
    <tr>
        <td>{$recarga->fecha}</td>
        <td>{$recarga->phone}</td>
        <td>&sect;{$recarga->amount}</td>
    </tr>
    {/foreach}
</table>
{else}
<p>Usted no ha hecho ninguna recarga aun</p>
{/if}
{space5}
<center>{button href="DIMECUBA" caption="Atras" color="grey"}</center>