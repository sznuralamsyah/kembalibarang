<table class="table table-stripped">
    <thead>
        <th>No</th>
        <th>Nama</th>
        <th>Aksi</th>
    </thead>
    <tbody>
        @foreach ($items as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->item_name }}</td>
                <td>
                    @if ($item->type == 'lost')
                        @if ($item->user_id != request()->user()->id && $item->closedCase == null)
                            <form action="{{ route('item.founded', ['item' => $item->id, 'type' => request('type')]) }}"
                                method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-sm btn-info"
                                    onclick="return confirm('Apakah anda yakin?')">Ditemukan</button>
                            </form>
                        @elseif($item->closedCase && $item->user_id == request()->user()->id && $item->closedCase?->status == 0)
                            <form action="{{ route('item.done', ['item' => $item->id, 'type' => request('type')]) }}"
                                method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-sm btn-info"
                                    onclick="return confirm('Apakah anda yakin?')">Selesai</button>
                            </form>
                        @endif
                    @elseif($item->type == 'found' && $item->user_id == auth()->id())
                        <form
                            action="{{ route('item.owner-founded', ['item' => $item->id, 'type' => request('type')]) }}"
                            method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-sm btn-info" onclick="return confirm('Apakah anda yakin?')">
                                Pemilik Ditemukan
                            </button>
                        </form>
                    @endif
                    <a href="{{ route('item.show', $item) }}" class="btn btn-sm btn-success">Detail</a>
                    @if (!$item->closedCase)
                        <a href="{{ route('item.edit', ['item' => $item->id, 'type' => request('type')]) }}"
                            class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('item.destroy', ['item' => $item->id, 'type' => request('type')]) }}"
                            method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger"
                                onclick="return confirm('Apakah anda yakin?')">Hapus</button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
