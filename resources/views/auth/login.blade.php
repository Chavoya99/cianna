@extends('../layouts/base')

@section('content')
    <div class="container text-center w-auto mt-5">
        <div class="row">
        <div class="col-md-6 mx-auto text-center">
                <div class="bg-white p-5 rounded-5 text-secondary shadow">
                    <div class="d-flex justify-content-center">
                        <img src="{{asset('assets/img/login-icon.svg')}}" alt="login-icon" style="height: 7rem"/>
                    </div>
                    <div class="text-center fs-1 fw-bold">Login</div>
                    <div class="input-group mt-4">
                        <div class="input-group-text bg-info">
                            <i data-lucide="user"></i>
                        </div>
                        <input class="form-control bg-light" type="email" placeholder="Correo"/>
                    </div>
                    <div class="input-group mt-1">
                        <div class="input-group-text bg-info">
                            <i data-lucide="lock-keyhole"></i>
                        </div>
                        <input class="form-control bg-light" type="password" placeholder="Contraseña"/>
                    </div>
                    <div class="d-flex justify-content-around mt-1">
                        <div class="d-flex align-items-center gap-1">
                        <input class="form-check-input" type="checkbox" />
                        <div class="pt-1" style="font-size: 0.9rem">Remember me</div>
                        </div>
                        <div class="pt-1">
                        <a href="#" class="text-decoration-none text-info fw-semibold fst-italic">
                            ¿Olvidó su contraseña?</a>
                        </div>
                    </div>
                    <div class="btn btn-info text-white w-100 mt-4 fw-semibold shadow-sm">
                        Login
                    </div>
                    <div class="d-flex gap-1 justify-content-center mt-1">
                        <div>¿No tienes una cuenta?</div>
                        <a href="#" class="text-decoration-none text-info fw-semibold">
                            Regístrate
                        </a>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection