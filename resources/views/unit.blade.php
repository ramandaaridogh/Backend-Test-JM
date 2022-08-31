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
                                       data-target="#modal-form"><i class="mdi mdi-plus"></i>
                                        New Data</a>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-12">
                                    <table class="table table-hover table-stripde table-bordered" id="table-data">
                                        <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Unit Name</th>
                                            <th>Status</th>
                                            <th>Last Updated Date</th>
                                            <th>Updated By</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        {{--                                        <tbody>--}}
                                        {{--                                            <tr>--}}
                                        {{--                                                <td>1</td>--}}
                                        {{--                                                <td>Information Technology Group</td>--}}
                                        {{--                                                <td><span class="badge badge-success">Active</span></td>--}}
                                        {{--                                                <td>10 December 2022, 19:08</td>--}}
                                        {{--                                                <td>Superadmin</td>--}}
                                        {{--                                                <td>--}}
                                        {{--                                                    <a href="javascript:void(0)" class="btn btn-primary btn-sm btn-modal" data-target="#modal-form"><i--}}
                                        {{--                                                            class="mdi mdi-pencil"></i> Edit</a>--}}
                                        {{--                                                </td>--}}
                                        {{--                                            </tr>--}}
                                        {{--                                            <tr>--}}
                                        {{--                                                <td>2</td>--}}
                                        {{--                                                <td>Accounting & Tax</td>--}}
                                        {{--                                                <td><span class="badge badge-danger">Inactive</span></td>--}}
                                        {{--                                                <td>4 September 2022, 19:08</td>--}}
                                        {{--                                                <td>Superadmin</td>--}}
                                        {{--                                                <td>--}}
                                        {{--                                                    <a href="javascript:void(0)" class="btn btn-primary btn-sm btn-modal" data-target="#modal-form"><i--}}
                                        {{--                                                            class="mdi mdi-pencil"></i> Edit</a>--}}
                                        {{--                                                </td>--}}
                                        {{--                                            </tr>--}}
                                        {{--                                        </tbody>--}}
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
                <form class="forms-sample" id="unit" method="POST">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add/Edit Data</h5>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id_unit" id="id_unit">
                            <div class="form-group row">
                                <label for="unit-name" class="col-sm-3 col-form-label">Unit Name</label>
                                <div class="col-sm-9">
                                    <input name="name" type="text" class="form-control" placeholder="Unit Name"
                                           id="unit-name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="status" class="col-sm-3 col-form-label">Status</label>
                                <div class="col-sm-9">
                                    <select name="status" id="status" class="form-control form-control-lg select2"
                                            style="width: 100%">
                                        <option value="0">Inactive</option>
                                        <option value="1">Active</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                            </button>
                            <button type="submit" id="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        @endsection

        @section('script')
            <script>
                const table = $('#table-data');
                const form = $('#unit');
                const modal = $('#modal-form');
                $('.btn-modal').on('click', function () {
                    modal.modal('show')
                })
                const updateOrCreateData = (url, data, method) => {
                    processData(url, method, {
                        data: data,
                        dataType: 'JSON',
                        beforeSend: function () {
                            $('#submit').attr('disabled', 'disabled');
                        }
                    }).then(data => {
                        modal.modal('hide');
                        table.DataTable().ajax.reload();
                        alert(data.message);
                    }).catch(errors => {
                        alert(errors.message);
                    })
                }
                form.submit(function (e) {
                    e.preventDefault();
                    let data = form.serialize();
                    const id = $('#id_unit').val();
                    if (id !== '') {
                        updateOrCreateData('{{ route('api.units.update',':id') }}'.replace(':id', id), data, 'PUT');
                    } else {
                        updateOrCreateData('{{ route('api.units.store') }}', data, 'POST');
                    }
                });

                modal.on('hidden.bs.modal', function () {
                    $("input[name='id_unit").val('')
                    $("input[name='name").val('')
                    $('#status').val('0').trigger('change')
                })

                const initForm = (id) => {
                    const url = '{{route('api.units.show',':id')}}'.replace(':id', id)
                    processData(url, "GET").then(data => {
                        $("input[name='id_unit").val(data.data.id)
                        $("input[name='name").val(data.data.name)
                        $('#status').val(data.data.status ? '1' : '0').trigger('change')
                        modal.modal('show')
                    }).catch(errors => {
                        alert(errors.message);
                    })
                }
                table.dataTable({
                    ajax: {
                        "url": "{{route('api.units.table')}}",
                        "type": "POST",
                        "headers": {
                            "X-CSRF-TOKEN": window.CSRF_TOKEN
                        }
                    },
                    columns: [
                        {data: 'DT_RowIndex', orderable: false, searchable: false},
                        {data: 'name'},
                        {data: 'status'},
                        {data: 'updated_at'},
                        {data: 'created_by'},
                        {data: 'action'},
                    ],
                    columnDefs: [
                        {
                            targets: [2],
                            className: "text-center",
                            mRender: (data) => {
                                const badge = data ? 'badge-success' : 'badge-danger';
                                return '<span class="badge ' + badge + ' ">Inactive</span>'
                            },
                        },
                    ],
                    stateSave: true
                }).on('click', '.btn-edit', function (event) {
                    initForm($(this).data('id'), table.api().row(this).data())
                }).on('click', '.btn-delete', function (event) {
                    //TODO
                }).wrap("<div class='table-responsive col-md-12 dragscroll'></div>");
            </script>
@endsection
