<tr>
	<th>(1) Stock (Brought Forward from the previous month)- (1.1 + 1.2 + 1.3 + 1.4 + 1.5)</th>
	<td class="text-right"><?= $stock; ?></td>
</tr>
<tr>
	<th>---- 1.1 Stock held by Food Reserve Agency</th>
	<td class="text-right"><?= $stock_reserve; ?></td>
</tr>
<tr>
	<th>---- ---- 1.1.1: For Strategic Use</th>
	<td class="text-right"><?= $strategic ?></td>
</tr>
<tr>
	<th>---- ---- 1.1.2: For Commercial</th>
	<td class="text-right"><?= $commercial ?></td>
</tr>
<tr>
	<th>---- 1.2 Stock held by Households</th>
	<td class="text-right"><?= $household ?></td>
</tr>
<tr>
	<th>---- 1.3 Stock held by Processors</th>
	<td class="text-right"><?= $processors ?></td>
</tr>
<tr>
	<th>---- 1.4 Stock held by Warehouses/Traders</th>
	<td class="text-right"><?= $warehouses ?></td>
</tr>
<tr>
	<th>---- 1.5 Stock held by Relief Agencies (e.g WFP etc)</th>
	<td class="text-right"><?= $relief ?></td>
</tr>
<tr>
	<th>(2) Imports projections for the reporting month (2.1 + 2.2)</th>
	<td class="text-right"><?= $import ?></td>
</tr>
<tr>
	<th>---- 2.1 From EAC</th>
	<td class="text-right"><?= $eac ?></td>
</tr>
<tr>
	<th>---- 2.2 From COMESA and SADC</th>
	<td class="text-right"><?= $comesa ?></td>
</tr>
<tr>
	<th>---- 2.3 From Extra Regional sources (i.e outside the EAC, COMESA and SADC)</th>
	<td class="text-right"><?= $world ?></td>
</tr>
<tr>
	<th>(3) Production Estimate for reporting month</th>
	<td class="text-right"><?= $production ?></td>
</tr>
<tr>
	<th>(4) Post harvest loss</th>
	<td class="text-right"><?= $loss ?></td>
</tr>