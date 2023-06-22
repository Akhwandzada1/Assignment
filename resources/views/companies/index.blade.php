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
                            <button type="button" class="btn btn-primary" id="add_company">Add Company</button>
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
        $('#company_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('companies.datatable') }}",
            "columns": [{
                    name: 'name',
                    data: 'name'
                },
                {
                    name: 'email',
                    data: 'email'
                },
                {
                    name: 'logo',
                    data: 'logo'
                },
                {
                    name: 'website',
                    data: 'website'
                },
                {
                    name: 'action',
                    data: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });
    });
    $(document).ready(function() {
        $('#company_table_filter').css('padding-left', '63%');
        $('#add_company').on('click', function() {
            axios.get("{{ route('companies.create') }}").then(function(response) {
                //$('#company_form_div').html(response.data)
                $('#modalForm').html(response.data)
                $('#modalForm').modal('show');
                NioApp.BS.fileinput('.custom-file-input');
            }).catch(function(error) {

            })
        });
        $(document).on('click', '.company-edit', function() {
            var url = $(this).attr('edit-url');
            axios.get(url)
                .then(function(response) {
                    //$('#company_form_div').html(response.data)
                    $('#modalForm').html(response.data)
                    $('#modalForm').modal('show');
                    NioApp.BS.fileinput('.custom-file-input');
                }).catch(function(error) {

                })
        });
        $(document).on('submit', '#company_form', function(e) {
            var form = document.getElementById("company_form")
            var url = $('#company_form').attr('action');
            e.preventDefault();
            var formdata = new FormData(form);
            axios.post(url,
                    formdata
                ).then(function(response) {
                    NioApp.Toast(response.data.message, 'success');
                    $('#company_table').DataTable().ajax.reload();
                    $('#modalForm').modal('hide');
                })
                .catch(function(error) {
                    NioApp.Toast(error.response.data.message, 'error');
                });
        })
        $(document).on('click', '.eg-swal-av3', function(e) {
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
                        $('#company_table').DataTable().ajax.reload();
                    }).catch(function (error){
                        NioApp.Toast('Unable to delete company', 'error');
                    })
                }
            });
            e.preventDefault();
        });
    });
</script>
@endpush