<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\attachement;
use Intervention\Image\ImageManagerStatic as Image;

class AttachmentsController extends Controller
{
    
   public function upload_save($file)
   {
   	foreach ($file as $files) {
   			dd($files);
   	}
   
   // 	 if($request->hasFile('pic')){
   //       $fulnameWithExt = $request->pic->getClientOriginalName();
   //       $filenam =  pathinfo($fulnameWithExt, PATHINFO_FILENAME);
   //       $ext  = $request->pic->getClientOriginalExtension();
   //       $filename  =  '$qwcsdiuhj'.time().'.'.$ext;
   //       $path = $request->pic->storeAs("public/storage/img", $filename);
   //       $upload = User::where('id', $request->id)->update(['image_url' => $filename]);
   //       if($upload){
   //          return back();
   //       }
   //    }else{
   //     return back()->with('error', 'Upload failed, please try again');  
   //    }
   // }
	}
}