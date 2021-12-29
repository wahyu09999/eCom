<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use PDF;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Order::get();
        if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('nama', function ($row) {
                    return $row->cart->user->nama;
                })
                ->addColumn('no_invoice', function ($row) {
                    return $row->cart->no_invoice;
                })
                ->addColumn('jumlah', function ($row) {
                    return $row->cart->detail->count();
                })
                ->addColumn('total', function ($row) {
                    return number_format($row->cart->total, 0, ',', '.');
                })
                ->addColumn('status_pembayaran', function ($row) {
                    if ($row->cart->status_pembayaran == "belum") {
                        return '<span class="badge badge-danger py-2 px-3">Belum Bayar</span>';
                    } else {
                        return '<span class="badge badge-success py-2 px-3">Sudah Bayar</span>';
                    }
                })
                ->addColumn('status_pengiriman', function ($row) {
                    if ($row->cart->status_pengiriman == "belum") {
                        return '<span class="badge badge-danger py-2 px-3">Belum Dikirim</span>';
                    } else {
                        return '<span class="badge badge-success py-2 px-3">Sudah Dikirim</span>';
                    }
                })
                ->addColumn('action', function ($row) {
                    $button = '<div class="btn-group" role="group">';
                    $button .= '<a href="javascript:void(0)" data-toggle="modal" data-id="' . $row->id . '" data-target="#editStatusTransaksiModal" class="btn btn-sm btn-info btn-edit-transaksi"><i class="material-icons">edit</i></a>';
                    $button .= '<a href="/transaksi/' . $row->id . '"  class="btn btn-sm btn-success"><i class="material-icons">visibility</i></a>';
                    $button .= '<a href="javascript:void(0)" data-toggle="modal" data-id="' . $row->id . '" data-target="#deleteTransaksiModal" class="btn btn-sm btn-danger btn-delete-transaksi"><i class="material-icons">delete</i></a>';
                    $button .= '</div>';
                    return $button;
                })
                ->rawColumns(['action', 'nama', 'no_invoice', 'jumlah', 'total', 'status_pembayaran', 'status_pengiriman'])
                ->make(true);
        }
        return view('transaksi.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Order::findOrFail($id);
        return view('transaksi.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Order::findOrFail($id);
        return response()->json(['success' => true, 'html' => view('transaksi.edit', compact('data'))->render()], 200);
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
        $payload = $request->only(['status_pembayaran', 'status_pengiriman']);
        Cart::findOrFail($id)->update($payload);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->cart->detail()->delete();
        $order->cart()->delete();
        $order->delete();
        return response()->json(['success' => true], 200);
    }

    public function cetak()
    {
        $data = Order::all();
        $pdf = PDF::loadview('transaksi.cetak', ['data' => $data])->setPaper('a4', 'landscape');
        return $pdf->stream();
    }
}