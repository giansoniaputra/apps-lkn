<option label="&nbsp;" value="ALL">Semua Nomor Rekening</option>
@foreach ($nasabah as $row)
    <option value="{{ $row->rekening }}">{{ $row->rekening }} -
        {{ $row->nama }}</option>
@endforeach
