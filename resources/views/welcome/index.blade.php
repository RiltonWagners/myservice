@extends('layouts.app')

@section('content')
<div class="container">
    <div class="jumbotron text-center">
        <h1 class="display-4">Bem-vindo!</h1>
        <p>Obrigado por se cadastrar em nosso site.</p>
        <p>Estamos felizes em tê-lo como membro da nossa comunidade.</p>
        <p>Continue explorando o nosso site e aproveite todas as funcionalidades que oferecemos.</p>
        <a class="btn btn-primary btn-lg" href="{{ route('login') }}" role="button">Começar</a>
    </div>
</div>

@endsection