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

                <form class=""  action="{{ route('shop.filter') }}" method="GET">
                    <select class="form-control m-auto col-md-3 col-sm-3 rounded-pill border border-success " name="category" onchange="this.form.submit()">
                        <option value="" disabled selected>Filter  </option>
                        <option value="all">All</option>
                        <option value="herbs">Herbs</option>
                        <option value="skin care">Skin care</option>
                        <option value="hair care">Hair care</option>
                        <option value="nutrition">Nutrition</option>
                        <option value="vitamins">Vitamins</option>
                        <option value="weight loss supplements">Weight loss supplements</option>
                        <option value="weight gain supplements">Weight gain supplements</option>

                    </select>
                </form>
            </div>
        </div>

        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
              <a class="nav-item nav-link active" id="nav-products-tab" data-toggle="tab" href="#nav-products" role="tab" aria-controls="nav-products" aria-selected="true">Products</a>
              <a class="nav-item nav-link" id="nav-offers-tab" data-toggle="tab" href="#nav-offers" role="tab" aria-controls="nav-offers" aria-selected="false">Offers</a>
            </div>
          </nav>
          <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-products" role="tabpanel" aria-labelledby="nav-products-tab">
            <div class="row">


            @forelse ($products as $product)


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
                                        @if ($product->quantity == 0)
                                        <span><button disabled style="border:none;color:white;background-color:transparent;margin-top:10px;cursor:pointer" type="submit"><i class="ion-ios-cart"></i></button></span>
                                        @else
                                        <span><button style="border:none;color:white;background-color:transparent;margin-top:10px;cursor:pointer" type="submit"><i class="ion-ios-cart"></i></button></span>
                                        @endif
                                    </form>
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-md-6 text-center m-auto ftco-animate">
                <h2>No products found!</h2>
            @endforelse

        </div>
        </div>
        <div class="row mt-5">
      <div class="col text-center">
        <div class="w-100">
         {{$products->links('pagination::bootstrap-5')}}
        </div>
      </div>
        </div>
        </div>
        <div class="tab-pane fade" id="nav-offers" role="tabpanel" aria-labelledby="nav-offers-tab">
            <div class="row">


                @forelse ($offers as $product)


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
                                            @if ($product->quantity == 0)
                                            <span><button disabled style="border:none;color:white;background-color:transparent;margin-top:10px;cursor:pointer" type="submit"><i class="ion-ios-cart"></i></button></span>
                                            @else
                                            <span><button style="border:none;color:white;background-color:transparent;margin-top:10px;cursor:pointer" type="submit"><i class="ion-ios-cart"></i></button></span>
                                            @endif
                                        </form>
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-md-6 text-center m-auto ftco-animate">
                    <h2>No products found!</h2>
                @endforelse

            </div>
            <div class="row mt-5">
          <div class="col text-center">
            <div class="w-100">
             {{$products->links('pagination::bootstrap-5')}}
            </div>
          </div>
          </div>

    </div>
    </div>
    </div>
    </div>
</section>


@include('layouts.footer')
