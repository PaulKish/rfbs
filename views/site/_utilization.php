	<tr>
		<td>(5) National Availability for the reporting month = (1+2+3) - (4)</td>
		<td><?= $total_stock ?></td>
	</tr>
	<tr>
		<td>(6) National Consumption (MT) in reporting month)</td>
		<td><?= $national ?></td>
	</tr>
	<tr>
		<td>(7) Seed (Projected allocation for seed in the reporting month) - (MT)</td>
		<td><?= $seed ?></td>
	</tr>
	<tr>
		<td>(8) Feed (Projected allocation for feed ) - (MT)</td>
		<td><?= $feed ?></td>
	</tr>
	<tr>
		<td>(9) Industrial Use</td>
		<td><?= $industrial ?></td>
	</tr>
	<tr>
		<td>(10) Export projections (projected exports in the reporting month)</td>
		<td><?= $export ?></td>
	</tr>
	<tr>
		<td>---- 10.1 Exports to EAC</td>
		<td><?= $export_eac ?></td>
	</tr>
	<tr>
		<td>---- 10.2 Exports COMESA and SADC</td>
		<td><?= $export_comesa ?></td>
	</tr>
	<tr>
		<td>---- 10.3 Exports to Extra regional destinations (i.e outside EAC, COMESA and SADC)</td>
		<td><?= $export_world ?></td>
	</tr>
	<tr>
		<td>(11) Available stock by end of the reporting month (MT) = 5 - (6 + 7 + 8 + 9 + 10)</td>
		<td><?= $available_stock ?></td>
	</tr>
</tbody>