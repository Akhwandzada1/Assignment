@extends('layouts.master')

@section('title')
    Projects
@endsection

@section('content')
<div class="nk-block-head nk-block-head-sm">
    <div class="nk-block-between">
        <div class="nk-block-head-content">
            <h3 class="nk-block-title page-title">Projects</h3>
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
                            @can('create_project')
                            <button type="button" class="btn btn-primary" id="add_project">Add Project</button>
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
        <div class="table-responsive">
        <table class="datatable-init nowrap table" id="project_table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Detail</th>
                    <th>Client</th>
                    <th>Total Cost</th>
                    <th>Deadline</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
        </div>
    </div>
</div><!-- .card-preview -->
@endsection

@push('scripts')
<script>
    $(document).ready(function (){
        $('#project_table').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('projects.datatable') }}",
          columns : [
            {
                name: 'name',
                data: 'name'
            },
            {
                name: 'detail',
                data: 'detail',
            },
            {
                name: 'client',
                data: 'client'
            },
            {
                name: 'total_cost',
                data: 'total_cost'
            },
            {
                name: 'deadline',
                data: 'deadline'
            },
            {
                name: 'action',
                data: 'action',
                orderable: false,
                searchable: false
            }
          ]  
        });
        $('#add_project').on('click', function (){
            axios.get("{{ route('projects.create') }}").then(function (response){
                $('#modalForm').html(response.data)
                $('#modalForm').modal('show');
                NioApp.Picker.dob('.date-picker-alt');
            }).catch(function (error){

            });
        })
        $(document).on('click', '.project-edit', function (){
            var url = $(this).attr('edit-url');
            axios.get(url).then(function (response){
                $('#modalForm').html(response.data)
                $('#modalForm').modal('show');
                NioApp.Picker.dob('.date-picker-alt');
            }).catch(function (error){

            })
        });
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
                        $('#project_table').DataTable().ajax.reload();
                    }).catch(function (error){
                        NioApp.Toast(error.response.data.message, 'error');
                    })
                }
            });
        });
        $(document).on('submit', '#project_form', function(e) {
            var form = document.getElementById("project_form")
            var url = $('#project_form').attr('action');
            e.preventDefault();
            var formdata = new FormData(form);
            axios.post(url,
                    formdata
                ).then(function(response) {
                    NioApp.Toast(response.data.message, 'success');
                    $('#project_table').DataTable().ajax.reload();
                    $('#modalForm').modal('hide');
                })
                .catch(function(error) {
                    NioApp.Toast(error.response.data.message, 'error');
                });
        })
    });
</script>
@endpush