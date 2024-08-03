@include('layouts.header')


<div class="hero-wrap hero-bread" style="background-image: url({{asset('assets/images/bg_1.jpg')}});">
    <div class="overlay" style="width: 100%"></div>
    <div class="container">
      <div class="row no-gutters slider-text align-items-center justify-content-center">
        <div class="col-md-9 ftco-animate text-center">
            <p class="breadcrumbs"><span class="mr-2"><a href="{{route('home')}}">Home</a></span> <span>Blog</span></p>
          <h1 class="mb-0 bread">Blog</h1>
        </div>
      </div>
    </div>
  </div>
 
  <section class="ftco-section ftco-degree-bg">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 ftco-animate">
                      <h2 class="mb-3">{{$blog->title}}</h2>
          <p>{{$blog->summary}}</p>
          <p>
            <img src="{{asset('blogs_uploads/'.$blog->image)}}" alt="blog image" class="img-fluid">
          </p>
          <p>{{$blog->content}}</p>
        


         
        </div> <!-- .col-md-8 -->
        
        <div class="col-lg-4 sidebar ftco-animate">

          <div class="sidebar-box ftco-animate">
            <h3 class="heading">Recent Blog</h3>
            @foreach($recentBlogs as $blog)
            <div class="block-21 mb-4 d-flex">
              <a class="blog-img mr-4" style="background-image: url({{asset('blogs_uploads/'.$blog->image)}});"></a>
              <div class="text">
                <h3 class="heading-1"><a href="{{route('blogs.show',$blog->id)}}">{{$blog->title}}</a></h3>
                <div class="meta">
                  <div><a href="{{route('blogs.show',$blog->id)}}"><span class="icon-calendar"></span> {{$blog->created_at->format('l, j F Y')}}</a></div>

                </div>
              </div>
            </div>
          @endforeach
          </div>

       

      </div>
    </div>
  </section> <!-- .section -->
  
 @include('layouts.footer')
