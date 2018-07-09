<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TaoTourRequest;
use App\Tour;
use App\User;
use App\Bill;
use App\Comment;
use App\Rate;
use App\ImageTour;
use App\Diadiem;
use Auth;

class TourController extends Controller
{
 
    public function index()
    {
        $tour = Tour::where('users_id', Auth::user()->id)->paginate(10);
        return view('page_hdv.danhsachtour', compact('tour'));
    }

    public function create()
    {
        $dd = Diadiem::all();
        return view('page_hdv.themtour',compact('dd'));
    }

    public function store(TaoTourRequest $request)
    {
        if($request->sokhachmax <= 0) return redirect()->back()->with('loiSokhachmax','So khach max phai lon hon 0');
        if($request->giatour <= 0) return redirect()->back()->with('loiGiatour','Gia tour phai lon hon 0');
        
        $tour = new Tour();
        $tour->users_id= Auth::user()->id;
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
        $cttour = Tour::where('id',$id)->first();
        return view('page_client.chitiet', compact('cttour'));
    }

    public function edit($id)
    {
        $idt = Tour::find($id);
        $dd = Diadiem::all();
        return view('page_hdv.themtour', compact('idt','dd'));
    }

    public function update(TaoTourRequest $request, Tour $tour)
    {
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
