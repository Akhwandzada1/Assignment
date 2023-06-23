<form action="@isset($employee) {{ route('employees.update', $employee->id) }} @else {{ route('employees.store') }} @endisset" class="form-validate is-alter" id="employee_form">
    @isset($employee)
        @method('PUT')
    @endisset
        @csrf
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    @isset($employee)
                    <h5 class="modal-title">Edit Employee</h5>
                    @else
                    <h5 class="modal-title">Add Employee</h5>
                    @endisset
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body" id="employee_form_div">
            <div class="form-group">
            <label class="form-label required" for="full-name">First Name</label>
            <div class="form-control-wrap">
                <input type="text" class="form-control" value="@isset($employee){{ $employee->first_name }}@endisset" name="first_name" required>
            </div>
        </div>
        <div class="form-group">
            <label class="form-label required" for="email-address">Last Name</label>
            <div class="form-control-wrap">
                <input type="text" class="form-control" id="last_name" value="@isset($employee){{ $employee->last_name }}@endisset" name="last_name" required>
            </div>
        </div>
        <div class="form-group">
            <label class="form-label required" for="phone-no">Email</label>
            <div class="form-control-wrap">
                <input type="text" class="form-control" id="email" value="@isset($employee){{ $employee->email }}@endisset" name="email" required>
            </div>
        </div>
        <div class="form-group">
            <label class="form-label required" for="phone-no">Phone Number</label>
            <div class="form-control-wrap">
                <input type="text" class="form-control" id="phone" value="@isset($employee){{ $employee->phone }}@endisset" name="phone" required>
            </div>
        </div>
        <div class="form-group">
        <label class="form-label required" for="default-06">Select Company</label>
            <div class="form-control-wrap ">
                <div class="form-control-select">
                    <select class="form-control" id="company_id" name="company_id">
                        @foreach($companies as $company)
                        <option value="{{ $company->id }}" @isset($employee) {{ $employee->company_id == $company->id ? 'selected' : '' }} @endisset>{{ $company->name }}</option>
                        @endforeach
                    </select>
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