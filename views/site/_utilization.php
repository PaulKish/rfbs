	<tr>
		<td>(5) National Availability for the reporting month = (1 + 2 + 3) - (4)</td>
		<td class="text-right"><strong><?= $total_stock ?></strong></td>
	</tr>
	<tr>
		<td>(6) National Consumption in reporting month)</td>
		<td class="text-right"><strong><?= $national ?></strong></td>
	</tr>
	<tr>
		<td>(7) Seed (Projected allocation for seed in the reporting month)</td>
		<td class="text-right"><strong><?= $seed ?></strong></td>
	</tr>
	<tr>
		<td>(8) Feed (Projected allocation for feed )</td>
		<td class="text-right"><strong><?= $feed ?></strong></td>
	</tr>
	<tr>
		<td>(9) Industrial Use</td>
		<td class="text-right"><strong><?= $industrial ?></strong></td>
	</tr>
	<tr>
		<td>(10) Export projections (projected exports in the reporting month)</td>
		<td class="text-right"><strong><?= $export ?></strong></td>
	</tr>
	<tr>
		<td>---- 10.1 Exports to EAC</td>
		<td class="text-right"><?= $export_eac ?></td>
	</tr>
	<tr>
		<td>---- 10.2 Exports COMESA and SADC</td>
		<td class="text-right"><?= $export_comesa ?></td>
	</tr>
	<tr>
		<td>---- 10.3 Exports to Extra regional destinations (i.e outside EAC, COMESA and SADC)</td>
		<td class="text-right"><?= $export_world ?></td>
	</tr>
	<tr>
		<td>(11) Available stock by end of the reporting month = 5 - (6 + 7 + 8 + 9 + 10)</td>
		<td class="text-right"><strong><?= $available_stock ?></strong></td>
	</tr>
</tbody>