<?php

namespace App\Http\Controllers;

use App\Channel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashBoradController extends Controller
{
    public function index()
    {
        $channels = Channel::where(['archived'=>'0'])->get();
        $weekEnd = Carbon::now()->endOfWeek();
        $currentDate = Carbon::now();

        foreach ($channels as $channel)
        {
            if ($channel->programs->isEmpty())
            {
                $channel->clssName = 'bg-danger';
                $channel->last_filled_date = '';
                continue;
            }
            $lastProgram = $channel->programs()->orderBy('program_start','DESC')->limit(1)->first();
            $lastProgramDate = $lastProgram->program_start;
            $lastProgramDate = new Carbon($lastProgramDate);
            $channel->last_filled_date  = Carbon::parse($lastProgramDate)->format('Y-m-d');
            if ( $lastProgramDate->gte($weekEnd) )
            {
                $channel->className = 'bg-success';
            }elseif ( $lastProgramDate->lt($weekEnd) && $lastProgramDate->gte($currentDate) ){
                $channel->className = 'bg-warning';
            }else{
                $channel->className = 'bg-danger';
            }
        }
//        dd($channels);
        return view('pages.dashboard',compact('channels'));

    }
}
