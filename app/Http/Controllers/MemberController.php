<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->input('query'); // Ambil query pencarian dari input form

        // Jika ada query pencarian, cari produk berdasarkan nama_produk
        if ($query) {
            $data = User::where('nama', 'like', '%' . $query . '%')->paginate(3);
        } else {
            // Jika tidak ada query pencarian, tampilkan semua produk
            $data = User::paginate(10);
        }

        return view("admin.member", compact('data'))->with([
            'user' => Auth::user()
        ]);
    }
    public function addMember()
    {
        return view("admin.modal.addMember", [
            'title' => 'Tambah Data Member',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMemberRequest $request)
    {
        $data = new User();
        $data->id = $request->id;
        $data->username = $request->username;
        $data->password = $request->password;
        $data->role = $request->role;
        $data->nama = $request->nama;
        $data->alamat = $request->alamat;
        $data->tgl_lahir = $request->tgl_lahir;
        $data->jenis_kelamin = $request->jenis_kelamin;
        $data->email = $request->email;
        $data->nomor_telpon = $request->nomor_telpon;

        // Alert::success('Berhasil', 'Data berhasil tersimpan');
        $data->save();
        return redirect('/member');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = User::findOrFail($id);

        return view(
            'admin.modal.EditMember',
            [
                'title' => 'Edit Data Member',
                'data' => $data,
            ]
        )->render();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMemberRequest $request, User $produk, $id)
    {
        $data = User::findOrFail($id);

        $field = [
            'id' => $request->id,
            'username' => $request->username,
            'password' => $request->password,
            'role' => $request->role,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'tgl_lahir' => $request->tgl_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'email' => $request->email,
            'nomor_telpon' => $request->nomor_telpon,
        ];
        $data::where('id', $id)->update($field);
        // Alert :: toast('Data Berhasil Disimpan', 'success');
        return redirect('/member');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $member, $id)
    {
        $data = User::find($id);
        $data->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil Menghapus Data',
        ]);
    }
}
