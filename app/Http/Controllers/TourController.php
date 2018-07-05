<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tour;
use App\User;
use App\Bill;
use App\ImageTour;
use App\Diadiem;
use Auth;

class TourController extends Controller
{
 
    public function index()
    {
        $iduser = Auth::user()->id;
        $tour = Tour::select('tour.id','tendiadiem','giatour','sokhachmax','hinhanh','mota','tentour')
                ->where('tour.users_id',$iduser)
                ->join('diadiem','tour.diadiem_id','=','diadiem.id')->paginate(4);

        $bill =  Bill::select('tour_id','tinhtrangdon')
                ->where('tour.users_id',$iduser)
                ->join('tour','tour.id','=','bill.tour_id')->get();

        $image = ImageTour::select('tour_id','image','imagetour.id')->where('tour.users_id',$iduser)
                ->join('tour','tour.id','=','imagetour.tour_id')->get();

        return view('page_hdv.danhsachtour', compact('tour','bill','image'));
    }

    public function create()
    {
        $dd = Diadiem::all();
        return view('page_hdv.themtour',compact('dd'));
    }

    public function store(Request $request)
    {
        $this -> validate($request,
            [
                'tentour'=>'required',
                'sokhachmax'=>'required|numeric',
                'giatour'=>'required|numeric',
                'mota'=>'required',
            ],
            [
                'tentour.required'=>'Vui long nhap ten tour',
                'sokhachmax.required'=>'Vui long nhap so khach toi da',
                'sokhachmax.numeric'=>'So khach max la 1 con so',
                'giatour.required'=>'Vui long nhap gia tour',
                'giatour.numeric'=>'Gia tien la 1 con so',
                'mota.required'=>'Vui long nhap mo ta',
            ]);
        if($request->sokhachmax <= 0) return redirect()->back()->with('loiSokhachmax','So khach max phai lon hon 0');
        if($request->giatour <= 0) return redirect()->back()->with('loiGiatour','Gia tour phai lon hon 0');
        $iduser = Auth::user()->id;
        $tour = new Tour();
        $tour->users_id= $iduser;
        $tour->tentour= $request->tentour;
        $tour->diadiem_id= $request->diadiem;
        $tour->sokhachmax=$request->sokhachmax;
        $tour->giatour= $request->giatour;
        $tour->mota= $request->mota;

        if($request->hasFile('hinhanh')){
            $file = $request->file('hinhanh');
            $duoi = $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != "png" && $duoi != "jpeg"){
                return redirect()->back()->with('loi','Định dạng ảnh phải là jpg, png, jpeg');
            }

            $name = $file->getClientOriginalName();
            echo $name;
            $hinhanh= str_random(4)."_".$name;
            while(file_exists("upload".$hinhanh)){
                $hinhanh= str_random(4)."_".$name;
            }
            
            $file->move("upload",$hinhanh);
            $tour->hinhanh = $hinhanh;
        }
        else
        {
            $tour->hinhanh = "";
        }

        $tour->save();
        return redirect()->back()->with('thanhcong','Them tour thanh cong');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $idt = Tour::find($id);
        $dd = Diadiem::all();
        return view('page_hdv.themtour', compact('idt','dd'));
    }

    public function update(Request $request, Tour $tour)
    {
        $this->validate($request,
            [
                'tentour'=>'required',
                'sokhachmax'=>'required',
                'giatour'=>'required',
                'mota'=>'required',
            ],
            [
                'tentour.required'=>'Vui long nhap ten tour',
                'sokhachmax.required'=>'Vui long nhap so khach toi da',
                'giatour.required'=>'Vui long nhap gia tour',
                'mota.required'=>'Vui long nhap mo ta',
            ]);
        $tour->tentour=$request->tentour;
        $tour->giatour=$request->giatour;
        $tour->mota=$request->mota;
        $tour->sokhachmax=$request->sokhachmax;
        $tour->diadiem_id=$request->diadiem;
        if($request->hasFile('hinhanh')){
            $file = $request->file('hinhanh');
            $duoi = $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != "png" && $duoi != "jpeg"){
                return redirect()->back()->with('loi','Định dạng ảnh phải là jpg,png,jpeg');
            }

            $name = $file->getClientOriginalName();
            $hinhanh= str_random(4)."_".$name;
            while(file_exists("upload".$hinhanh)){
                $hinhanh= str_random(4)."_".$name;
            }
            
            $file->move("upload",$hinhanh);
            $tour->hinhanh = $hinhanh;
        }

        $tour->save();
        return redirect()->back()->with('thanhcong','Sua tour thanh cong');
    }

    public function destroy(Tour $tour)
    {
        $tour->delete();
        return redirect()->back()->with('thongbao','Xoa tour thanh cong');
    }
}
