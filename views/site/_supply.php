<?php 
use app\models\Volume;
?>
<h3>Domestic Supply</h3>
<table class="table table-bordered table-stripped">
	<thead>
		<th>Component</th>
		<th>Volume (MT)</th>
	</thead>
	<tbody>
		<tr>
			<td>(1) Stock (Brought Forward from the previous month)- (1.1 + 1.2 + 1.3 + 1.4 + 1.5)</td>
			<td><?= $stock; ?></td>
		</tr>
		<tr>
			<td>---- 1.1 Stock held by Food Reserve Agency</td>
			<td><?= $stock_reserve; ?></td>
		</tr>
		<tr>
			<td>---- ---- 1.1.1: For Strategic Use</td>
			<td><?= $strategic ?></td>
		</tr>
		<tr>
			<td>---- ---- 1.1.2: For Commercial</td>
			<td><?= $commercial ?></td>
		</tr>
		<tr>
			<td>---- 1.2 Stock held by Households</td>
			<td><?= $household ?></td>
		</tr>
		<tr>
			<td>---- 1.3 Stock held by Processors</td>
			<td><?= $processors ?></td>
		</tr>
		<tr>
			<td>---- 1.4 Stock held by Warehouses/Traders</td>
			<td><?= $warehouses ?></td>
		</tr>
		<tr>
			<td>---- 1.5 Stock held by Relief Agencies (WFP etc)</td>
			<td><?= $relief ?></td>
		</tr>
		<tr>
			<td>(2) Imports projections for the reporting month - e.g April 2011 (2.1 + 2.2)</td>
			<td><?= $import ?></td>
		</tr>
		<tr>
			<td>---- 2.1 From EAC</td>
			<td><?= $eac ?></td>
		</tr>
		<tr>
			<td>---- 2.2 From COMESA and SADC</td>
			<td><?= $comesa ?></td>
		</tr>
		<tr>
			<td>---- 2.3 From Extra Regional sources (from outside the EAC, COMESA and SADC)</td>
			<td><?= $world ?></td>
		</tr>
		<tr>
			<td>(3) Production Estimate for reporting month</td>
			<td><?= $production ?></td>
		</tr>
		<tr>
			<td>(4) Post harvest loss</td>
			<td><?= $loss ?></td>
		</tr>
	</tbody>
</table>