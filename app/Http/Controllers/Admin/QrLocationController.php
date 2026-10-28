<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\QrLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class QrLocationController extends Controller
{
    public function index(){ $locations=QrLocation::withCount('qrTokens')->orderBy('nama_lokasi')->get(); return view('admin.locations.index',compact('locations')); }
    public function create(){ return view('admin.locations.create'); }
    public function store(Request $r){ $d=$r->validate(['nama_lokasi'=>'required|max:100','latitude'=>'nullable|numeric','longitude'=>'nullable|numeric','radius'=>'required|integer|min:1|max:1000']); $d['kode_lokasi']=strtoupper(Str::random(8));$d['status']=$r->boolean('status');QrLocation::create($d);return redirect()->route('admin.locations.index')->with('success','Lokasi QR berhasil ditambahkan.'); }
    public function edit($id){$location=QrLocation::findOrFail($id);return view('admin.locations.edit',compact('location'));}
    public function update(Request $r,$id){$location=QrLocation::findOrFail($id);$d=$r->validate(['nama_lokasi'=>'required|max:100','latitude'=>'nullable|numeric','longitude'=>'nullable|numeric','radius'=>'required|integer|min:1|max:1000']);$d['status']=$r->boolean('status');$location->update($d);return redirect()->route('admin.locations.index')->with('success','Lokasi berhasil diperbarui.');}
    public function destroy($id){QrLocation::findOrFail($id)->delete();return back()->with('success','Lokasi berhasil dihapus.');}
}