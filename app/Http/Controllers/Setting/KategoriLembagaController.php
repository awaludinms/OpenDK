<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Lembaga\StoreKategoriLembagaRequest;
use App\Http\Requests\Lembaga\UpdateKategoriLembagaRequest;
use App\Models\KategoriLembaga;
use App\Models\Lembaga;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KategoriLembagaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $page_title = 'Kategori Lembaga';
        $page_description = '';

        if ($request->ajax()) {

            return DataTables::of(
                KategoriLembaga::select(
                    'id',
                    'kategori_lembaga',
                    'deskripsi_kategori_lembaga',
                )
            )
                ->addColumn('checklist', function ($row) {

                    return '<input type="checkbox" name="check[]" value="' . $row->id . '">';
                })
                ->addColumn('aksi', function ($row) {
                    $data['edit_url'] = route('setting.kategori_lembaga.edit', $row->id);
                    $data['delete_url'] = route('setting.kategori_lembaga.destroy', $row->id);

                    return view('forms.aksi', $data);
                })
                ->addIndexColumn()
                ->make();
        }

        return view('setting.kategori_lembaga.index', compact('page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $page_title = 'Kategori Lembaga';
        $page_description = 'Tambah Data';

        return view('setting.kategori_lembaga.create', compact('page_title', 'page_description'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKategoriLembagaRequest $request)
    {
        //
        try {
            KategoriLembaga::create($request->validated());
        } catch (\Exception $e) {
            report($e);

            return back()->withInput()->with('error', 'Kategori Lembaga gagal disimpan!');
        }
        return redirect()->route('setting.kategori_lembaga.index')->with('success', 'Kategori Lembaga berhasil disimpan!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KategoriLembaga  $kategoriLembaga
     * @return \Illuminate\Http\Response
     */
    public function show(KategoriLembaga $kategori_lembaga)
    {
        //
        return response()->json([
            'jumlah_lembaga' => Lembaga::where('das_kategori_lembaga_id', $kategori_lembaga->id)->count('id')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KategoriLembaga  $kategoriLembaga
     * @return \Illuminate\Http\Response
     */
    public function edit(KategoriLembaga $kategori_lembaga)
    {
        //
        $page_title = 'Kategori Lembaga';
        $page_description = 'Ubah Kategori Lembaga : ' . $kategori_lembaga->kategori_lembaga;

        return view('setting.kategori_lembaga.edit', compact('kategori_lembaga', 'page_title', 'page_description'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KategoriLembaga  $kategoriLembaga
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateKategoriLembagaRequest $request, KategoriLembaga $kategori_lembaga)
    {
        try {
            $kategori_lembaga->update($request->validated());
        } catch (\Exception $e) {
            report($e);

            return back()->withInput()->with('error', 'Kategori Lembaga gagal diupdate!');
        }
        return redirect()->route('setting.kategori_lembaga.index')->with('success', 'Kategori Lembaga berhasil diupdate!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KategoriLembaga  $kategoriLembaga
     * @return \Illuminate\Http\Response
     */
    public function destroy(KategoriLembaga $kategoriLembaga)
    {
        //
    }
}
