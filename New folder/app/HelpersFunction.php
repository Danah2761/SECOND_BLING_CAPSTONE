<?php

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Kutia\Larafirebase\Facades\Larafirebase;

function isNavbarActive(string $url): string
{
    return Request()->is(app()->getLocale().'/'.$url) ? 'active' : '';
}
function isNavbarTreeActive(string $url): string
{
    return Request()->is(app()->getLocale().'/'.$url) ? 'is-expanded' : '';
}
function isFullUrl(string $url): string
{
    return Request()->fullUrl() == url(app()->getLocale().'/'.$url) ? 'active' : '';
}
function getAuthByGuard(string $guard): Authenticatable
{
    return auth()->guard($guard)->user();
}


 function getAverageFeedbackByWorker(\App\Models\Worker $worker): string
 {
    $rate = $worker->with('feedbacks')
        ->withCount(['feedbacks as average_rating' => function ($query) {
            $query->select(DB::raw('coalesce(avg(rate), 0)'));
        }])->first()->average_rating;
    return number_format($rate, 1);
}
// function sendNotification($token, $notification)
//{
//    Http::acceptJson()->withToken(config('fcm.token'))->post(
//        'https://fcm.googleapis.com/fcm/send',
//        [
//            'to' => $token,
//            'notification' => $notification,
//        ]
//    );
//}
function sendNotification($token, $notification)
{
    return Larafirebase::withTitle($notification['title'])
        ->withBody($notification['body'])
        ->withIcon(asset('logo.png'))
        ->withClickAction($notification['url'] ?? '')
        ->withPriority('high')
        ->sendNotification([$token]);
}
