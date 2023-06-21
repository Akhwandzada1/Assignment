@extends('layouts.master')

@section('content')
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h3 class="nk-block-title page-title">Companies Table</h3>
                    <div class="nk-block-des text-soft">
                        <!-- <p>You have total 2,595 users.</p> -->
                    </div>
                </div><!-- .nk-block-head-content -->
                <div class="nk-block-head-content">
                    <div class="toggle-wrap nk-block-tools-toggle">
                        <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                        <div class="toggle-expand-content" data-content="pageMenu">
                            <ul class="nk-block-tools g-3">
                                <li>
                                    <!-- <a href="{{ route('companies.create') }}" class="btn btn-white btn-outline-light">
                                        <em class="icon ni ni-plus">
                                        </em>
                                        <span>Add Company</span>
                                    </a> -->
                                    <li class="preview-item">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalForm">Add Company</button>
                                    </li>
                                </li>
                                
                            </ul>
                        </div>
                    </div><!-- .toggle-wrap -->
                </div><!-- .nk-block-head-content -->
            </div><!-- .nk-block-between -->
        </div><!-- .nk-block-head -->
<div class="card card-preview">
        <div class="card-inner">
            <table class="datatable-init nowrap table" id="company_table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Logo</th>
                        <th>Website</th>
                    </tr>
                </thead>
            </table>
        </div>
        </div><!-- .card-preview -->
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#company_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('companies.datatable') }}",
                "columns" : [
                    { name : 'name', data: 'name'},
                    { name : 'email', data: 'email' },
                    { name : 'logo', data:'logo' },
                    { name : 'website', data:'website' }
                ]
            });
        });
        $(document).ready(function (){
            $('#company_table_filter').css('padding-left', '63%');
        });
    </script>
@endpush