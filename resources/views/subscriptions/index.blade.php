@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="pricing-header text-center">    
                <span style="color:#fe5002;font-weight: bold;font-size:25px">Minha assinatura</span><br>
            </div>
        </div>
        <div class="col-md-12">
            <div class="">
                <div class="card-body">
                    <div class="form-group">
                        <div class="card-deck">
                            <?php $assigned = false; ?>
                            @foreach($plans as $plan)
                                <div class="card" 
                                    @if($plan->price[0]->id_product == $subscription)
                                        style= "box-shadow: 0 0 5px {{ $plan->color_dark }}; background: {{ $plan->color }};"
                                    @else
                                        style= "box-shadow: 0 0 5px {{ $plan->color_dark }};"
                                    @endif>
                                    <div class="card-body">
                                        <h5 class="card-title" style="text-align: -webkit-center;font-weight: bold; color: {{ $plan->color_dark}};">
                                            <div style="padding: 0px 5px 0px 0px; display: inline-flex;">
                                        @if($plan->price[0]->id_product == $subscription)
                                            
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-hand-index" viewBox="0 0 16 16" style="margin-right: 10px;">
                                                    <g transform="rotate(90 8 8)">
                                                    <path d="M6.75 1a.75.75 0 0 1 .75.75V8a.5.5 0 0 0 1 0V5.467l.086-.004c.317-.012.637-.008.816.027.134.027.294.096.448.182.077.042.15.147.15.314V8a.5.5 0 1 0 1 0V6.435a4.9 4.9 0 0 1 .106-.01c.316-.024.584-.01.708.04.118.046.3.207.486.43.081.096.15.19.2.259V8.5a.5.5 0 0 0 1 0v-1h.342a1 1 0 0 1 .995 1.1l-.271 2.715a2.5 2.5 0 0 1-.317.991l-1.395 2.442a.5.5 0 0 1-.434.252H6.035a.5.5 0 0 1-.416-.223l-1.433-2.15a1.5 1.5 0 0 1-.243-.666l-.345-3.105a.5.5 0 0 1 .399-.546L5 8.11V9a.5.5 0 0 0 1 0V1.75A.75.75 0 0 1 6.75 1zM8.5 4.466V1.75a1.75 1.75 0 1 0-3.5 0v5.34l-1.2.24a1.5 1.5 0 0 0-1.196 1.636l.345 3.106a2.5 2.5 0 0 0 .405 1.11l1.433 2.15A1.5 1.5 0 0 0 6.035 16h6.385a1.5 1.5 0 0 0 1.302-.756l1.395-2.441a3.5 3.5 0 0 0 .444-1.389l.271-2.715a2 2 0 0 0-1.99-2.199h-.581a5.114 5.114 0 0 0-.195-.248c-.191-.229-.51-.568-.88-.716-.364-.146-.846-.132-1.158-.108l-.132.012a1.26 1.26 0 0 0-.56-.642 2.632 2.632 0 0 0-.738-.288c-.31-.062-.739-.058-1.05-.046l-.048.002zm2.094 2.025z"/>
                                                    </g>
                                                </svg>
                                            
                                        @endif
                                        <p class="card-title" style="text-align: -webkit-center; font-weight: bold; font-size: x-large; color: {{ $plan->color_dark}};">{{ $plan->name}}</p>
                                        </div>
                                        
                                        </h5>
                                        <p class="card-text" style="text-align: -webkit-center; font-size: small;">{{ $plan->description }}</p>
                                        <ul class="list-group" style="color:{{ $plan->color_dark}};">
                                            <li class="list-group-item d-flex align-items-center" style= "background: {{ $plan->color_light }};">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" fill="green" width="24px" height="24px">
                                                    <path d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M9 16.17l-4.17-4.17-1.42 1.41L9 19 21.01 6.99l-1.41-1.42L9 16.17z"/>
                                                </svg>
                                                Recurso 1
                                            </li>
                                            <li class="list-group-item d-flex align-items-center" style= "background: {{ $plan->color_light }};">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" fill="green" width="24px" height="24px">
                                                    <path d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M9 16.17l-4.17-4.17-1.42 1.41L9 19 21.01 6.99l-1.41-1.42L9 16.17z"/>
                                                </svg>
                                                Recurso 2
                                            </li>
                                            <li class="list-group-item d-flex align-items-center" style= "background: {{ $plan->color_light }};">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" fill="green" width="24px" height="24px">
                                                    <path d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M9 16.17l-4.17-4.17-1.42 1.41L9 19 21.01 6.99l-1.41-1.42L9 16.17z"/>
                                                </svg>
                                                Recurso 3
                                            </li>
                                            <li class="list-group-item d-flex align-items-center" style= "background: {{ $plan->color_light }};">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" fill="green" width="24px" height="24px">
                                                    <path d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M9 16.17l-4.17-4.17-1.42 1.41L9 19 21.01 6.99l-1.41-1.42L9 16.17z"/>
                                                </svg>
                                                Recurso 3
                                            </li>
                                            <li class="list-group-item d-flex align-items-center" style= "background: {{ $plan->color_light }};">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" fill="red" width="24px" height="24px">
                                                    <path d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z"/>
                                                </svg>
                                                Recurso 6
                                            </li>
                                            <li class="list-group-item d-flex align-items-center" style= "background: {{ $plan->color_light }};">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" fill="red" width="24px" height="24px">
                                                    <path d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z"/>
                                                </svg>
                                                Recurso 6
                                            </li>
                                            <li class="list-group-item d-flex align-items-center" style= "background: {{ $plan->color_light }};">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" fill="red" width="24px" height="24px">
                                                    <path d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z"/>
                                                </svg>
                                                Recurso 7
                                            </li>
                                        </ul>
                                    </div>
                                    @if($plan->price[0]->id_product == $subscription)
                                        @if($plan->id == 1)
                                            <?php $assigned = true; ?>
                                            <div class="card-body list-group"></div>
                                        @else
                                            <div class="card-body list-group">
                                                <a href="{{ route('subscriptions.show') }}" class='btn btn-success' style="background-color: {{ $plan->color }};border-color: {{ $plan->color_dark }}; color: {{ $plan->color_dark }}; padding: 5px;font-weight: 500;font-family: -apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Ubuntu,sans-serif;font-size:16px;">Cancelar assinatura</a>
                                            </div>
                                        @endif
                                    @else
                                        @if($plan->id != 1 && $assigned)
                                            <div >
                                                <div style="display: flex; align-items: center; justify-content: center; opacity: 1;">
                                                    <span title="Plano de assinatura" style="text-align: center; font-size: 16px;font-weight: 500; -webkit-font-smoothing: antialiased;color: hsla(0,0%,10%,.9);  font-family: -apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Ubuntu,sans-serif;color: hsla(0,0%,10%,.7);">{{ $plan->name }}</span>
                                                </div>
                                                <div style="display: flex; align-items: center; justify-content: center; opacity: 1;">
                                                    <span title="Plano de assinatura" style="text-align: center; font-size: 28px;font-weight: 600;">30 dias grátis</span>
                                                </div>
                                                <div style="display: flex; align-items: center; justify-content: center; opacity: 1;">
                                                    <span title="Plano de assinatura" style="text-align: center; font-size: 16px;font-weight: 500; -webkit-font-smoothing: antialiased;color: hsla(0,0%,10%,.9);  font-family: -apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Ubuntu,sans-serif;color: hsla(0,0%,10%,.7);">Depois, R$ {{ $plan->price[0]->price }} por mês</span>
                                                </div>
                                                <form method="POST" action="{{ route('subscriptions.store') }}">
                                                    @csrf
                                                    <div class="card-body list-group">                                                
                                                        <input type="hidden" name="id_price" id="id_price" value="{{ $plan->price[0]->id_price }}">
                                                        <button type="submit" class='btn btn-success' style="background-color: {{ $plan->color_dark }};border-color: {{ $plan->color_dark }};padding: 9px;font-weight: 500;font-family: -apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Ubuntu,sans-serif;font-size:16px;">Assinar</button>
                                                    </div>
                                                </form>
                                                <div style="padding-bottom: 7px;"></div>
                                            </div>
                                        @else
                                            <div ></div>
                                        @endif
                                    @endif
                                </div>
                            @endforeach
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection