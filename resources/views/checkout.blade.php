@include('layouts.header')

<div class="hero-wrap hero-bread" style="background-image: url({{asset('public/assets/images/bg_1.jpg')}});">
    <div class="overlay" style="width: 100%"></div>
    <div class="container">
      <div class="row no-gutters slider-text align-items-center justify-content-center">
        <div class="col-md-9 ftco-animate text-center">
            <p class="breadcrumbs"><span class="mr-2"><a href="{{route('home')}}">Home</a></span> <span>Checkout</span></p>
          <h1 class="mb-0 bread">Checkout</h1>
        </div>
      </div>
    </div>
  </div>
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
        <div class="col-xl-7 ftco-animate">

                          <h3 class="mb-4 billing-heading">Billing Details</h3>
                <form action="{{route('orders.store')}}" class="billing-form d-flex" method="POST">
                    @csrf
                <div class="row align-items-end">
                    <div class="col-md-6">
                  <div class="form-group">
                      <label for="firstname">First Name</label>
                    <input type="text" required  name="first_name" class="form-control"  value="{{ old('first_name') }}" placeholder="">
                    @error('first_name')
                    <div class="text-danger"> {{ $message }} </div>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                      <label for="lastname">Last Name</label>
                    <input type="text" required name="last_name" class="form-control"  value="{{ old('last_name') }}" placeholder="">
                    @error('last_name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
              </div>
              <div class="w-100"></div>
                  <div class="col-md-12">
                      <div class="form-group">
                          <label for="country">State / Country</label>
                          <div class="select-wrap">
                        <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                        <select required name="country"  value="{{ old('country') }}" class="form-control">
                           <option disabled selected>select your country</option>
                            <option value="egypt">Egypt</option>
                        </select>

                      </div>
                      @error('country')
                      <div class="text-danger">{{ $message }}</div>
                      @enderror
                      </div>
                  </div>
                  <div class="w-100"></div>
                  <div class="col-md-12">
                      <div class="form-group">
                          <label for="delivery">delivery region</label>
                          <div class="select-wrap">
                        <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                        <select id="delivery-region" required name="delivery"  value="{{ old('delivery') }}" class="form-control">
                           <option disabled selected>select your delivery region</option>
                            <option value="50">cairo & giza</option>
                            <option value="60">alexandria</option>
                            <option value="70">delta governorates</option>
                            <option value="80">upper egypt</option>
                        </select>

                      </div>
                      @error('delivery')
                      <div class="text-danger">{{ $message }}</div>
                      @enderror
                      </div>
                  </div>
                  <div class="w-100"></div>
                  <div class="col-md-12">
                      <div class="form-group">
                      <label for="streetaddress">Street Address</label>
                    <input type="text" required name="street" class="form-control"  value="{{ old('street') }}" placeholder="House number and street name">
                    @error('street')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  </div>

                  <div class="w-100"></div>
                  <div class="col-md-12">
                      <div class="form-group">
                      <label for="towncity">Town / City</label>
                    <input type="text" required name="city" class="form-control"  value="{{ old('city') }}" placeholder="">
                    @error('city')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  </div>

                  <div class="w-100"></div>
                  <div class="col-md-6">
                  <div class="form-group">
                      <label for="phone">Phone</label>
                    <input type="text" required name="phone" class="form-control"  value="{{ old('phone') }}" placeholder="">
                    @error('phone')
                    <div class="text-danger"> {{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                      <label for="emailaddress">Email Address</label>
                    <input type="email" required name="email" class="form-control"  value="{{ old('email') }}"  placeholder="">
                    @error('email')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
              </div>
              <div class="w-100"></div>
              <div class="col-md-12">

              </div>
              </div>
                  </div>
                  <div class="col-xl-5">
            <div class="row mt-5 pt-3">
                <div class="col-md-12 d-flex mb-5">
                    <div class="cart-detail cart-total p-3 p-md-4">
                        <h3 class="billing-heading mb-4">Cart Total</h3>
                        <p class="d-flex">
                                  <span>Subtotal</span>
                                  <span>L.E {{$total}}</span>
                              </p>
                              <p class="d-flex">
                                <span>delivery</span>
                                <span id="delivery-cost">L.E {{ session('temporary_order.delivery', 0)}}</span>
                            </p>

                              <hr>
                              <p class="d-flex total-price">
                                  <span>Total</span>
                                  <span id="total-price">L.E {{$total + session('temporary_order.delivery', 0)}}</span>
                              </p>
                              </div>
                </div>
                <div class="col-md-12">
                    <div class="cart-detail p-3 p-md-4">
                        <h3 class="billing-heading mb-4">Payment Method</h3>

                                  <div class="form-group">
                                      <div class="col-md-12">
                                          <div class="radio">
                                             <label><input type="radio" name="payment" value="cash" class="mr-2"> Cash on delivery</label>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <div class="col-md-12">
                                          <div class="radio">
                                             <label><input type="radio" name="payment" value="online payment" class="mr-2"> online payment</label>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <div class="col-md-12">
                                          <div class="checkbox">
                                             <label><input type="checkbox" name="terms"   class="mr-2"> I have read and accept the terms and conditions</label>
                                             @error('terms')
                                             <div class="text-danger">{{ $message }}</div>
                                             @enderror
                                          </div>
                                      </div>
                                  </div>
                                  <p><button type="submit" class="btn btn-primary py-3 px-4">Place an order</button></p>
                              </div>
                            </form><!-- END -->

                </div>
            </div>
        </div> <!-- .col-md-8 -->
      </div>
    </div>
  </section>
  <script>
    document.getElementById('delivery-region').addEventListener('change', function() {
        // Get the selected delivery cost from the dropdown
        var selectedDeliveryCost = parseInt(this.value);

        // Update the delivery cost display
        document.getElementById('delivery-cost').innerText =  'L.E ' + selectedDeliveryCost;

        // Get the subtotal (assuming $total is available in the template)
        var subtotal = {{ $total }};

        // Calculate and update the total price
        var total = subtotal + selectedDeliveryCost;
        document.getElementById('total-price').innerText = 'L.E ' + total;
    });
</script>


@include('layouts.footer')
