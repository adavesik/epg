<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Programs;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $prog = new Programs();

        //regex for matching time and program name, eg. 12:01 klklkl
        $regex = '/([0-9:]{5} )(.*)/';
        if($request->has('list', 'channel_id', 'prog_date'))
        {
            $str = $request->input('list');
            $channel_id = $request->input('channel_id');
            $channel = Channel::where('channel_id',$channel_id)->get()[0];
            $channel_id = $channel->id;
            $prog_date = $request->input('prog_date');
        }

        $i = 1;

        $progDateAnotherFormat = str_replace('-', '/', $prog_date);
        $prevProgDate = date('Y-m-d', strtotime("-1 day", strtotime($progDateAnotherFormat)));

        //match all programs with their time
        preg_match_all($regex, $str, $matches, PREG_SET_ORDER, 0);
        if($prog->checkProgramMaxDate($channel_id, $prevProgDate)){
            $end_time = $prog_date.' '.implode(':', explode('.', trim($matches[0][1]))).':00';
            //update record and set last programme end time
            $data = Array (
                'program_end' => $end_time
            );

            if($prog->updateProgramEndDate($channel_id, $data)){
                foreach ($matches as $match){
                    //dd($matches);
                    $tmpstart = trim($match[1]);
                    if (isset($matches[$i])){
                        $tmpend = trim($matches[$i][1]);
                    }
                    else{
                        $tmpend = "00:00";
                    }

                    $starttime = $prog_date.' '.implode(':', explode('.', $tmpstart)).':00';
                    $endtime = $prog_date.' '.implode(':', explode('.', $tmpend)).':00';

                    if($i < count($matches)) {
                        $i++;
                    }
                    else{$endtime = NULL;}

                    $title =  trim($match[2]);
                    $title = preg_replace('/&/', 'and', $title, -1);

                    $programList = Array ("channel_id" => $channel_id,
                        "program_start" => $starttime,
                        "program_end" => $endtime,
                        "title" => $title,
                        "subtitle" => $title,
                        "description" => " ",
                        "date" => '1900-01-01',
                        "category_id" => 1,
                        "icon" => 'Doe',
                        "year" => '2019',
                        "rating_id" => null,
                    );
                    $prog->insertProgramList($programList);
                }
                return response()->json([
                    'error' => false,
                    'message'  => "Daily program successfully saved to DB!",
                ], 200);
            }
        }
        else{
            return response()->json([
                'error' => true,
                'message'  => "Can't find program end date was set to NULL",
            ], 200);
        }

        //dd($prevProgDate);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function check(Request $request)
    {
        $epgTextArray = json_decode($request->epgtext, true);

        //dd($epgTextArray);

        $regex = '/^([0-9]{2}[:]{1}[0-9]{2} )(.*)/';
        $prevuseDate = '00:00';
        $errorArray = array();

        foreach ($epgTextArray as $lineKey => $lineValue) {
            $lineValue = str_replace("։",":", $lineValue);
            if (!preg_match($regex, $lineValue)) {
                $errorArray[$lineKey] = '<b>'.$lineKey.'</b>' . '-րդ տողում ժամի ֆորմատը սխալ է:';
            } elseif (str_replace(":","", substr(trim($prevuseDate), 0, 5)) > str_replace(":","", substr(trim($lineValue), 0, 5))){
                $errorArray[$lineKey] = $lineKey . '-րդ տողում ժամը սխալ է նախորդ հաղորդման նկատմամբ';
            }
            $prevuseDate = $lineValue;
        }

        if($errorArray) {
            return response()->json([
                'error' => true,
                'message'  => $errorArray,
            ], 200);
        }
        else {
            $errorArray[0] = "Daily program format is correct. You can save it to DB.";
            return response()->json([
                'error' => false,
                'message'  => $errorArray,
            ], 200);
        }

        //echo json_encode($errorArray);
    }
}
