<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Http\Requests\DangKyRequest;   
use App\Http\Requests\DangKyHDVRequest;
use App\Http\Requests\DangNhapRequest;   
use App\Http\Requests\SuaNguoiDungRequest;
use App\Http\Requests\DatTourRequest;
use App\User;
use App\Tour;
use App\Diadiem;
use App\Bill;
use App\Comment;
use App\Rate;
use App\ImageTour;
use Hash;
use Auth;

class PageController extends Controller
{
    public function getTrangchu(){
        $tour=Tour::paginate(12);
        return view('client.page_client.danhsachtour',compact('tour'));
    }

    public function getTourDiadiem($iddd){
        $tourdiadiem= Diadiem::find($iddd);     
        return view('client.page_client.danhsachtour',compact('tourdiadiem'));
    }

    public function postDattour(DatTourRequest $request){
        $tour = Tour::find($request->idtour);
        if($tour->sokhachtoida < $request->sokhachdangky || $request->sokhachdangky < 0){
            return redirect()->back()->with('loiKhachMax','So khach dang ky phai nho hon hoac bang so khach max.');
        }

        $bill = new Bill();
        $bill->tour_id = $request->idtour;
        $bill->users_id = $request->idkhach;
        $bill->tongtien = $request->giatour;
        $bill->tinhtrangdon = 0;
        $bill->thoigianbatdau = $request->thoigianbatdau;
        $bill->sokhachdangky = $request->sokhachdangky;
        $bill->save();
        return redirect()->back()->with('successDatTour','Gui don dat tour thanh cong');
    }

    public function getTourCuaHdv($idhdv){
        $tourhdv=Tour::where('users_id',$idhdv)->paginate(12);
        return view('client.page_client.danhsachtour', compact('tourhdv'));
    }

    public function getQuydinh(){
        return view('client.page_client.quydinh');
    }

    public function postDangkykhach(DangKyRequest $req){
        $users = new User();
        $users->hoten = $req->hoten;
        $users->email = $req->email;
        $users->password= Hash::make($req->password);
        $users->sodienthoai = $req->sodienthoai;
        $users->quyen = 1;
        $users->save();
        return redirect()->back()->with('thanhcongkhach','Dang ky thành công');
    }

    public function postDangkyhdv(DangKyHDVRequest $req){
        $users = new User();
        $users->hoten = $req->hoten;
        $users->email = $req->email;
        $users->password = Hash::make($req->password);
        $users->sodienthoai = $req->sodienthoai;
        $users->diachi = $req->diachi;
        $users->quyen = 2;
        $users->save();
        return redirect()->back()->with('thanhconghdv','Dang ky tai khoan thanh cong');
    }

    public function postDangnhap(DangNhapRequest $req){
        $check_user = array('email'=>$req->email,'password'=>$req->password);
        $check_admin = array('email'=>$req->email,'password'=>$req->password,'quyen'=>3);
        $remember = $req->ghinho;
        if(Auth::attempt($check_admin, $remember)){
            return redirect()->route('trang-chu-admin');
        }else if(Auth::attempt($check_user, $remember)){
            return redirect()->back();
        }else{
            return redirect()->back()->with('loiLogin','Sai tài khoản hoặc mật khẩu!');
        }
    }

    public function getDangxuat(){
        Auth::logout();
        return redirect()->route('trang-chu');
    }

    public function getThongtincanhan(){
        $user = Auth::user();
        return view('client.page_client.thongtincanhan', compact('user'));
    }

    public function getThongtinHDV($idhdv){
        $cthdv = User::where('id',$idhdv)->get();
        return view('client.page_client.thongtincanhan', compact('cthdv'));
    }

    public function postSuathongtin(SuaNguoiDungRequest $request){
        $user = Auth::user();

        if($request->checkpassword == "on"){
            $user->password = bcrypt($request->password);
        }
        if($request->hasFile('anhdaidien')){
            $file = $request->file('anhdaidien');
            $duoi = $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != "png" && $duoi != "jpeg"){
                return redirect()->back()->with('loianh','Định dạng ảnh phải là jpg, png, jpeg');
            }

            $name = $file->getClientOriginalName();
            $anhdaidien= str_random(4)."_".$name;
            while(file_exists("upload".$anhdaidien)){
                $anhdaidien= str_random(4)."_".$name;
            }
            
            $file->move("upload",$anhdaidien);
            $user->anhdaidien = $anhdaidien;
        }
        
        if ($request->namsinh != "") {
            $y = date('Y');
            if($y - $request->namsinh  <= 100 && $y - $request->namsinh  >= 3) {
                $user->namsinh = $request->namsinh;
            }else{
                return redirect()->back()->with('loinamsinh','Vui long nhap dung nam sinh');
            }
        }

        $user->hoten = $request->hoten;
        $user->gioitinh = $request->gioitinh;
        $user->sodienthoai=$request->sodienthoai;
        $user->diachi = $request->diachi;
        $user->save();
        return redirect()->back()->with('suathanhcong','Sua thong tin thanh cong');
    }

    public function getTimkiem(Request $request){
        if(empty($request->timkiem)) return redirect()->back()->with('loiTimkiem','loi tim kiem');
        $tk = $request->timkiem;
        $tourtimkiem = Tour::where('tentour','like','%'.$tk.'%')
                ->orwhere('giatour',$tk)->paginate(12);
        $count  = Tour::where('tentour','like','%'.$tk.'%')
                ->orwhere('giatour',$tk)->count();
        return view('client.page_client.danhsachtour',compact('tourtimkiem','count'));
    }

    public function getLichsu(){
        $lichsu = Bill::where('users_id',Auth::user()->id)->paginate(6);
        return view('client.page_client.lichsudattour', compact('lichsu'));
    }

    public function Danhgia($idtour, Request $request){
        if($request->sodiem == 0) return redirect()->back()->with('errorRate','Loi danh gia!');

        $rate = new Rate();
        $rate->tour_id = $idtour;
        $rate->users_id = Auth::user()->id;
        $rate->sodiem = $request->sodiem;
        $rate->save();
        return redirect()->back()->with('successRate','Cam on ban da danh gia tour.');
    }

}
