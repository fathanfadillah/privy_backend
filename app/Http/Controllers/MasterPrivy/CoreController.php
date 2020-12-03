<?php

namespace App\Http\Controllers\MasterPrivy;

use DataTables;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Model
use App\Models\Core;

class CoreController extends Controller
{
    protected $route = 'master-privy.core.';
    protected $view  = 'pages.masterPrivy.core.';
    protected $title = 'Core';
    protected $path  = '/images/';

    public function index()
    {
        $route = $this->route;
        $title = $this->title;
        $path = $this->path;
        // dd(Core::count());
        return view($this->view . 'index', compact(
            'route',
            'title',
            'path'
        ));
    }

    public function api()
    {
        $cores = Core::orderBy('updated_at','desc');
        return DataTables::of($cores)
            ->addColumn('action', function ($c) {
                return "
                <a href='#' onclick='edit(" . $c->id . ")' title='Edit Role'><i class='icon-pencil mr-1'></i></a>
                <a href='#' onclick='remove(" . $c->id . ")' class='text-danger' title='Hapus Role'><i class='icon-remove'></i></a>";
            })
            ->editColumn('foto',  function ($c) {
                if ($c->foto != null) {
                    return "<img width='50' class='img-fluid mx-auto d-block rounded-circle' alt='foto' src='" . config('app.sftp_src').$this->path . $c->foto . "'>";
                } else {
                    return "<img width='50' class='rounded img-fluid mx-auto d-block' alt='foto' src='" . asset('images/404.png') . "'>";
                }
            })
            ->addIndexColumn()
            ->rawColumns(['action', 'foto'])
            ->toJson();
            
    }

    public function store(Request $request)
    {
        $count = Core::count();
        if($count < 4){
            $request->validate([
                'title'  => 'required',
                'deskripsi'     => 'required',
                 'foto'     => 'required|mimes:png,jpg,jpeg,svg|max:1024'         
             ]);
    
            $file     = $request->file('foto');
            $fileName = time() . "." . $file->getClientOriginalName();  
            // $request->file('foto')->move("images/privy/", $fileName);
            $request->file('foto')->storeAs($this->path, $fileName, 'sftp', 'public');
    
            $cores = new Core();
            $cores->title = $request->title;
            $cores->deskripsi = $request->deskripsi;
            $cores->foto = $fileName;
            $cores->save();    
            $status = ' berhasil tersimpan.';
            $code = 200;
        }else{
            $status = ' sudah penuh.';
            $code = 507;
        }               

        return response()->json([
            'message' => 'Data ' . $this->title . $status
        ],$code);
    }

    public function destroy($id)
    {
        $cores = Core::findOrFail($id);

        // Proses Delete Foto
        $exist = $cores->foto;
        // $path  = "images/privy/" . $exist;
        // \File::delete(public_path($path));
        Storage::disk('sftp')->delete($this->path . $exist);
        // delete from table admin_details
        $cores->delete();   

        return response()->json([
            'message' => 'Data ' . $this->title . ' berhasil dihapus.'
        ]);
    }

    public function edit($id)
    {
        $cores = Core::findOrFail($id);

        return $cores;
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            // 'no_telp' => 'required',
            'title'  => 'required',
            'deskripsi'     => 'required'
            //  'foto'     => 'required|mimes:png,jpg,jpeg|max:1024'         
            // 'alamat_pedagang' => 'required'
        ]);
        
        
        $title       = $request->title;
        $deskripsi = $request->deskripsi;
        
        $cores   = Core::find($id);

        if ($request->foto != null) {
            $request->validate([
                'foto'     => 'required|mimes:png,jpg,jpeg,svg|max:1024'         
         ]);

            // Proses Saved Foto
                $file     = $request->file('foto');
                $fileName = time() . "." . $file->getClientOriginalName();  
                $request->file('foto')->storeAs($this->path , $fileName, 'sftp', 'public');

                $exist = $cores->foto;
                if ($exist != null) {
                    Storage::disk('sftp')->delete($this->path . $exist);
                }
          
            $cores->update([
                'foto' => $fileName,
                'title'=> $title,
                'deskripsi'=> $deskripsi,
            ]);
        }else{
            $cores->update([
              'title'=> $title,
                'deskripsi'=> $deskripsi,
            ]);
        }

        return response()->json([
            'message' => 'Data ' . $this->title . ' berhasil diperbaharui.'
        ]);
    }
}