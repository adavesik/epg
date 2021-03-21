<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Programs extends Model
{
    protected $fillable = ['channel_id', 'program_start', 'title','category_id'];

    public function getDailyProgramList($channel, $day){
        $programs = DB::table('programs')
            ->select('id', 'channel_id', 'program_start', 'program_end', 'title', 'subtitle', 'description')
            ->whereDate('program_start', '=', $day)
            ->where('channel_id', '=', $channel)
            ->orderBy('program_start', 'ASC')
            ->limit(50)
            ->get();

        return $programs;
    }


    public function getLastProgramDate($channel){
//        dd($channel);

        $lastDate = DB::table('programs')
            ->selectRaw('SUBSTRING(MAX(program_start), 1, 10) as ps')
            ->where('channel_id', '=', $channel)
            ->first();

        return $lastDate;
    }

    public function getLastProgramEndTime($channel){
        $lastDate = DB::table('programs')
            ->selectRaw('MAX(program_end) as max_stop')
            ->where('channel_id', '=', $channel)
            ->first();

        if ($lastDate->max_stop == null) {
            $max_armfirst_stop = date('Y-m-d 00:00:00');
        } else {
            $max_armfirst_stop = $lastDate->max_stop;
        }
        $max_armfirst_stop = str_replace('-', '', str_replace(':', '', str_replace(' ', '', $max_armfirst_stop)));

        return $max_armfirst_stop;
    }


    public function checkProgramMaxDate($channel, $day){
        $lastDate = DB::table('programs')
            ->where('channel_id', '=', $channel)
            ->whereNull('program_end')
            ->whereDate('program_start', $day)
            ->get();

        $lastDate->toArray(); //shoud be 1
        $lastDateCount = count($lastDate);

        if ($lastDateCount == 1){
            return true;
        }
        else{
            return false;
        }
    }


    public function updateProgramEndDate($channel, $newDay){
        $updateDate = DB::table('programs')
            ->where('channel_id', '=', $channel)
            ->whereNull('program_end')
            ->update($newDay);

        return $updateDate;
    }


    public function insertProgramList($data){
        return DB::table('programs')->insert($data);
    }


    public function getSpecificDateProgramsList($channel, $startDate, $endDate){
        return DB::table('programs')
            ->where('channel_id', $channel)
            ->whereDate('program_start', '>=', $startDate)
            ->whereDate('program_end', '<', $endDate)
            ->whereNotNull('program_end')
            ->orderBy('program_start')
            ->get();
    }

}
