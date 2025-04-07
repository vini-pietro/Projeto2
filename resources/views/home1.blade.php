@extends('layouts.app')

@section('content')

<!-- Banner de Boas-Vindas -->
<div class="jumbotron text-center bg-light p-5">
    <h1 class="display-4">Welcome to Projeto2</h1>
    <p class="lead">The best solution to organize your events.</p>
    <!-- <a href="{{ route('about') }}" class="btn btn-primary btn-lg">Saiba Mais</a> botao para saiba mais -->
</div>

<div>
<a href="{{ route('register') }}" class="btn btn-primary mt-3">Criar Usuário</a>

<a href="{{ route('login') }}" class="btn btn-success mt-3">Fazer Login</a>

</div>
<!-- Seção de Destaques -->
<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Organize Events</h5>
                    <p class="card-text">Manage your event efficiently.</p>
                    <a href="{{ route('about') }}" class="btn btn-outline-primary">Learn More</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Connect with Friends</h5>
                    <p class="card-text">Facilitate communication and organization.</p>
                    <a href="{{ route('contact') }}" class="btn btn-outline-primary">Contact Us</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Ease of Use</h5>
                    <p class="card-text">User-friendly and intuitive interface.</p>
                    <a href="{{ route('about') }}" class="btn btn-outline-primary">See More</a>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
