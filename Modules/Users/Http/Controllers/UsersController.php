<?php

namespace Modules\Users\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Modules\Users\Entities\Users;
use Yajra\DataTables\DataTables;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Users::where([
                ['deleted', '=', $request->deleted],
                ['role', '!=', 'developer'],
            ])
                ->orderBy('name', 'ASC')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    if ($row->deleted == 0) {

                        $btn = '
                            <button type="button" class="btn btn-info btn-sm" id="detail" data="' . $row->id . '">
                                <span class="fa fa-eye"></span>
                            </button>
                            <button type="button" class="btn btn-secondary btn-sm" id="ubah" data="' . $row->id . '">
                                <span class="fa fa-edit"></span>
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" id="hapus" data="' . $row->id . '">
                                <span class="fa fa-trash"></span>
                            </button>
                    ';
                    } else {
                        $btn = '
                            <button type="button" class="btn btn-secondary btn-sm" id="restore" data="' . $row->id . '">
                                <span class="fa fa-recycle"></span>
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" id="destroy" data="' . $row->id . '">
                                <span class="fa fa-times"></span>
                            </button>
                    ';
                    }

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('users::index');
    }

    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'name'     => 'required|min:5',
            'username' => 'required|min:5|unique:users',
            'password' => 'required|min:5|max:255',
            'role'     => 'required',
        ]);

        if ($validasi->fails()) {
            return response()->json(Config::get('app.swalError'));
        } else {
            Users::create([
                'name'       => $request->name,
                'username'   => $request->username,
                'password'   => Hash::make($request->password),
                'role'       => $request->role,
                'created_by' => Auth::user()->name,
                'updated_by' => Auth::user()->name,
            ]);

            return response()->json(Config::get('app.swalSuccess'));
        }
    }

    public function show(Request $request)
    {
        $row = Users::findOrFail($request->id);

        $data = response()->json([
            'id'       => $row->id,
            'name'     => $row->name,
            'username' => $row->username,
            'role'     => $row->role,
        ]);

        return $data;
    }

    public function update(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'name'     => 'required|min:5',
            'role'     => 'required',
        ]);

        if ($validasi->fails()) {
            return response()->json(Config::get('app.swalError'));
        } else {

            $user = Users::findOrFail($request->id);
            $cek = Users::where([
                ['id', '!=', $request->id],
                ['username', '=', $request->username]
            ])->count();

            if ($cek == 0) {
                $user->update([
                    'name'       => $request->name,
                    'username'   => $request->username,
                    'role'       => $request->role,
                    'created_by' => Auth::user()->name,
                    'updated_by' => Auth::user()->name,
                ]);

                return response()->json(Config::get('app.swalUpdate'));
            } else {
                return response()->json(Config::get('app.swalErrUsername'));
            }
        }
    }

    public function recycle(Request $request)
    {
        Users::where(['id' => $request->id])->update([
            'deleted' => $request->deleted
        ]);

        if ($request->deleted == 1) return response()->json(Config::get('app.swalDelete'));
        else return response()->json(Config::get('app.swalRestore'));
    }

    public function destroy(Request $request)
    {
        Users::where(['id' => $request->id])->delete();

        return response()->json(Config::get('app.swalDelete'));
    }
}
