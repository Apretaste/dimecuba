<h1>Ultimas recargas</h1>
<center>
<table width="100%" border="1">
    <tr>
        <th width="50%">Comprador</th>
        <th width="50%">Fecha</th>
    </tr>
    {foreach $compradores as $comprador}
    <tr>
        <td>{link href="PERFIL @{$comprador->user}" caption="@{$comprador->user}"}</td>
        <td>{$comprador->fecha}</td>
    </tr>
    {/foreach}
</table>
{space5}
{button href="DIMECUBA MIAS" caption="Mis recargas" color="green"}
{button href="DIMECUBA" caption="Atras" color="grey"}
</center>