<?php

namespace App\Http\Controllers;

use App\Models\Priority;
use App\Models\Statu;
use App\Models\Type;
use Illuminate\Http\Request;

class DatatableController extends Controller
{
    public function priority()
    {
        $priorities = Priority::select('id', 'description', 'status', 'created_at', 'updated_at')->get();

        return datatables()->of($priorities)->toJson();
    }

    public function status()
    {
        $status = Statu::select('id', 'description', 'status', 'created_at', 'updated_at')->get();

        return datatables()->of($status)->toJson();
    }

    public function type()
    {
        $types = Type::select('id', 'description', 'status', 'created_at', 'updated_at')->get();

        return datatables()->of($types)->toJson();
    }
}
