<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Js;

abstract class BaseController extends Controller
{
    protected $resource;
    protected $model;
    public function __construct($model, $resource)
    {
        $this->model = $model;
        $this->resource = $resource;
    }

    abstract protected function indexRelations(): array;
    abstract protected function showRelations(): array;
    abstract protected function editRelations(): array;

    public function index(Request $request): JsonResource
    {
        $filters = $request->query() ?? [];

        $paginatePerPage = $filters['items_per_page'] ?? 10;

        /** @var \Illuminate\Database\Eloquent\Builder */
        $query = $this->model::query();

        $query->with($this->indexRelations());

        if (isset($filters["search"])) {
            $query->where('name', 'LIKE', "%{$filters["search"]}%");
        }

        $items = $query->paginate($paginatePerPage);

        return $this->resource::collection($items);
    }

    // Método para mostrar un recurso en específico (GET /{id})
    public function show(Request $request, $id)
    {
        $item = $this->find($id);

        return new $this->resource($item);
    }

    public function store(Request $request)
    {
        $data = $this->storeValidationRules($request);

        $item = $this->create($data);

        return new $this->resource($item);
    }

    public function update(Request $request, $id)
    {
        $data = $this->updateValidationRules(
            $request
        );

        $item = $this->updateItem($id, $data);

        return new $this->resource($item);
    }

    public function destroy($id)
    {
        $this->delete($id);

        return response()->json(['data' => 'El recurso ha sido eliminado']);
    }

    public  function create($data)
    {
        return $this->model::create($data);
    }

    public function delete($id)
    {
        $resource = $this->model::find($id);

        if (!$resource) {
            return response()->json(['message' => 'Resource not found'], 404);
        }

        $resource->delete();

        return response()->json(['message' => 'Resource deleted successfully']);
    }

    public function updateItem($id, array $data)
    {
        $resource = $this->model::find($id);

        if (!$resource) {
            return response()->json(['data' => 'El recurso no se ha encontrado'], 404);
        }

        $item = $resource->update($data);

        return $item;
    }

    public function find($id, array $queryOptions = [])
    {

        $query = $this->model::with($this->showRelations());

        if (count($queryOptions)) {
            foreach ($queryOptions as $key => $value) {
                $query->where($key, $value);
            }
        }

        $item = $query->find($id);

        if (!$item) {
            return response()->json(['message' => 'Resource not found'], 404);
        }

        return $item;
    }

    abstract protected function storeValidationRules(Request $request);
    abstract protected function updateValidationRules(Request $request);
}