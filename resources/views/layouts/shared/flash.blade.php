@if (session()->has('success'))
    <div id="alert" class="alert alert-success alert-dismissible fade show" role="alert">
        <div class="text-dark">{{ session('success') }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session()->has('edit'))
    <div id="alert" class="alert alert-primary alert-dismissible fade show" role="alert">
        <div class="text-dark">{{ session('edit') }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session()->has('error'))
    <div id="alert" class="alert alert-danger alert-dismissible fade show" role="alert">
        <div class="text-dark">{{ session('error') }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session()->has('warning'))
    <div id="alert" class="alert alert-warning alert-dismissible fade show" role="alert">
        <div class="text-dark">{{ session('warning') }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session()->has('info'))
    <div id="alert" class="alert alert-primary alert-dismissible fade show" role="alert">
        <div class="text-dark">{{ session('info') }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div id="alert" class="alert alert-danger alert-dismissible fade show" role="alert">
            <div class="text-dark">{{ $error }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endforeach
@endif
