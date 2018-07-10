<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Http\Requests\DangKyRequest;   
use App\Http\Requests\DangKyHDVRequest;
use App\Http\Requests\DangNhapRequest;   
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
        $tour=Tour::paginate(10);
        return view('client.page_client.danhsachtour',compact('tour'));
    }

    public function getDiadiem($iddd){
        $tourdiadiem= Diadiem::find($iddd);     
        return view('client.page_client.danhsachtour',compact('tourdiadiem'));
    }

    public function postDattour($idtour, Request $request){
        $request->session()->flash('errorDatTour','');
        $this-> validate($request,
            [
                'timeBD'=>'required|date',
                'sokhachdangky'=>'required',
            ],
            [
                'timeBD.required'=>'Vui long nhap thoi gian bat dau',
                'timeBD.date'=>'Khong dung dinh dang date',
                'sokhachdangky.required'=>'Vui long nhap so khach dang ky',
            ]);
        $bill = new Bill();
        $bill->tour_id = $request->idtour;
        $bill->users_id = $request->idkhach;
        $bill->tongtien = $request->giatour;
        $bill->tinhtrangdon = 0;
        $bill->timeBD = $request->timeBD;

        $tour = Tour::find($idtour);
        if($tour->sokhachmax < $request->sokhachdangky || $request->sokhachdangky < 0) return redirect()->back()->with('loiKhachMax','So khach dang ky phai nho hon hoac bang so khach max.');
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
        if(Auth::attempt($check_admin))
            return redirect()->route('trang-chu-admin');
        else if(Auth::attempt($check_user))
            return redirect()->back();
        else
            return redirect()->back()->with('loiLogin','Sai tài khoản hoặc mật khẩu!');
    }

    public function getDangxuat(){
        Auth::logout();
        return redirect()->route('trang-chu');
    }

    public function postBinhluan($idtour, Request $request){
        if(empty($request->noidung)) return redirect()->back()->with('errorComment','loi binh luan');
        $comment = new Comment();
        $comment->noidung = $request->noidung;
        $comment->users_id = Auth::user()->id;
        $comment->parent_id = 0;
        $comment->tour_id = $idtour;
        $comment->save();
        return redirect()->back()->with('successComment','Gui binh luan thanh cong');
    }

    public function getThongtincanhan(){
        $user = Auth::user();
        return view('client.page_client.thongtincanhan', compact('user'));
    }

    public function getThongtinHDV($idhdv){
        $cthdv = User::where('id',$idhdv)->get();
        return view('client.page_client.thongtincanhan', compact('cthdv'));
    }

    public function postSuathongtin(Request $request){
       $this -> validate($request,
            [
                'hoten'=>'required',
                'sodienthoai'=>'required|numeric',
            ],
            [
                'hoten.required'=>'Vui long nhap ho ten',
                'sodienthoai.required'=>'Vui long nhap so dien thoai',
                'sodienthoai.numeric'=>'So dien thoai la 1 day so',
            ]);     
        $user = Auth::user();
        $user->hoten = $request->hoten;

        if($request->checkpassword == "on"){
            $this->validate($request,
                [
                    'password'=>'required|min:6|max:30',
                    'passwordAgain' =>'required|same:password'
                ],
                [
                    'password.required' => 'Bạn chưa nhập mật khẩu moi',
                    'password.min' => 'Mật khẩu moi toi thieu 6 kí tự',
                    'password.max' => 'Mật khẩu moi tối đa 30 kí tự',
                    'passwordAgain.required' => 'Bạn chưa nhập lại mật khẩu',
                    'passwordAgain.same' => 'Xac nhan mat khau moi khong đúng'
                ]);
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
        $user->sodienthoai=$request->sodienthoai;
        $user->diachi = $request->diachi;
        if ($request->namsinh != "") {
            $y = date('Y');
            if($y - $request->namsinh  <= 100 && $y - $request->namsinh  >= 3) {
                $user->namsinh = $request->namsinh;
            }else{
                return redirect()->back()->with('loinamsinh','Vui long nhap dung nam sinh');
            }
        }
        if($request->gioitinh != ""){
            $user->gioitinh = $request->gioitinh;
        }
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

    public function postTraloi($idbl, Request $request){
        if(empty($request->traloi)) return redirect()->back()->with('errorReply','loi tra loi.');
   
        $traloi = new Comment();
        $traloi->parent_id = $idbl;
        $traloi->users_id = Auth::user()->id;
        $traloi->tour_id = Comment::find($idbl)->tour_id;
        $traloi->noidung = $request->traloi;
        $traloi->save();
        return redirect()->back()->with('successReply','tra loi thanh cong.');
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
