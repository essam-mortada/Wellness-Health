@include('admin.layouts.header')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-9 text-center mt-2">
            <h3 class=" display-4 display-md-2 display-lg-1" style="color:#82ae46; font-family:--font-family-sans-serif">
                Welcome {{ Auth::user()->name }} To Admin Dashboard
            </h3>
            <img src="{{ asset('assets/images/adminhome.svg') }}" alt="admin home" class="img-fluid mt-3" style="max-height: 500px;">
        </div>
    </div>
</div>


@include('admin.layouts.scripts')
