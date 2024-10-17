<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Interfaces\CaptainRepositoryInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CaptainController extends BaseController
{
    public function __construct(
        private CaptainRepositoryInterface $captainRepository,
    )
    {
        $this->middleware('permission:captains-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:captains-create', ['only' => ['store']]);
        $this->middleware('permission:captains-edit', ['only' => ['edit', 'update','change']]);
        $this->middleware('permission:captains-delete', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.users.captains.index');
    }

    public function list(): JsonResponse
    {
        $data = $this->captainRepository->webList();
        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('name', function ($row) {
                $link = route('users.captains.show', $row->id);
                if (auth()->user()->can('captains-list')) {
                $url = "<a href='{$link}'>{$row->name}</a>";
                } else {
                    $url =  "<p>{$row->name}</p>";
                }
                return $url;
            })
            ->addColumn('action', function ($row) {
                return view('pages.users.captains.actions', compact('row'));
            })->editColumn('status', function ($row) {
                return view('pages.users.captains.status', compact('row'));
            })
            ->rawColumns(['action', 'status', 'name'])
            ->make(true);
    }


    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id): RedirectResponse | View
    {
        $captain = $this->captainRepository->captainDetail($id);
        return view('pages.users.captains.show', compact('captain'));
    }

}
