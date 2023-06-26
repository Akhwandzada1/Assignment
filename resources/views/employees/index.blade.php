@extends('layouts.master')

@section('title')
    Employees
@endsection

@section('content')
<div class="nk-block-head nk-block-head-sm">
    <div class="nk-block-between">
        <div class="nk-block-head-content">
            <h3 class="nk-block-title page-title">Employees</h3>
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
                            @can('create_employee')
                            <button type="button" class="btn btn-primary" id="add_employee">Add Employee</button>
                            @endcan
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
        <table class="datatable-init nowrap table" id="employee_table">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Company</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
    </div>
</div><!-- .card-preview -->

@endsection

@push('scripts')
<script>
$(document).ready(function() {
        $('#employee_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('employees.datatable') }}",
            "columns": [
                {
                    name: 'first_name',
                    data: 'first_name'
                },
                {
                    name: 'last_name',
                    data: 'last_name'
                },
                {
                    name: 'email',
                    data: 'email'
                },
                {
                    name: 'phone',
                    data: 'phone'
                },
                {
                    name: 'company',
                    data: 'company'
                },
                {
                    name: 'action',
                    data: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });

        // To Open Create Form
        $('#add_employee').on('click', function (){
            axios.get("{{ route('employees.create') }}").then(function (response){
                $('#modalForm').html(response.data)
                $('#modalForm').modal('show');
            }).catch(function (error){

            })
        })
        //To Open Edit Form
        $(document).on('click', '.employee-edit', function (){
            var url = $(this).attr('edit-url');
            axios.get(url).then(function (response){
                $('#modalForm').html(response.data)
                $('#modalForm').modal('show');
            }).catch(function (error){

            })
        })
        //To Open Delete Confirmation Box & then delete
        $(document).on('click', '.delete-confirmation', function(e) {
            var deleteUrl = $(this).attr('delete-url');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!'
            }).then(function(result) {
                console.log(result);
                if (result.value) {
                    axios.delete(deleteUrl)
                    .then(function (response){
                        NioApp.Toast(response.data.message, 'success');
                        $('#employee_table').DataTable().ajax.reload();
                    }).catch(function (error){
                        NioApp.Toast(error.response.data.message, 'error');
                    })
                }
            });
        });
        //Edit & Add Employee functionality
        $(document).on('submit', '#employee_form', function(e) {
            var form = document.getElementById("employee_form")
            var url = $('#employee_form').attr('action');
            e.preventDefault();
            var formdata = new FormData(form);
            axios.post(url,
                    formdata
                ).then(function(response) {
                    NioApp.Toast(response.data.message, 'success');
                    $('#employee_table').DataTable().ajax.reload();
                    $('#modalForm').modal('hide');
                })
                .catch(function(error) {
                    NioApp.Toast(error.response.data.message, 'error');
                });
        })
    });
</script>
@endpush