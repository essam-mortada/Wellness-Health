@include('layouts.header')
@if (@session('success'))
<div class="col-md-3 alert alert-success text-center m-auto mt-3" role="alert">
{{session('success')}}
</div>
@endif
@if (@session('error'))
<div class="col-md-3 alert alert-danger text-center m-auto mt-3" role="alert">
{{session('error')}}
</div>
@endif
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 mb-5 text-center">
                <h2 class="mb-3">Our Products</h2>
            </div>
        </div>
        <div class="row">
            @foreach ($products as $product)


            <div class="col-md-6 col-lg-3 ftco-animate">
                <div class="product text-center" style="height:90%;width:100%">
                    <a  class="img-prod"><img style="max-height: 200px" class="img-fluid" src="{{asset('public/products_uploads/'.$product->image)}}" alt="product">
                      <!--  <span class="status">30%</span>-->
                        <div class="overlay"></div>
                    </a>
                    <div class="text py-3 pb-4 px-3 text-center">
                        <h3><a href="{{ route('products.show', $product->id) }}">{{$product->name}}</a></h3>
                        @if ($product->quantity == 0)

                        <div class="text-danger"><p>out of stock</p></div>
                        @endif
                        <div class="d-flex">
                            <div class="pricing">
                                <p class="price"><span class="mr-2 price-dc"></span><span class="price-sale">EGP{{$product->price}}</span></p>
                            </div>
                        </div>
                        <div class="bottom-area d-flex px-3">
                            <div class="m-auto d-flex">
                                <a href="{{ route('products.show', $product->id) }}" class="add-to-cart d-flex justify-content-center align-items-center text-center">
                                    <span><i class="ion-ios-eye"></i></span>
                                </a>
                                <a href="#" class="buy-now d-flex justify-content-center align-items-center mx-1">
                                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                        @csrf
                                        <span><button style="border:none;color:white;background-color:transparent;margin-top:12px;cursor:pointer" type="submit"><i class="ion-ios-cart"></i></button></span>

                                    </form>
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
        <div class="row mt-5">
      <div class="col text-center">
        <div class="w-100">
         {{$products->links('pagination::bootstrap-5')}}
        </div>
      </div>
    </div>
    </div>
</section>
<script>
      $(document).ready(function() {
        setTimeout(function() {
            $('.alert').fadeOut('slow');
        }, 3000); // 3 seconds
    });
    
</script>

@include('layouts.footer')
