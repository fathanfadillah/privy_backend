<?php

namespace App\Http\Controllers\MasterPrivy;

use DataTables;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Model
use App\Models\Entrepreneur;

class EntrepreneurController extends Controller
{
    protected $route = 'master-privy.entrepreneur.';
    protected $view  = 'pages.masterPrivy.entrepreneur.';
    protected $title = 'Entrepreneur';
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
        $entrepreneurs = Entrepreneur::orderBy('updated_at','desc');
        return DataTables::of($entrepreneurs)
            ->addColumn('action', function ($en) {
                return "
                <a href='#' onclick='edit(" . $en->id . ")' title='Edit Role'><i class='icon-pencil mr-1'></i></a>
                <a href='#' onclick='remove(" . $en->id . ")' class='text-danger' title='Hapus Role'><i class='icon-remove'></i></a>";
            })
            ->editColumn('foto',  function ($en) {
                if ($en->foto != null) {
                    return "<img width='50' class='img-fluid mx-auto d-block rounded-circle' alt='foto' src='" . config('app.sftp_src').$this->path . $en->foto . "'>";
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
        $request->validate([
            'deskripsi'     => 'required',
             'foto'     => 'required|mimes:png,jpg,jpeg|max:1024'         
         ]);

        $file     = $request->file('foto');
        $fileName = time() . "." . $file->getClientOriginalName();  
        // $request->file('foto')->move("images/privy/", $fileName);
        $request->file('foto')->storeAs($this->path, $fileName, 'sftp', 'public');

        $entrepreneurs = new Entrepreneur();
        $entrepreneurs->deskripsi = $request->deskripsi;
        $entrepreneurs->foto = $fileName;
        $entrepreneurs->save();
                

        return response()->json([
            'message' => 'Data ' . $this->title . ' berhasil tersimpan.'
        ]);
    }

    public function destroy($id)
    {
        $entrepreneurs = Entrepreneur::findOrFail($id);

        // Proses Delete Foto
        $exist = $entrepreneurs->foto;
        // $path  = "images/privy/" . $exist;
        // \File::delete(public_path($path));
        Storage::disk('sftp')->delete($this->path . $exist);
        
        // delete from table admin_details
        $entrepreneurs->delete();   

        return response()->json([
            'message' => 'Data ' . $this->title . ' berhasil dihapus.'
        ]);
    }

    public function edit($id)
    {
        $entrepreneurs = Entrepreneur::findOrFail($id);

        return $entrepreneurs;
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            // 'no_telp' => 'required',
            'deskripsi'     => 'required'
            //  'foto'     => 'required|mimes:png,jpg,jpeg|max:1024'         
            // 'alamat_pedagang' => 'required'
        ]);
               
        $deskripsi = $request->deskripsi;
        $foto  = $request->foto;
        
        $entrepreneurs   = Entrepreneur::find($id);

        if ($request->foto != null) {
            $request->validate([
                'foto' => 'required|mimes:png,jpg,jpeg|max:2024'
            ]);

            // Proses Saved Foto
                $file     = $request->file('foto');
                $fileName = time() . "." . $file->getClientOriginalName();  
                $request->file('foto')->storeAs($this->path, $fileName, 'sftp', 'public');

            $exist = $entrepreneurs->foto;
            if ($exist != null) {
                Storage::disk('sftp')->delete($this->path . $exist);
            }
          
            $entrepreneurs->update([
                'foto' => $fileName,
                'deskripsi'=> $deskripsi,
            ]);
        }else{
            $entrepreneurs->update([
                'deskripsi'=> $deskripsi,
            ]);
        }

        return response()->json([
            'message' => 'Data ' . $this->title . ' berhasil diperbaharui.'
        ]);
    }
}