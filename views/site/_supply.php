<tr>
	<td>(1) Stock (Brought Forward from the previous month)- (1.1 + 1.2 + 1.3 + 1.4 + 1.5)</td>
	<td class="text-right"><strong><?= $stock; ?></strong></td>
</tr>
<tr>
	<td>---- 1.1 Stock held by Food Reserve Agency</td>
	<td class="text-right"><?= $stock_reserve; ?></td>
</tr>
<tr>
	<td>---- ---- 1.1.1: For Strategic Use</td>
	<td class="text-right"><?= $strategic ?></td>
</tr>
<tr>
	<td>---- ---- 1.1.2: For Commercial</td>
	<td class="text-right"><?= $commercial ?></td>
</tr>
<tr>
	<td>---- 1.2 Stock held by Households</td>
	<td class="text-right"><?= $household ?></td>
</tr>
<tr>
	<td>---- 1.3 Stock held by Processors</td>
	<td class="text-right"><?= $processors ?></td>
</tr>
<tr>
	<td>---- 1.4 Stock held by Warehouses/Traders</td>
	<td class="text-right"><?= $warehouses ?></td>
</tr>
<tr>
	<td>---- 1.5 Stock held by Relief Agencies (e.g WFP etc)</td>
	<td class="text-right"><?= $relief ?></td>
</tr>
<tr>
	<td>(2) Imports projections for the reporting month (2.1 + 2.2)</td>
	<td class="text-right"><strong><?= $import ?></strong></td>
</tr>
<tr>
	<td>---- 2.1 From EAC</td>
	<td class="text-right"><?= $eac ?></td>
</tr>
<tr>
	<td>---- 2.2 From COMESA and SADC</td>
	<td class="text-right"><?= $comesa ?></td>
</tr>
<tr>
	<td>---- 2.3 From Extra Regional sources (i.e outside the EAC, COMESA and SADC)</td>
	<td class="text-right"><?= $world ?></td>
</tr>
<tr>
	<td>(3) Production Estimate for reporting month</td>
	<td class="text-right"><strong><?= $production ?></strong></td>
</tr>
<tr>
	<td>(4) Post harvest loss</td>
	<td class="text-right"><strong><?= $loss ?></strong></td>
</tr>