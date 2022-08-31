@extends('layout')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <h1> Wellcome. {{auth()->user()->name}}</h1>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-form" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add/Edit Data</h5>
                    </div>
                    <div class="modal-body">
                        <form class="forms-sample">
                            <div class="form-group row">
                                <label for="nik" class="col-sm-3 col-form-label">NIK</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="NIK" id="nik">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="Name" id="name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="unit" class="col-sm-3 col-form-label">Unit</label>
                                <div class="col-sm-9">
                                    <select name="" id="unit" class="form-control form-control-lg select2"
                                            style="width: 100%">
                                        <option value="">Information Technology Group</option>
                                        <option value="">Accounting & Tax</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="position" class="col-sm-3 col-form-label">Position</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="Position" id="position">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="dob" class="col-sm-3 col-form-label">Date of Birth</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" placeholder="Date of Birth" id="dob">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="place_of_birth" class="col-sm-3 col-form-label">Place of Birth</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="Place of Birth"
                                           id="place_of_birth">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="status" class="col-sm-3 col-form-label">Status</label>
                                <div class="col-sm-9">
                                    <select name="" id="status" class="form-control form-control-lg select2"
                                            style="width: 100%">
                                        <option value="0">Inactive</option>
                                        <option value="1">Active</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-import" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Import Data</h5>
                    </div>
                    <div class="modal-body">
                        <form class="forms-sample">
                            <div class="form-group row">
                                <label for="file" class="col-sm-3 col-form-label">Select File</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control" id="file">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="progress" style="height: 15px">
                                        <div class="progress-bar" role="progressbar" style="width: 25%;"
                                             aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>

        @endsection

@section('script')
    <script>

        let table = $('#table-data').DataTable();

        $('.btn-modal').on('click', function () {

            let modal = $(this).attr('data-target')

            $(modal).modal('show')

        })

    </script>
@endsection
