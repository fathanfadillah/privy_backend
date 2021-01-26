<?php

namespace App\Http\Controllers\MasterPrivy;

use DataTables;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Model
use App\Models\Enterprise;

class EnterpriseController extends Controller
{
    protected $route = 'master-privy.enterprise.';
    protected $view  = 'pages.masterPrivy.enterprise.';
    protected $title = 'Enterprise';
    protected $path  = '/images/';

    public function index()
    {
        $route = $this->route;
        $title = $this->title;
        $path = $this->path;
        return view($this->view . 'index', compact(
            'route',
            'title',
            'path'
        ));
    }

    public function api()
    {
        $enterprise = Enterprise::orderBy('updated_at','desc');
        return DataTables::of($enterprise)
            ->addColumn('action', function ($e) {
                return "
                <a href='#' onclick='edit(" . $e->id . ")' title='Edit Role'><i class='icon-pencil mr-1'></i></a>
                <a href='#' onclick='remove(" . $e->id . ")' class='text-danger' title='Hapus Role'><i class='icon-remove'></i></a>";
            })
            ->editColumn('foto',  function ($e) {
                if ($e->foto != null) {
                    return "<img width='50' class='img-fluid mx-auto d-block rounded-circle' alt='foto' src='" . config('app.sftp_src'). $this->path . $e->foto . "'>";
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
        $count = Enterprise::count();
        $request->validate([
            'title'  => 'required',
            'deskripsi'     => 'required',
             'foto'     => 'required|mimes:png,jpg,jpeg|max:1024'         
         ]);
        if($count < 10){
            $file     = $request->file('foto');
            $fileName = time() . "." . $file->getClientOriginalName();  
            // $request->file('foto')->move("images/privy/", $fileName);
            $request->file('foto')->storeAs($this->path, $fileName, 'sftp', 'public');
    
            $enterprises = new Enterprise();
            $enterprises->title = $request->title;
            $enterprises->deskripsi = $request->deskripsi;
            $enterprises->foto = $fileName;
            $enterprises->save();
            $status = ' berhasil tersimpan.';    
            $code = 200;
        }else{
            $status = ' sudah penuh.';
            $code = 507;
        }      
        
        $responses = response()->json([
            'message' => 'Data ' . $this->title . $status,
        ],$code);

        return $responses;
    }

    public function destroy($id)
    {
        $enterprises = Enterprise::findOrFail($id);

        // Proses Delete Foto
        $exist = $enterprises->foto;
        // $path  = "images/privy/" . $exist;
        // \File::delete(public_path($path));
        Storage::disk('sftp')->delete($this->path . $exist);

        // delete from table admin_details
        $enterprises->delete();   

        return response()->json([
            'message' => 'Data ' . $this->title . ' berhasil dihapus.'
        ]);
    }

    public function edit($id)
    {
        $enterprises = Enterprise::findOrFail($id);

        return $enterprises;
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
        $foto  = $request->foto;
        
        $enterprises   = Enterprise::find($id);

        if ($request->foto != null) {
            $request->validate([
                'foto' => 'required|mimes:png,jpg,jpeg|max:2024'
            ]);

            // Proses Saved Foto
                $file     = $request->file('foto');
                $fileName = time() . "." . $file->getClientOriginalName();  
                // $request->file('foto')->move("images/privy/", $fileName);
                $request->file('foto')->storeAs($this->path, $fileName, 'sftp','public');
          
            $exist = $enterprises->foto;
            if($exist != null){
                Storage::disk('sftp')->delete($this->path.$exist);
            }    

            $enterprises->update([
                'foto' => $fileName,
                'title'=> $title,
                'deskripsi'=> $deskripsi,
            ]);
        }else{
            $enterprises->update([
              'title'=> $title,
                'deskripsi'=> $deskripsi,
            ]);
        }

        return response()->json([
            'message' => 'Data ' . $this->title . ' berhasil diperbaharui.'
        ]);
    }
}