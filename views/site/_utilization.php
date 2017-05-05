	<tr>
		<th>(5) National Availability for the reporting month = (1 + 2 + 3) - (4)</th>
		<td class="text-right"><?= $total_stock ?></td>
	</tr>
	<tr>
		<th>(6) National Consumption in reporting month)</th>
		<td class="text-right"><?= $national ?></td>
	</tr>
	<tr>
		<th>(7) Seed (Projected allocation for seed in the reporting month)</th>
		<td class="text-right"><?= $seed ?></td>
	</tr>
	<tr>
		<th>(8) Feed (Projected allocation for feed )</th>
		<td class="text-right"><?= $feed ?></td>
	</tr>
	<tr>
		<th>(9) Industrial Use</th>
		<td class="text-right"><?= $industrial ?></td>
	</tr>
	<tr>
		<th>(10) Export projections (projected exports in the reporting month)</th>
		<td class="text-right"><?= $export ?></td>
	</tr>
	<tr>
		<th>---- 10.1 Exports to EAC</th>
		<td class="text-right"><?= $export_eac ?></td>
	</tr>
	<tr>
		<th>---- 10.2 Exports COMESA and SADC</th>
		<td class="text-right"><?= $export_comesa ?></td>
	</tr>
	<tr>
		<th>---- 10.3 Exports to Extra regional destinations (i.e outside EAC, COMESA and SADC)</th>
		<td class="text-right"><?= $export_world ?></td>
	</tr>
	<tr>
		<th>(11) Available stock by end of the reporting month = 5 - (6 + 7 + 8 + 9 + 10)</th>
		<td class="text-right"><?= $available_stock ?></td>
	</tr>
</tbody>