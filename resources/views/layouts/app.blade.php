<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Scripts -->
    <!--
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <!-- Principal CSS do Bootstrap -->
    <!--
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
-->
    @vite(['resources/js/app.js'])
    
    <script src="//cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>

<!-- Theme included stylesheets -->
<link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">

  
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();

            $("#zipcode").keypress(function() {
                $(this).mask('00000-000');
            });
            
            const message = document.getElementById('#message');
            if (message !== null) {
                setTimeout(function() {
                    $('#message').style.opacity = "0";
                }, 4000);
                
                setTimeout(function() {
                    $('#message').style.display = "none";
                }, 6000);
            }

            $("#btn_search").change(function() {

                const url = "{{ route('search') }}";
                search = $(this).val();
                $.ajax({
                    url: url,
                    data: {
                        'search': search,
                    },
                    success: function(data) {
                        $("#publications").html(data);
                    }
                })
            });


            window.onscroll = function() {myFunction()};

            var navbar = document.getElementById("navbar");
            var sticky = navbar.offsetTop;

            function myFunction() {
            if (window.pageYOffset >= sticky) {
                navbar.classList.add("sticky")
            } else {
                navbar.classList.remove("sticky");
            }
            }
/*
            document.getElementById('submitCustomerId').addEventListener('click', function(event) {
                event.preventDefault(); // Impede o comportamento padrão do link
                document.getElementById('CustomerId').submit();
            });
            
*/
        });

        
    </script>

    <style>
        #message {
            opacity: 1;
            transition: opacity 3s;
        }
        
        #navbar {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 2;
        }
        
    </style>

</head>

