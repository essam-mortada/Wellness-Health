@include('layouts.header')

<section id="home-section"  class="hero">
    <div  class="home-slider owl-carousel">
    <div class="slider-item" style="background-image: url({{asset('public/assets/images/bg_1.jpg')}});">
        <div class="overlay"></div>
      <div class="container">
        <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

          <div class="col-md-12 ftco-animate text-center">
            <h1 style="color: black" class="mb-2">Nourish Your Body &amp; Empower Your Life  </h1>
            <h2 style="color: black" class="subheading mb-4">100% Safe Products </h2>
            <p><a href="#products" class="btn btn-primary">View Details</a></p>
          </div>

        </div>
      </div>
    </div>

    <div class="slider-item" style="background-image: url({{asset('public/assets/images/bg_2.jpg')}});">
       {{--<div class="overlay"></div>--}}
      <div class="container">
        <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

          <div class="col-sm-12 ftco-animate text-center">
            <h1 style="color: black" class="mb-2">We serve Your Health &amp; Body</h1>
            <h2 style="color: black" class="subheading mb-4">ِA click away from your home</h2>
            <p><a href="#products" class="btn btn-primary">View Details</a></p>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>

<section class="ftco-section">
      <div class="container">
          <div class="row no-gutters ftco-services">
    <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
      <div class="media block-6 services mb-md-0 mb-4">
        <div class="icon bg-color-1 active d-flex justify-content-center align-items-center mb-2">
              <span class="flaticon-shipped"></span>
        </div>
        <div class="media-body">
          <h3 class="heading">Fast Delivery</h3>
          <span>Fast delivery for you</span>
        </div>
      </div>
    </div>
    <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
      <div class="media block-6 services mb-md-0 mb-4">
        <div class="icon bg-color-2 d-flex justify-content-center align-items-center mb-2">
              <span class="flaticon-diet"></span>
        </div>
        <div class="media-body">
          <h3 class="heading">Always Good
          </h3>
          <span>Product well package</span>
        </div>
      </div>
    </div>
    <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
      <div class="media block-6 services mb-md-0 mb-4">
        <div class="icon bg-color-3 d-flex justify-content-center align-items-center mb-2">
              <span class="flaticon-award"></span>
        </div>
        <div class="media-body">
          <h3 class="heading">Superior Quality</h3>
          <span>Quality Products</span>
        </div>
      </div>
    </div>
    <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
      <div class="media block-6 services mb-md-0 mb-4">
        <div class="icon bg-color-4 d-flex justify-content-center align-items-center mb-2">
              <span class="flaticon-customer-service"></span>
        </div>
        <div class="media-body">
          <h3 class="heading">Support</h3>
          <span>24/7 Support</span>
        </div>
      </div>
    </div>
  </div>
      </div>
  </section>



<section class="ftco-section"  id="products">
<div class="container">
        <div class="row justify-content-center mb-3 pb-3">
  <div class="col-md-12 heading-section text-center ftco-animate">
      <span class="subheading">Featured Products</span>
    <h2 class="mb-4">Our Products</h2>
    <p>Explore our selection of natural products</p>
  </div>
  @if (@session('success'))
  <div class="col-md-5 alert alert-success text-center m-auto mt-3" role="alert">
  {{session('success')}}
  </div>
@endif
  @if (@session('error'))
        <div class="col-md-5 alert alert-danger text-center m-auto mt-3" role="alert">
        {{session('error')}}
        </div>
@endif
</div>
</div>

<div class="container">
    <div class="row">
        @foreach ($products as $product)


        <div class="col-md-6 col-lg-3 ftco-animate" >
            <div class="product text-center" style="height:90%;width:100%" >
                <a  class="img-prod"><img style="max-height: 200px" class="img-fluid" src="{{asset('public/products_uploads/'.$product->image)}}" alt="Colorlib Template">
                  <!--  <span class="status">30%</span>-->
                    <div class="overlay"></div>
                </a>
                <div class="text py-3 pb-4 px-3 text-center">
                    <h3><a href="{{route('products.show',$product->id)}}"> {{$product->name}}</a></h3>
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
                                    <span><button style="border:none;color:white;background-color:transparent;margin-top:10px;cursor:pointer" type="submit"><i class="ion-ios-cart"></i></button></span>

                                </form>
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        @endforeach


    </div>
</div>
</section>
{{--
<section class="ftco-section img" style="background-image: url({{asset('public/assets/images/bg_3.png')}});">
<div class="container">
        <div class="row justify-content-end">
  <div class="col-md-6 heading-section ftco-animate deal-of-the-day ftco-animate">
      <span class="subheading">Best Price For You</span>
    <h2 class="mb-4">Deal of the day</h2>
    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
    <h3><a href="#">diet pills</a></h3>
    <span class="price">$10 <a href="#">now $5 only</a></span>
    <div id="timer" class="d-flex mt-5">
                  <div class="time" id="days"></div>
                  <div class="time pl-3" id="hours"></div>
                  <div class="time pl-3" id="minutes"></div>
                  <div class="time pl-3" id="seconds"></div>
                </div>
  </div>
</div>
</div>
</section>
--}}
<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          {{ session('done') }}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- JavaScript to Trigger Modal -->
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const successMessage = '{{ session("done") }}';
      if (successMessage) {
        $('#successModal').modal('show');
      }
    });
  </script>

@include('layouts.footer')
