<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Http\Requests\DangKyRequest;   
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
        $tour=Tour::paginate(6);
        return view('page_client.index',compact('tour'));
    }

    public function getDiadiem($iddd){
        $idd= Diadiem::find($iddd);     
        return view('page_client.diadiem',compact('idd'));
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
        if($tour->sokhachmax < $request->sokhachdangky || $request->sokhachdangky < 0) return redirect()->back()->with('loi','So khach dang ky phai nho hon hoac bang so khach max.');
        $bill->sokhachdangky = $request->sokhachdangky;
        $bill->save();
        return redirect()->back()->with('successDatTour','Gui don dat tour thanh cong');
    }

    public function getTourOfHdv($idhdv){
        $tour=Tour::where('users_id',$idhdv)->paginate(6);
        return view('page_client.tour_cua_hdv', compact('tour'));
    }

    public function getQuydinh(){
        return view('page_client.quydinh');
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

    public function postDangkyhdv(Request $req){
        $req->session()->flash('message2','');
        $this -> validate($req,
            [
                'hoten'=> 'required',
                'email'=> 'required|email|unique:users,email',
                'password'=> 'required|max:30|min:6',
                'passwordAgain'=> 'same:password',
                'sodienthoai'=> 'required|integer',
                'diachi'=> 'required',
            ],
            [
                'hoten.required'=> 'Vui long nhap ho ten',
                'email.required'=> 'Vui long nhap email',
                'email.email'=> 'Khong dung dinh dang email, vui long nhap lai',
                'email.unique'=> 'Email nay da co nguoi su dung',
                'password.required'=> 'Vui long nhap mat khau',
                'password.min'=> 'Mat khau toi thieu 6 ky tu',
                'password.max'=> 'Mat khau toi da 30 ky ty',
                'passwordAgain.same'=> 'Mat khau xac nhan khong hop le',
                'sodienthoai.required'=> 'Vui long nhap so dien thoai',
                'sodienthoai.integer'=> 'So dien thoai la 1 day so',
                'diachi.required'=> 'Vui long nhap dia chi',
            ]);
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

    public function postDangnhap(Request $req){
        $req->session()->flash('message3','');
    	$this -> validate($req,
            [
                'email'=> 'required|email',
                'password'=> 'required|max:30|min:6',
            ],
            [
                'email.required'=> 'Vui long nhap email',
                'email.email'=> 'Khong dung dinh dang email, vui long nhap lai',
                'password.required'=> 'Vui long nhap mat khau',
                'password.min'=> 'Mat khau toi thieu 6 ky tu',
                'password.max'=> 'Mat khau toi da 30 ky ty',
            ]);
        $check_user = array('email'=>$req->email,'password'=>$req->password);
        $check_admin = array('email'=>$req->email,'password'=>$req->password,'quyen'=>3);
        if(Auth::attempt($check_admin))
            return redirect()->route('trang-chu-admin');
        else if(Auth::attempt($check_user))
            return redirect()->back();
        else
            return redirect()->back()->with('loiDangNhap','Sai tài khoản hoặc mật khẩu!');
    }

    public function getDangxuat(){
        Auth::logout();
        return redirect()->route('trang-chu');
    }

    public function postBinhluan($idtour, Request $request){
        if(empty($request->noidung)) return redirect()->back()->with('loiBinhluan','loi binh luan');
        $iduser = Auth::user()->id;

        $comment = new Comment();
        $comment->noidung = $request->noidung;
        $comment->users_id = $iduser;
        $comment->parent_id = 0;
        $comment->tour_id = $idtour;
        $comment->save();
        return redirect()->back()->with('thanhcong','Gui binh luan thanh cong');
    }

    public function getThongtincanhan(){
        $user = Auth::user();
        return view('page_client.thongtincanhan', compact('user'));
    }

    public function getThongtinHDV($idhdv){
        $cthdv = User::where('id',$idhdv)->get();
        return view('page_client.thongtincanhan', compact('cthdv'));
    }

    public function postSuathongtin(Request $request){
       $this -> validate($request,
            [
                'hoten'=>'required',
                'sodienthoai'=>'required|integer',
            ],
            [
                'hoten.required'=>'Vui long nhap ho ten',
                'sodienthoai.required'=>'Vui long nhap so dien thoai',
                'sodienthoai.integer'=>'So dien thoai la 1 day so',
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
            if ($y - $request->namsinh  <= 100 && $y - $request->namsinh  >= 3) {
                $user->namsinh = $request->namsinh;
            }else return redirect()->back()->with('loinamsinh','Vui long nhap dung nam sinh');
        }
        if($request->gioitinh != "")
            $user->gioitinh = $request->gioitinh;
        $user->save();
        return redirect()->back()->with('suathanhcong','Sua thong tin thanh cong');
    }

    public function getTimkiem(Request $request){
        if(empty($request->timkiem)) return redirect()->back()->with('loiTimkiem','loi tim kiem');
        $tk = $request->timkiem;
        $ketqua = Tour::where('tentour','like','%'.$tk.'%')
                ->orwhere('giatour',$tk)->paginate(6);
        $count  = Tour::where('tentour','like','%'.$tk.'%')
                ->orwhere('giatour',$tk)->get();
        return view('page_client.timkiem',compact('ketqua','count'));
    }

    public function getLichsu(){
        $lichsu = Bill::where('users_id',Auth::user()->id)->paginate(6);
        return view('page_client.lichsudattour', compact('lichsu'));
    }



    public function postTraloi($idbl, Request $request){
        $iduser= Auth::user()->id;
        $idtour = Comment::find($idbl)->tour_id;

        if(empty($request->traloi)) return redirect()->route('chi-tiet',$idtour)->with('loiTraLoi','loi tra loi.');

        $traloi = new Comment();
        $traloi->parent_id = $idbl;
        $traloi->users_id = $iduser;
        $traloi->tour_id = $idtour;
        $traloi->noidung = $request->traloi;
        $traloi->save();
        return redirect()->route('chi-tiet',$idtour);
    }

    public function Danhgia($idtour, Request $request){
        $iduser = Auth::user()->id;
        if($request->sodiem == 0) return redirect()->back()->with('errorRate','Loi danh gia!');
        else
        {
            $rate = new Rate();
            $rate->tour_id = $idtour;
            $rate->users_id = $iduser;
            $rate->sodiem = $request->sodiem;
            $rate->save();
            return redirect()->back()->with('successRate','Cam on ban da danh gia tour.');
        }
    }

}
