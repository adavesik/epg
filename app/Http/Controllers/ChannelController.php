<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Programs;
use DateTime;
use Intervention\Image\Facades\Image;
use Intervention\Image\ImageServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChannelController extends Controller
{
    protected $channel;

    public function __construct(Channel $channel){
        $this->channel = $channel;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $channels = Channel::where('archived', 0)->orderBy('id', 'desc')->paginate(5);
        return view('pages.channels.index')->with('channels',$channels);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $validator = Validator::make($request->input(), array(
            'channel_id' => 'required',
            'utc_offset' => 'required',
            'name_am' => 'required',
            'name_en' => 'required',
            'name_ru' => 'required',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ));

        $this->channel->display_name_am = $request->name_am;
        $this->channel->display_name_en = $request->name_en;
        $this->channel->display_name_ru = $request->name_ru;
        $this->channel->channel_id = $request->channel_id;
        $this->channel->utc_offset = $request->utc_offset;

        if ($request->has("channel_orig_id")) {
            $this->channel->channel_orig_id = $request->channel_orig_id;
        }

        if( $request->hasFile( 'logo' ) ) {
            $image = $request->file( 'logo' );
            $imageType = $image->getClientOriginalExtension();
            $imageStr = (string) Image::make( $image )->
            resize( 300, null, function ( $constraint ) {
                $constraint->aspectRatio();
            })->encode( $imageType );

            $this->channel->channel_logo = base64_encode( $imageStr );
            $this->channel->channel_logo_type = $imageType;
            $this->channel->save();
        }

        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => $validator->errors(),
            ], 422);
        }

        $channel = $this->channel->save();

        return response()->json([
            'error' => false,
            'channel'  => $channel,
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $channel = Channel::find($id);

        return response()->json([
            'error' => false,
            'channel'  => $channel,
        ], 200);
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        //dd($request);
        $validator = Validator::make($request->input(), array(
            'name_am' => 'required',
        ));

        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => $validator->errors(),
            ], 422);
        }

        $channel = Channel::find($id);
        //TODO add channel_id and channel_logo updates too
        $channel->display_name_am = $request->input('name_am');
        $channel->display_name_ru = $request->input('name_ru');
        $channel->display_name_en = $request->input('name_en');
        $channel->channel_orig_id = $request->input('channel_orig_id');

        $channel->save();

        return response()->json([
            'error' => false,
            'task'  => $channel,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        //$channel = Channel::destroy($id);
        $channel = Channel::find($id);
        $channel->archived = 1;

        $channel->save();

        return response()->json([
            'error' => false,
            'task'  => $channel,
        ], 200);
    }

    public function enable(Request $request)
    {
        //dd($request);
        //$channel = Channel::destroy($id);
        $channel = Channel::find($request->channel_id);
        $channel->archived = 0;

        $channel->save();

        return response()->json([
            'error' => false,
            'task'  => $channel,
        ], 200);
    }

    public function list()
    {
        $channels = Channel::where('archived', 0)->get();
        return response()->json([
            'error' => false,
            'channel'  => $channels,
        ], 200);
    }


    public function epg($id)
    {
        $objChannel = new Channel();
        $program = new Programs();
        //dd($objChannel->getDailyProgramList('24', '2019-11-04'));

        $channel        = $objChannel->getChannelByID($id);
        $lastFilledDate = $program->getLastProgramDate($id);
        $nextFillabelDate = $this->setNextDateToBeFilled($lastFilledDate->ps);
        //dd($nextFillabelDate);
        $prev7Days      = $this->getLastNDays(7,'Y-m-d');

        return view('pages.channels.epg', compact('channel', 'id', 'prev7Days', 'lastFilledDate', 'nextFillabelDate'));
    }


    public function addChannelByURL(Request $request)
    {
        //dd($request);
        $validator = Validator::make($request->input(), array(
            'url' => 'required',
        ));

        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => $validator->errors(),
            ], 422);
        }
        $channelID = $request->channel_id;
        $channel = Channel::findOrFail($channelID);
        $channel->epg_url = $request->input('url');

        $channel->save();

        return response()->json([
            'error' => false,
            'task'  => $channel,
        ], 200);
    }

    public function deleteChannelByURL($id)
    {
        //$channel = Channel::destroy($id);
        $channel = Channel::find($id);
        $channel->epg_url = NULL;

        $channel->save();

        return response()->json([
            'error' => false,
            'task'  => $channel,
        ], 200);
    }

    public function updateChannelByURL(Request $request, $id)
    {
        //dd($request);
        $validator = Validator::make($request->input(), array(
            'url' => 'required',
        ));

        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => $validator->errors(),
            ], 422);
        }

        $channel = Channel::find($id);

        $channel->epg_url = $request->input('url');

        $channel->save();

        return response()->json([
            'error' => false,
            'task'  => $channel,
        ], 200);
    }


    public function fetchChannelEpgByURL($id)
    {
        $program = new Programs();
        //$channel = Channel::destroy($id);
        $channel = Channel::find($id);
        $channelID = $channel->channel_id;
        $xmlUrl = $channel->epg_url;
        $channelOrigID = $channel->channel_orig_id;

        $max_stop = $program->getLastProgramEndTime($channelID);

        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', $xmlUrl, [
            'headers' => ['Accept' => 'application/xml'],
            'timeout' => 120
        ])->getBody()->getContents();

        $responseXml = simplexml_load_string($response);
        $endProgramme = $responseXml->programme;
        $endCount = 0;
        foreach ($responseXml->programme as $temp_programme){
            if($temp_programme['channel'] == $channelOrigID) {
                $endCount++;
                $endProgramme = $responseXml->programme[$endCount];
                if($endProgramme['start'] !='') {
                    if (substr($temp_programme['start'], 0, 14) > $max_stop) {
                        $start_date = substr($temp_programme['start'], 0, 4) . '-'
                            . substr($temp_programme['start'], 4, 2) . '-'
                            . substr($temp_programme['start'], 6, 2) . ' '
                            . substr($temp_programme['start'], 8, 2) . ':'
                            . substr($temp_programme['start'], 10, 2) . ':00';

                        $stop_date = substr($endProgramme['start'], 0, 4) . '-'
                            . substr($endProgramme['start'], 4, 2) . '-'
                            . substr($endProgramme['start'], 6, 2) . ' '
                            . substr($endProgramme['start'], 8, 2) . ':'
                            . substr($endProgramme['start'], 10, 2) . ':00';
                        $title = '';
                        $description = '';
                        $sub_title = '';
                        foreach ($temp_programme->children() as $child_tag) {
                            $child_tag_name = $child_tag->getName();
                            switch ($child_tag_name) {
                                case 'title':
                                    $title = $child_tag;
                                    break;
                                case 'sub-title':
                                    $sub_title = $child_tag;
                                    $tag_title->addAttribute('lang', $child_tag['lang']);
                                    break;
                                case 'desc':
                                    $description = $child_tag;
                                    break;
                                default:
                                    break;
                            }


                            $programList = Array("channel_id" => $channelID,
                                "program_start" => $start_date,
                                "program_end" => $stop_date,
                                "title" => $title,
                                "subtitle" => $title,
                                "description" => $description,
                                "date" => '1900-01-01',
                                "category_id" => 1,
                                "icon" => 'Doe',
                                "year" => '2019',
                                "rating_id" => null,
                            );
                            $program->insertProgramList($programList);
                        }
                        //dd( $channelID . "', '" . $start_date . "', '" . $stop_date . "', '" . $title . "', '" . $sub_title . "', '" . $description);
                    }
                }
            }
        }

        return response()->json([
            'error' => false,
            'message'  => "Congrats!!!",
        ], 200);
    }


    public function setNextDateToBeFilled($current){
        try {
            $date = new DateTime($current);
        } catch (\Exception $e) {
        }
        $date->modify('+1 day');

        return $date->format('Y-m-d') . "\n";
    }


    public function getLastNDays($days, $format = 'd/m')
    {
        $m = date("m");
        $de = date("d");
        $y = date("Y");
        $dateArray = array();
        for ($i = 0; $i <= $days - 1; $i++) {
            $dateArray[] = date($format, mktime(0, 0, 0, $m, ($de - $i), $y));
        }
        return array_reverse($dateArray);
    }


    public function showChannelByURL(Request $request){
        $channelsWithUrl = $this->channel->getChannelsWithUrl();
        return view('pages.epg.byurl')->with('channels',$channelsWithUrl);
    }

    public function disabled()
    {
        $channels = Channel::where('archived', 1)->orderBy('id', 'desc')->paginate(5);
        return view('pages.channels.disabled')->with('channels',$channels);
    }
}
