@include('layouts.header')
@if (session('success'))
  <script src="{{asset('public/assets/js/sweetalert2@11.js')}}"></script>
  <script>
      Swal.fire({
          icon: 'success',
          title: 'Success!',
          text: '{{ session('success') }}',
          confirmButtonText: 'OK',
          timer: 3000,
          timerProgressBar: true,
      });
  </script>
@endif

@if (session('error'))
<script src="{{asset('public/assets/js/sweetalert2@11.js')}}"></script>
  <script>
      Swal.fire({
          icon: 'error',
          title: 'Error!',
          text: '{{ session('error') }}',
          confirmButtonText: 'OK',
          timer: 3000,
          timerProgressBar: true,
      });
  </script>
@endif
<div class="container">
    <h1 class="my-5">Your Wishlist</h1>
    @if ($wishlistItems->isEmpty())
        <p>Your wishlist is empty.</p>
    @else
        <div class="row">
            @foreach ($wishlistItems as $product)
                <div class="col-md-4 mb-4" style="max-height: 600px">
                    <div class="card" style="height: 520px">
                        <a href="{{route('products.show',$product->id)}}"><img style="height: 300px" src="{{ $product->images->isNotEmpty() ? asset('public/products_uploads/' . $product->images->first()->image_path) : asset('public/products_uploads/default.png') }}" class="card-img-top" alt="{{ $product->name }}"></a>
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text"><strong>Price:</strong> EGP {{ $product->price }}</p>
                            <form action="{{ route('wishlist.remove', $product->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash"></i> Remove
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@include('layouts.footer')
