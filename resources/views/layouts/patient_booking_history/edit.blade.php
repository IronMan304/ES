<x-app-layout>
	<div class="content">
		<div class="page-header">
			<div class="row">
				<div class="col-sm-12">
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="/">Dashboard</a></li>
						<li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                        <li class="breadcrumb-item"><a href="/patient">Patient list</a></li>
                        <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
						<li class="breadcrumb-item"><a href="{{ route('pbh.index', $patient->id)}}">Patient Info</a></li>
                        <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                        <li class="breadcrumb-item">Patient info Edit</li>
					</ul>
				</div>
			</div>
		</div>
@include('layouts.shared.flash')
	  <div class="row d-flex justify-content-left">
		<div class="col-md-8">
		  <div class="card card-table show-entire">
            <div class="card-body p-4">
                <div class="row">
                  
                        <form method="POST" action="{{ route('patient.update', $patient->id) }}">
                        @csrf
                        @method('PUT')

                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $patient->name) }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" name="address" id="address" class="form-control" value="{{ old('address', $patient->address) }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="contact_number">Contact Number</label>
                                    <input type="text" name="contact_number" id="contact_number" class="form-control" value="{{ old('contact_number', $patient->contact_number) }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <select name="gender" id="gender" class="form-control" required>
                                        <option value="Male" {{ old('gender', $patient->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ old('gender', $patient->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="age">Age</label>
                                    <input type="number" name="age" id="age" class="form-control" value="{{ old('age', $patient->age) }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="civil_status_id">Civil Status</label>
                                    <select name="civil_status_id" id="civil_status_id" class="form-control">
                                        <option value="" {{ old('civil_status_id', $patient->civil_status_id) == '' ? 'selected' : '' }}>Select</option>
                                        @foreach ($civilStatuses as $civilStatus)
                                            <option value="{{ $civilStatus->id }}" {{ old('civil_status_id', $patient->civil_status_id) == $civilStatus->id ? 'selected' : '' }}>{{ $civilStatus->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="blood_type_id">Blood Type</label>
                                    <select name="blood_type_id" id="blood_type_id" class="form-control">
                                        <option value="" {{ old('blood_type_id', $patient->blood_type_id) == '' ? 'selected' : '' }}>Select</option>
                                        @foreach ($bloodTypes as $bloodType)
                                            <option value="{{ $bloodType->id }}" {{ old('blood_type_id', $patient->blood_type_id) == $bloodType->id ? 'selected' : '' }}>{{ $bloodType->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="btn-group" role="group">
                                        <button type="submit" class="btn btn-primary">Update</button>

                                        <a class="btn btn-warning btn mx-1" href="{{ route('pbh.index', $patient->id)}}" target="_blank" title="Cancel">
                                            Cancel
                                        </a>
                                </div>
                        </form>
                    
                </div>

            </div>
          </div>
	    </div>
	  </div>
	</div>
</x-app-layout>
