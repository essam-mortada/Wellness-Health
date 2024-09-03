<!-- resources/views/admin/products/show.blade.php -->

@include('admin.layouts.header')

    <div class="container">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <h1>order Details</h1>
                <a href="{{ route('messages.index') }}" class="btn btn-success" >Back to messages</a>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <h2>{{ $message->name }}</h2>
                        <p><strong>Email:</strong> {{ $message->email }}</p>
                        <p><strong>Subject:</strong> {{ $message->subject }}</p>
                        <p><strong>Message:</strong> {{ $message->message }}</p>
                        <p><strong>Date:</strong> {{ $message->created_at }}</p>
                    </div>
                </div>

                  
                </div>
            </div>
        </div>
    </div>
    @include('admin.layouts.scripts')
