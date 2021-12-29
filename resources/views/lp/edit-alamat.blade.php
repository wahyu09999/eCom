<form action="{{ route('alamat-pengiriman.update', $data->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="modal-body">
        <div class="row">
            <div class="col-md-6">
                <div class="tax-select mb-25px">
                    <label>Nama Penerima</label>
                    <input type="text" class="px-2 @error('nama_penerima') border-danger @enderror" name="nama_penerima" placeholder="Masukkan Nama Penerima" value="{{ $data->nama_penerima}}" />
                    @error('nama_penerima')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="tax-select mb-25px">
                    <label>Nomor HP</label>
                    <input type="text" class="px-2 @error('no_tlp') border-danger @enderror" name="no_tlp" placeholder="Masukkan Nomor HP" value="{{ $data->no_tlp}}" />
                    @error('no_tlp')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="tax-select mb-25px">
                    <label>Alamat</label>
                    <input type="text" class="px-2 @error('alamat') border-danger @enderror" name="alamat" placeholder="Masukkan Alamat" value="{{ $data->alamat}}" />
                    @error('alamat')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="tax-select mb-25px">
                    <label>Kelurahan/Desa</label>
                    <input type="text" class="px-2 @error('kelurahan') border-danger @enderror" name="kelurahan" placeholder="Masukkan Kelurahan/Desa" value="{{ $data->kelurahan}}" />
                    @error('kelurahan')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="tax-select mb-25px">
                    <label>Kecamatan</label>
                    <input type="text" class="px-2 @error('kecamatan') border-danger @enderror" name="kecamatan" placeholder="Masukkan Kecamatan" value="{{ $data->kecamatan}}" />
                    @error('kecamatan')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="tax-select mb-25px">
                    <label>Kabupaten/Kota</label>
                    <input type="text" class="px-2 @error('kota') border-danger @enderror" name="kota" placeholder="Masukkan Kabuptae/Kota" value="{{ $data->kota}}" />
                    @error('kota')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="tax-select mb-25px">
                    <label>Provinsi</label>
                    <input type="text" class="px-2 @error('provinsi') border-danger @enderror" name="provinsi" placeholder="Masukkan Provinsi" value="{{ $data->provinsi}}" />
                    @error('provinsi')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="tax-select mb-25px">
                    <label>Kodepos</label>
                    <input type="number" class="px-2 @error('kodepos') border-danger @enderror" name="kodepos" placeholder="Masukkan Kodepos" value="{{ $data->kodepos}}" />
                    @error('kodepos')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="tax-select-wrapper">
                    <div class="tax-select mb-0">
                        <label>Status Alamat Pengiriman</label>
                        <select class="email s-email s-wid @error('status') border-danger @enderror" name="status">
                            <option disabled selected hidden>-- Pilih status alamat pengiriman --</option>
                            <option value="1" {{$data->status == 1 ? 'selected' : '' }}>Utama</option>
                            <option value="0" {{$data->status == 0 ? 'selected' : '' }}>Opsional</option>
                        </select>
                    </div>
                    @error('status')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>
