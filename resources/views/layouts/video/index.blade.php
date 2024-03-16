<x-app-layout>
	<div class="content">
		<div class="page-header">
			<div class="row">
				<div class="col-sm-12">
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="/">Dashboard</a></li>
						<li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
						<li class="breadcrumb-item active">Online Appointment</li>
					</ul>
				</div>
			</div>
		</div>

		<div class="row d-flex justify-content-center">
			<div class="col-sm-12">
				<div class="card card-table show-entire">
					<div class="card-body">
						<iframe src="{{ $appointment->hostRoomUrl }}" style="height: 614px; width:100%"
							allow="camera; microphone; fullscreen; speaker; display-capture; autoplay"></iframe>
					</div>
				</div>
			</div>
		</div>
	</div>
</x-app-layout>
