<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="../">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="./images/favicon.png">
    <!-- Page Title  -->
    <title>Dashboard</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ mix('css/theme.css') }}">
    <link id="skin-default" rel="stylesheet" href="{{ mix('css/theme.css') }}">
</head>

<body class="nk-body bg-lighter npc-general has-sidebar ">
    <div class="nk-app-root">
        <div class="nk-main ">
            @include('partials.sidebar')
        <div class="nk-wrap ">
            @include('partials.header') 
            <div class="nk-content ">
            @yield('content')
        </div>    
        </div>
    </div>
    </div>

    <div class="modal fade" id="modalForm">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Company</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" class="form-validate is-alter" id="add_company_form">
                        @csrf
                        <div class="form-group">
                            <label class="form-label" for="full-name">Name</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="email-address">Email address</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="email" name="email" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="phone-no">Website</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="website" name="website" id="phone-no">
                            </div>
                        </div>
                        <div class="form-group">
                        <label class="form-label" for="default-06">Logo</label>
                            <div class="form-control-wrap">
                                <div class="custom-file">
                                    <input type="file" multiple class="custom-file-input" id="logo" name="logo">
                                    <label class="custom-file-label" for="customFile">Logo Image</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <script src="{{ mix('js/theme.js') }}"></script>
    <script src="{{ mix('js/app.js') }}"></script>
    <script>
        var form = document.getElementById("add_company_form")
        $('#add_company_form').on('submit', function(e){
            e.preventDefault();
            var formdata = new FormData(form);
            axios.post("{{ route('companies.store') }}",
                formdata
            ).then(function (response){
                NioApp.Toast(response.data.message, 'success');
                $('#company_table').DataTable().ajax.reload();
            })
            .catch(function (error){
                NioApp.Toast('Unable to create company', 'error');
            });
        })
    </script>
    @stack('scripts')
</body>

</html>