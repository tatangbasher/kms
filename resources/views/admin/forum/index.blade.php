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
                            <div class="card-body my-2">
                                <form action="/admin/forum">
                                    <div class="row mt--4 mb--5">
                                        <div class="col-md-12">
                                            <div class="row">
                                              <div class="col-md-9">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="Cari Diskusi" name="search" value="{{ request('search') }}" required />
                                                </div>
                                              </div>
                                              <div class="col-auto">
                                                <button type="submit" class="btn btn-success px-5">
                                                    Cari
                                                </button>
                                              </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        @if ($posts->count() > 0)
                            @foreach ($posts as $post)
                            <div class="card my-2">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <a href="/admin/forum/show/{{ $post->id }}">  
                                                <h5 class="h2 card-title font-weight-bold">{{ $post->title }}</h5>
                                            </a>
                                            <span class="mb-0 text-muted">{{ Str::words($post->body, 30, '...') }}</span>
                                        </div>
                                        <div class="col-auto">
                                            <a href="/admin/forum/edit/{{ $post->id }}">
                                                <span class="text-warning mr-2"><i class="fa fa-edit"></i></span>
                                            </a>
                                            <form action="/admin/forum/destroy/{{ $post->id }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="d-block text-danger" style="cursor: pointer; border: none; background-color: transparent;">
                                                    <span class="text-danger mr-2"><i class="fa fa-trash"></i></span>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <p class="mt-3 mb-0 text-muted text-sm">
                                        <span class="text-success mr-2">{{ $post->comments->count() }} <i class="fa fa-comments"></i></span>
                                    </p>
                                </div>
                            </div>
                            @endforeach
                            <div class="d-flex justify-content-center my-3">
                                {{ $posts->links() }}
                            </div>
                        @else
                            <div class="card my-2">
                                <div class="card-body">
                                    <div class="text-center">Tidak Ada Diskusi</div>
                                </div>
                            </div>
                        @endif
                        
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