<?php
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class Helpers {
        public static function watermark_detail($image,$name,$url){
                $watermark     =  Image::make('logo.jpg');

                $img           =  Image::make($image);
                //#1
                $watermarkSize = $img->width(); //size of the image minus 20 margins
                //#2
                $watermarkSize = $img->width(); //half of the image size
                //#3
                $resizePercentage = 0;//70% less then an actual image (play with this value)

                // resize watermark width keep height auto
                $watermark->resize($watermarkSize, null, function ($constraint) {
                $constraint->aspectRatio();
                });
                //insert resized watermark to image center aligned
                $img->insert($watermark,'center');
                //save new image
                $img->save($url.'/'.$name);
        }
        public static function stripUnicode($str){
          if(!$str) return false;
           $unicode = array(
              'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
              'd'=>'đ',
              'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
              'i'=>'í|ì|ỉ|ĩ|ị',
              'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
              'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
              'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
           );
        foreach($unicode as $nonUnicode=>$uni) $str = preg_replace("/($uni)/i",$nonUnicode,$str);
        return $str;
        }
        
}

?>