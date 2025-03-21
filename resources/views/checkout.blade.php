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
@endif
  <section class="ftco-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xl-7 ftco-animate">

                          <h3 class="mb-4 billing-heading">Billing Details</h3>
                <form action="{{route('placeOrder')}}" class="billing-form d-flex" method="POST">
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
                            <option value="100">Lower Egypt & alexandria</option>
                            <option value="100">delta governorates</option>
                            <option value="150">upper egypt</option>
                            <option value="200">North & south sinai</option>
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
                        <label for="floor">floor</label>
                      <input type="number" required name="floor" class="form-control"  value="{{ old('floor') }}" placeholder="">
                      @error('floor')
                      <div class="text-danger"> {{ $message }}</div>
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
                    <input type="number" required name="phone" class="form-control"  value="{{ old('phone') }}" placeholder="">
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
                                  <span>EGP {{$total}}</span>
                              </p>
                              <p class="d-flex">
                                <span>Discount</span>
                                <span  id="discount-amount">EGP 0</span>
                            </p>
                              <p class="d-flex">
                                <span>delivery</span>
                                <span id="delivery-cost">EGP {{ session('temporary_order.delivery', 0)}}</span>
                            </p>

                              <hr>
                              <p class="d-flex total-price">
                                  <span>Total</span>

                                    <span id="total-price">EGP {{$total + session('temporary_order.delivery', 0)}}</span>
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
                                  {{--<div class="form-group">
                                      <div class="col-md-12">
                                          <div class="radio">
                                             <label><input type="radio" name="payment" value="online payment" class="mr-2"> online payment</label>
                                          </div>
                                      </div>
                                  </div>--}}
                                  @error('payment')
                                 <div class="text-danger">{{ $message }}</div>
                                    @enderror
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
                                  <div class="row">

                                    <!-- Promo Code Form -->
                                    <div class="col-md-12">
                                        <input class="form-control" type="text" id="promoCode" placeholder="Enter Promo Code">
                                        <button @if ($total<200) disabled @endif class="btn btn-primary mt-3" type="button" id="applyPromo">Apply Promo Code</button>
                                    </div>
                                    <div id="promoMessage"></div>
                                    @if ($total<200)
                                    <p>
                                        Add more {{200-$total}} to apply promo code <br>
                                        <a href="{{route('shop')}}">Continue shopping</a>
                                    </p>
                                     @endif


                                    <!-- Place Order Button -->
                                    <div class="col-md-12 mt-4">
                                        <p>
                                            <button type="submit" class="btn btn-primary py-3 px-4">Place an order</button>
                                        </p>
                                    </div>
                                </div>                              </div>
                            </form><!-- END -->

                    </div>
            </div>
        </div> <!-- .col-md-8 -->
      </div>
    </div>
  </section>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script>
    document.getElementById('delivery-region').addEventListener('change', function() {
        // Get the selected delivery cost from the dropdown
        var selectedDeliveryCost = parseInt(this.value);

        // Update the delivery cost display
        document.getElementById('delivery-cost').innerText =  'EGP ' + selectedDeliveryCost;

        // Get the subtotal (assuming $total is available in the template)
        var subtotal = {{ $total }};

        // Calculate and update the total price
        var total = subtotal + selectedDeliveryCost;
        document.getElementById('total-price').innerText = 'EGP ' + total;
    });

    $(document).ready(function() {
    // Update total when delivery region changes
    $('#delivery-region').on('change', function() {
        updateTotalWithDiscountAndDelivery();
    });

    // Apply promo code
    $('#applyPromo').on('click', function() {
        let promoCode = $('#promoCode').val();

        $.ajax({
            url: '{{ route("apply.promo") }}',
            type: 'POST',
            data: {
                promo_code: promoCode,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    $('#promoMessage').html(`<span style="color: green;">${response.message}</span>`);
                    $('#discount-amount').text(`EGP ${response.discountAmount}`);

                    // Store discount value and update total
                    updateTotalWithDiscountAndDelivery(response.totalAfterDiscount);
                } else {
                    $('#promoMessage').html(`<span style="color: red;">${response.message}</span>`);
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", error);
                $('#promoMessage').html(`<span style="color: red;">Failed to apply promo code.</span>`);
            }
        });
    });

    // Function to calculate and update the total with discount and delivery cost
    function updateTotalWithDiscountAndDelivery(totalAfterDiscount = {{ $total }}) {
        // Get selected delivery cost
        let deliveryCost = parseInt($('#delivery-region').val()) || 0;

        // Calculate total with discount and delivery
        let totalWithDelivery = totalAfterDiscount + deliveryCost;

        // Update total display
        $('#total-price').text(`EGP ${totalWithDelivery}`);
        $('#delivery-cost').text(`EGP ${deliveryCost}`);
    }
});
</script>


@include('layouts.footer')
