<div class="modal-content">
    <div class="modal-header">
        <h1 class="modal-title fs-5">
            @if ($enrollmentId)
            Edit Enrollment
            @else
            Add Enrollment
            @endif
        </h1>
        <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    @if ($errors->any())
    {{ implode('', $errors->all('<div>:message</div>')) }}
    @endif
    <form wire:submit.prevent="store" enctype="multipart/form-data">
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group local-forms">
                        <label>Student
                        </label>
                        <select class="form-control select" wire:model="student_id">
                            <option value="" selected>Select a Student</option>
                            @foreach ($students as $student)
                            <option value="{{ $student->id }}">
                                {{ $student->first_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group local-forms">
                        <label>Level
                        </label>
                        <select class="form-control select" wire:model="level_id">
                            <option value="" selected>Select a Year Level</option>
                            @foreach ($levels as $level)
                            <option value="{{ $level->id }}">
                                {{ $level->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                @if($level_id == 5 || $level_id == 6)
                <div class="col-md-6">
                    <div class="form-group local-forms">
                        <label>Strand
                        </label>
                        <select class="form-control select" wire:model="course_id">
                            <option value="" selected>Select a Strand</option>
                            @foreach ($courses as $course)
                            <option value="{{ $course->id }}">
                                {{ $course->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
    </form>
</div>