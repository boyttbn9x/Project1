<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::resource('payment','PaymentController',['only'=>['create','store']]);

Route::get('trang-chu',['as' => 'trang-chu', 'uses' => 'PageController@getTrangchu']);
Route::get('quy-dinh',['as' => 'quy-dinh', 'uses' => 'PageController@getQuydinh']);

Route::get('chi-tiet/{id}', ['as' => 'chi-tiet', 'uses' => 'TourController@show']);

Route::get('dia-diem-{iddd}',['as'=>'diadiem', 'uses'=>'PageController@getDiadiem']);

Route::post('dat-tour-{idtour}',['as' => 'dattour', 'uses' => 'PageController@postDattour']);
Route::get('lich-su-dat-tour',['as'=>'lich-su','uses'=>'PageController@getLichsu']);

Route::get('thong-tin-hdv-{idhdv}',['as' => 'tthdv', 'uses' => 'PageController@getThongtinHDV']);
Route::get('tour-cua-hdv-{idhdv}',['as' => 'tour_hdv', 'uses' => 'PageController@getTourCuaHdv']);

//dang ky
Route::post('dang-ky-khach',['as'=>'dang-ky-khach', 'uses'=> 'PageController@postDangkykhach']);
Route::post('dang-ky-hdv',['as'=>'dang-ky-hdv', 'uses'=> 'PageController@postDangkyhdv']);
Route::post('dang-nhap',['as'=>'dang-nhap', 'uses'=> 'PageController@postDangnhap']);
Route::get('dang-xuat',['as'=>'dang-xuat', 'uses'=> 'PageController@getDangxuat']);

//Binh luan va tra loi
Route::post('binh-luan-{idtour}',['as'=>'binh-luan', 'uses'=> 'PageController@postBinhluan']);
Route::post('tra-loi-{idbl}',['as'=>'tra-loi', 'uses'=> 'PageController@postTraloi']);

//danh gia tour
Route::post('danh-gia-{idtour}',['as'=>'danh-gia','uses' => 'PageController@Danhgia']);

//xem va sua thong tin ca nhan
Route::get('thong-tin-ca-nhan',['as'=>'thong-tin-ca-nhan', 'uses' => 'PageController@getThongtincanhan']);
Route::post('sua-thong-tin',['as'=>'sua-thong-tin', 'uses'=>'PageController@postSuaThongtin']);

Route::get('tim-kiem',['as'=>'tim-kiem','uses' => 'PageController@getTimkiem']);


//--------------------HDV------------------
Route::group(['prefix'=>'hdv','middleware'=>'CheckHDV'], function(){
	Route::get('trang-chu',['as' => 'trang-chu-hdv', 'uses'=>'HdvController@trangchu']);
	Route::resource('tour','TourController');

	Route::get('dsdontour',['as'=>'dsdontour', 'uses'=>'HdvController@getDSdontour']);
	Route::get('dsdontourmoi',['as'=>'dsdontourmoi', 'uses'=>'HdvController@getDSdontourmoi']);
	Route::get('cndontour/{idd}',['as'=>'chapnhan', 'uses'=>'HdvController@getChapnhandon']);
	Route::get('tcdontour/{idd}',['as'=>'tuchoi', 'uses'=>'HdvController@getTuchoidon']);

	Route::get('themanhtour/{idtour}',['as'=>'them-anh-tour', 'uses'=>'HdvController@getThemAnh']);
	Route::post('themanhtour/{idtour}',['as'=>'them-anh-tour', 'uses'=>'HdvController@postThemAnh']);
	Route::get('xoaanh/{idm}',['as'=>'xoa-anh', 'uses'=>'HdvController@getXoaAnh']);
});


//------------------ADMIN------------------
Route::group(['prefix'=>'admin','middleware'=>'CheckAdmin'],function(){
	Route::get('trang-chu',['as'=>'trang-chu-admin', 'uses'=> 'AdminController@trangchu']);

	//quan ly nguoi dung
	Route::get('dskhach',['as'=>'dskhach1', 'uses'=> 'AdminController@getDSkhach']);
	Route::get('xoakhach/{idk}',['as'=>'xoakhach1', 'uses'=> 'AdminController@Xoakhach']);
	Route::get('dshdv',['as'=>'dshdv1', 'uses'=> 'AdminController@getDShdv']);
	Route::get('xoahdv/{idhdv}',['as'=>'xoahdv1', 'uses'=> 'AdminController@Xoahdv']);
	Route::get('chapnhan/{idhdv}',['as'=>'cnhdv1', 'uses'=> 'AdminController@ChapnhanHdv']);

	//quan ly binh luan
	Route::get('dsbinhluan',['as'=>'dsbinhluan', 'uses'=>'AdminController@DSBinhluan']);
	Route::get('xoabinhluan/{idbl}',['as'=>'xoabinhluan', 'uses'=>'AdminController@Xoabinhluan']);

	Route::resource('diadiem','DiaDiemController', ['except'=>['show']]);

	Route::get('thongke-donhang',['as'=>'thongke-donhang', 'uses'=> 'AdminController@ThongkeDonhang']);
	Route::get('thongke-doanhthu',['as'=>'thongke-doanhthu', 'uses'=> 'AdminController@ThongkeDoanhthu']);
});

