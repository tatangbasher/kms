@extends('layouts.app')

@section('content')
    @include('layouts.headers.nocards')
    
    <div class="container-fluid mt--7">
        <div class="mt-8">
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-md-12">
                        @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
                                <span class="alert-inner--text"><strong>Berhasil!</strong> {{ session('success') }} </span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div class="card">
                            <div class="card-body">
                                <h2 class="display-4 text-center">{{ $title }}</h2>
                                <form action="/admin/solution/show" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card">
                                      <div class="card-body">
                                        <div class="form-group">
                                            <label>Permasalahan</label>
                                            <div class="row">
                                              <div class="col">
                                                @foreach ($problems as $problem)
                                                <div class="form-check">
                                                  <input type="checkbox" name="problem[]" value="{{ $problem->id }}">
                                                  <label class="fs-6 fw-light">{{ $problem->name }}</label>
                                                </div>
                                                @endforeach
                                              </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                          <div class="col text-right">
                                            <button
                                              type="submit"
                                              class="btn btn-primary px-5"
                                            >
                                              Cari
                                            </button>
                                          </div>
                                      </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>   
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush