<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProdukRequest;
use App\Models\Kategori;
use App\Models\Produk;
use App\Repositories\Repository;
use App\Services\OracleService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

use function App\Helpers\deleteFile;
use function App\Helpers\updateFile;
use function App\Helpers\uploadFile;

class ProdukController extends Controller
{
    public function __construct(Produk $produk)
    {
        $this->model = new Repository($produk);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Produk::with('kategori')->get();
        if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('gambar', function ($row) {
                    if ($row->gambar) {
                        return '<img class="img-thumbnail w-100" src="' . $row->gambar . '" />';
                    }
                    return '<img class="img-thumbnail w-100" src="/img/not.png" />';
                })
                ->addColumn('action', function ($row) {
                    $button = '<div class="btn-group" role="group">';
                    $button .= '<a href="/produk/' . $row->id . '/edit"  class="btn btn-sm btn-info"><i class="material-icons">edit</i></a>';
                    $button .= '<a href="/produk/' . $row->id . '"  class="btn btn-sm btn-success"><i class="material-icons">visibility</i></a>';
                    $button .= '<a href="javascript:void(0)" data-toggle="modal" data-id="' . $row->id . '" data-target="#deleteProdukModal" class="btn btn-sm btn-danger btn-delete-produk"><i class="material-icons">delete</i></a>';
                    $button .= '</div>';
                    return $button;
                })
                ->rawColumns(['action', 'gambar'])
                ->make(true);
        }
        return view('produk.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = Kategori::all();
        return view('produk.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProdukRequest $request)
    {

        $payload = $request->only(['kategori_id', 'nama', 'harga', 'stok', 'deskripsi']);
        if ($request->hasFile('gambar')) {
            $oci = new OracleService();

            $payload['gambar'] = $oci->uploadObject($request->file('gambar'), 'uts');
        }
        $this->model->create($payload);
        return redirect()->route('produk.index')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->model->getModel()->where('id', $id)->first();
        return view('produk.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kategori = Kategori::all();
        $data = $this->model->getModel()->where('id', $id)->first();
        return view('produk.edit', compact('data', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $produk = $this->model->show($id);
        $payload = $request->only(['kategori_id', 'nama', 'harga', 'stok', 'deskripsi']);
        if ($request->hasFile('gambar')) {
            $payload['gambar'] = updateFile($produk->gambar, 'produk', $request->file('gambar'), 'produk');
        } else {
            $payload['gambar'] = $produk->gambar;
        }
        $this->model->update($payload, $id);
        return redirect()->route('produk.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produk = $this->model->show($id);
        if ($produk->gambar) {
            deleteFile($produk->gambar, 'produk');
        }
        $this->model->delete($id);
        return response()->json(['success' => true, 'messages' => 'Data berhasil dihapus'], 200);
    }
}
