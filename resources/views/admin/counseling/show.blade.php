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
                                <div class="table-responsive d-flex justify-content-center">
                                    <table class="table table-borderless mx-9 my-6">
                                        <tr>
                                          <td>Nama Siswa</td>
                                          <td>
                                            {{ $counseling->student->name }}
                                          </td>
                                        </tr>
                                        <tr>
                                          <td>Kelas</td>
                                          <td>
                                            {{ $counseling->student->student_class->name }}
                                          </td>
                                        </tr>
                                        <tr>
                                          <td>Masalah yang dihadapi</td>
                                          @foreach ($counseling->problems->pluck('name') as $problem_name)
                                          <td>
                                            {{ $loop->iteration }}.
                                            {{ $problem_name }}
                                          </td>
                                          @endforeach
                                        </tr>
                                        <tr>
                                            <td>Solusi</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">
                                                <div class="form-group">
                                                    <textarea class="form-control" name="" id="" cols="30" rows="10">@if($counseling->solutions != NULL){{ $counseling->solutions }}@else @endif</textarea>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>   
        </div>
    </div>
@endsection

@push('js')
    <script>
        var datatable = $('#crudTable').DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: {
                url: '{!! url()->current() !!}',
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'created_at', name: 'created_at' },
                { data: 'student.name', name: 'student.name' },
                { data: 'student.nis', name: 'student.nis' },
                { data: 'student.student_class.name', name: 'student.student_class.name' },
                { data: 'status', name: 'status' },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    width: '15%'
                },
            ],
            language: {
                paginate: {
                    next: '<i class="ni ni-bold-right text-muted"></i>',
                    previous: '<i class="ni ni-bold-left text-muted"></i>'
                }
            }
        });
    </script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush