<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Epg;
use App\Programs;
use DOMDocument;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use SimpleXMLElement;
use Spatie\ArrayToXml\ArrayToXml;

class EpgController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("pages.epg.generate");
        //dd($result);
    }

    public function buildFullEPG(Request $request){

        //dd($request);
        $objChannel = new Channel();
        $objProgram = new Programs();
        $channelList = $objChannel->getActiveChannels();

        if ($request->has('datefilter')){
            $dateRange = $request->datefilter;
        }
        else{
            // TODO add error message
        }

        $UTCoffset ='+0400';
        $tempDate = explode(" - ", $dateRange);

        //dd($tempDate);
        $startDate = date('Y-m-d', strtotime("+0 day", strtotime(trim($tempDate[0]))));
        $endDate = date('Y-m-d', strtotime("+1 day", strtotime(trim($tempDate[1]))));


        $yourFileNameHere = "FullEPG.xml";

        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><!DOCTYPE tv SYSTEM "http://xmltv.cvs.sourceforge.net/viewvc/xmltv/xmltv/xmltv.dtd"><tv generator-info-name="cvs2xmltv"/>');

        //generate XML first part
        foreach ($channelList as $channel){
            $channelTag = $xml->addChild('channel');
            $channelTag->addAttribute('id', $channel->channel_id);
            if($channel->display_name_am !="") {
                $channelTag->addChild('display-name', $channel->display_name_am)->addAttribute('lang', 'am');
            }
            if($channel->display_name_en !="") {
                $channelTag->addChild('display-name', $channel->display_name_en)->addAttribute('lang', 'en');
            }
            if($channel->display_name_ru !="") {
                $channelTag->addChild('display-name', $channel->display_name_ru)->addAttribute('lang', 'ru');
            }
        }

        foreach ($channelList as $channel){

            $programsList = $objProgram->getSpecificDateProgramsList($channel->channel_id, $startDate, $endDate);

            foreach ($programsList as $program){
                $programme = $xml->addChild('programme');
                $programme->addAttribute('channel', $program->channel_id);
                $programme->addAttribute('stop', str_replace(' ','', str_replace('-','',str_replace(':','',$program->program_end))). ' '.$channel->utc_offset);
                $programme->addAttribute('start',str_replace(' ','', str_replace('-','',str_replace(':','',$program->program_start))). ' '.$channel->utc_offset);


                $tag_title = $programme->addChild('title', str_replace('"', '',$program->title));
                $tag_title->addAttribute('lang','en');

                if(trim($program->description) != "") {
                    $tag_description = $programme->addChild('desc', str_replace('"', '',$program->description));
                    $tag_description->addAttribute('lang', 'en');
                }
            }
        }

        $dom = new DOMDocument("1.0");
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;
        $result = $xml->asXML();

        $response = Response::create($result, 200);
        $response->header('Content-Type', 'text/xml');
        $response->header('Cache-Control', 'public');
        $response->header('Content-Description', 'File Transfer');
        $response->header('Content-Disposition', 'attachment; filename=' . $yourFileNameHere . '');
        $response->header('Content-Transfer-Encoding', 'binary');
        return $response;
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
        //
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

}
