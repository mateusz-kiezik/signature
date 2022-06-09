<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class DepartmentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = Department::all();
            return DataTables::collection($model)->toJson();
        }
        return view('pages.departments.index');
    }

    public function create(): View
    {
        return view('pages.departments.create');
    }

    public function store(Request $request)
    {
        try {
            Department::create([
                'short' => $request['short'],
                'name' => $request['name'],
                'legal_form' => $request['legal_form'],
                'street' => $request['street'],
                'postal_code' => $request['postal_code'],
                'city' => $request['city'],
                'country' => $request['country'],
                'vat_id' => $request['vat_id'],
                'regon' => $request['regon'],
                'krs' => $request['krs'],
                'aeo' => $request['aeo'],
                'fmc' => $request['fmc'],
                'phone' => $request['phone']
            ]);
            Alert::success('Success', 'New department created successfully');
            return redirect()->route('departments.index');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('departments.index');
        }
    }
}
