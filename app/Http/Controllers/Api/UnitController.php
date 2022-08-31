<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUnitRequest;
use App\Http\Requests\UpdateUnitRequest;
use App\Http\Resources\UnitResource;
use App\Models\Unit;
use App\Traits\HasApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;
use Yajra\DataTables\Exceptions\Exception;

class UnitController extends Controller
{
    use HasApiResponse;

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->sendResponse(UnitResource::collection(Unit::all()), 'Units retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUnitRequest $request
     * @return JsonResponse
     */
    public function store(StoreUnitRequest $request): JsonResponse
    {
        $unit = Unit::query()->create($request->validated());
        return $this->sendResponse(UnitResource::make($unit), 'Unit created successfully.');
    }

    /**
     * @throws Exception
     */
    public function datatables()
    {
        $units = Unit::query()->with('editor');
        return datatables($units)
            ->addIndexColumn()
            ->addColumn('updated_at', function (Unit $unit) {
                return $unit->updated_at->diffForHumans();
            })
            ->addColumn('created_by', function (Unit $unit) {
                return $unit->editor->name ?? null;
            })
            ->addColumn('action', function ($unit) {
                return '<button data-id="' . $unit->id . '" class="btn btn-primary btn-sm btn-modal btn-edit" data-target="#modal-form"><i class="mdi mdi-pencil"></i> Edit</button>';
            })
            ->only(['name', 'status', 'updated_at', 'created_by', 'action'])
            ->make(true);
    }

    public function select2(Request $request)
    {
        return response()->json(
            Unit::query()
                ->where('status', '=', true)
                ->when($request->search, fn($builder) => $builder->where('name', 'like', "%" . trim($request->search) . "%"))
                ->limit(5)
                ->pluck('name', 'id')
                ->map(fn($value, $key) => array('id' => $key, 'text' => $value))
                ->values()
        );
    }

    /**
     * Display the specified resource.
     *
     * @param Unit $unit
     * @return JsonResponse
     */
    public function show(Unit $unit): JsonResponse
    {
        return $this->sendResponse(UnitResource::make($unit), 'Unit created successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUnitRequest $request
     * @param Unit $unit
     * @return JsonResponse
     */
    public function update(UpdateUnitRequest $request, Unit $unit): JsonResponse
    {
        try {
            $unit->updateOrFail($request->validated());
            return $this->sendResponse(UnitResource::make($unit), 'Unit updated successfully.');
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Unit $unit
     * @return JsonResponse
     */
    public function destroy(Unit $unit): JsonResponse
    {
        if ($unit->delete()) {
            return $this->sendResponse('', 'Unit has been deleted successfully.');
        }
        return $this->sendError('Unit could not be deleted.');

    }
}
