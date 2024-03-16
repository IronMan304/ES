<x-app-layout>
  <div class="content">
    @if(!auth()->user()->hasRole('Patient'))
    <div class="page-header">
      <div class="row">
        <div class="col-sm-12">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
            <li class="breadcrumb-item"><a href="/patient">Patient list</a></li>
            <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
            <li class="breadcrumb-item">Patient Info</li>
          </ul>
        </div>
      </div>
    </div>
    @endif
    @include('layouts.shared.flash')
    <div class="row">
      <div class="col-sm-12">

        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="doctor-profile-head">

                  <div class="row">
                    <div class="col-lg-6 col-xl-4 col-md-4">
                      <div class="p-4">
                        
                          <div class="names-profiles justify-content-left">
                            <h4 class="text-bold">{{ $patient->name }}</h4>
                          </div>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>


        <div class="row">
          <div class="col-lg-4">
            <div class="doctor-personals-grp">
              <div class="card">
                <div class="card-header">
                  <div class="heading-detail ">
                    <h3 class="mb-0">Info    
                      @hasrole('admin')                
                      <a class="btn btn-primary btn-sm mx-1" href="{{ route('patient.edit', $patient->id) }}" title="Edit Information">
													<i class='fa fa-pen-to-square'></i>
											</a>    
                      @endhasrole
                    </h3>
                  </div>
                </div>

                <div class="card-body">

                  <div class="about-me-list">
                    <ul class="list-space">
                      <li>
                        <h4>Name</h4>
                        <span>{{ $patient->name }}</span>
                      </li>
                      <li>
                        <h4>Address</h4>
                        <span>{{ $patient->address }}</span>
                      </li>
                      <li>
                        <h4>Contact Number</h4>
                        <span>{{ $patient->contact_number }}</span>
                      </li>
                      <li>
                        <h4>Gender</h4>
                        <span>{{ $patient->genders->name ?? ''}}</span>
                      </li>
                      <li>
                        <h4>Age</h4>
                        <span>{{ $patient->age }}</span>
                      </li>
                      <li>
                        <h4>Civil Status</h4>
                        <span style="{{ $civilStatuses ? '' : 'color: red;' }}">{{ $civilStatuses ?? 'Empty' }}</span>
                      </li>
                      <li>
                        <h4>Blood Type</h4>
                        <span style="{{ $bloodtypes ? '' : 'color: red' }}">{{ $bloodtypes ?? 'Empty' }}</span>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div> 
          </div>


          <div class="col-lg-8">
            <div class="doctor-personals-grp">

              <div class="card">
                <div class="card-header">
                  <h3>Booking</h3>
                </div>

                <div class="card-body table-dash">
                  <div class="personal-list-out">
                    <div class="row">

                        <div class="table-responsive">
                          <table class="table mb-0 border-0 datatable custom-table patient-profile-table">
                            <thead>
                              <tr>
                                <th>Barcode</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($bookings as $booking)
                              <tr>              
                                <td>{{ $booking->barcode }}</td>
                                <td> 
                                  @if ($booking->status->id === 1)
                                  <span class="text-danger">{{ $booking->status->name }}</span>
                                  @else
                                  <span class="text-success">{{ $booking->status->name }}</span>
                                  @endif
                                </td>
                                <td>{{ $booking->created_at->format('m/d/Y') }}</td>
                                <td>
                                  <a class="btn btn-primary btn-sm mx-1" href="{{ route('mobile_service.index', $patient->id) }}" title="Edit Information">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                </td>

                              </tr>
                              @endforeach
                            </tbody>
                          </table>
                        </div>

                      </div>
                    </div>       
                  </div>
                </div>
              
              <div class="card">

                <div class="card-header">
                  <div class="heading-detail">
                    <h3 class="mb-0">Billing</h3>
                  </div>
                </div>

                <div class="card-body table-dash">
                  <div class="table-responsive">
                    <table class="table mb-0 border-0 datatable custom-table patient-profile-table">
                      <thead>
                        <tr>
                          <th>Total Amount</th>
                          <th>Status</th>
                          <th>Mode of Payment</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($billings as $billing)
                        <tr>
                          <td>{{ $billing->total_amt }}</td>
                          <td>
                            @if ($billing->payable_amt != 0 && $billing->paid_amt == 0)
                            <span class="text-danger">Unpaid</span>
                            @else
                            <span class="text-success">Paid</span>
                            @endif
                          </td>
                          <td>
                            @if ($billing->payment_id == 1)
                            <span class="text-success">Cash</span>
                            @else
                            <span class="text-warning">AR</span>
                            @endif
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>

              </div>

            </div>
          </div>

          
        </div>


      </div>
    </div>
  </div>
@section('custom_script')
@include('layouts.scripts.patient-scripts')
@endsection
</x-app-layout>