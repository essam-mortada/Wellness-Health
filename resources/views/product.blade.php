@include('layouts.header')

<div class="hero-wrap hero-bread" style="background-image: url({{asset('assets/images/bg_1.jpg')}});">
    <div class="overlay" style="width: 100%"></div>
    <div class="container">
      <div class="row no-gutters slider-text align-items-center justify-content-center">
        <div class="col-md-9 ftco-animate text-center">
            <p class="breadcrumbs"><span class="mr-2"><a href="{{route('home')}}">Home</a></span> <span class="mr-2"><a href="index.html">Product</a></span> <span>Product Single</span></p>
          <h1 class="mb-0 bread">Product </h1>
        </div>
      </div>
    </div>
  </div>
 @if (@session('success'))
        <div class="col-md-3 alert alert-success text-center m-auto mt-3" role="alert">
        {{session('success')}}
        </div>
        @endif
  <section class="ftco-section">
      <div class="container">
          <div class="row">
              <div class="col-lg-6 mb-5 ftco-animate text-center" >
                  <a href="{{asset('products_uploads/'.$product->image)}}" class="image-popup"><img style="max-height: 400px" src="{{asset('products_uploads/'.$product->image)}}" class="img-fluid" alt="product"></a>
              </div>
              <div class="col-lg-6 product-details pl-md-5 ftco-animate">
                  <h3>{{$product->name}}</h3>
                  <div class="rating d-flex">
                          <p class="text-left mr-4">
                              <a href="#" class="mr-2">5.0</a>
                              <a href="#"><span class="ion-ios-star-outline"></span></a>
                              <a href="#"><span class="ion-ios-star-outline"></span></a>
                              <a href="#"><span class="ion-ios-star-outline"></span></a>
                              <a href="#"><span class="ion-ios-star-outline"></span></a>
                              <a href="#"><span class="ion-ios-star-outline"></span></a>
                          </p>
                          <p class="text-left mr-4">
                              <a href="#" class="mr-2" style="color: #000;">100 <span style="color: #bbb;">Rating</span></a>
                          </p>
                          <p class="text-left">
                              <a href="#" class="mr-2" style="color: #000;">500 <span style="color: #bbb;">Sold</span></a>
                          </p>
                      </div>
                  <p class="price"><span>L.E{{$product->price}}</span></p>
                  <p>{{$product->description}}
                      </p>
                      <div class="row mt-4">
                          <div class="col-md-6">
                              <div class="form-group d-flex">

                  </div>
                          </div>
                          <div class="w-100"></div>
                          <div class="input-group col-md-6 d-flex mb-3">
                   <span class="input-group-btn ">
                      <button type="button" class="quantity-left-minus btn"  data-type="minus" data-field="quantity">
                     <i class="ion-ios-remove"></i>
                      </button>
                      </span>
                      <form action="{{ route('cart.add', $product->id) }}" method="POST" class="d-flex align-items-center">
                        @csrf
                        <input type="number" id="quantity" name="quantity" class="form-control input-number" placeholder="quantity"  min="1" max="100">
                   <span class="input-group-btn ">
                      <button type="button" class="quantity-right-plus btn" data-type="plus" data-field="quantity">
                       <i class="ion-ios-add"></i>
                   </button>
                   </span>
                </div>
                <div class="w-100"></div>
                <div class="col-md-12">
                    <p style="color: #000;">{{$product->quantity}} pieces available</p>
                </div>
            </div>
            <p><input type="submit" value="Add To Cart" class="btn btn-black py-3 px-5"></p>
        </form>
              </div>
          </div>
      </div>
  </section>

  <section class="ftco-section">
      <div class="container">
              <div class="row justify-content-center mb-3 pb-3">
        <div class="col-md-12 heading-section text-center ftco-animate">
            <span class="subheading">Products</span>
          <h2 class="mb-4">Related Products</h2>
          <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
        </div>
      </div>
      </div>
      <div class="container">
          <div class="row">
            @foreach ($products as $product)


              <div class="col-md-6 col-lg-3 ftco-animate">
                  <div class="product text-center" style="height:90%;width:100%">
                      <a href="{{route('products.show',$product->id)}}" class="img-prod"><img style="max-height: 200px" class="img-fluid" src="{{asset('products_uploads/'.$product->image)}}" alt="product">
                          <!--<span class="status">30%</span>-->
                          <div class="overlay"></div>
                      </a>
                      <div class="text py-3 pb-4 px-3 text-center">
                          <h3><a href="#">{{$product->name}}</a></h3>
                          <div class="d-flex">
                              <div class="pricing">
                                  <p class="price"><span class="mr-2 price-dc"></span><span class="price-sale">L.E{{$product->price}}</span></p>
                              </div>
                          </div>
                          <div class="bottom-area d-flex px-3">
                              <div class="m-auto d-flex">
                                  <a href="{{route('products.show',$product->id)}}" class="add-to-cart d-flex justify-content-center align-items-center text-center">
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

@include('layouts.footer')
