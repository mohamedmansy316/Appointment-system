<?php

namespace App\Http\Traits;

use MacsiDigital\Zoom\Facades\Zoom;
trait MeetingTrait
{
    public function createMeeting($request){

        $user = Zoom::user()->first();

        $meetingData = [
            'topic' => $request->topic,
            'duration' => $request->duration,
            'password' => $request->password,
            'start_time' => $request->start_time,
            'timezone' => config('zoom.timezone')
          // 'timezone' => 'Africa/Cairo'
        ];
        $meeting = Zoom::meeting()->make($meetingData);

        $meeting->settings()->make([
            'join_before_host' => false,
            'host_video' => false,
            'mute_upon_entry' => true,
            'waiting_room' => true,
            'approval_type' => config('zoom.approval_type'),
            'audio' => config('zoom.audio'),
        ]);

        return  $user->meetings()->save($meeting);


    }
}
