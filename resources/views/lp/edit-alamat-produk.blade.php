<form action="{{route('updatealamatproduk', $data->id)}}" method="POST">
    @csrf
    @method('PUT')
    <div class="modal-body">
        @foreach ($alamatpengiriman as $item)
        <div class="form-check">
            <input class="form-check-input" type="radio" name="alamat_pengiriman_id" id="alamat_pengiriman_id_{{$item->id}}" value="{{$item->id}}" {{$data->alamat_pengiriman_id == $item->id ? 'checked' : ''}}>
            <label class="form-check-label" for="alamat_pengiriman_id_{{$item->id}}">
                <span class="font-weight-bold">{{$item->nama_penerima}} {{$item->status == 1? '(Utama)' : ''}}</span> <br>
                {{$item->no_tlp}} | {{$item->alamat}} <br>
                {{$item->kelurahan}} - {{$item->kecamatan}} - {{$item->kota}} - {{$item->provinsi}}
                <br>
                {{$item->kodepos}}
            </label>
        </div>
        @endforeach
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>
