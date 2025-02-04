@include('layouts.header')


<div class="hero-wrap hero-bread" style="background-image: url({{asset('public/assets/images/bg_1.jpg')}});">
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
                      <div class="row">
                        @foreach($blogs as $blog)
                          <div class="col-md-12 d-flex ftco-animate">
                  <div class="blog-entry align-self-stretch d-md-flex">
                    <a href="{{route('blogs.show',$blog->id)}}<div class="hero-wrap hero-bread" style="background-image: url({{asset('public/assets/images/bg_1.jpg')}});">
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
                      <div class="row">
                        @foreach($blogs as $blog)
                          <div class="col-md-12 d-flex ftco-animate">
                  <div class="blog-entry align-self-stretch d-md-flex">
                    <a href="{{route('blogs.show',$blog->id)}}" class="block-20" style="background-image: url({{asset('public/blogs_uploads/'.$blog->image)}});">
                    </a>
                    <div class="text d-block pl-md-4">
                        <div class="meta mb-3">
                        <div><a href="{{route('blogs.show',$blog->id)}}">{{$blog->created_at->format('l, j F Y')}}</a></div>
                        <div><a href="{{route('blogs.show',$blog->id)}}">{{$blog->author}}</a></div>
                      </div>
                      <h3 class="heading"><a href="{{route('blogs.show',$blog->id)}}">{{$blog->title}}</a></h3>
                      <p>{{$blog->summary}}</p>
                      <p><a href="{{route('blogs.show',$blog->id)}}" class="btn btn-primary py-2 px-3">Read more</a></p>
                    </div>
                  </div>
                </div>
       @endforeach
                      </div>
        </div> <!-- .col-md-8 -->
        <div class="col-lg-4 sidebar ftco-animate">

            <div class="sidebar-box ftco-animate">
              <h3 class="heading">Recent Blog</h3>
              @foreach($recentBlogs as $blog)
              <div class="block-21 mb-4 d-flex">
                <a class="blog-img mr-4" style="background-image: url({{asset('public/blogs_uploads/'.$blog->image)}});"></a>
                <div class="text">
                  <h3 class="heading-1"><a href="{{route('blogs.show',$blog->id)}}">{{$blog->title}}</a></h3>
                  <div class="meta">
                    <div><a href="{{route('blogs.show',$blog->id)}}"><span class="icon-calendar"></span> {{$blog->created_at->format('l, j F Y')}}</a></div>
                    <div><a href="{{route('blogs.show',$blog->id)}}"><span class="icon-person"></span> {{$blog->author}}</a></div>
                  </div>
                </div>
              </div>
            @endforeach
            </div>

            <div class="sidebar-box ftco-animate">
              <h3 class="heading">Categories</h3>
              <ul class="categories">
                @foreach($categories as $category)
                <li><a href="{{route('blogs.category',$category->id)}}">{{$category->name}} <span>({{$category->blogs->count()}})</span></a></li>
                @endforeach
              </ul>
            </div>

        </div>





      </div>
    </div>
  </section> <!-- .section -->" class="block-20" style="background-image: url({{asset('public/blogs_uploads/'.$blog->image)}});">
                    </a>
                    <div class="text d-block pl-md-4">
                        <div class="meta mb-3">
                        <div><a href="{{route('blogs.show',$blog->id)}}">{{$blog->created_at->format('l, j F Y')}}</a></div>

                      </div>
                      <h3 class="heading"><a href="{{route('blogs.show',$blog->id)}}">{{$blog->title}}</a></h3>
                      <p>{{$blog->summary}}</p>
                      <p><a href="{{route('blogs.show',$blog->id)}}" class="btn btn-primary py-2 px-3">Read more</a></p>
                    </div>
                  </div>
                </div>
       @endforeach
                      </div>
        </div> <!-- .col-md-8 -->
        <div class="col-lg-4 sidebar ftco-animate">

            <div class="sidebar-box ftco-animate">
              <h3 class="heading">Recent Blog</h3>
              @foreach($recentBlogs as $blog)
              <div class="block-21 mb-4 d-flex">
                <a class="blog-img mr-4" style="background-image: url({{asset('public/blogs_uploads/'.$blog->image)}});"></a>
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
    </div>
  </section> <!-- .section -->

@include('layouts.footer')
