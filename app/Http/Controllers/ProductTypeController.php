<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductType;

class ProductTypeController extends Controller
{
    public function getList()
    {
        $theloai = ProductType::all();
        return view('admin.product_type.list',['theloai'=>$theloai]);
    }

    public function getAdd()
    {
        return view('admin.product_type.add');
    }

    public function postAdd(Request $request)
    {
        $this->validate($request,[
                'name'=>'required|min:2|max:100|unique:type_products,name',
            ],[
                'name.required'=>'Bạn chưa nhập tiêu đề',
                'name.min'=>'Tiêu đề phải từ 2 ký tự trở lên',
                'name.max'=>'Tiêu đề tối đa 100 ký tự',
                'name.unique'=>'Tiêu đề đã tồn tại',
            ]);

        $theloai = new ProductType;
        $theloai->name = $request->name;
        $theloai->description = $request->description;
        $theloai->alias = str_slug($request->name);

        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $duoi = $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
            {
                return redirect('admin/product_type/add')->with('thongbao','Bạn chọn hình không đúng định dạng');
            }
            $name = $file->getClientOriginalName();
            $hinh = str_random(5)."-".$name;
            while(file_exists("upload/category/".$hinh))
            {
                $hinh = str_random(5)."-".$name;
            }
            $file->move("upload/category/",$hinh);
            $theloai->image = $hinh;
        }
        else
        {
            $theloai->image = "";
        }
        $theloai->save();
        return redirect('admin/product_type/add')->with('thongbao','Thêm thành công');
        //return view("admin.product_type.add",['thongbao'=>'Thêm thể loại thành công']);
        //return redirect('admin/product_type/list')->with('thongbao','Thêm thể loại thành công');
    }

    public function getEdit($id)
    {
        $theloai = ProductType::find($id);
        return view("admin.product_type.edit",['theloai'=>$theloai]);
    }

    public function postEdit(Request $request,$id)
    {
        $theloai = ProductType::find($id);
        $this->validate($request,[
                'name'=>'required|min:2|max:100',
            ],[
                'name.required'=>'Bạn chưa nhập tiêu đề',
                'name.min'=>'Tiêu đề phải từ 3 ký tự trở lên',
                'name.max'=>'Tiêu đề không quá 100 ký tự',
            ]);

        $theloai->name = $request->name;
        $theloai->description = $request->description;
        $theloai->alias = str_slug($request->name);

        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $duoi = $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
            {
                return redirect('admin/product_type/edit/'.$id)->with('error_img','Bạn chọn hình chưa đúng định dạng');
            }
            $name = $file->getClientOriginalName();
            $hinh = str_random(5)."-".$name;
            while(file_exists("upload/category/".$hinh))
            {
                $hinh = str_random(5)."-".$name;
            }
            unlink("upload/category/".$theloai->image);
            $file->move("upload/category/",$hinh);
            $theloai->image = $hinh;
        }

        $theloai->save();
        // return redirect('admin/product_type/edit/'.$id)->with('thongbao','Sửa thể loại thành công');
        return redirect('admin/product_type/list')->with('thongbao','Sửa thể loại thành công');
    }

    public function getDel($id)
    {
        $theloai = ProductType::find($id);
        $theloai->delete();
        return redirect('admin/product_type/list')->with('thongbao','Xóa thể loại thành công');
    }
}
