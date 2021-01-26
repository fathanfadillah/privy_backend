<?php

namespace App\Http\Controllers\MasterPrivy;

use DataTables;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Model
use App\Models\Liputan;

class LiputanController extends Controller
{
    protected $route = 'master-privy.liputan.';
    protected $view  = 'pages.masterPrivy.liputan.';
    protected $title = 'liputan';
    protected $path  = '/images/';
    

    public function index()
    {
        $route = $this->route;
        $title = $this->title;
        $path = $this->path;
        // dd($route);
        return view($this->view . 'index', compact(
            'route',
            'title',
            'path'
        ));
    }

    public function api()
    {
        $liputans = Liputan::orderBy('updated_at','desc');
        return DataTables::of($liputans)
            ->addColumn('action', function ($p) {
                return "
                <a href='#' onclick='edit(" . $p->id . ")' title='Edit Role'><i class='icon-pencil mr-1'></i></a>
                <a href='#' onclick='remove(" . $p->id . ")' class='text-danger' title='Hapus Role'><i class='icon-remove'></i></a>";
            })
            ->editColumn('foto',  function ($p) {
                if ($p->foto != null) {
                    return "<img width='50' class='img-fluid mx-auto d-block rounded-circle' alt='foto' src='" . config('app.sftp_src').$this->path . $p->foto . "'>";
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
        $count = Liputan::count();
        if($count < 13){
            $request->validate([
                // 'no_telp' => 'required',
                'foto'     => 'required|mimes:png,jpg,jpeg|max:1024'         
                // 'alamat_pedagang' => 'required'
            ]);
    
                    $file     = $request->file('foto');
            $fileName = time() . "." . $file->getClientOriginalName();  
            // $request->file('foto')->move("images/privy/", $fileName);
            $request->file('foto')->storeAs($this->path, $fileName,'sftp','public');
    
            $liputans = new Liputan();
            // $pedagang->nm_pedagang     = $request->nm_pedagang;
            // $pedagang->alamat_pedagang = $request->alamat_pedagang;
            // $pedagang->no_ktp = $request->no_ktp;
            // $pedagang->no_telp = $request->no_telp;
           
            $liputans->foto = $fileName;
            $liputans->save();
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
        $liputans = Liputan::findOrFail($id);

        // Proses Delete Foto
        $exist = $liputans->foto;
        // $path  = "images/privy/" . $exist;
        // \File::delete(public_path($path));
        Storage::disk('sftp')->delete($this->path . $exist);
        
        // delete from table admin_details
        $liputans->delete();   

        return response()->json([
            'message' => 'Data ' . $this->title . ' berhasil dihapus.'
        ]);
    }

    public function edit($id)
    {
        $liputans = liputan::findOrFail($id);

        return $liputans;
    }

    public function update(Request $request, $id)
    {
        $foto  = $request->foto;
        $liputans   = Liputan::find($id);

        if ($request->foto != null) {
            $request->validate([
                'foto' => 'required|mimes:png,jpg,jpeg|max:2024'
            ]);

            // Proses Saved Foto
                $file     = $request->file('foto');
                $fileName = time() . "." . $file->getClientOriginalName();  
                // $request->file('foto')->move("images/privy/", $fileName);
                $request->file('foto')->storeAs($this->path, $fileName,'sftp','public');
          
                $exist = $liputans->foto;
            if ($exist != null) {
                Storage::disk('sftp')->delete($this->path . $exist);
            }
            $liputans->update([
                'foto'=> $fileName
            ]);
        }

        return response()->json([
            'message' => 'Data ' . $this->title . ' berhasil diperbaharui.'
        ]);
    }
}