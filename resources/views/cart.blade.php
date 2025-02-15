@include('layouts.header')



<div class="hero-wrap hero-bread" style="background-image: url({{asset('public/assets/images/bg_1.jpg')}});">
    <div class="overlay" style="width: 100%"></div>
    <div class="container">
      <div class="row no-gutters slider-text align-items-center justify-content-center">
        <div class="col-md-9 ftco-animate text-center">
            <p class="breadcrumbs"><span class="mr-2"><a href="{{route('home')}}">Home</a></span> <span>Cart</span></p>
          <h1 class="mb-0 bread">My Cart</h1>
        </div>
      </div>
    </div>
  </div>
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
  <section class="ftco-section ftco-cart">
          <div class="container">
              <div class="row">
              <div class="col-md-12 ftco-animate">
                @if (@session('cart'))
                  <div class="cart-list">

                        <table class="table">
                          <thead class="thead-primary">
                            <tr class="text-center">
                              <th>&nbsp;</th>
                              <th>&nbsp;</th>
                              <th>Product name</th>
                              <th>Price</th>
                              <th>Quantity</th>
                              <th>Total</th>
                            </tr>
                          </thead>
                          <tbody>



                            @foreach(session('cart') as $id => $details)
                            <tr class="text-center">
                              <td class="product-remove">
                                <form  action="{{ route('cart.remove', $id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button style="padding: 10px; cursor:pointer;" type="submit"><i class="ion-ios-close"></i></button>
                            </form></td>

                              <td class="image-prod"><div class="img" loading="lazy" style="background-image:url({{ asset('public/products_uploads/' . (is_array($details['images']) && !empty($details['images']) ? $details['images'][0] : 'public/products_uploads/default.jpg')) }});"></div></td>

                              <td class="product-name">
                                  <h3>{{$details['name']}}</h3>
                              </td>

                              <td class="price">EGP{{$details['price']}}</td>

                              <td class="quantity">
                                <form id="update-quantity-form-{{ $id }}" action="{{route('cart.update')}}" method="POST">
                                    @csrf
                                    @method('patch')
                                    <input type="hidden" name="id" value="{{$id}}">
                                  <div class="input-group mb-3">
                                   <input type="number" name="quantity" class="quantity form-control input-number" value="{{$details['quantity']}}" min="1" max="100">
                                   <input type="submit" style="display: none">
                                </form>
                                </div>
                            </td>

                              <td class="total">EGP{{$details['price'] * $details['quantity']}}</td>
                            </tr><!-- END TR-->


                            @endforeach
                                @else

                                    <h5 class="text-center" >You Don't Have Any product Yet</h3>

                            @endif
                          </tbody>
                        </table>
                    </div>
              </div>
          </div>
          @if (session('cart'))


          <div class="row justify-content-end">

              <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
                  <div class="cart-total mb-3">
                      <h3>Cart Totals</h3>
                      <p class="d-flex">
                          <span>Subtotal</span>
                          <span>EGP{{$total}}</span>
                      </p>

                      <hr>
                      <p class="d-flex total-price">
                          <span>Total</span>
                          <span>EGP{{$total}}</span>
                      </p>
                  </div>
                  <p><a href="{{route('checkout')}}" class="btn btn-primary py-3 px-4">Proceed to Checkout</a></p>
                  <p><a href="{{route('shop')}}" class="btn btn-primary py-3 px-4">Continue shopping</a></p>
                </div>
          </div>
          </div>
          @endif
      </section>

@include('layouts.footer')
