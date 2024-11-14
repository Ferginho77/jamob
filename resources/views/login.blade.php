@extends('layouts.header')

@section('title', 'LOGIN PAGE')

@section('content')
<main>
    <div class="d-flex justify-content-center align-items-center vh-100 position-relative"> <!-- Added position-relative for centering -->
        <div class="card shadow-lg border-0 rounded-lg p-4 p-lg-5 " style=" position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"> <!-- Centered card -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card-body d-flex align-items-center">
                        <div class="flex-grow-1 p-3">
                            <h3 class="text-center fs-1 my-4 display-4">Login</h3>
                            <form method="post" class="w-100">
                                @csrf
                                <div class="form-floating mb-3">
                                    <input 
                                        class="form-control" 
                                        id="username" 
                                        required 
                                        type="text" 
                                        name="username" 
                                        placeholder="Username"
                                    />
                                    <label for="username">Username</label>
                                </div>
                                <div class="form-floating mb-3 ">
                                    <input 
                                        class="form-control" 
                                        id="password" 
                                        required 
                                        type="password" 
                                        name="password" 
                                        placeholder="Password"
                                    />
                                    <label for="password">Password</label>
                                </div>
                                <div class="d-grid gap-2 mx-auto">
                                    <button 
                                        class="btn btn-primary btn-lg" 
                                        type="submit" 
                                        name="login" 
                                        value="login"
                                    >
                                        Login
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="border-start ps-3 ms-3 d-none d-md-block">
                            <img 
                                src="/img/logo-perumda-tr.png" 
                                class="img-fluid" 
                                alt="Logo"
                                style="max-width: 200px; height: auto;"  
                            >
                        </div>
                    </div>
                </div>
            </div>
            <p class="text-center" style="font-size: 14px;">© 2024 <a href="https://www.tirtaraharja.co.id/" target="_blank" style="text-decoration: none;">PERUMDA Air Minum Tirta Raharja</a></p>
        </div>
    </div>
</main>

<style>
    @media (min-width: 992px) {
        .card {
            padding: 3rem;
        }
        h3 {
            font-size: 2.5rem;
        }
        .btn {
            font-size: 1.25rem;
        }
    }
</style>