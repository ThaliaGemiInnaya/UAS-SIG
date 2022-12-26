<div class="uk-overflow-auto">
	<table class="uk-table uk-table-justify uk-table-divider">
		<thead>
			<tr>
                    <th>NO</th>
					<th>NAMA KECAMATAN</th>
					<th>LOKASI</th>
					<th>KETERANGAN</th>
					<th>LATITUDE</th>
					<th>LONGITUDE</th>
					<th>KATEGORI</th>
					
					<th>AKSI</th>
			</tr>
		</thead>
		<tbody>
		<?php if( ! empty($pertanian)) {
            ?>
            <?php 
            $no=1;
			foreach($pertanian as $r){ 
				
			?>
				
				<tr>
					<td width="40px"><?=$no?></td>
					<td><?=$r->kecamatanpertanian?></td>
					<td><?=$r->lokasipertanian?></td>
					<td><?=$r->keteranganpertanian?></td>
					<td><?=$r->latitudepertanian?></td>
					<td><?=$r->longitudepertanian?></td>
					<td><?=$r->kategoripertanian?></td>
					<td>
                    <a href="#" class="uk-icon-link uk-margin-small-right" id="formedit" uk-icon="file-edit"
                    data-id="<?=$r->idpertanian?>"
                    data-kecamatan="<?=$r->kecamatanpertanian?>"
                    data-lokasi="<?=$r->lokasipertanian?>"
                    data-latitude="<?=$r->latitudepertanian?>"
                    data-longitude="<?=$r->longitudepertanian?>"
                    data-keterangan="<?=$r->keteranganpertanian?>"
                    data-kategori="<?=$r->kategoripertanian?>"
					
					></a>
					<a href="#" class="uk-icon-link" uk-icon="trash" id="hapusdata" 
					data-id="<?=$r->idpertanian?>"
                    data-kecamatan="<?=$r->kecamatanpertanian?>"></a>
				
					</td>
				</tr>
			<?php $no++; }
			 }else{
				?>
				<tr><td colspan="9" class="no-records">No records</td></tr>
				<?php } ?>
		</tbody>
	</table>
    
	</div>
    <ul class="uk-pagination" uk-margin-small-right>
    <?php echo $pagelinks?>
    </ul>
    
    
