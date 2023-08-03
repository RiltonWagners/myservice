@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="pricing-header text-center">    
                <span style="color:#fe5002;font-weight: bold;font-size:25px">Meu negócio</span><br>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card-body">
                <div class="form-group">
                    <div class="card-deck">
                        <div class="card text-center" style="box-shadow: 0 0 5px black;">
                            <div class="card-body col-md-12">
                                <span style="color:#fe5002;font-weight: bold;font-size:25px">Status</span>
                            </div>
                            <div class="col-md-12">
                                <div class="pricing-header text-center" style="margin-top: -20px;margin-bottom: 5px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="green" width="24px" height="24px" style="margin-bottom: 12px;">
                                        <path d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M9 16.17l-4.17-4.17-1.42 1.41L9 19 21.01 6.99l-1.41-1.42L9 16.17z"/>
                                    </svg>
                                    <span style="font-size:18px; font-weight: bold;">Publicado</span><br>
                                </div>
                            </div>
                            <div class="col-md-10" style="align-self: center;">
                                <div class="card-deck list-group">
                                    <a class='btn btn-outline-primary' href="{{ route('business.details')  }}"  style="padding: 9px;font-weight: 500;font-family: -apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Ubuntu,sans-serif;font-size:16px;">Mais informações</a>
                                </div>
                                <div style="padding-bottom: 20px;"></div>
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card-body">
                <div class="form-group">
                    <div class="card-deck">
                        <div class="card text-center col-md-12" style="box-shadow: 0 0 5px black; flex-flow: wrap;">
                            <div class="card-body col-md-12">
                                <span style="color:#fe5002;font-weight: bold;font-size:25px">Opções</span>
                            </div>
                            <div class="card-body list-group col-md-6">
                                <a class='btn btn-outline-primary' href="{{ route('business.show')  }}"  style="padding: 9px;font-weight: 500;font-family: -apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Ubuntu,sans-serif;font-size:16px;">Ver</a>
                            </div>
                            <div class="card-body list-group col-md-6">
                                <a class='btn btn-primary' href="{{ route('business.edit')  }}"  style="padding: 9px;font-weight: 500;font-family: -apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Ubuntu,sans-serif;font-size:16px;">Editar</a>
                            </div>
                            <div style="padding-bottom: 7px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection