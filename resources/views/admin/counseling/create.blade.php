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
                      <form action="/admin/counseling/store" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                          <div class="card-body">
                            <div class="row">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label>Nomor Induk Siswa</label>
                                  <select name="student_id" required class="form-control" id="nis">
                                    <option value="0" disabled="true" selected="true">-Pilih-</option>
                                    @foreach($students as $student)
                                      <option value="{{ $student->id }}">{{ $student->nis }}</option>
                                    @endforeach
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label>Nama</label>
                                  <input type="text" class="form-control disabled" name="student_name" id="student_name" required disabled/>
                                </div>
                                <div class="form-group">
                                  <label>Kelas</label>
                                  <input type="text" class="form-control disabled" name="student_class_name" id="student_class" required disabled/>
                                </div>
                                <div class="form-group">
                                  <label>Permasalahan</label>
                                  <div class="row">
                                    <div class="col">
                                      @foreach ($problems as $problem)
                                      <div class="form-check">
                                        <input type="checkbox" id="" name="problem_id[]" value="{{ $problem->id }}">
                                        <label class="fs-6 fw-light">{{ $problem->name }}</label>
                                      </div>
                                      @endforeach
                                    </div>
                                  </div>
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
    <script type="text/javascript">
      $(document).ready(function (){

          $(document).on('change', '#nis', function() {

                var student_id = $(this).val();

                var a = $('#student_name').parent();

                $.ajax({
                  type      : 'GET',
                  url       : '{{ route('find_student') }}',
                  data      : 'id=' + student_id,
                  success:function(data){
                    a.find('#student_name').val(data.name);
                  },

                  error:function(){

                  }
                });

          });

          $(document).on('change', '#nis', function() {

                var student_id = $(this).val();

                var a = $('#student_class').parent();

                $.ajax({
                  type      : 'GET',
                  url       : '{{ route('find_student') }}',
                  data      : 'id=' + student_id,
                  success:function(data){
                    a.find('#student_class').val(data.student_class.name);
                  },

                  error:function(){

                  }
                });

          });

      });
    </script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush