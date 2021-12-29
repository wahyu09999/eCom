<form action="{{route('transaksi.update', $data->cart->id)}}" method="POST">
    @csrf
    @method('PUT')
    <div class="modal-body">
        @if ($data->bukti_transfer)
        <div class="form-group">
            <label>Bukti Transfer</label> <br>
            <img src="{{asset('storage/bukti_transfer/' . $data->bukti_transfer)}}" class="img-thumbnail w-50" alt="">
        </div>
        @endif
        <div class="form-group">
            <label for="status_pembayaran">Status Pembayaran</label>
            <select class="form-control" name="status_pembayaran">
                <option value="sudah" {{$data->cart->status_pembayaran == "sudah" ? 'selected' : ''}}>Sudah Bayar</option>
                <option value="belum" {{$data->cart->status_pembayaran == "belum" ? 'selected' : ''}}>Belum Bayar</option>
            </select>
        </div>
        <div class="form-group">
            <label for="status_pengiriman">Status Pengiriman</label>
            <select class="form-control" name="status_pengiriman">
                <option value="sudah" {{$data->cart->status_pengiriman == "sudah" ? 'selected' : ''}}>Sudah Dikirim</option>
                <option value="belum" {{$data->cart->status_pengiriman == "belum" ? 'selected' : ''}}>Belum Dikirim</option>
            </select>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>
