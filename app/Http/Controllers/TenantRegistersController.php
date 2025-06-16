<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tenant;
use App\Models\Task;

class TenantRegistersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Tenant $tenant)
    {
        tenancy()->initialize($tenant);

        // Carga los datos como array
        $tasks = Task::all()->toArray();
        $tenantData = $tenant->toArray();

        tenancy()->end();

        // Envía solo los datos simples a la vista
        return view('registers.index', [
            'tenant' => $tenantData,
            'tasks' => $tasks,
        ]);
    }
}
