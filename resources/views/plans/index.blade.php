@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="pricing-header text-center">    
                <span style="color:#fe5002;font-weight: bold;font-size:25px">Planos de assinatura</span><br>
                <span style="color:#000;font-size:20px">
                Escolha o plano ideal para você e aproveite ao máximo nossa plataforma!
                </span>
            </div>
        </div>
        <!--
        <div class="col-md-12">
            <div class="">
                <div class="card-body">
                    <div class="form-group">
                        <div class="card-deck">
                            <div class="card col-md-6" style="box-shadow: 0 0 5px #fbb400;">
                                <div class="card-body">
                                    <h5 class="card-title" style="text-align: -webkit-center;font-weight: bold;">Para você</h5>
                                    <p class="card-text">Para quem procura profissionais de confiança em diversas áreas.</p>
                                    <p class="card-text">Ao se cadastrar você terá a possibilidade de descrever detalhadamente o tipo de serviço que está necessitando.</p>
                                    <p class="card-text">Cadastre-se grátuitamente e publique já o que você precisa!</p>
                                </div>
                            </div>
                            <div class="card col-md-6" style="box-shadow: 0 0 5px #ec4603;">
                                <div class="card-body">
                                    <h5 class="card-title" style="text-align: -webkit-center;font-weight: bold;">Profissional</h5>
                                    <p class="card-text">Para quem é profissional e quer conquistar novos clientes.</p>
                                    <p class="card-text">Ao se cadastrar você terá a oportunidade de expandir seus negócios, conquistar novos clientes e aumentar sua visibilidade no mercado.</p>
                                    <p class="card-text">Cadastre-se como profissional autônomo ou empresa, encontre novos trabalhos e faça o seu negócio crescer.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>-->
        <div class="col-md-12">
            <div class="">
                <div class="card-body">
                    <form method="POST" action="">
                        @csrf
                    
                        <div class="form-group">
                            <div class="card-deck">
                                @foreach($plans as $plan)
                                    <div class="card" style="box-shadow: 0 0 5px {{ $plan->color_dark}};">
                                        <div class="card-body">
                                            <h5 class="card-title" style="text-align: -webkit-center;font-weight: bold;">{{ $plan->name}}</h5>
                                            <p class="card-text">{{ $plan->description}}</p>
                                            <ul class="list-group">
                                            <li class="list-group-item d-flex align-items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="green" width="24px" height="24px">
                                                        <path d="M0 0h24v24H0z" fill="none"/>
                                                        <path d="M9 16.17l-4.17-4.17-1.42 1.41L9 19 21.01 6.99l-1.41-1.42L9 16.17z"/>
                                                    </svg>
                                                    Recurso 1
                                                </li>
                                                <li class="list-group-item d-flex align-items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="green" width="24px" height="24px">
                                                        <path d="M0 0h24v24H0z" fill="none"/>
                                                        <path d="M9 16.17l-4.17-4.17-1.42 1.41L9 19 21.01 6.99l-1.41-1.42L9 16.17z"/>
                                                    </svg>
                                                    Recurso 2
                                                </li>
                                                <li class="list-group-item d-flex align-items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="red" width="24px" height="24px">
                                                        <path d="M0 0h24v24H0z" fill="none"/>
                                                        <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z"/>
                                                    </svg>
                                                    Recurso 3
                                                </li>
                                                <li class="list-group-item d-flex align-items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="red" width="24px" height="24px">
                                                        <path d="M0 0h24v24H0z" fill="none"/>
                                                        <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z"/>
                                                    </svg>
                                                    Recurso 4
                                                </li>
                                                <li class="list-group-item d-flex align-items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="red" width="24px" height="24px">
                                                        <path d="M0 0h24v24H0z" fill="none"/>
                                                        <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z"/>
                                                    </svg>
                                                    Recurso 5
                                                </li>
                                                <li class="list-group-item d-flex align-items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="red" width="24px" height="24px">
                                                        <path d="M0 0h24v24H0z" fill="none"/>
                                                        <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z"/>
                                                    </svg>
                                                    Recurso 6
                                                </li>
                                                <li class="list-group-item d-flex align-items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="red" width="24px" height="24px">
                                                        <path d="M0 0h24v24H0z" fill="none"/>
                                                        <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z"/>
                                                    </svg>
                                                    Recurso 7
                                                </li>
                                            </ul>
                                        </div>
                                        <div >
                                            <div style="display: flex; align-items: center; justify-content: center; opacity: 1;">
                                                    <span title="Plano de assinatura" style="text-align: center; font-size: 16px;font-weight: 500; -webkit-font-smoothing: antialiased;color: hsla(0,0%,10%,.9);  font-family: -apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Ubuntu,sans-serif;color: hsla(0,0%,10%,.7);">{{ $plan->name }}</span>
                                            </div>
                                            @if( $plan->id_product != "prod_OEdjAEvA7PwxF3")
                                            <div style="display: flex; align-items: center; justify-content: center; opacity: 1;">
                                                <span title="Plano de assinatura" style="text-align: center; font-size: 28px;font-weight: 600;">30 dias grátis</span>
                                            </div>
                                            <div style="display: flex; align-items: center; justify-content: center; opacity: 1;">
                                                <span title="Plano de assinatura" style="text-align: center; font-size: 16px;font-weight: 500; -webkit-font-smoothing: antialiased;color: hsla(0,0%,10%,.9);  font-family: -apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Ubuntu,sans-serif;color: hsla(0,0%,10%,.7);">Depois, R$ {{ $plan->price[0]->price }} por mês</span>
                                            </div>
                                            @else
                                            <div style="display: flex; align-items: center; justify-content: center; opacity: 1;">
                                                <span title="Plano de assinatura" style="text-align: center; font-size: 28px;font-weight: 600;">Grátis</span>
                                            </div>                                            
                                            @endif
                                            <div class="card-body list-group">
                                                <input type="hidden" name="id_price" id="id_price" value="{{ $plan->price[0]->id_price }}">
                                                @if(auth()->check())
                                                    <form method="POST" action="{{ route('subscriptions.store') }}">
                                                        @csrf
                                                        <div class="card-body list-group">                                                
                                                            <input type="hidden" name="id_price" id="id_price" value="{{ $plan->price[0]->id_price }}">
                                                            <button type="submit" class='btn btn-success' style="background-color: {{ $plan->color_dark }};border-color: {{ $plan->color_dark }};padding: 9px;font-weight: 500;font-family: -apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Ubuntu,sans-serif;font-size:16px;">Assinar</button>
                                                        </div>
                                                    </form>
                                                @else
                                                    <a href="{{ route('register') }}" class='btn btn-success' style="background-color: {{ $plan->color_dark }};border-color: {{ $plan->color_dark }};padding: 9px;font-weight: 500;font-family: -apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Ubuntu,sans-serif;font-size:16px;">Assinar</a>
                                                    <!--<button type="submit" class='btn btn-success' style="background-color: {{ $plan->color_dark }};border-color: {{ $plan->color_dark }};padding: 9px;font-weight: 500;font-family: -apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Ubuntu,sans-serif;font-size:16px;">Assinar</button>-->
                                                @endif
                                            </div>
                                            <div style="padding-bottom: 7px;"></div>
                                        </div>
                                        
                                    </div>
                                @endforeach
                                <!--
                                <div class="card" style="box-shadow: 0 0 5px #01c700;">
                                    <div class="card-body">
                                        <h5 class="card-title" style="text-align: -webkit-center;font-weight: bold;">Plano Grátis</h5>
                                        <p class="card-text">É uma ótima maneira de começar a utilizar os serviços sem nenhum custo. Embora possua recursos básicos, oferece uma oportunidade para explorar a plataforma e aproveitar funcionalidades essenciais.</p>
                                        <ul class="list-group">
                                        <li class="list-group-item d-flex align-items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="green" width="24px" height="24px">
                                                    <path d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M9 16.17l-4.17-4.17-1.42 1.41L9 19 21.01 6.99l-1.41-1.42L9 16.17z"/>
                                                </svg>
                                                Recurso 1
                                            </li>
                                            <li class="list-group-item d-flex align-items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="green" width="24px" height="24px">
                                                    <path d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M9 16.17l-4.17-4.17-1.42 1.41L9 19 21.01 6.99l-1.41-1.42L9 16.17z"/>
                                                </svg>
                                                Recurso 2
                                            </li>
                                            <li class="list-group-item d-flex align-items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="red" width="24px" height="24px">
                                                    <path d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z"/>
                                                </svg>
                                                Recurso 3
                                            </li>
                                            <li class="list-group-item d-flex align-items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="red" width="24px" height="24px">
                                                    <path d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z"/>
                                                </svg>
                                                Recurso 4
                                            </li>
                                            <li class="list-group-item d-flex align-items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="red" width="24px" height="24px">
                                                    <path d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z"/>
                                                </svg>
                                                Recurso 5
                                            </li>
                                            <li class="list-group-item d-flex align-items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="red" width="24px" height="24px">
                                                    <path d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z"/>
                                                </svg>
                                                Recurso 6
                                            </li>
                                            <li class="list-group-item d-flex align-items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="red" width="24px" height="24px">
                                                    <path d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z"/>
                                                </svg>
                                                Recurso 7
                                            </li>
                                        </ul>
                                    </div>
                                    <div >
                                        <div style="display: flex; align-items: center; justify-content: center; opacity: 1;">
                                                <span title="Plano de assinatura" style="text-align: center; font-size: 16px;font-weight: 500; -webkit-font-smoothing: antialiased;color: hsla(0,0%,10%,.9);  font-family: -apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Ubuntu,sans-serif;color: hsla(0,0%,10%,.7);">Plano de assinatura</span>
                                        </div>
                                        <div style="display: flex; align-items: center; justify-content: center; opacity: 1;">
                                            <span title="Plano de assinatura" style="text-align: center; font-size: 28px;font-weight: 600;">Grátis</span>
                                        </div>
                                        <div class="card-body list-group">
                                            <a href="#" class='btn btn-success' style="background-color: #01c700;border-color: #01c700;padding: 9px;font-weight: 500;font-family: -apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Ubuntu,sans-serif;font-size:16px;">Assinar</a>
                                        </div>
                                        <div style="padding-bottom: 7px;"></div>
                                    </div>
                                    
                                </div>
                                <div class="card" style="box-shadow: 0 0 5px #0195ff;">
                                    <div class="card-body">
                                        <h5 class="card-title" style="text-align: -webkit-center;font-weight: bold;">Plano Basic</h5>
                                        <p class="card-text">É projetado para oferecer um pacote de recursos aprimorados. O Plano Basic oferece uma gama mais ampla de recursos  em comparação com o Plano Free e você terá acesso a funcionalidades adicionais.</p>
                                        <ul class="list-group">
                                            <li class="list-group-item d-flex align-items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="green" width="24px" height="24px">
                                                    <path d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M9 16.17l-4.17-4.17-1.42 1.41L9 19 21.01 6.99l-1.41-1.42L9 16.17z"/>
                                                </svg>
                                                Recurso 1
                                            </li>
                                            <li class="list-group-item d-flex align-items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="green" width="24px" height="24px">
                                                    <path d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M9 16.17l-4.17-4.17-1.42 1.41L9 19 21.01 6.99l-1.41-1.42L9 16.17z"/>
                                                </svg>
                                                Recurso 2
                                            </li>
                                            <li class="list-group-item d-flex align-items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="green" width="24px" height="24px">
                                                    <path d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M9 16.17l-4.17-4.17-1.42 1.41L9 19 21.01 6.99l-1.41-1.42L9 16.17z"/>
                                                </svg>
                                                Recurso 3
                                            </li>
                                            <li class="list-group-item d-flex align-items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="red" width="24px" height="24px">
                                                    <path d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z"/>
                                                </svg>
                                                Recurso 4
                                            </li>
                                            <li class="list-group-item d-flex align-items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="red" width="24px" height="24px">
                                                    <path d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z"/>
                                                </svg>
                                                Recurso 5
                                            </li>
                                            <li class="list-group-item d-flex align-items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="red" width="24px" height="24px">
                                                    <path d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z"/>
                                                </svg>
                                                Recurso 6
                                            </li>
                                            <li class="list-group-item d-flex align-items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="red" width="24px" height="24px">
                                                    <path d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z"/>
                                                </svg>
                                                Recurso 7
                                            </li>
                                        </ul>
                                    </div>
                                    <div >
                                        <div style="display: flex; align-items: center; justify-content: center; opacity: 1;">
                                            <span title="Plano de assinatura" style="text-align: center; font-size: 16px;font-weight: 500; -webkit-font-smoothing: antialiased;color: hsla(0,0%,10%,.9);  font-family: -apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Ubuntu,sans-serif;color: hsla(0,0%,10%,.7);">Plano Basic</span>
                                        </div>
                                        <div style="display: flex; align-items: center; justify-content: center; opacity: 1;">
                                            <span title="Plano de assinatura" style="text-align: center; font-size: 28px;font-weight: 600;">30 dias grátis</span>
                                        </div>
                                        <div style="display: flex; align-items: center; justify-content: center; opacity: 1;">
                                            <span title="Plano de assinatura" style="text-align: center; font-size: 16px;font-weight: 500; -webkit-font-smoothing: antialiased;color: hsla(0,0%,10%,.9);  font-family: -apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Ubuntu,sans-serif;color: hsla(0,0%,10%,.7);">Depois, R$ 5,90 por mês</span>
                                        </div>
                                        <div class="card-body list-group">
                                            <input type="hidden" name="id_price" id="id_price" value="price_1NN3bVBWhRPzAP4lNu2vNdeq">
                                            <button type="submit" class='btn btn-success' style="background-color: #0195ff;border-color: #0195ff;padding: 9px;font-weight: 500;font-family: -apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Ubuntu,sans-serif;font-size:16px;">Assinar</button>
                                        </div>                                        
                                        <div style="padding-bottom: 7px;"></div>
                                    </div>
                                </div>
                                <div class="card" style="box-shadow: 0 0 5px #ec4603;">
                                    <div class="card-body">
                                        <h5 class="card-title" style="text-align: -webkit-center;font-weight: bold;">Plano Light</h5>
                                        <p class="card-text">É uma opção intermediária que oferece um equilíbrio entre recursos e custo. O Plano Light proporciona uma experiência mais robusta do que o Plano Basic, mas a um preço mais acessível do que o Plano Pro.</p>
                                        <ul class="list-group">
                                            <li class="list-group-item d-flex align-items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="green" width="24px" height="24px">
                                                    <path d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M9 16.17l-4.17-4.17-1.42 1.41L9 19 21.01 6.99l-1.41-1.42L9 16.17z"/>
                                                </svg>
                                                Recurso 1
                                            </li>
                                            <li class="list-group-item d-flex align-items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="green" width="24px" height="24px">
                                                    <path d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M9 16.17l-4.17-4.17-1.42 1.41L9 19 21.01 6.99l-1.41-1.42L9 16.17z"/>
                                                </svg>
                                                Recurso 2
                                            </li>
                                            <li class="list-group-item d-flex align-items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="green" width="24px" height="24px">
                                                    <path d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M9 16.17l-4.17-4.17-1.42 1.41L9 19 21.01 6.99l-1.41-1.42L9 16.17z"/>
                                                </svg>
                                                Recurso 3
                                            </li>
                                            <li class="list-group-item d-flex align-items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="green" width="24px" height="24px">
                                                    <path d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M9 16.17l-4.17-4.17-1.42 1.41L9 19 21.01 6.99l-1.41-1.42L9 16.17z"/>
                                                </svg>
                                                Recurso 4
                                            </li>
                                            <li class="list-group-item d-flex align-items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="green" width="24px" height="24px">
                                                    <path d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M9 16.17l-4.17-4.17-1.42 1.41L9 19 21.01 6.99l-1.41-1.42L9 16.17z"/>
                                                </svg>
                                                Recurso 5
                                            </li>
                                            <li class="list-group-item d-flex align-items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="red" width="24px" height="24px">
                                                    <path d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z"/>
                                                </svg>
                                                Recurso 6
                                            </li>
                                            <li class="list-group-item d-flex align-items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="red" width="24px" height="24px">
                                                    <path d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z"/>
                                                </svg>
                                                Recurso 7
                                            </li>
                                        </ul>
                                    </div>
                                    <div >
                                        <div style="display: flex; align-items: center; justify-content: center; opacity: 1;">
                                            <span title="Plano de assinatura" style="text-align: center; font-size: 16px;font-weight: 500; -webkit-font-smoothing: antialiased;color: hsla(0,0%,10%,.9);  font-family: -apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Ubuntu,sans-serif;color: hsla(0,0%,10%,.7);">Plano Light</span>
                                        </div>
                                        <div style="display: flex; align-items: center; justify-content: center; opacity: 1;">
                                            <span title="Plano de assinatura" style="text-align: center; font-size: 28px;font-weight: 600;">30 dias grátis</span>
                                        </div>
                                        <div style="display: flex; align-items: center; justify-content: center; opacity: 1;">
                                            <span title="Plano de assinatura" style="text-align: center; font-size: 16px;font-weight: 500; -webkit-font-smoothing: antialiased;color: hsla(0,0%,10%,.9);  font-family: -apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Ubuntu,sans-serif;color: hsla(0,0%,10%,.7);">Depois, R$ 9,90 por mês</span>
                                        </div>
                                        <div class="card-body list-group">
                                            <input type="hidden" name="id_price" id="id_price" value="price_1NN3d3BWhRPzAP4lhFNlffDi">
                                            <button type="submit" class='btn btn-success' style="background-color: #ec4603;border-color: #ec4603;padding: 9px;font-weight: 500;font-family: -apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Ubuntu,sans-serif;font-size:16px;">Assinar</button>
                                        </div>                                        
                                        <div style="padding-bottom: 7px;"></div>
                                    </div>
                                </div>
                                <div class="card" style="box-shadow: 0 0 5px #7b2bf3;">
                                    <div class="card-body">
                                        <h5 class="card-title" style="text-align: -webkit-center;font-weight: bold;">Plano Pro</h5>
                                        <p class="card-text">É a escolha premium para aqueles que buscam o melhor em termos de recursos. Com acesso completo a todas as funcionalidades e benefícios exclusivos, o Plano Pro oferece a melhor experiência possível.</p>
                                        <ul class="list-group">
                                            <li class="list-group-item d-flex align-items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="green" width="24px" height="24px">
                                                    <path d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M9 16.17l-4.17-4.17-1.42 1.41L9 19 21.01 6.99l-1.41-1.42L9 16.17z"/>
                                                </svg>
                                                Recurso 1
                                            </li>
                                            <li class="list-group-item d-flex align-items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="green" width="24px" height="24px">
                                                    <path d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M9 16.17l-4.17-4.17-1.42 1.41L9 19 21.01 6.99l-1.41-1.42L9 16.17z"/>
                                                </svg>
                                                Recurso 2
                                            </li>
                                            <li class="list-group-item d-flex align-items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="green" width="24px" height="24px">
                                                    <path d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M9 16.17l-4.17-4.17-1.42 1.41L9 19 21.01 6.99l-1.41-1.42L9 16.17z"/>
                                                </svg>
                                                Recurso 3
                                            </li>
                                            <li class="list-group-item d-flex align-items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="green" width="24px" height="24px">
                                                    <path d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M9 16.17l-4.17-4.17-1.42 1.41L9 19 21.01 6.99l-1.41-1.42L9 16.17z"/>
                                                </svg>
                                                Recurso 4
                                            </li>
                                            <li class="list-group-item d-flex align-items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="green" width="24px" height="24px">
                                                    <path d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M9 16.17l-4.17-4.17-1.42 1.41L9 19 21.01 6.99l-1.41-1.42L9 16.17z"/>
                                                </svg>
                                                Recurso 5
                                            </li>
                                            <li class="list-group-item d-flex align-items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="green" width="24px" height="24px">
                                                    <path d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M9 16.17l-4.17-4.17-1.42 1.41L9 19 21.01 6.99l-1.41-1.42L9 16.17z"/>
                                                </svg>
                                                Recurso 6
                                            </li>
                                            <li class="list-group-item d-flex align-items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="green" width="24px" height="24px">
                                                    <path d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M9 16.17l-4.17-4.17-1.42 1.41L9 19 21.01 6.99l-1.41-1.42L9 16.17z"/>
                                                </svg>
                                                Recurso 7
                                            </li>
                                        </ul>
                                    </div>
                                    <div >
                                        <div style="display: flex; align-items: center; justify-content: center; opacity: 1;">
                                            <span title="Plano de assinatura" style="text-align: center; font-size: 16px;font-weight: 500; -webkit-font-smoothing: antialiased;color: hsla(0,0%,10%,.9);  font-family: -apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Ubuntu,sans-serif;color: hsla(0,0%,10%,.7);">Plano Pro</span>
                                        </div>
                                        <div style="display: flex; align-items: center; justify-content: center; opacity: 1;">
                                            <span title="Plano de assinatura" style="text-align: center; font-size: 28px;font-weight: 600;">30 dias grátis</span>
                                        </div>
                                        <div style="display: flex; align-items: center; justify-content: center; opacity: 1;">
                                            <span title="Plano de assinatura" style="text-align: center; font-size: 16px;font-weight: 500; -webkit-font-smoothing: antialiased;color: hsla(0,0%,10%,.9);  font-family: -apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Ubuntu,sans-serif;color: hsla(0,0%,10%,.7);">Depois, R$ 12,90 por mês</span>
                                        </div>
                                        <div class="card-body list-group">
                                            <input type="hidden" name="id_price" id="id_price" value="price_1NN3eDBWhRPzAP4l3Iqjxlb7">
                                            <button type="submit" class='btn btn-success' style="background-color: #7b2bf3;border-color: #7b2bf3;padding: 9px;font-weight: 500;font-family: -apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Ubuntu,sans-serif;font-size:16px;">Assinar</button>
                                        </div>
                                        <div style="padding-bottom: 7px;"></div>
                                    </div>
                                </div>
                                -->
                            </div>
                        </div>


                        
<script type="text/javascript">
   (function() {
      function $MPC_load() {
         window.$MPC_loaded !== true && (function() {
         var s = document.createElement("script");
         s.type = "text/javascript";
         s.async = true;
         s.src = document.location.protocol + "//secure.mlstatic.com/mptools/render.js";
         var x = document.getElementsByTagName('script')[0];
         x.parentNode.insertBefore(s, x);
         window.$MPC_loaded = true;
      })();
   }
   window.$MPC_loaded !== true ? (window.attachEvent ? window.attachEvent('onload', $MPC_load) : window.addEventListener('load', $MPC_load, false)) : null;
   })();
  /*
        // to receive event with message when closing modal from congrants back to site
        function $MPC_message(event) {
          // onclose modal ->CALLBACK FUNCTION
         // !!!!!!!!FUNCTION_CALLBACK HERE Received message: {event.data} preapproval_id !!!!!!!!
        }
        window.$MPC_loaded !== true ? (window.addEventListener("message", $MPC_message)) : null; 
        */
</script>




                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection