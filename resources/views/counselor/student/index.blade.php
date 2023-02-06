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
                                <a href="/counselor/student/create" class="btn btn-sm btn-primary mb-3">Tambah Data Baru</a>
                                <div class="table-responsive">
                                    <table class="table table-hover scroll-horizontal-vertical w-100" id="crudTable">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Siswa</th>
                                                <th>NIS</th>
                                                <th>Kelas</th>
                                                <th>Tahun Ajaran</th>
                                                <th>Semester</th>
                                                <th>Jenis Kelamin</th>
                                                <th>No. Handphone</th>
                                                <th>Alamat</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
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
                { data: 'name', name: 'name' },
                { data: 'nis', name: 'nis' },
                { data: 'student_class.name', name: 'student_class.name' },
                { data: 'academic_year.name', name: 'academic_year.name' },
                { data: 'academic_year.semester', name: 'academic_year.semester'},
                { data: 'gender', name: 'gender' },
                { data: 'phone', name: 'phone' },
                { data: 'address', name: 'address' },
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