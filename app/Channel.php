<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Channel extends Model
{
    protected $fillable = ['display_name_am', 'display_name_en', 'display_name_ru', 'channel_logo', 'channel_logo_type', 'epg_url'];

    public function getChannelByID($channel){
        $channelData = DB::table('channels')
            ->where('channel_id', '=', $channel)
            ->get();
        return $channelData;
    }

    public function getChannelIDbyOrigID($orig){
        $channelData = DB::table('channels')
            ->where('channel_orig_id', '=', $orig)
            ->first();
        return $channelData;
    }

    public function getActiveChannelsCount(){
        return DB::table('channels')
            ->where('archived', '=', 0)
            ->count();
    }

    public function getActiveChannels(){
        return DB::table('channels')
            ->where('archived', '=', 0)
            ->whereNull('epg_url')
            ->get();
    }

    public function getChannelsWithUrl(){
        return DB::table('channels')
            ->where('archived', '=', 0)
            ->whereNotNull('epg_url')
            ->get();
    }

    public function programs()
    {
        return $this->hasMany(Programs::class,'channel_id','id');
    }

}
