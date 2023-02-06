@extends('layouts.app')

@section('content')
    @include('layouts.headers.nocards')
    
    <div class="container-fluid mt--7">
        <div class="mt-8">
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-12">
                      @if ($errors->any())
                          <div class="alert alert-danger">
                              <ul>
                                  @foreach ($errors->all() as $error)
                                      <li>{{ $error }}</li>
                                  @endforeach
                              </ul>
                          </div>
                      @endif
                      <form action="/counselor/forum/update/{{ $post->id }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="card">
                          <div class="card-body">
                            <div class="row">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label>Judul Diskusi</label>
                                  <input type="text" class="form-control" name="title" value="{{ $post->title }}" required />
                                </div>

                                <div class="form-group">
                                  <label>Isi Diskusi</label>
                                  <textarea type="text" class="form-control" name="body" rows="4" cols="50" required>{{ $post->body }}</textarea>
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