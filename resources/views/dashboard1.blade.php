@extends('layouts.app')

@section('title', 'PDAM TIRTA RAHARJA')

@section('content')

<section class="content">
				<div class="container-fluid">
					<div class="row p-5">
						<div class="col-xl-3 col-md-6 p-5 bg-success">
							<!-- small box -->
							<div class="small-box bg-success">
								<div class="inner">
									<h3 id="wila_Alarm"><?php  ?></h3>

									<p>Mobil Tersedia</p>
								</div>
								<div class="icon">
									<i class="ion ion-checkmark"></i>
								</div>
							</div>
						</div>
						<!-- ./col -->
						<div class="col-lg-3 col-6">
							<!-- small box -->
							<div class="small-box bg-warning">
								<div class="inner">
									<h3 id="wilb_Alarm"><?php ?></h3>

									<p>Total Pengajuan Request</p>
								</div>
								<div class="icon">
									<i class="ion ion-document-text"></i>
								</div>
							</div>
						</div>
						<!-- ./col -->
						<div class="col-lg-3 col-6">
							<!-- small box -->
							<div class="small-box bg-blue">
								<div class="inner">
									<h3 id="wild_Alarm"><?php  ?></h3>

									<p>Perangkat Yang Dimiliki</p>
								</div>
								<div class="icon">
									<i class="ion ion-laptop"></i>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-6">
							<!-- small box -->
							<div class="small-box bg-red">
								<div class="inner">
									<h3 id="wild_Alarm"><?php  ?></h3>

									<p>Antrian Request</p>
								</div>
								<div class="icon">
									<i class="ion ion-clock"></i>
								</div>
							</div>
						</div>
						<!-- ./col -->
					</div>
					<!-- /.row -->
					
					<!-- /.row -->
					<div class="row">
						<div class="col-lg-8 col-12">
							<div class="card">
								<div class="card-header">
									<h3 class="card-title" style="display: contents">Daftar Request</h3>
								</div>
								<!-- /.card-header -->
								<div class="card-body">
									<div id="jsGrid1"></div>
								</div>
								<!-- /.card-body -->
							</div>
							<!-- /.card -->	
						</div>
						<div class="col-lg-4 col-12">
							<div class="card">
								<div class="card-header">
									<h3 class="card-title" style="display: contents">Daftar Perangkat</h3>
								</div>
								<!-- /.card-header -->
								<!-- /.card-header -->
								<div class="card-body">
									
								</div>
								<!-- /.card-body -->
							</div>
							<!-- /.card -->	
						</div>
					</div>
					<!-- /.row -->
				</div>
				<!-- ./ Container-Fluid Content //-->
			</section>

@endsection