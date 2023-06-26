<form action="@isset($project) {{ route('projects.update', $project->id) }} @else {{ route('projects.store') }} @endisset" class="form-validate is-alter" id="project_form">
    @isset($project)
        @method('PUT')
    @endisset
        @csrf
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@isset($project) Edit @else Add @endisset Project</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body" id="employee_form_div">
            <div class="form-group">
            <label class="form-label required" for="name">Name</label>
            <div class="form-control-wrap">
                <input type="text" class="form-control" value="@isset($project){{ $project->name }}@endisset" name="name" required>
            </div>
        </div>
        <div class="form-group">
            <label class="form-label required" for="detail">Detail</label>
            <div class="form-control-wrap">
                <input type="text" class="form-control" id="detail" value="@isset($project){{ $project->detail }}@endisset" name="detail" required>
            </div>
        </div>
        <div class="form-group">
            <label class="form-label required" for="client">Client</label>
            <div class="form-control-wrap">
                <input type="text" class="form-control" id="client" value="@isset($project){{ $project->client }}@endisset" name="client" required>
            </div>
        </div>
        <div class="form-group">
            <label class="form-label required" for="total_cost">Total Cost</label>
            <div class="form-control-wrap">
                <input type="text" class="form-control" id="total_cost" value="@isset($project){{ $project->total_cost }}@endisset" name="total_cost" required>
            </div>
        </div>
        <div class="form-group">
            <label class="form-label required" for="deadline">Deadline</label>
            <div class="form-control-wrap">
                <input type="text" class="form-control" id="deadline" value="@isset($project){{ $project->deadline }}@endisset" name="deadline" required>
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