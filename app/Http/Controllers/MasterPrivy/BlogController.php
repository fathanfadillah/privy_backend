<?php

namespace App\Http\Controllers\MasterPrivy;

use DataTables;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Model
use App\Models\Blog;
use App\Models\BlogKategori;

class BlogController extends Controller
{
    protected $route = 'master-privy.blog.';
    protected $view  = 'pages.masterPrivy.blog.';
    protected $title = 'Blog';
    protected $path  = '/images/';

    public function index()
    {
        $route = $this->route;
        $title = $this->title;
        $path = $this->path;
        // data kategori
        $blog_kategoris = BlogKategori::all();
        return view($this->view . 'index', compact(
            'route',
            'title',
            'path',
            'blog_kategoris'
        ));
    }

    public function api()
    {
        $blogs = Blog::orderBy('updated_at','desc');
        return DataTables::of($blogs)
            ->addColumn('pembukaan', function ($p) {
                return $p->pembukaan;
            })
            ->addColumn('isi', function ($i) {
                return $i->isi;
            })
            ->addColumn('action', function ($b) {
                return "
                <a href='#' onclick='edit(" . $b->id . ")' title='Edit Role'><i class='icon-pencil mr-1'></i></a>
                <a href='#' onclick='remove(" . $b->id . ")' class='text-danger' title='Hapus Role'><i class='icon-remove'></i></a>";
            })
            ->editColumn('foto',  function ($b) {
                if ($b->foto != null) {
                    return "<img width='50' class='img-fluid mx-auto d-block rounded-circle' alt='foto' src='" . config('app.sftp_src').$this->path . $b->foto . "'>";
                } else {
                    return "<img width='50' class='rounded img-fluid mx-auto d-block' alt='foto' src='" . asset('images/404.png') . "'>";
                }
            })
            ->addIndexColumn()
            ->rawColumns(['action', 'foto','pembukaan','isi'])
            ->toJson();
            
    }

    public function store(Request $request)
    {
        $count = Blog::count();
            $request->validate([
                // 'no_telp' => 'required',
                'judul'  => 'required',
                'kategori'  => 'required',
                'tanggal_terbit'     => 'required',
                'pembukaan'  => 'required',
                'isi'     => 'required',
                'foto'     => 'required|mimes:png,jpg,jpeg|max:1024'
                //  'foto'     => 'required|mimes:png,jpg,jpeg|max:1024'         
                // 'alamat_pedagang' => 'required'
            ]);
    
            $file     = $request->file('foto');
            $fileName = time() . "." . $file->getClientOriginalName();  
            // $request->file('foto')->move("images/privy/", $fileName);
            $request->file('foto')->storeAs($this->path, $fileName, 'sftp', 'public');
    
    
            $blogs = new Blog();
            // $pedagang->nm_pedagang     = $request->nm_pedagang;
            // $pedagang->alamat_pedagang = $request->alamat_pedagang;
            // $pedagang->no_ktp = $request->no_ktp;
            // $pedagang->no_telp = $request->no_telp;
           
            $blogs->judul = $request->judul;
            $blogs->kategori = $request->kategori;
            $blogs->tanggal_terbit = $request->tanggal_terbit;
            $blogs->pembukaan = $request->pembukaan;
            $blogs->isi = $request->isi;
            $blogs->foto = $fileName;
            $blogs->save();
            // $status = ' berhasil tersimpan.';
            // $code = 200; 

        return response()->json([
            'message' => 'Data ' . $this->title . ' berhasil tersimpan'
        ]);
    }

    public function destroy($id)
    {
        $blogs = Blog::findOrFail($id);

        // Proses Delete Foto
        $exist = $blogs->foto;
        // $path  = "images/privy/" . $exist;
        // \File::delete(public_path($path));
        Storage::disk('sftp')->delete($this->path . $exist);

        // delete from table admin_details
        $blogs->delete();   

        return response()->json([
            'message' => 'Data ' . $this->title . ' berhasil dihapus.'
        ]);
    }

    public function edit($id)
    {
        $blogs = Blog::findOrFail($id);

        return $blogs;
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul'  => 'required',
            'kategori'  => 'required',
            'tanggal_terbit'     => 'required',
            'pembukaan'  => 'required',
            'isi'     => 'required',
        ]);
        
        $judul      =  $request->judul;
        $kategori   = $request->kategori;
        $tanggal_terbit = $request->tanggal_terbit;
        $pembukaan = $request->pembukaan;
        $isi       = $request->isi;
        // $foto       = $request->foto;

        $blogs   = Blog::find($id);

        if ($request->foto != null) {
            $request->validate([
                'foto' => 'required|mimes:png,jpg,jpeg|max:2024'
            ]);

            // Proses Saved Foto
                $file     = $request->file('foto');
                $fileName = time() . "." . $file->getClientOriginalName();  
                // $request->file('foto')->move("images/privy/", $fileName);
                $request->file('foto')->storeAs($this->path , $fileName, 'sftp', 'public');

                $exist = $blogs->foto;
            if ($exist != null) {
                Storage::disk('sftp')->delete($this->path . $exist);
            }
          
            $blogs->update([
                'foto' => $fileName,
                'judul'  => $judul,
                'kategori'  => $kategori,
                'tanggal_terbit'     => $tanggal_terbit,
                'pembukaan'  => $pembukaan,
                'isi'     => $isi,
            ]);
        }else{
            $blogs->update([
                'judul'  => $judul,
                'kategori'  => $kategori,
                'tanggal_terbit'     => $tanggal_terbit,
                'pembukaan'  => $pembukaan,
                'isi'     => $isi,
            ]);
        }

        return response()->json([
            'message' => 'Data ' . $this->title . ' berhasil diperbaharui.'
        ]);
    }
}