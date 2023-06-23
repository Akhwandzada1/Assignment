<form enctype="multipart/form-data" action="@isset($company) {{ route('companies.update', $company->id) }} @else {{ route('companies.store') }} @endisset" class="form-validate is-alter" id="company_form">
    @isset($company)
        @method('PUT')
    @endisset
        @csrf
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@isset($company) Edit @else Add @endisset Company</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body" id="company_form_div">
            <div class="form-group">
            <label class="form-label required" for="name">Name</label>
            <div class="form-control-wrap">
                <input type="text" class="form-control" value="@isset($company){{ $company->name }}@endisset" name="name" required>
            </div>
        </div>
        <div class="form-group">
            <label class="form-label required" for="email">Email address </label>
            <div class="form-control-wrap">
                <input type="email" class="form-control" id="email" value="@isset($company){{ $company->email }}@endisset" name="email" required>
            </div>
        </div>
        <div class="form-group">
            <label class="form-label required" for="website">Website</label>
            <div class="form-control-wrap">
                <input type="text" class="form-control" id="website" value="@isset($company){{ $company->website }}@endisset" name="website" id="phone-no" required>
            </div>
        </div>
        <div class="form-group">
        <label class="form-label @if(!isset($company)) required @endif">Logo</label>
            <div class="form-control-wrap">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="logo" name="logo" accept="image/png, image/gif, image/jpeg" @if(!isset($company)) required @endif >
                    <label class="custom-file-label" for="customFile"></label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-lg btn-primary">Save</button>
        </div>
        </div>
            </div>
        </div>
    </div>
    </form>