<div class="modal-content">
    <div class="modal-header">
        <h1 class="modal-title fs-5">
            @if ($studentId)
            Add Student User Account
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
                <div class="col-md-12">
                    <div class="form-group local-forms">
                        <label>
                            First name
                        </label>
                        <input class="form-control" type="text" wire:model="first_name" placeholder />
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group local-forms">
                        <label>
                            Middle name

                        </label>
                        <input class="form-control" type="text" wire:model="middle_name" placeholder />
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group local-forms">
                        <label>
                            Last name

                        </label>
                        <input class="form-control" type="text" wire:model="last_name" placeholder />
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group local-forms">
                        <label>
                            Email

                        </label>
                        <input class="form-control" type="email" wire:model="email" placeholder />
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group local-forms">
                        <label>Password</label>
                        <div class="input-group">
                            <input id="password" class="form-control" type="password" wire:model="password" placeholder />
                            <span class="input-group-text">
                                <span id="toggle" toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            </span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>
<script>
 // custom.js

const password = document.getElementById('password');
const toggle = document.getElementById('toggle');

toggle.addEventListener('click', function() {

  if (password.type === 'password') {
    password.type = 'text';
    toggle.classList.add('fa-eye-slash');
  } else {
    password.type = 'password'; 
    toggle.classList.remove('fa-eye-slash');
  }

});
</script>
