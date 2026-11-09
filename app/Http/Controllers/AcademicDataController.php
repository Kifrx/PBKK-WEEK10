<?php

namespace App\Http\Controllers;

use App\Models\Departemen;
use App\Models\Dosen;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\ForeignKeyConstraintViolationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AcademicDataController extends Controller
{
    public function index(Request $request): View
    {
        $module = $request->route('module');
        $definition = config("academic.{$module}");
        $model = $definition['model'];
        $fields = $definition['fields'];
        $hasDepartment = isset($fields['departemen_id']);

        $filters = $request->validate([
            'q' => ['nullable', 'string', 'max:100'],
            'departemen_id' => ['nullable', 'integer', 'exists:departemens,id'],
            'is_active' => ['nullable', 'in:0,1'],
        ]);

        $keyword = trim($filters['q'] ?? '');
        $department = $filters['departemen_id'] ?? null;
        $active = $filters['is_active'] ?? null;
        $relations = array_values(array_intersect_key([
            'departemen_id' => 'departemen',
            'dosen_id' => 'dosen',
        ], $fields));

        $records = $model::with($relations)
            ->when($keyword !== '', function (Builder $query) use ($definition, $keyword) {
                $query->where(function (Builder $search) use ($definition, $keyword) {
                    foreach ($definition['search'] as $column) {
                        $search->orWhere($column, 'like', "%{$keyword}%");
                    }
                });
            })
            ->when($hasDepartment && $department !== null, fn (Builder $query) => $query->where('departemen_id', $department))
            ->when($module === 'mahasiswa' && $active !== null, fn (Builder $query) => $query->where('is_active', $active))
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        $departments = $hasDepartment ? Departemen::orderBy('nama')->pluck('nama', 'id') : collect();

        return view('academic.index', compact('module', 'definition', 'records', 'departments', 'filters', 'hasDepartment'));
    }

    public function create(Request $request): View
    {
        return $this->form($request->route('module'));
    }

    public function store(Request $request): RedirectResponse
    {
        $module = $request->route('module');
        $model = config("academic.{$module}.model");
        $model::create($this->validated($request, $module));

        return to_route("admin.{$module}.index")->with('status', 'Data berhasil ditambahkan.');
    }

    public function edit(Request $request, int $record): View
    {
        $module = $request->route('module');

        return $this->form($module, $this->record($module, $record));
    }

    public function update(Request $request, int $record): RedirectResponse
    {
        $module = $request->route('module');
        $model = $this->record($module, $record);
        $model->update($this->validated($request, $module, $model));

        return to_route("admin.{$module}.index")->with('status', 'Data berhasil diperbarui.');
    }

    public function destroy(Request $request, int $record): RedirectResponse
    {
        $module = $request->route('module');

        try {
            $this->record($module, $record)->delete();
        } catch (ForeignKeyConstraintViolationException) {
            return to_route("admin.{$module}.index")->withErrors(['delete' => 'Data masih digunakan oleh data akademik lain.']);
        }

        return to_route("admin.{$module}.index")->with('status', 'Data berhasil dihapus.');
    }

    private function record(string $module, int $id): Model
    {
        $model = config("academic.{$module}.model");

        return $model::findOrFail($id);
    }

    private function form(string $module, ?Model $record = null): View
    {
        $definition = config("academic.{$module}");
        $fields = $definition['fields'];
        $options = ['is_active' => [1 => 'Aktif', 0 => $module === 'mahasiswa' ? 'Cuti' : 'Nonaktif']];

        if (isset($fields['departemen_id'])) {
            $options['departemen_id'] = Departemen::orderBy('nama')->pluck('nama', 'id');
        }

        if (isset($fields['dosen_id'])) {
            $options['dosen_id'] = Dosen::orderBy('nama')->pluck('nama', 'id');
        }

        return view('academic.form', compact('module', 'definition', 'record', 'options'));
    }

    private function validated(Request $request, string $module, ?Model $record = null): array
    {
        $model = config("academic.{$module}.model");
        $table = (new $model)->getTable();
        $rules = [];

        foreach (array_keys(config("academic.{$module}.fields")) as $field) {
            $rules[$field] = match ($field) {
                'kode', 'nrp', 'nip' => ['required', 'string', 'max:30', Rule::unique($table, $field)->ignore($record?->getKey())],
                'email' => ['required', 'email', 'max:255', Rule::unique($table, $field)->ignore($record?->getKey())],
                'departemen_id' => ['required', 'integer', 'exists:departemens,id'],
                'dosen_id' => ['required', 'integer', 'exists:dosens,id'],
                'deadline' => ['required', 'date_format:Y-m-d'],
                'is_active' => ['required', 'boolean'],
                'deskripsi' => ['nullable', 'string', 'max:10000'],
                default => ['required', 'string', 'max:255'],
            };
        }

        return $request->validate($rules, [], config("academic.{$module}.fields"));
    }
}
