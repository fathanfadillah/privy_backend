<?php

namespace App\Http\Controllers\MasterPrivy;

use DataTables;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Model
use App\Models\UsersPrivy;

class UsersController extends Controller
{
    protected $route = 'master-privy.users.';
    protected $view  = 'pages.masterPrivy.users.';
    protected $title = 'Users';

    public function index()
    {
        $route = $this->route;
        $title = $this->title;
        // dd($route);
        return view($this->view . 'index', compact(
            'route',
            'title'
        ));
    }

    public function api()
    {
        $users = UsersPrivy::orderBy('updated_at','desc');
        return DataTables::of($users)
            ->addColumn('action', function ($u) {
                return "
                <a href='#' onclick='edit(" . $u->id . ")' title='Edit Role'><i class='icon-pencil mr-1'></i></a>
                <a href='#' onclick='remove(" . $u->id . ")' class='text-danger' title='Hapus Role'><i class='icon-remove'></i></a>";
            })
            ->addColumn('kolom_status', function($k) {
                if($k->status_login=='1'){
                    return "<i class='text-success icon-check'></i>";
                }else{
                    return "<i class='text-danger icon-remove'></i>";
                }
            })
            ->addIndexColumn()
            ->rawColumns(['action','kolom_status'])
            ->toJson();
            
    }

    public function edit($id)
    {
        $pimpinans = UsersPrivy::findOrFail($id);

        return $pimpinans;
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            // 'no_telp' => 'required',
            'status_login'     => 'required'
            //  'foto'     => 'required|mimes:png,jpg,jpeg|max:1024'         
            // 'alamat_pedagang' => 'required'
        ]);
        
        $status_login = $request->status_login;
        $users   = UsersPrivy::find($id);
        $users->update([
            'status_login'=> $status_login,
        ]);

        return response()->json([
            'message' => 'Data ' . $this->title . ' berhasil diperbaharui.'
        ]);
    }
}