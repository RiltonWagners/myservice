<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
      
  <h4 class="my-0 mr-md-auto font-weight-normal"><a href="{{ url('/') }}" class="navbar-brand">{{ config('app.name') }} </a></h4>
  
  <nav class="my-md-0 mr-md-3">
    <a class="navbar-brand p-2 text-dark" href="#">Meus anúncios</a>
    <a class="navbar-brand p-2 text-dark" href="#">Favoritos</a>
    <a class="navbar-brand p-2 text-dark" href="#">Notificações</a>
    <a class="navbar-brand p-2 text-dark" href="#">Minha conta</a>
    
      <!-- Authentication Links -->
      @guest
          @if (Route::has('login'))
              <a class="btn btn-outline-primary" href="{{ route('login') }}">Entrar</a>
          @endif

          @if (Route::has('register'))
              <a class="btn btn-outline-primary" href="{{ route('register') }}">Cadastre-se</a>
          @endif
      @else
          <a id="navbarDropdown" class="btn btn-outline-primary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
              {{ Auth::user()->name }}
          </a>

          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
              </form>
          </div>
      @endguest
    
  </nav>
  
</div>