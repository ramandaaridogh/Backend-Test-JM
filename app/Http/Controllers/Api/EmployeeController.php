<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use App\Traits\HasApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Throwable;
use Yajra\DataTables\Exceptions\Exception;

class EmployeeController extends Controller
{
    use HasApiResponse;

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return $this->sendResponse(EmployeeResource::collection(Employee::with(["unit", 'editor'])->get()), 'Employees retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreEmployeeRequest $request
     * @return Response
     */

    public function store(StoreEmployeeRequest $request)
    {
        $employee = Employee::query()->create($request->validated());
        return $this->sendResponse(EmployeeResource::make($employee), 'Employee created successfully.');
    }

    /**
     * @throws Exception
     */
    public function datatables()
    {
        $employees = Employee::query()->with(['editor', 'unit'])->latest('created_at');
        return datatables($employees)
            ->addIndexColumn()
            ->addColumn('updated_at', function (Employee $employee) {
                return $employee->updated_at->diffForHumans();
            })
            ->addColumn('created_by', function (Employee $employee) {
                return $employee->editor->name ?? null;
            })
            ->addColumn('action', function ($employee) {
                return '<button data-id="' . $employee->id . '" class="btn btn-primary btn-sm btn-modal btn-edit" data-target="#modal-form"><i class="mdi mdi-pencil"></i> Edit</button>';
            })
            ->only(['nik', 'name', 'unit', 'position_name', 'date_of_birth', 'place_of_birth', 'updated_at', 'created_by', 'action'])
            ->make(true);
    }

    /**
     * Display the specified resource.
     *
     * @param Employee $employee
     * @return Response
     */

    public function show(Employee $employee): JsonResponse
    {
        return $this->sendResponse(EmployeeResource::make($employee), 'Employee created successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateEmployeeRequest $request
     * @param Employee $employee
     * @return JsonResponse
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee): JsonResponse
    {
        // dd($request->validated());
        try {
            $employee->updateOrFail($request->validated());
            return $this->sendResponse(EmployeeResource::make($employee), 'Employee updated successfully.');
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Employee $employee
     * @return Response
     */

    public function destroy(Employee $employee)
    {
        if ($employee->delete()) {
            return $this->sendResponse('', 'Employee has been deleted successfully.');
        }
        return $this->sendError('Employee could not be deleted.');
    }
}
