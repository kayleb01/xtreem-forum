<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\report;
use Auth;

class ReportController extends Controller
{
   public function create(Request $request)
   {
          $request->validate([
            'comment'=> 'required',
            'thread' => 'required',
            'report' => 'required'
          ]);
          $report = report::create([
            'byUser'     => Auth::user()->id,
            'report'     => $request->report,
            'comment_id' => $request->comment,
            'thread_id'  => $request->thread,
            'status'     => 0
          ]);
          return $report;

   }

}
