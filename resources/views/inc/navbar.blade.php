<style>
  header{
    background-color: black;
    color: white;
  }
  .website-header{
    padding: 20px;
    height: 80px;
    display: flex;
    flex-wrap: wrap;
  }

  .social-icons{
    text-align: right;
    flex-grow: 1;
  }

  .social-icons i{
    margin: 0 8px;
    cursor: pointer;
  }
  .website-header img{
    width: 50px;
    height: 50px;
    margin: 0px 30px;
}
  .new li{
    padding: 10px 10px;
  }
  .new li a{
    color: rgb(255, 255, 255);
    font-size: 20px;
    font-weight: 500px;
  }
  .new li a:hover{
    color: red;
  }
  .navbar-toggler { border-color: #008000; }

  .breaking-news-section{
    padding: 0 30px 0 60px;
    display: flex;
    height: 30px;
  }
  #btext{
    width: 200px;
    font-size: 16px;
    text-transform: uppercase;
    color: red;
    font-weight: 600px;
    margin: auto 0;
  }
  

</style>
<header>
  <div class="website-header">
    <a class="navbar-brand" href="{{ url('/') }}">
      <h1 style="color: white"><img style="width: 50px; height: 50px;" src="/1sapp/public/storage/cover_images/blog-icon.png"> {{ config('app.name', 'Social_Blog') }}</h1>
    </a>
    <div class="social-icons">
        <i class="fab fa-facebook-f"></i>
        <i class="fab fa-twitter"></i>
        <i class="fab fa-google-plus-g"></i>
        <i class="fab fa-instagram"></i>
        <i class="fas fa-rss"></i>
    </div>
  </div>
  <nav class="navbar navbar-expand-md shadow-sm " style="height: 40px">
    <div class="container"  >
        <button class="navbar-toggler bg-light" style="height: 30px" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent" >
            <!-- Left Side Of Navbar -->
            
            <ul class="navbar-nav new me-auto mb-2 mb-lg-0" >
              <li class="nav-item">
                <a class="nav-link " aria-current="page" href="/1sapp/public"><i class="fas fa-home"> Home</i></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#about"<i class="fas fa">About</i></a>
              </li>
              {{-- <li class="nav-item">
                <a class="nav-link" href="/1sapp/public/timeline"><i class="fas fa">Timeline</i></a>
              </li> --}}
              {{-- <li class="nav-item">
                <a class="nav-link" href="/1sapp/public/posts "><i class="fas fa">Blog</i></a>
              </li> --}}
              <li class="nav-item ml-auto">
                <a class="nav-link" href="/1sapp/public/posts/create "><i class="fa fa-plus" aria-hidden="true"> Create Post</i></a>
              </li>
              <li class="nav-item ml-auto">
                <a class="nav-link" href="/1sapp/public/posts/search "><i class="fas fa-search"> Search Post</i></a>
              </li>
              <li class="nav-item ml-auto">
                <a class="nav-link" href="/1sapp/public/user/searchpeople "><i class="fas fa-search"> Search People</i></a>
              </li>
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto" >
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" style="font-size: 20px;" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif
                    
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" style="font-size: 20px;" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                
                    <li class="nav-item dropdown">
                        
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" style="font-size: 20px;" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('home') }}">My Profile</a>
                            <a class="dropdown-item" href="{{ route('user.edit') }}">Edit Details</a>
                            <a class="dropdown-item" href="{{ route('password.edit') }}">Change Password</a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                              onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
  </nav>
</header>
