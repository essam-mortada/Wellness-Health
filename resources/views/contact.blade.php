@include('layouts.header')

<div class="hero-wrap hero-bread" style="background-image: url({{asset('public/assets/images/bg_1.jpg')}});">
    <div class="overlay" style="width: 100%"></div>
    <div class="container">
      <div class="row no-gutters slider-text align-items-center justify-content-center">
        <div class="col-md-9 ftco-animate text-center">
            <p class="breadcrumbs"><span class="mr-2"><a href="{{route('home')}}">Home</a></span> <span>Contact us</span></p>
          <h1 class="mb-0 bread">Contact us</h1>
        </div>
      </div>
    </div>
  </div>

  <section class="ftco-section contact-section bg-light">
    @if (@session('success'))
    <div class="col-md-3 alert alert-success text-center m-auto mb-3 mt-3" role="alert">
    {{session('success')}}
    </div>
    @endif
    <div class="container">

        <div class="row d-flex mb-5 contact-info justify-content-between">
        <div class="w-100"></div>

        <div class="col-md-5 d-flex ">
            <div class="info bg-white p-4">
              <p><span>Phone:</span> <a href="tel://1234567920">+20 102 580 6537</a></p>
            </div>
        </div>
        <div class="col-md-5 d-flex">
            <div class="info bg-white p-4">
              <p><span>Email:</span> <a href="mailto:info@yoursite.com">support@wellnezmart.net</a></p>
            </div>
        </div>

      </div>
      {{--
      <div class="row block-9">
        <div class="col-md-9 m-auto order-md-last d-flex">
          <form action="{{route('messages.store')}}" class="bg-white p-5 contact-form" method="post">
            @csrf
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Your Name" name="name">
            </div>
            <div class="form-group">
              <input type="email" class="form-control" placeholder="Your Email" name="email">
            </div>
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Subject" name="subject">
            </div>
            <div class="form-group">
              <textarea name="message" id="" cols="30" rows="7" class="form-control" placeholder="Message"></textarea>
            </div>
            <div class="form-group">
              <input type="submit" value="Send Message" class="btn btn-primary py-3 px-5">
            </div>
          </form>

        </div>


      </div>--}}
    </div>
  </section>


@include('layouts.footer')
