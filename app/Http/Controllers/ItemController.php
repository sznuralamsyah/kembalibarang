<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(!request()->has('type'), 404);
        $items = Item::where('type', request('type'))->get();
        // if (request('type') == 'lost') $items->where(function ($q) {
        //     $q->where(function ($q) {
        //         $q->whereDoesntHave('closedCase')->orWhere('user_id', request()->user()->id);
        //     })->whereDoesntHave('closedCase', fn($cc) => $cc->where('status', 1));
        // });
        // else $items->whereDoesntHave('closedCase');
        $notResolvedYet = $items->where('closedCase', null);
        $waitingConfirmation = $items->where('closedCase', '!=', null)->where('closedCase.status', 0)->where('user_id', request()->user()->id);
        $done = $items->where('closedCase', '!=', null)->where('closedCase.status', 1)->where('user_id', request()->user()->id);
        return view('item.index', compact('notResolvedYet', 'waitingConfirmation', 'done'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(!request()->has('type'), 404);
        return view('item.form', ['type' => 'store', 'item' => new Item(), 'categories' => Category::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valid = $request->validate([
            'item_name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'type' => 'required|in:lost,found',
            'main_picture' => 'required|image',
            'second_picture' => 'nullable|image',
            'third_picture' => 'nullable|image',
            'lost_found_date' => 'required|date'
        ]);
        $valid['user_id'] = $request->user()->id;
        $valid['main_picture'] = '/storage/' . $request->file('main_picture')->store('items/');
        if ($request->hasFile('second_picture')) {
            $valid['second_picture'] = '/storage/' . $request->file('second_picture')->store('items/');
        }
        if ($request->hasFile('third_picture')) {
            $valid['third_picture'] = '/storage/' . $request->file('third_picture')->store('items/');
        }
        Item::create($valid);
        return to_route('item.index', ['type' => $valid['type']])->with('status', 'Barang berhasil ditambahkan');
    }

    public function show(Item $item)
    {
        return view('item.show', ['item' => $item]);
    }

    public function founded(Request $request, Item $item)
    {
        abort_if($item->closedCase && $item->user_id != $request->user()->id, 404);
        $item->closedCase()->create(['user_id' => $request->user()->id, 'status' => 0]);
        return back()->with('status', 'Barang pemenemuan berhasil disimpan');
    }

    public function done(Request $request, Item $item)
    {
        abort_if(!$item->closedCase || $item->user_id != $request->user()->id, 404);
        $item->closedCase->update(['status' => 1]);
        return back()->with('status', 'Barang telah selesai dikonfirmasi');
    }

    public function ownerFounded(Request $request, Item $item)
    {
        abort_if($item->closedCase || $item->user_id != $request->user()->id, 404);
        $item->closedCase()->create(['user_id' => $request->user()->id, 'status' => 1]);
        return back()->with('status', 'Barang pemenemuan berhasil ditemukan oleh pemilih');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        abort_if(!request()->has('type'), 404);
        return view('item.form', ['type' => 'update', 'item' => $item, 'categories' => Category::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        $valid = $request->validate([
            'item_name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'type' => 'required|in:lost,found',
            'main_picture' => 'nullable|image',
            'second_picture' => 'nullable|image',
            'third_picture' => 'nullable|image',
            'lost_found_date' => 'required|date'
        ]);
        if ($request->hasFile('main_picture')) {
            $this->deletePicture($item, 'main_picture');
            $valid['main_picture'] = '/storage/' . $request->file('main_picture')->store('items');
        }
        if ($request->hasFile('second_picture')) {
            $this->deletePicture($item, 'second_picture');
            $valid['second_picture'] = '/storage/' . $request->file('second_picture')->store('items');
        }
        if ($request->hasFile('third    _picture')) {
            $this->deletePicture($item, 'third  _picture');
            $valid['third   _picture'] = '/storage/' . $request->file('third   _picture')->store('items');
        }
        $item->update($valid);
        return to_route('item.index', ['type' => $valid['type']])->with('status', 'Barang berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $this->deletePicture($item, 'main_picture');
        $this->deletePicture($item, 'second_picture');
        $this->deletePicture($item, 'third_picture');
        $item->delete();
        return to_route('item.index', ['type' => request('type')])->with('status', 'Barang berhasil dihapus');
    }

    private function deletePicture(Item $item, $column)
    {
        $exists = Storage::exists(substr($item[$column], 9));
        if ($exists) {
            Storage::delete(substr($item[$column], 9));
        }
        return $exists;
    }
}
