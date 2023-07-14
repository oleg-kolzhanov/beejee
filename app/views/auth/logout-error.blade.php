@extends('layouts.app')

@section('content')
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <div class="mb-md-5 mt-md-4">
                                <h2 class="fw-bold mb-2 text-uppercase">Logout error</h2>
                                <p class="text-white-50 mb-5">Try again later.</p>
                                <a href="/" class="btn btn-outline-light btn-lg mt-5 px-5">Ok</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection