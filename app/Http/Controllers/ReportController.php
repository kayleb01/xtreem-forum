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
            'reply_id'=> 'required',
            'thread' => 'required',
            'report' => 'required'
          ]);
          $report = report::create([
            'byUser'     => auth()->id(),
            'report'     => $request->report,
            'reply_id'   => $request->reply_id,
            'thread_id'  => $request->thread,
            'status'     => 0
          ]);
          return $report;

   }

}
