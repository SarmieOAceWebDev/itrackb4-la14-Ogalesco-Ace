@extends('layouts.app')

@section('title' , 'log in')

@section('content')
<div class = "row justify-content-center">
    <div class = "col-md-5">
        <div class = "card shadow-sm"><div class ="card-body">
            <h3 class = "card-title text-center mb-4">Log in</h3>

            <form method="POST" action="{{ route('login.store') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control">
                    @error('email')
                            <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control">
                    @error('password')
                            <div class="text-danger">{{ $message }}</div>
                    @enderror

                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Log in</button>
                    
                </div>
            </form>
        </div></div>
    </div>
    @endsection