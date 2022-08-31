@extends('layout')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-12">
                                    <a href="javascript:void(0)" class="btn btn-sm btn-primary btn-modal"
                                       data-target="#modal-form"><i class="mdi mdi-plus"></i> New Data</a>
                                    <a href="javascript:void(0)" class="btn btn-sm btn-success btn-modal"
                                       data-target="#modal-import"><i class="mdi mdi-download"></i> Import</a>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-12">
                                    <table class="table table-hover table-stripde table-bordered" id="table-data">
                                        <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NIK</th>
                                            <th>Employee Name</th>
                                            <th>Unit</th>
                                            <th>Position</th>
                                            <th>Date of Birth</th>
                                            <th>Place of Birth</th>
                                            <th>Last Updated Date</th>
                                            <th>Updated By</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-form" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form class="forms-sample" id="formEmployee" method="POST">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add/Edit Data</h5>
                            <input type="hidden" name="id_employee" id="id_employee">
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <label for="nik" class="col-sm-3 col-form-label">NIK</label>
                                <div class="col-sm-9">
                                    <input name="nik" type="text" class="form-control" placeholder="NIK" id="nik">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-9">
                                    <input name="name" type="text" class="form-control" placeholder="Name" id="name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="unit_id" class="col-sm-3 col-form-label">Unit</label>
                                <div class="col-sm-9">
                                    <select name="unit_id" id="unit_id" class="form-control"
                                            style="width: 100%"></select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="position_name" class="col-sm-3 col-form-label">Position</label>
                                <div class="col-sm-9">
                                    <input name="position_name" type="text" class="form-control" placeholder="Position"
                                           id="position_name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="dob" class="col-sm-3 col-form-label">Date of Birth</label>
                                <div class="col-sm-9">
                                    <input name="date_of_birth" type="date" class="form-control"
                                           placeholder="Date of Birth" id="dob">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="place_of_birth" class="col-sm-3 col-form-label">Place of Birth</label>
                                <div class="col-sm-9">
                                    <input name="place_of_birth" type="text" class="form-control"
                                           placeholder="Place of Birth" id="place_of_birth">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button id="submit" type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </form>
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
            <script type="text/javascript">
                $(document).ready(function () {
                    const table = $('#table-data');
                    const form = $('#formEmployee');
                    const modal = $('#modal-form');
                    $('.btn-modal').on('click', function () {
                        modal.modal('show')
                    })
                    const updateOrCreateData = (url, data, method) => {
                        processData(url, method, {
                            data: data,
                            dataType: 'JSON',
                            beforeSend: function () {
                                $('#submit').attr('disabled', true);
                            }
                        }).then(data => {
                            modal.modal('hide');
                            $('#submit').attr('disabled', false)
                            table.DataTable().ajax.reload();
                            alert(data.message);
                        }).catch(errors => {
                            alert(errors.message);
                        })
                    }
                    form.submit(function (e) {
                        e.preventDefault();
                        let data = form.serialize();
                        const id = $('#id_employee').val();
                        if (id !== '') {
                            updateOrCreateData('{{ route('api.employees.update',':id') }}'.replace(':id', id), data, 'PUT');
                        } else {
                            updateOrCreateData('{{ route('api.employees.store') }}', data, 'POST');
                        }
                    });

                    modal.on('hidden.bs.modal', function () {
                        $("input[name='id_employee").val('')
                        $("input[name='nik").val('')
                        $("input[name='name").val('')
                        $("input[name='position_name").val('')
                        $("input[name='date_of_birth").val('')
                        $("input[name='place_of_birth").val('')
                        $('#unit_id').val('').trigger('change')
                    })

                    const initForm = (id) => {
                        const url = '{{route('api.employees.show',':id')}}'.replace(':id', id)
                        processData(url, "GET").then(data => {
                            $("input[name='id_employee").val(data.data.id)
                            $("input[name='nik").val(data.data.nik)
                            $("input[name='name").val(data.data.name)
                            $("input[name='position_name").val(data.data.position_name)
                            $("input[name='date_of_birth").val(data.data.date_of_birth)
                            $("input[name='place_of_birth").val(data.data.place_of_birth)
                            $('#unit_id').val(data.data.user_id).trigger('change')
                            modal.modal('show')
                        }).catch(errors => {
                            alert(errors.message);
                        })
                    }
                    $('#unit_id').select2({
                        placeholder: "Select Unit",
                        dropdownParent: "#modal-form",
                        ajax: {
                            url: "{{route('api.units.select2')}}",
                            type: "POST",
                            dataType: 'json',
                            delay: 250,
                            data: function (params) {
                                return {
                                    _token: window.CSRF_TOKEN,
                                    search: params.term
                                };
                            },
                            processResults: function (response) {
                                return {
                                    results: response
                                };
                            },
                            cache: true
                        }
                    })
                    table.dataTable({
                        ajax: {
                            "url": "{{route('api.employees.table')}}",
                            "type": "POST",
                            "headers": {
                                "X-CSRF-TOKEN": window.CSRF_TOKEN
                            }
                        },
                        columns: [
                            {data: 'DT_RowIndex', orderable: false, searchable: false},
                            {data: 'nik'},
                            {data: 'name'},
                            {data: 'unit.name', orderable: false, searchable: false},
                            {data: 'position_name'},
                            {data: 'date_of_birth'},
                            {data: 'place_of_birth'},
                            {data: 'updated_at'},
                            {data: 'created_by', orderable: false, searchable: false},
                            {data: 'action'},
                        ],
                        stateSave: true
                    }).on('click', '.btn-edit', function (event) {
                        initForm($(this).data('id'))
                    }).on('click', '.btn-delete', function (event) {
                        //TODO
                    }).wrap("<div class='table-responsive col-md-12 dragscroll'></div>");
                });


            </script>
@endsection
