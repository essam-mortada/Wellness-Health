@include('layouts.header')
<style>
   .tab-content > .tab-pane {
     display :block;
     }
</style>
@if (Auth::user())

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
<div class="liton__wishlist-area pb-50 mb-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- PRODUCT TAB AREA START -->
                <div class="ltn__product-tab-area">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="ltn__tab-menu-list mb-50">
                                    <div class="nav">
                                       {{-- <a class="active show" data-toggle="tab" href="#liton_tab_1_1">الطلبات <i class="fas fa-file-alt"></i></a>
                                        <a data-toggle="tab" href="#liton_tab_1_2">العنوان <i class="fas fa-map-marker-alt"></i></a>
                                        --}}
                                        <a class="active show" data-toggle="tab" href="#liton_tab_1_3"> Profile  <i class="fas fa-user"></i></a>
                                        <a href="#"  onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();"> Logout <i class="fas fa-sign-out-alt"></i></a>
                                                 <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                    @csrf
                                                </form>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="tab-content">
                                   {{-- <div class="tab-pane fade active show" id="liton_tab_1_1">
                                        <div class="ltn__myaccount-tab-content-inner">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>الطلب</th>
                                                            <th>التاريخ</th>
                                                            <th>الحالة</th>
                                                            <th>الإجمالي</th>
                                                            <th>الإجراء</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse (Auth::user()->orders as $order)

                                                        <tr>
                                                            <td style="direction:ltr; unicode-bidi:bidi-override; ">{{$order->order_number}}</td>
                                                            <td>{{$order->created_at->locale('ar')->translatedFormat('j F Y') }}</td>
                                                            <td>@if ($order->status == 0)
                                                                <span class="badge bg-warning">{{ __('dashboard.pending') }}</span>
                                                            @elseif ($order->status == 1)
                                                                <span class="badge bg-success">{{ __('dashboard.processing') }}</span>
                                                            @elseif ($order->status == 2)
                                                                <span class="badge bg-primary">{{ __('dashboard.out_for_delivery') }}</span>
                                                            @elseif ($order->status == 3)
                                                                <span class="badge bg-danger">{{ __('dashboard.cancelled') }}</span>
                                                            @elseif ($order->status == 4)
                                                                <span class="badge bg-info">{{ __('dashboard.completed') }}</span>
                                                            @endif</td>
                                                            <td>{{$order->total_price}} ر.س </td>
                                                            <td><a href="{{route('show.order',$order->id)}}">تفاصيل الطلب</a></td>
                                                        </tr>
                                                          @empty
                                                          <tr>
                                                            <td class="text-center" colspan="5">لا يوجد أي طلبات</td>
                                                          </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    --}}
                                    {{--<div class="tab-pane fade" id="liton_tab_1_2">
                                        <div class="ltn__myaccount-tab-content-inner">
                                            <p>العناوين التالية ستُستخدم في صفحة الدفع بشكل افتراضي.</p>
                                            <div class="ltn__form-box">
                                                <form action="{{route('address.store')}}" method="POST">
                                                    @csrf
                                                    <div class="row mb-50">
                                                        <div class="col-md-6">
                                                            <h6>وصف العنوان</h6>
                                                            <input type="text" name="title" value="{{old('title')}}">
                                                        </div>

                                                        <div class="col-md-6">
                                                            <h6>المدينة</h6>
                                                            <div class="input-item mb-20">
                                                                <select class="selectpicker" name="city_id" data-live-search="true" title="أختر مدينتك">
                                                                    @foreach ($cities as $city )
                                                                    <option value="{{$city->id}}">{{$city->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <h6>العنوان</h6>
                                                            <textarea class="textarea-add" type="text" name="address" placeholder="أكتب العنوان بالتفصيل..."></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="btn-wrapper text-center">
                                                        <button type="submit" class="btn theme-btn-1 btn-effect-1 text-uppercase">حفظ العنوان</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="saved-addres pt-30">
                                                <h4 class="title-2">العناوين المحفوظة سابقا</h4>
                                                @foreach ($addresses as $address )

                                                <div class="address-content">
                                                    <div class="design-image">
                                                        <img loading="lazy" src="{{asset('public/assets/img/address.jpg')}}" alt="address" loading="lazy">
                                                    </div>
                                                    <div class="design-details">
                                                        <h3 class="animated fadeIn">{{$address->title}}</h3>
                                                        <p>{{$address->address}} </p>

                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>--}}
                                    <div class="tab-pane fade" id="liton_tab_1_3">
                                        <div class="ltn__myaccount-tab-content-inner mb-50">
                                            <div class="ltn__form-box">
                                                <form action="{{route('update.user',Auth::user()->id)}}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="row mb-50">
                                                        <div class="col-md-6">
                                                            <label>Name</label>
                                                            <input type="text" value="{{Auth::user()->name}}" name="name">
                                                        </div>
                                                        {{--<div class="col-md-6">
                                                            <label>الاسم الأخير:</label>
                                                            <input type="text" name="ltn__lastname">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>رقم التليفون:</label>
                                                            <input type="text" name="ltn__lastname" placeholder="">
                                                        </div>--}}
                                                        <div class="col-md-6">
                                                            <label> Email</label>
                                                            <input type="email" name="email" value="{{Auth::user()->email}}">
                                                        </div>
                                                    </div>
                                                    <div class="btn-wrapper mb-5">
                                                        <button type="submit" class="btn theme-btn-1 btn-effect-1 text-uppercase">Save Changes </button>
                                                    </div>
                                                </form>
                                                <form action="{{route('password.update',Auth::user()->id)}}" method="POST">
                                                    @csrf

                                                    <fieldset>
                                                        <legend>Change password</legend>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label>Current password :</label>
                                                                <input type="password" required name="current_password">
                                                                @error('current_password')
                                                                   <p class="text-danger">

                                                                    {{$message}}
                                                                </p>
                                                                @enderror
                                                                <label> New password :</label>
                                                                <input type="password" required name="new_password">
                                                                @error('new_password')
                                                                <p class="text-danger">

                                                                 {{$message}}
                                                             </p>
                                                             @enderror
                                                                <label> Confirm Password :</label>
                                                                <input type="password" required name="new_password_confirmation">
                                                                @error('new_password_confirmation')
                                                                <p class="text-danger">

                                                                 {{$message}}
                                                             </p>
                                                             @enderror
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                    <div class="btn-wrapper">
                                                        <button type="submit" class="btn theme-btn-1 btn-effect-1 text-uppercase">Save Changes </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- PRODUCT TAB AREA END -->
            </div>
        </div>
    </div>
</div>
@endif
@include('layouts.footer')
