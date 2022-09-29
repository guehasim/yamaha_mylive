<div class="right_col" role="main">
	<div class="">
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 ">
				<div class="x_panel">
					<div class="x_title">
						<h2>Live Ticket Action</h2>
						<ul class="nav navbar-right panel_toolbox">
							<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
							</li>
							<li class="dropdown">
								
							</li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<br />
						<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="<?php echo base_url(); ?>transaksi/simpan_action" enctype="multipart/form-data">	
							<div class="row">
								<?php foreach ($tiket->result() as $ad): ?>

									<div class="col-md-12 col-sm-12">
										<label class="col-form-label label-align" for="first-name">Live Date <span class="required">*</span>
										</label>
										<div>
											 <input id="birthday" name="tanggal" class="date-picker form-control font-size-16 col-md-2" type="text" onfocus="this.type='date'" value="<?php echo date('d-m-Y',strtotime($ad->Trans_TglJam));?>" onclick="this.type='date'"required >
					                           <script>
					                              function timeFunctionLong(input) {
					                                setTimeout(function() {
					                                  input.type = 'text';
					                                }, 60000);
					                              }
					                            </script>
										</div>
									</div>

									<div class="col-md-4 col-sm-12">
										<label class="col-form-label label-align" for="first-name">NIK <span class="required">*</span>
										</label>
										<div>
											<input type="text" value="<?php echo $ad->NikUser;?>" class="form-control" disabled>
										</div>
									</div>

									<input type="hidden" name="id_transaksi" value="<?php echo $ad->ID_Transaksi;?>">

									<div class="col-md-4 col-sm-12">
										<label class="col-form-label label-align" for="first-name">Nama
										</label>
										<div>
											<input type="text" value="<?php echo $ad->NamaUser;?>" class="form-control" disabled>
										</div>
									</div>
									<div class="col-md-4 col-sm-12">
										<label class="col-form-label label-align" for="first-name">Dept
										</label>
										<div>
											<input type="text" value="<?php echo $ad->DeptUser;?>" class="form-control" disabled>
										</div>
									</div>

									<div class="col-md-6 col-sm-12">
									<label class="col-form-label label-align" for="first-name">Kategori <span class="required">*</span>
									</label>
									<div>
										<select class="form-control" disabled>
											<option><?php echo $ad->Kategori;?></option>
										</select>
									</div>
								</div>
								<div class="col-md-12 col-sm-12">
									<label class="col-form-label label-align" for="first-name">Deskripsi <span class="required">*</span>
									</label>
									<div>
										<textarea class="form-control" disabled><?php echo $ad->Trans_Deskripsi;?></textarea>
									</div>
								</div>
								<?php endforeach ?>

								<div class="col-md-12 col-sm-12">
									<label class="col-form-label label-align" for="first-name">Action <span class="required">*</span>
									</label>
									<div>
										<textarea class="form-control" name="aksi"></textarea>
									</div>
								</div>

								<div class="col-md-12 col-sm-12">
									<label class="col-form-label label-align" for="first-name">Image After <span class="required">*</span>
									</label>
									<div>
										<input type="file" name="image" class="form-control" required>
									</div>
								</div>
								<div class="col-md-6 col-sm-12">
									<label class="col-form-label label-align" for="first-name">&nbsp;
									</label>									
									<div class="item form-group">
										<!-- <div class="col-md-6 col-sm-6 offset-md-3"> -->
											<button type="submit" class="btn btn-success">Simpan</button>
											<a href="<?php echo base_url() ?>transaksi"><button class="btn btn-primary" type="button">Kembali</button></a>
										<!-- </div> -->
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>