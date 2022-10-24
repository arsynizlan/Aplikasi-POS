<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use PDF;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('member.index');
    }
    public function data()
    {
        $member = Member::orderBy('kode_member', 'asc')->get();
        return datatables()
            ->of($member)
            ->addIndexColumn()
            ->addColumn('kode_member', function ($member) {
                return '<span class="badge bg-label-success me-1">' . $member->kode_member . '</span>';
            })
            ->addColumn('select_all', function ($produk) {
                return '<input type="checkbox" name="id_member[]" value="' . $produk->id_member . '">
                ';
            })

            ->addColumn('aksi', function ($member) {
                return '
                <div class="btn-group">
                <button type="button" onclick="editForm(`' . route('member.update', $member->id_member) . '`)" class="btn btn-icon btn-info"><i class="bx bx-edit-alt"></i></button>
                <button type="button" onclick="deleteData(`' . route('member.destroy', $member->id_member) . '`)" class="btn btn-icon btn-danger"><i class="bx bx-trash"></i></button>
            </div>
                ';
            })

            ->rawColumns(['aksi', 'kode_member', 'select_all'])
            ->make(true);
        // ->addColumn('action', 'users.action');
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
        $member = Member::latest()->first() ?? new Member();
        $kode_member = (int) $member->kode_member + 1 ?? 1;

        $member = new Member();
        $member->kode_member = tambah_nol_didepan($kode_member, 5);
        $member->nama = $request->nama;
        $member->telepon = $request->telepon;
        $member->alamat = $request->alamat;
        $member->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $member = Member::find($id);

        return response()->json($member, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $member = Member::find($id)->update($request->all());


        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member = Member::find($id);
        $member->delete();

        return response(null, 204);
    }
    public function cetakMember(Request $request)
    {
        ini_set('max_execution_time', '0');
        $datamember = collect(array());
        foreach ($request->id_member as $id) {
            $member = Member::find($id);
            $datamember[] = $member;
        }

        $datamember = $datamember->chunk(2);
        $setting    = Setting::first();

        $no  = 1;

        $pdf = PDF::loadView('member.cetak', compact('datamember', 'no','setting'));
        $pdf->setPaper(array(0, 0, 566.93, 850.39), 'potrait');
        return $pdf->stream('member.pdf');
    }
}
