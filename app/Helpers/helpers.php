<?php

use App\Models\Post;
use App\Models\Role;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;

use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Carbon\Carbon;

function settings ($key){

    $setting = Setting::where('key', $key)->first();

    return $setting->value ?? null;
}

function placeholder($type='image'){
    
    if( $type === 'image' ){
        return url('theme_images/placeholder.svg');
    }
    
    return url('theme_images/placeholder.svg');
}

function user_can($action, $args)
{
    $userCan = false;

    if( ! Auth::user() ){
        return $userCan;
    }

    $userRole = Auth::user()->role;
    if( ! $userRole ){
        return $userCan;
    }

    $role = Role::where('slug', $userRole)->pluck($args);
    if( ! $role ){
        return $userCan;
    }

    $userCan = $role[0]['can'][$action] ?? false;

    return $userCan;
}

function get_date ( $date )
{
    return \Carbon\Carbon::parse( $date )->translatedFormat('l j F Y');
}
function get_date_m ( $date )
{
    return \Carbon\Carbon::parse( $date )->translatedFormat('j F Y');
}
function get_month ( $date )
{
    return \Carbon\Carbon::parse( $date )->translatedFormat('F');
}
function get_day ( $date )
{
    return \Carbon\Carbon::parse( $date )->translatedFormat('j');
}

function get_time ( $date )
{
    return \Carbon\Carbon::parse( $date )->format('g:i A');
}

function get_datetime ( $date )
{
    return \Carbon\Carbon::parse( $date )->translatedFormat('l j F Y - h:i a');
}

function get_words($str, $count = 10)
{
    return implode(
        '', 
        array_slice( 
        preg_split(
            '/([\s,\.;\?\!]+)/', 
            $str, 
            $count*2+1, 
            PREG_SPLIT_DELIM_CAPTURE
        ),
        0,
        $count*2-1
        )
    );
}

function seTools (string $title, string $disc, string $type = 'home', string $url, string $keyword, $cat = '', $img='')
{
    SEOMeta::setTitle($title .' &raquo; '. settings('appName') ?? config('app.name'), '' );
    SEOMeta::setDescription( $disc );
    SEOMeta::setCanonical( $url );
    // SEOMeta::addMeta('article:published_time', $date->toW3CString(), 'property');
    SEOMeta::addMeta('article:section', $cat, 'property');
    SEOMeta::addKeyword([$keyword]);

    OpenGraph::setDescription( $disc );
    OpenGraph::setTitle( $title );
    OpenGraph::setUrl( $url );
    OpenGraph::addProperty('type', $type);
    OpenGraph::addImage($img ?? settings('appLogo'));

    TwitterCard::setTitle( $title );
    TwitterCard::setSite( settings('appName') ?? config('app.name'), '' );

    JsonLd::setTitle( $title );
    JsonLd::setDescription( $disc );
    JsonLd::addImage( settings('appLogo') );
}

function can_update_office( $officeId )
{
    $can = false;

    if( !can_view_office( $officeId ) ){
        return false;
    }

    if( user_can('update', 'offices') ){
        $can = true;
    }

    $susc = Auth::user()->subscribe()->where('post_id', $officeId)->first() ?? null;
    
    if( $susc && $susc->terms === 'manager' ){
        $can = true;
    }

    return $can;
}

function can_view_office( $officeId )
{
    $can = false;
    $office = Post::where(['id'=> $officeId, 'type'=> 'office'])->first();
    if( !$office ){
        return false;
    }

    $susc = Auth::user()->subscribe()->where('post_id', $officeId)->first() ?? null;
    
    if( $susc && $susc->status === 'active' ){
        $can = true;
    }
    
    if( user_can('view', 'offices') ){
        $can = true;
    }

    return $can;
}