<body>

    <nav id="navbar" class="navbar navbar-icon-top navbar-expand-lg navbar-dark" style="background-color: #282625; justify-content: flex-start !important; --bs-navbar-padding-y: 0 !important;">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" style="padding: 0; margin: 10px;">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- mobile-->
        <div class="d-md-none" style="flex-flow: row; width: 300px;">
            <form class="form-inline" style="flex-flow: row;" action="/search" method="GET">
                <input class="form-control" type="text" placeholder="O que você precisa?" aria-label="Buscar serviço" id="search" name="search" required>
                <button class="btn btn-outline-primary my-2 my-sm-0" type="submit" id="btn_search" style="margin-left:10px;">Buscar</button>
            </form>
        </div>
        <div class="col d-md-none">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="list-group list-group-flush" style="align-items: center;">
                    <a class="navbar-brand" href="{{url('/')}}"><strong>{{ config('app.name') }}</strong></a>
                </ul>
                <div class="row g-3" style="--bs-gutter-x: 8px; text-align: center;">
                    <div class="col">
                        <a href="{{url('/')}}" class="btn btn-outline-primary">Home</a>
                    </div>
                    <div class="col">
                        <a href="{{url('/plans')}}" class="btn btn-outline-primary">Planos</a>
                    </div>
                </div>
                <div style="border-bottom: 1px solid white; margin: 12px 0 -5px 0;"></div>

                <!-- Authentication Links -->

                @guest
                <div class="row g-3" style="text-align:center; padding-bottom: 10px; margin: 5px -20px">
                    @if (Route::has('login'))
                    <div class="col">
                        <a class="btn btn-outline-primary" style="margin-left: 10px; padding: 5px 35px 5px 35px;" href="{{ route('login') }}">{{ __('Entrar') }}</a>
                    </div>
                    @endif

                    @if (Route::has('register'))
                    <div class="col">
                        <a class="btn btn-outline-primary" style="padding: 5px 20px 5px 20px;" href="{{ route('register') }}">{{ __('Cadastre-se') }}</a>
                    </div>
                    @endif

                    @else
                    @auth
                    <div class="row" style="text-align:center; padding-bottom: 20px; margin: 0px -20px; padding-top: 20px">
                    <div class="row">
                        <div class="col">
                            <a id="navbarDropdown" class="btn btn-outline-primary" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fa fa-user-o"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu" aria-labelledby="navbarDropdown">
                                <span class="dropdown-item" style="background: none; color: #fe5002; font-weight: bold;">{{ Auth::user()->name }}</span>
                                <span class="dropdown-item" style="background: none; color: #fe5002; font-size: smaller; padding-top: unset;">{{ Auth::user()->email }}</span>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('my_publication.create')}}">Criar anúncio</a>
                                <a class="dropdown-item" href="{{ route('my_publications.index') }}">Meus anúncios</a>
                                <a class="dropdown-item" href="{{ route('subscriptions') }}">Minha assinatura</a>
                                @if(Gate::allows('admin'))
                                    <a class="dropdown-item" href="{{ route('category.index') }}">Gerenciar categorias</a>
                                    <a class="dropdown-item" href="{{ route('service.index') }}">Gerenciar serviços</a>
                                @endif
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                    {{ __('Sair') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                        <div class="col">
                            <a class="btn btn-outline-primary" href="{{ route('my_business.my_business')}}">
                                <i class="fa fa-briefcase" style="color:#fe5002;"></i>
                            </a>
                        </div>
                        <div class="col">
                            <a class="btn btn-outline-primary" href="{{ route('my_publication.create')}}">
                                <i class="fa fa-plus-square" style="color:#fe5002;"></i>
                            </a>
                        </div>
                        <div class="col">
                            <a class="btn btn-outline-primary" href="{{ route('my_publications.index') }}">
                                <i class="fa fa-tags">
                                    <span class="badge badge-danger">{{ Auth::user()->publications()->count(); }}</span>
                                </i>
                            </a>
                        </div>
                        <div class="col">
                            <a class="btn btn-outline-primary" href="#">
                                <i class="fa fa-bell-o"></i>
                            </a>
                        </div>
                        </div>
                    </div>
                    @endauth
                    @endguest
                </div>
            </div>
        </div>
        <!--mobile end -->

        <!--web -->
        <div class="collapse navbar-collapse d-none d-md-block" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav mr-auto">
                <a class="navbar-brand" href="{{url('/')}}"><strong style="color:#fe5002;">{{ config('app.name') }}</strong></a>
                <li class="nav-item d-none d-md-block">
                    <form class="form-inline my-2 my-lg-0" style="flex-flow: row;" action="/search" method="GET">
                        <input class="form-control mr-sm-2" type="text" placeholder="O que você precisa?" aria-label="Buscar serviço" id="search" name="search" required>
                        <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Buscar</button>
                    </form>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/')}}" style="color:#fe5002; text-decoration: none;" onmouseover="this.style.color='white'" onmouseout="this.style.color='#fe5002'">
                        <!--
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-house-door" viewBox="0 0 16 16">
                            <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146ZM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5Z" />
                        </svg><br>
                        -->
                        Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/plans')}}" style="color:#fe5002; text-decoration: none;" onmouseover="this.style.color='white'" onmouseout="this.style.color='#fe5002'">
                        <!--
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-buildings" viewBox="0 0 16 16">
                            <path d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L6 7.64V4.5a.5.5 0 0 1 .276-.447l8-4a.5.5 0 0 1 .487.022ZM6 8.694 1 10.36V15h5V8.694ZM7 15h2v-1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V15h2V1.309l-7 3.5V15Z" />
                            <path d="M2 11h1v1H2v-1Zm2 0h1v1H4v-1Zm-2 2h1v1H2v-1Zm2 0h1v1H4v-1Zm4-4h1v1H8V9Zm2 0h1v1h-1V9Zm-2 2h1v1H8v-1Zm2 0h1v1h-1v-1Zm2-2h1v1h-1V9Zm0 2h1v1h-1v-1ZM8 7h1v1H8V7Zm2 0h1v1h-1V7Zm2 0h1v1h-1V7ZM8 5h1v1H8V5Zm2 0h1v1h-1V5Zm2 0h1v1h-1V5Zm0-2h1v1h-1V3Z" />
                        </svg><br>
                        -->
                        Planos
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link">
                        <svg width="10" height="50" fill="currentColor">
                            <line x1="5" y1="0" x2="5" y2="50" stroke="#fe5002" stroke-width="2" />
                        </svg>
                    </a>
                </li>

                @auth
                <li class="nav-item dropdown" data-toggle="tooltip" data-bs-placement="top" data-bs-title="Meu negócio">
                    <a id="navbarDropdown" class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    <i class="fa fa-briefcase" style="color:#fe5002;">
                        </i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <span class="dropdown-item" style="background: none; color: #fe5002; font-weight: bold;">Meu negócio</span>
                        
                        @if(Auth::user()->Business[0]['status'] == 'published')
                            <span class="dropdown-item" style="background: none; color: #01c700; font-size: smaller; padding-top: unset; margin-top: -10px;">(Publicado)</span>
                        @else
                            <span class="dropdown-item" style="background: none; color: #dc3545; font-size: smaller; padding-top: unset; margin-top: -10px;">(Não publicado)</span>
                        @endif

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('my_business.show')}}">Ver</a>
                        <a class="dropdown-item" href="{{ route('my_business.edit') }}">Editar</a>
                        <a class="dropdown-item" href="#">Orçamentos</a>
                    </div>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-bs-placement="top" data-bs-title="Anunciar serviço" style="color:#fe5002;">
                    <a class="nav-link" href="{{ route('my_publication.create')}}">
                        <i class="fa fa-plus-square" style="color:#fe5002;"></i>
                    </a>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-bs-placement="top" data-bs-title="Meus anúncios">
                    <a class="nav-link" href="{{ route('my_publications.index') }}">
                        <i class="fa fa-tags" style="color:#fe5002;">
                            <span class="badge badge-danger">{{ Auth::user()->publications()->count(); }}</span>
                        </i>
                    </a>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-bs-placement="top" data-bs-title="Notificações" style="color:#fe5002;">
                    <a class="nav-link" href="#">
                        <i class="fa fa-bell-o" style="color:#fe5002;"></i>
                    </a>
                </li>
                @endauth

            </ul>
            <!-- Authentication Links -->
            <ul class="navbar-nav">
                @guest

                @if (Route::has('login'))
                <a class="btn btn-outline-primary" href="{{ route('login') }}" style="margin-left: 10px; background: #fe5002; color: white;">{{ __('Entrar') }}</a>
                @endif

                @if (Route::has('register'))
                <a class="btn btn-outline-primary" href="{{ route('register') }}" style="margin-left: 10px;">{{ __('Cadastre-se') }}</a>
                @endif

                @else
                <li class="nav-item dropdown" data-toggle="tooltip" data-bs-placement="top" data-bs-title="Minha conta">
                    <a id="navbarDropdown" class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <i class="fa fa-user-o" style="color:#fe5002;">
                        </i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <span class="dropdown-item" style="background: none; color: #fe5002; font-weight: bold;">{{ Auth::user()->name }}</span>
                        <span class="dropdown-item" style="background: none; color: #fe5002; font-size: smaller; padding-top: unset;">{{ Auth::user()->email }}</span>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('my_publication.create')}}">Criar anúncio</a>
                        <a class="dropdown-item" href="{{ route('my_publications.index') }}">Meus anúncios</a>
                        <a class="dropdown-item" href="{{ route('subscriptions') }}">Minha assinatura</a>
                        <!--
                        <form id="CustomerId" action="{{ route('subscriptions')}}" method="post">
                            @csrf
                            <input type="hidden" name="id_customer" id="id_customer" value="">
                                <a class="dropdown-item" href="#" id="submitCustomerId">Assinatura</a>
                        </form>
                        -->
                        @if(Gate::allows('admin'))
                            <a class="dropdown-item" href="{{ route('plan.index') }}">Gerenciar planos</a>
                            <a class="dropdown-item" href="{{ route('category.index') }}">Gerenciar categorias</a>
                            <a class="dropdown-item" href="{{ route('service.index') }}">Gerenciar serviços</a>
                        @endif                        
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                            {{ __('Sair') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest

            </ul>
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav mr-auto"></ul>
        </div>
        <!--web end -->
    </nav>
    <main class="py-4" style="position:relative; top:60px;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">

                    @if(session('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{session('message')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    @if(isset($message_not_found))
                    <div class="alert alert-primary alert-dismissible fade show" role="alert" id="message">
                        {{$message_not_found}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <!--FORM VALIDATE-->
                    @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul style="margin-bottom: auto;">

                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach

                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                </div>
            </div>
        </div>

        @yield('content')

    </main>
    
    <div style="background: #ededed; margin-top: 65px;">
        <div class="container"  style="margin-top: 30px;">
            <footer class="pt-4 pt-md-5 border-top" style="padding-bottom: 30px;">
                <div class="row">
                    <div class="col-4 col-md">
                        <h5><strong style="color: #4a4a4a">Planos</strong></h5>
                        <ul class="list-unstyled text-small" style="color:#595959 !important; text-decoration: none;">
                            <li><a class="text-muted" href="{{url('/plans')}}" style="color:#595959 !important; text-decoration: none;">Planos</a></li>
                        </ul>
                    </div>
                    <div class="col-4 col-md">
                        <h5><strong style="color: #4a4a4a">Utilidades</strong></h5>
                        <ul class="list-unstyled text-small">
                            <li><a class="text-muted" href="#" style="color:#595959 !important; text-decoration: none;">Ajuda</a></li>
                            <li><a class="text-muted" href="#" style="color:#595959 !important; text-decoration: none;">Como anunciar</a></li>
                        </ul>
                    </div>
                    <div class="col-4 col-md">
                        <h5><strong style="color: #4a4a4a">Sobre</strong></h5>
                        <ul class="list-unstyled text-small">
                            <li><a class="text-muted" href="{{ route('privacy.index') }}" style="color:#595959 !important; text-decoration: none;">Política de privacidade</a></li>
                            <li><a class="text-muted" href="#" style="color:#595959 !important; text-decoration: none;">Termos de uso</a></li>
                        </ul>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</body>

</html>