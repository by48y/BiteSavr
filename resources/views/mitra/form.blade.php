@if ($errors->any())
    <div class="card" style="border-color: var(--bad); color: var(--bad); margin-bottom: 16px">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ $action }}">
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif
    <div class="form">
        <div class="field">
            <label for="nama_usaha">Nama usaha</label>
            <input
                id="nama_usaha"
                name="nama_usaha"
                value="{{ old('nama_usaha', $mitraProfile?->nama_usaha) }}"
                required
                maxlength="150"
            >
        </div>
        <div class="field">
            <label for="status_verifikasi">Status verifikasi</label>
            <select id="status_verifikasi" name="status_verifikasi" required>
                @foreach (['pending' => 'Pending', 'verified' => 'Verified', 'rejected' => 'Rejected'] as $value => $label)
                    <option
                        value="{{ $value }}"
                        @selected(old('status_verifikasi', $mitraProfile?->status_verifikasi ?? 'pending') === $value)
                    >
                        {{ $label }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="field full">
            <label for="alamat">Alamat</label>
            <textarea id="alamat" name="alamat" rows="4" required>{{ old('alamat', $mitraProfile?->alamat) }}</textarea>
        </div>
        <div class="field">
            <label for="koordinat">Koordinat <span class="hint">(opsional)</span></label>
            <input
                id="koordinat"
                name="koordinat"
                value="{{ old('koordinat', $mitraProfile?->koordinat) }}"
                maxlength="100"
                placeholder="0.5071, 101.4478"
            >
        </div>
    </div>
    <div class="row" style="margin-top: 20px">
        <button class="btn pri" type="submit">Simpan</button>
        <a class="btn" href="{{ route('mitra.index') }}">Batal</a>
    </div>
</form>
