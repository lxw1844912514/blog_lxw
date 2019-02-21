<?php

namespace App\Admin\Controllers;

use App\AdminUser;
use Illuminate\Http\Request;

use Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Storage;

class ExcelController extends Controller
{
    //
    public function index()
    {
        return view('admin/excel/index');
    }

    //导出
    public function export()
    {
        /*   $cellData = array(['学号', '姓名', '成绩'], ['10001', 'AAAAA', '99']);
             Excel::create('学生成绩', function ($excel) use ($cellData) {
                 $excel->sheet('score', function ($sheet) use ($cellData) {
                     $sheet->rows($cellData);
                 });
             })->export('xls');*/

//        $email = DB::table('admin_users')->whereRaw('id > ?', [2])->toSql();
        /*$users = DB::table('admin_users')
            ->skip(1)
            ->take(2)
            ->get();
        dd($users);*/

        //方法二：
//        $users = AdminUser::all()->toArray();
//        $users=DB::table('admin_users')->select('id','name','email','created_at','status')->get();
        $users=DB::table('admin_users')->get();
        $header[] = array('ID号', '姓名', '邮箱', '创建时间', '状态');
        $arr = array();
        foreach ($users as$one) {
            $data = array($one->id, $one->name, $one->email, $one->created_at, $one->status);
            array_push($arr, $data);
        }
        $arrData = array_merge($header, $arr);

        Excel::create(iconv('UTF-8', 'UTF-8', '管理员表'), function ($excel) use ($arrData) {
            $excel->sheet('score', function ($sheet) use ($arrData) {
                $sheet->rows($arrData);
            });
        })->store('xlsx')->export('xlsx');
    }

    //导入
    public function import(Request $request)
    {
        /*$filePath = 'storage/exports/' . iconv('UTF-8', 'GBK', '学生成绩') . '.xls';
        Excel::load($filePath, function ($reader) {
            $data = $reader->all();
            dd($data);
        });*/

        $file = $request->file('file');
        $tabl_name = date('YmdHis', time()) . rand(100, 999);
        if (!$file) {
            return back()->withErrors('请选择要上传的文件');
        }
        $entension = $file->getClientOriginalExtension(); //上传文件的后缀.
        $new_name = $tabl_name . '.' . $entension;
        if ($file->isValid()) {
            $path = $request->file('file')->storeAs('import', $new_name);
            // 更新文件本地地址  storage/import/20180720105908.xlsx
            $path = '/public/storage/' . $path;
            Excel::load($path, function ($reader) use ($tabl_name) {
                //获取Excel的第几张表
                $reader = $reader->getSheet(0);
                //获取表中数据
                $data = $reader->toArray();
                $this->create_table($tabl_name, $data);
                return back()->with('success', '上传文件成功');
            });
        } else {
            return back()->withErrors('上传文件失败');
        }
        return redirect('/admin/files');
    }

    //创建表
    public function create_table($table_name, $field_arr)
    {
        $tmp = $table_name;
        $val = $field_arr;
        //创建表结构  因为已经有db_import表不再需要执行创建表结构程序。
        //注意Excel标题最好是英文
        /*  $tables = DB::select("show tables");
          $tables = array_column($tables, 'Tables_in_blog');*/
        $tables = array_map('reset', \DB::select('SHOW TABLES'));
        if (!in_array('db_import', $tables)) {
            Schema::dropIfExists('db_import');
            Schema::create("db_import", function (Blueprint $table) use ($tmp, $val) {
                $fields = $val[0];          //列字段
                $table->increments('id');  //主键
                foreach ($fields as $key => $value) {
                    $table->string($fields[$key]);
                }
            });
        }

        //填充数据
      $value_str = array();
        if ($id = DB::table('db_import')->max('id')) {
            $id = $id + 1;
        } else {
            $id = 1;
        }
        //$id = DB::table('db_import')->max('id') ? DB::table('db_import')->max('id') + 1 : 1;
        foreach ($val as $key => $value) {
            if ($key != 0) {
//                $content = implode(',', $value);
//                $content2 = explode(',', $content);
                foreach ($value as $key2 => $va2) {
                    if (!empty($va2)) {
                        $value_str[] = "'$va2'";
                    }
                }
                $news = implode(',', $value_str);
                if (!empty($news)) {
                    $news = "$id," . $news;
                    DB::insert("insert into db_import VALUES ($news)");
                }

                $value_str = array();
                $id = $id + 1;
            }
        }
        return $id;
    }

    //下载Excel模板文件
    public function downloadExcel()
    {
        //echo asset('storage/photo/moban.png');
        //http://test.open.lixiaowang.top/storage/photo/moban.png
        //$contents = Storage::get('photo/moban.xls');
        $exists = Storage::exists('photo/moban.xls');
        if ($exists) {
            return Storage::download('photo/moban.xls');
        }
    }
}
