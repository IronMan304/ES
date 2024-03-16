<div class="modal-content">
    <div class="modal-header">
        <h3 class="modal-title fs-5">Upload</h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <form action="{{ route('patient.preview') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group local-forms">
                        <label>Package
                            <span class="login-danger">*</span>
                        </label>
                        <select class="form-select" name="group_id">
                            <option selected value="">--select--</option>
                            @foreach ($groups as $group)
                                <option value="{{ $group->id }}">
                                    {{ $group->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group local-forms">
                        <label>Company
                            <span class="login-danger">*</span>
                        </label>
                        <select class="form-select" name="company_id">
                            <option selected value="">--select--</option>
                            @foreach ($companies as $company)
                                <option value="{{ $company->id }}">
                                    {{ $company->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group local-forms">
                        <label>Spreadsheet
                            <span class="login-danger">*</span>
                        </label>
                        <input type="file" name="excel_file" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group local-forms">
                        <label>Date Start
                            <span class="login-danger">*</span>
                        </label>
                        <input type="date" name="date_start" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group local-forms">
                        <label>Date End
                            <span class="login-danger">*</span>
                        </label>
                        <input type="date" name="date_end" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Preview</button>
        </div>

    </form>
</div>
