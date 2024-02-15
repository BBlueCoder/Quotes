<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
      <a class="navbar-brand" href="/">Home</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          @auth
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="/user/{{auth()->user()->username}}">My quotes</a>
            </li>
          @endauth
        </ul>
        <div class="d-flex">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              @auth
              <li class="nav-item">
                <div class="dropdown">
                  <a class="link-dark" href="#"  data-bs-toggle="dropdown"  data-bs-display="static" aria-expanded="false">
                    @if (auth()->user()->profile_pic != null)
                        <img width="24px" height="24px" style="border-radius: 50%" src="{{asset('storage/' . auth()->user()->profile_pic)}}" alt="profile picture" />
                    @else
                      <i class="fa-solid fa-user"></i></a>
                    @endif
                  </a>
                
                  <ul class="dropdown-menu dropdown-menu-sm-end">
                    <li><a class="dropdown-item" href="/user/profile">Profile</a></li>
                    <li><a class="dropdown-item" href="/user/logout">Log out</a></li>
                  </ul>
                </div>
              </li>
              @else
                <li class="nav-item">
                  <a class="link-dark link-opacity-75-hover link-underline-opacity-0 me-2" aria-current="page" href="/user/register">
                    <i class="fa-solid fa-user-plus me-1"></i>Register</a>
                </li>
                <li class="nav-item">
                    <a class="link-dark link-opacity-75-hover link-underline-opacity-0 me-2" aria-current="page" href="/user/login">
                        <i class="fa-solid fa-arrow-right-to-bracket me-1"></i>Login</a>
                </li>
              @endauth
              </ul>
        </div>
      </div>
    </div>
  </nav>