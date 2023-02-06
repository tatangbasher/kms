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
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h3 class="h1 card-title font-weight-bold">{{ $post->title }}</h3>
                                        <h4 class="mb-3">Oleh {{ $post->user->name }} pada {{ $date }}</h4>
                                        <span class="mb-0 text-muted">{{ $post->body }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @foreach ($post->comments as $comment)
                        <div class="row">
                            @if (Auth::user()->role_id == $comment->user->role_id)
                            <div class="col-md-12 d-flex justify-content-end">
                            @else
                            <div class="col-md-12">
                            @endif
                                <div class="col-md-8 card my-2">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                @if (Auth::user()->role_id == $comment->user->role_id)
                                                <h4 class="mb-3 d-flex justify-content-end">
                                                    Komentar oleh 
                                                    {{ $comment->user->name }}
                                                </h4>
                                                <span class="mb-0 text-muted d-flex justify-content-end">
                                                    {{ $comment->body }}
                                                </span>
                                                @else
                                                <h4 class="mb-3">
                                                    Komentar oleh 
                                                    {{ $comment->user->name }}
                                                </h4>
                                                <span class="mb-0 text-muted">
                                                    {{ $comment->body }}
                                                </span>
                                                @endif
                                            </div>
                                            <a href="/counselor/forum/comment/edit/{{ $comment->id }}">
                                                <span class="text-warning mr-2"><i class="fa fa-edit"></i></span>
                                            </a>
                                            <form action="/counselor/forum/destroy/comment/{{ $comment->id }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="d-block text-danger" style="cursor: pointer; border: none; background-color: transparent;">
                                                    <span class="text-danger mr-2"><i class="fa fa-trash"></i></span>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <form action="/counselor/forum/comment/store/{{ $post->id }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card mt-2">
                              <div class="card-body">
                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <label>Komentar</label>
                                      <textarea type="text" class="form-control" name="body" rows="4" cols="50" required></textarea>
                                    </div>
                                  </div> 
                                </div>
                                <div class="row">
                                  <div class="col text-right">
                                    <button
                                      type="submit"
                                      class="btn btn-success px-5"
                                    >
                                      Simpan
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
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush