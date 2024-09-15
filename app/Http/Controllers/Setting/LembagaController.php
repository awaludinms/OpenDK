<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Lembaga\StoreLembagaRequest;
use App\Http\Requests\Lembaga\UpdateLembagaRequest;
use App\Models\KategoriLembaga;
use App\Models\Lembaga;
use App\Models\Penduduk;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LembagaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
    {
        //
        $page_title = 'Pengelolaan Lembaga';
        $page_description = '';

        if ($request->ajax()) {

            return DataTables::of(
                Lembaga::select(
                    'id',
                    'nama_lembaga',
                    'kode_lembaga',
                    'penduduk_id',
                    'das_kategori_lembaga_id',
                    'jumlah_anggota_lembaga'
                )->with(['kategori_lembaga', 'penduduk'])
                    ->whereHas('kategori_lembaga', function ($q) {
                        $q->select(
                            'kategori_lembaga',
                        );
                    })
                    ->whereHas('penduduk', function ($q) {
                        $q->select(
                            'nama',
                        );
                    })
            )
                ->addColumn('checklist', function ($row) {

                    return '<input type="checkbox" name="check[]" value="' . $row->id . '">';
                })
                ->addColumn('jumlah_anggota_lembaga', function ($row) {
                    return 0;
                })
                ->addColumn('aksi', function ($row) {
                    $data['edit_url'] = route('setting.lembaga.edit', $row->id);
                    $data['delete_url'] = route('setting.lembaga.destroy', $row->id);

                    return view('forms.aksi', $data);
                })
                ->addIndexColumn()
                ->make();
        }

        return view('setting.lembaga.index', compact('page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $page_title = 'Lembaga';
        $page_description = 'Tambah Data';
        $kategori_lembagas = KategoriLembaga::pluck('kategori_lembaga', 'id')->toArray();

        return view('setting.lembaga.create', compact('kategori_lembagas', 'page_title', 'page_description'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLembagaRequest $request)
    {
        //
        try {
            Lembaga::create($request->validated());
        } catch (\Exception $e) {
            report($e);

            return back()->withInput()->with('error', 'Lembaga gagal disimpan!');
        }
        return redirect()->route('setting.lembaga.index')->with('success', 'Lembaga berhasil disimpan!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lembaga  $lembaga
     * @return \Illuminate\Http\Response
     */
    public function show(Lembaga $lembaga)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lembaga  $lembaga
     * @return \Illuminate\Http\Response
     */
    public function edit(Lembaga $lembaga)
    {
        //
        $page_title = 'Lembaga';
        $page_description = 'Ubah Lembaga : ' . $lembaga->nama_lembaga;
        return view('setting.lembaga.edit', compact('lembaga','page_title', 'page_description'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lembaga  $lembaga
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLembagaRequest $request, Lembaga $lembaga)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lembaga  $lembaga
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lembaga $lembaga)
    {
        //
    }

    public function get_kategori_lembaga(Request $request)
    {
        $results = [];
        $kategori_lembaga = KategoriLembaga::where('kategori_lembaga', 'like', $request->term . '%')
            ->limit(40)
            ->get();
        foreach ($kategori_lembaga as $kategori) {
            $results[] = [
                'id' => $kategori->id,
                'text' => $kategori->kategori_lembaga . '--' . $kategori->deskripsi_kategori_lembaga
            ];
        }

        return response()->json(['results' => $results]);
    }

    public function get_ketua_lembaga(Request $request)
    {
        $results = [];
        $penduduks = Penduduk::where(function ($q) use ($request) {
            $q->where('nama', 'like', $request->term . '%')
                ->orWhere('nik', 'like', $request->term . '%');
        })
            ->limit(40)
            ->get();
        foreach ($penduduks as $penduduk) {
            $results[] = [
                'id' => $penduduk->id,
                'text' => $penduduk->nama . '--' . $penduduk->nik,
            ];
        }
        return response()->json(['results' => $results]);
    }
}
