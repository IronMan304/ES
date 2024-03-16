<div class="content">

    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                    <li class="breadcrumb-item active">Permission List</li>
                </ul>
            </div>
        </div>
    </div>
    <livewire:flash-message.flash-message />
    <div class="row d-flex justify-content-center">
        <div class="col-sm-8">
            <div class="card card-table show-entire">
                <div class="card-body">

                    <div class="page-table-header mb-2">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="doctor-table-blk">
                                    <h3>Permission List</h3>
                                    <div class="doctor-search-blk">
                                        <div class="add-group">
                                            <a wire:click="createPermission" class="btn btn-primary add-pluss ms-2"><img
                                                    src="assets/img/icons/plus.svg" alt></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto text-end float-end ms-auto download-grp">
                                <div class="top-nav-search table-search-blk">
                                    <form>
                                        <input type="text" class="form-control" placeholder="Search here"
                                            wire:model.debounce.500ms="search" name="search">
                                        <a class="btn"><img src="assets/img/icons/search-normal.svg" alt></a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table border-0 custom-table comman-table datatable mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 20%">ID</th>
                                    <th style="width: 60%">Name</th>
                                    <th style="width: 20%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $permission)
                                    <tr>
                                        <td>{{ $permission->id }}</td>
                                        <td>{{ $permission->name }}</td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-primary btn-sm mx-1"
                                                    wire:click="editPermission({{ $permission->id }})" title="Edit">
                                                    <i class='fa fa-pen-to-square'></i>
                                                </button>
                                                <a class="btn btn-danger btn-sm mx-1"
                                                    wire:click="deletePermission({{ $permission->id }})" title="Delete">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </div>
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

{{-- Modal --}}
<div class="modal fade" id="permissionModal" tabindex="-1" aria-labelledby="permissionModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <livewire:authentication.permission-form />
    </div>
</div>
@section('custom_script')
    @include('layouts.scripts.permission-scripts')
@endsection
