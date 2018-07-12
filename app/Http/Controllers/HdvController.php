<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Tour;
use App\Diadiem;
use App\Bill;
use App\ImageTour;
use Auth;

class HdvController extends Controller
{
    public function trangchu(){
    	return view('hdv.layout_hdv.index');
    }

    public function getDSdontour(){
        $bill = Tour::where('users_id', Auth::user()->id)->get();
        return view('hdv.page_hdv.danhsachdondattour', compact('bill'));
    }

    public function getDSdontourmoi(){
        $newbill = Tour::where('users_id', Auth::user()->id)->get();
        return view('hdv.page_hdv.danhsachdondattour', compact('newbill'));
    }

    public function getDSdontourthanhtoan(){
        $billtt = Tour::where('users_id', Auth::user()->id)->get();
        return view('hdv.page_hdv.danhsachdondattour', compact('billtt'));
    }

    public function getChapnhandon($idd){
        $don = Bill::find($idd)->update(['tinhtrangdon' => 1]);
        return redirect()->back()->with('chapnhan','Chap nhan don dat tour thanh cong');
    }

    public function getTuchoidon($idd){
        $don = Bill::find($idd)->update(['tinhtrangdon' => 2]);
        return redirect()->back()->with('tuchoi','Tu choi don dat tour thanh cong');
    }

    public function getXacnhanditour($idd){
        $don = Bill::find($idd)->update(['tinhtrangdon' => 4]);
        return redirect()->back()->with('thanhcong','Xac nhan thanh cong');
    }

    public function getThemAnh($idtour){
        $tour = Tour::find($idtour);
        return view('hdv.page_hdv.themanhtour', compact('tour'));
    }

    public function postThemAnh($idtour, Request $request){
        if($request->hasFile('image')){
            $file = $request->file('image');
            $duoi = $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != "png" && $duoi != "jpeg"){
                return redirect()->back()->with('loi','Định dạng ảnh phải là jpg,png,jpeg');
            }

            $name = $file->getClientOriginalName();
            $image= str_random(4)."_".$name;
            while(file_exists("upload".$image)){
                $image= str_random(4)."_".$name;
            }
            
            $file->move("upload",$image);

            $imagetour = new ImageTour();
            $imagetour->image = $image;
            $imagetour->tour_id = $idtour;
            $imagetour->save();
            return redirect()->back()->with('success','Them hinh anh thanh cong.');
        }else{
            return redirect()->back()->with('error','Them hinh anh that bai.');
        }
    }

    public function getXoaAnh($idm){
        ImageTour::find($idm)->delete();
        return redirect()->back()->with('delImage','Xoa anh thanh cong');
    }

}
