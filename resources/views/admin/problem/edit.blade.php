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
                      <form action="/admin/problem/update/{{ $problem->id }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="card">
                          <div class="card-body">
                            <div class="row">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label>Nama</label>
                                  <input type="text" class="form-control" name="name" value="{{ $problem->name }}" required />
                                </div>
                                <div class="form-group">
                                  <label>Bobot Permasalahan</label>
                                  <select name="priority" required class="form-control">
                                    <option selected>(Pilih Bobot)</option>
                                      <option value="1">1</option>
                                      <option value="3">3</option>
                                      <option value="5">5</option>
                                    </select>
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