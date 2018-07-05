<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Diadiem;
use App\Comment;
use App\Bill;
use App\Tour;

class AdminController extends Controller
{
    public function trangchu(){
    	return view('admin.layout_admin.index');
    }

    public function getDSkhach(){
    	$dskhach = User::select('id','hoten','email','gioitinh','sodienthoai','diachi','namsinh')->where('quyen',1)->get();
    	return view('admin.page_admin.danhsachnguoidung', compact('dskhach'));
    }

    public function getDShdv(){
    	$dshdv = User::select('id','hoten','email','sodienthoai','diachi','status')->where('quyen',2)->get();
    	return view('admin.page_admin.danhsachnguoidung', compact('dshdv'));
    }

    public function Xoakhach($idk){
    	User::find($idk)->delete(); 	
    	return redirect()->back()->with('thongbao','Xoa thanh cong');
    }

    public function Xoahdv($idhdv){
    	User::find($idhdv)->delete();
    	return redirect()->back()->with('thongbao','Xoa thanh cong');
    }

    public function ChapnhanHDV($idhdv){
        $cn = User::find($idhdv);
        $cn->status=2;
        $cn->save();
        return redirect()->back()->with('success','Thanh cong');
    }

    public function DSBinhluan(){
        $comment = Comment::select('comment.id','email','tentour','noidung','tour_id')
        ->join('users','users.id','=','comment.users_id')
        ->join('tour','tour.id','=','comment.tour_id')
        ->get();
        return view('admin.page_admin.dsbinhluan', compact('comment'));
    }

    public function DSTraloi(){
        $traloi = Traloi::all();
        return view('admin.page_admin.dstraloi', compact('traloi'));
    }

    public function Xoabinhluan($idbl){
        Comment::find($idbl)->delete();
        return redirect()->back()->with('thongbao','Xoa binh luan thanh cong');
    }

    public function Xoatraloi($idtl){
        Traloi::find($idtl)->delete();
        return redirect()->back()->with('thongbao','Xoa tra loi binh luan thanh cong');
    }

    public function ThongkeDonhang(){
        $bill = Bill::select('bill.id','tour_id','tentour','sodienthoai','tongtien','timeBD','tinhtrangdon','sokhachdangky','email','bill.created_at')
            ->join('tour','tour.id','=','bill.tour_id')
            ->join('users','bill.users_id','=','users.id')
            ->get();

        return view('admin.page_admin.TKDonhang', compact('bill'));
    }

    public function ThongkeDoanhthu(){
        $bill = Bill::select('email','tongtien','bill.id')
        ->join('tour','tour.id','=','bill.tour_id')
        ->join('users','tour.users_id','=','users.id')
        ->where('tinhtrangdon',3)
        ->get();

        return view('admin.page_admin.TKDoanhthu', compact('bill'));
    }

}
