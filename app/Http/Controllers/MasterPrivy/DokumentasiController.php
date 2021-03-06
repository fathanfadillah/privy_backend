<?php

namespace App\Http\Controllers\MasterPrivy;

use DataTables;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Model
use App\Models\Dokumentasi;

class DokumentasiController extends Controller
{
    protected $route = 'master-privy.dokumentasi.';
    protected $view  = 'pages.masterPrivy.dokumentasi.';
    protected $title = 'Dokumentasi';
    protected $path  = '/images/';

    public function index()
    {
        $route = $this->route;
        $title = $this->title;
        $path = $this->path;
        // dd('monyet');
        // dd($route);
        return view($this->view . 'index', compact(
            'route',
            'title',
            'path'
        ));
    }

    public function api()
    {
        $dokumentasis = Dokumentasi::orderBy('updated_at','desc');
        return DataTables::of($dokumentasis)
            ->addColumn('action', function ($d) {
                return "
                <a href='#' onclick='edit(" . $d->id . ")' title='Edit Role'><i class='icon-pencil mr-1'></i></a>
                <a href='#' onclick='remove(" . $d->id . ")' class='text-danger' title='Hapus Role'><i class='icon-remove'></i></a>";
            })
            ->editColumn('icon',  function ($d) {
                if ($d->icon != null) {
                    return "<img width='50' class='img-fluid mx-auto d-block rounded-circle' alt='icon' src='" . config('app.sftp_src').$this->path . $d->icon . "'>";
                } else {
                    return "<img width='50' class='rounded img-fluid mx-auto d-block' alt='icon' src='" . asset('images/404.png') . "'>";
                }
            })
            ->addIndexColumn()
            ->rawColumns(['action', 'icon'])
            ->toJson();
            
    }

    public function store(Request $request)
    {
        // dd('tai');
        $count = Dokumentasi::count();
        if($count < 7 ){
            $request->validate([
                'title'  => 'required',
                'deskripsi'     => 'required', 
                'link'     => 'required',
                'icon' => 'required|max:2024'
            ]);
    
            $file     = $request->file('icon');
            $fileName = time() . "." . $file->getClientOriginalName();  
            // $request->file('icon')->move("images/privy/", $fileName);
            $request->file('icon')->storeAs($this->path, $fileName, 'sftp', 'public');
    
            $dokumentasis = new Dokumentasi();
            $dokumentasis->title = $request->title;
            $dokumentasis->deskripsi = $request->deskripsi;
            $dokumentasis->link = $request->link;
            $dokumentasis->icon = $fileName;
            $dokumentasis->save();
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
        $dokumentasis = Dokumentasi::findOrFail($id);
        $exist = $dokumentasis->icon;
        Storage::disk('sftp')->delete($this->path . $exist);

        // $path  = "images/privy/" . $exist;
        // \File::delete(public_path($path));

        $dokumentasis->delete();   

        return response()->json([
            'message' => 'Data ' . $this->title . ' berhasil dihapus.'
        ]);
    }

    public function edit($id)
    {
        $dokumentasis = Dokumentasi::findOrFail($id);

        return $dokumentasis;
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title'  => 'required',
            'deskripsi'     => 'required',
            'link'     => 'required'
        ]);
        
        
        $title       = $request->title;
        $deskripsi = $request->deskripsi;
        $link = $request->link;
        $icon  = $request->icon;
        
        $dokumentasis   = Dokumentasi::find($id);

        if ($request->icon != null) {
            $request->validate([
                'icon' => 'required|max:2024'
            ]);

            // Proses Saved icon
                $file     = $request->file('icon');
                $fileName = time() . "." . $file->getClientOriginalName();  
                // $request->file('icon')->move("images/privy/", $fileName);
                $request->file('icon')->storeAs($this->path , $fileName, 'sftp', 'public');
          
                $exist = $dokumentasis->icon;
                if ($exist != null) {
                    Storage::disk('sftp')->delete($this->path . $exist);
                }


            $dokumentasis->update([
                'icon' => $fileName,
                'title'=> $title,
                'deskripsi'=> $deskripsi,
                'link'=> $link,
            ]);
        }else{
            $dokumentasis->update([
                'title'=> $title,
                'deskripsi'=> $deskripsi,
                'link'=> $link,
            ]);
        }

        return response()->json([
            'message' => 'Data ' . $this->title . ' berhasil diperbaharui.'
        ]);
    }
}