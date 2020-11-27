<?php

namespace App\Http\Controllers\MasterPrivy;

use DataTables;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Model
use App\Models\Verifikasi;

class VerifikasiController extends Controller
{
    protected $route = 'master-privy.verifikasiPDF.';
    protected $view  = 'pages.masterPrivy.verifikasiPDF.';
    protected $title = 'Verifikasi PDF';
    protected $path  = '/files/';
    

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
        $verifikasis = Verifikasi::orderBy('updated_at','desc');
        return DataTables::of($verifikasis)
            ->addColumn('action', function ($v) {   
                return "
                <a href='#' onclick='remove(" . $v->id . ")' class='text-danger' title='Hapus Role'><i class='icon-remove'></i></a>";
            })
            ->editColumn('file',  function ($v) {
                if ($v->file != null) {
                    return "<img width='50' class='img-fluid mx-auto d-block' alt='foto' src='" . asset('images/pdf_icon.png') . "'>"."<a href='".config('app.sftp_src').$this->path.$v->file."'>$v->file</a>";
                } else {
                    return "<img width='50' class='rounded img-fluid mx-auto d-block' alt='foto' src='" . asset('images/404.png') . "'>";
                }
                // return "<a href='".asset('files/privy/'.$v->file)."'>$v->file</a>";
            })
            ->addIndexColumn()
            ->rawColumns(['action', 'file'])
            ->toJson();
            
    }

    

    public function destroy($id)
    {
        $verifikasis = Verifikasi::findOrFail($id);

        // Proses Delete Foto
        $exist = $verifikasis->foto;
        // $path  = "images/privy/" . $exist;
        // \File::delete(public_path($path));
        Storage::disk('sftp')->delete($this->path . $exist);
        // delete from table admin_details
        $verifikasis->delete();   

        return response()->json([
            'message' => 'Data ' . $this->title . ' berhasil dihapus.'
        ]);
    }
  
}