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
                      <form action="/counselor/student/store" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                          <div class="card-body">
                            <div class="row">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label>Nama</label>
                                  <input type="text" class="form-control" name="name" required />
                                </div>
                              </div> 
                              <div class="col-md-12">
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label>Nomor Induk Siswa</label>
                                      <input type="text" class="form-control" name="nis" required />
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label>Kelas</label>
                                      <select name="student_class_id" required class="form-control">
                                              <option value="null" selected>(Pilih Kelas)</option>
                                          @foreach ($student_classes as $student_class)
                                              <option value="{{ $student_class->id }}">{{ $student_class->name }}</option>
                                          @endforeach
                                      </select>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label>Semester</label>
                                      <select name="academic_year_id" required class="form-control">
                                              <option value="null" selected>(Pilih Semester)</option>
                                          @foreach ($academic_years as $academic_year)
                                              <option value="{{ $academic_year->id }}">{{ $academic_year->name }} - {{ $academic_year->semester }}</option>
                                          @endforeach
                                      </select>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label>Jenis Kelamin</label>
                                      <select name="gender" required class="form-control">
                                        <option value="null" selected>(Pilih Gender)</option>
                                        <option value="Laki-Laki">Laki-Laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                      </select>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label>Alamat</label>
                                  <textarea type="text" class="form-control" name="address" rows="4" cols="50" required>
                                  </textarea>
                                </div>
                              </div> 
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label>No. HP</label>
                                  <input type="text" class="form-control" name="phone" required />
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