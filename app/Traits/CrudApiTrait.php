<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

trait CrudApiTrait
{
    /**
     * Create a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = $this->validateRequest($request);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message'   => 'Invalid Request Data',
                'errors' => $validator->errors(),
            ], 422);
        }

        if ($request->employee_id != null && auth()->user()->id != $request->employee_id) {
            return response()->json([
                'status' => 'error',
                'message'   => 'Invalid employee_id',
                'errors' => $validator->errors(),
            ], 422);
        }

        $insert = $request->all();

        $model = $this->model::create($insert);

        return response()->json([
            'status' => 'success',
            'message' => 'Resource created successfully!',
            'data' => $model,
        ], 201);
    }

    /**
     * Retrieve all resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $data = $this->model::orderBy('created_at', $request->sort ?? 'desc')
            ->get();
        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }

    /**
     * Retrieve a specific resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $model = $this->model::find($id);

        if (!$model) {
            return response()->json(['status' => 'error', 'message' => 'Resource not found'], 404);
        }

        return response()->json(['status' => 'success', 'data' => $model]);
    }

    /**
     * Update a specific resource.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        
        $validator = $this->validateRequest($request, $id);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $model = $this->model::find($id);

        if (!$model) {
            return response()->json(['status' => 'error', 'message' => 'Resource not found'], 404);
        }

        $model->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Resource updated successfully!',
            'data' => $model,
        ]);
    }

    /**
     * Delete a specific resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $model = $this->model::find($id);

        if (!$model) {
            return response()->json(['status' => 'error', 'message' => 'Resource not found'], 404);
        }

        $model->delete();

        return response()->json(['status' => 'success', 'message' => 'Resource deleted successfully!']);
    }

    /**
     * Validate the incoming request.
     *
     * @param Request $request
     * @param int|null $id
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validateRequest(Request $request, $id = null)
    {
        if (method_exists((new $this->model), "rules")) {
            $rules = (new $this->model)->rules();
        } else {
            $rules = (new $this->model)->rules ?? [];
        }

        return Validator::make($request->all(), $rules);
    }
}
