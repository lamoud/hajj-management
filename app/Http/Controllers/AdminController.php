<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\Models\Building;
use App\Models\Bus;
use App\Models\Camp;
use App\Models\Pilgrim;
use App\Models\Setting;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RalphJSmit\Laravel\SEO\Support\SEOData;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function admin_show ()
    {
        $title = __('Dashboard');
        $pageType = 'admin_show';
        $agencies = Agency::count();
        $camps = Camp::count();
        $buildings = Building::count();
        $units = Unit::count();
        $pilgrims = Pilgrim::count();
        $users = User::count();
        $roles = Role::count();
        $buses = Bus::count();
        $SEOData = new SEOData(
            title: $title,
            description: settings('appName'),
            author: settings('appName'),
            site_name: settings('appName'),
            image: settings('appLogo'),
        );
        return view('admin.admin_show', compact(
            'title',
            'SEOData',
            'pilgrims',
            'buildings',
            'units',
            'camps',
            'agencies',
            'users',
            'roles',
            'buses',
            'pageType'
        ));
    }

    // Start season_management
    public function season_management()
    {
        $title = __('Season management');
        $pageType = 'season_management';
        $SEOData = new SEOData(
            title: $title,
            description: settings('appName'),
            author: settings('appName'),
            site_name: settings('appName'),
            image: settings('appLogo'),
        );
        return view('admin.season.season_management', compact('title', 'pageType', 'SEOData'));

    }
    // End season_management

    // Start agency_management
    public function agency_management()
    {
        $title = __('Agency management');
        $pageType = 'agency_management';
        $SEOData = new SEOData(
            title: $title,
            description: settings('appName'),
            author: settings('appName'),
            site_name: settings('appName'),
            image: settings('appLogo'),
        );
        return view('admin.agency.agency_management', compact('title', 'pageType', 'SEOData'));

    }
    // End agency_management
    // Start camps_management
    public function camps_management()
    {
        $title = __('Mena camps');
        $pageType = 'camps_management';
        $SEOData = new SEOData(
            title: $title,
            description: settings('appName'),
            author: settings('appName'),
            site_name: settings('appName'),
            image: settings('appLogo'),
        );
        return view('admin.camps.camps_management', compact('title', 'pageType', 'SEOData'));

    }
    public function arafa_camps()
    {
        $title = __('Arafa camps');
        $pageType = 'arafa_camps';
        $SEOData = new SEOData(
            title: $title,
            description: settings('appName'),
            author: settings('appName'),
            site_name: settings('appName'),
            image: settings('appLogo'),
        );
        return view('admin.camps.arafa_camps', compact('title', 'pageType', 'SEOData'));

    }
    public function muzdalifah_camps()
    {
        $title = __('Muzdalifah camps');
        $pageType = 'muzdalifah_camps';
        $SEOData = new SEOData(
            title: $title,
            description: settings('appName'),
            author: settings('appName'),
            site_name: settings('appName'),
            image: settings('appLogo'),
        );
        return view('admin.camps.muzdalifah_camps', compact('title', 'pageType', 'SEOData'));

    }
    // End camps_management
    // Start buildings_management
    public function buildings_management()
    {
        $title = __('Buildings management');
        $pageType = 'buildings_management';
        $SEOData = new SEOData(
            title: $title,
            description: settings('appName'),
            author: settings('appName'),
            site_name: settings('appName'),
            image: settings('appLogo'),
        );
        return view('admin.buildings.buildings_management', compact('title', 'pageType', 'SEOData'));

    }
    // End buildings_management
    // Start units_management
    public function units_management()
    {
        $title = __('Units management');
        $pageType = 'units_management';
        $SEOData = new SEOData(
            title: $title,
            description: settings('appName'),
            author: settings('appName'),
            site_name: settings('appName'),
            image: settings('appLogo'),
        );
        return view('admin.units.units_management', compact('title', 'pageType', 'SEOData'));

    }
    public function units_management_type()
    {
        $title = __('Units type');
        $pageType = 'units_management_type';
        $SEOData = new SEOData(
            title: $title,
            description: settings('appName'),
            author: settings('appName'),
            site_name: settings('appName'),
            image: settings('appLogo'),
        );
        return view('admin.units.units_management_type', compact('title', 'pageType', 'SEOData'));

    }
    // End units_management
    // Start pilgrims_management
    public function pilgrims_management()
    {
        $title = __('Pilgrims management');
        $pageType = 'pilgrims_management';
        $SEOData = new SEOData(
            title: $title,
            description: settings('appName'),
            author: settings('appName'),
            site_name: settings('appName'),
            image: settings('appLogo'),
        );
        return view('admin.pilgrims.pilgrims_management', compact('title', 'pageType', 'SEOData'));

    }
    // End pilgrims_management
    // Start buses_management
    public function buses_management()
    {
        $title = __('Buses management');
        $pageType = 'buses_management';
        $SEOData = new SEOData(
            title: $title,
            description: settings('appName'),
            author: settings('appName'),
            site_name: settings('appName'),
            image: settings('appLogo'),
        );
        return view('admin.buses.buses_management', compact('title', 'pageType', 'SEOData'));

    }
    public function bus_escalation()
    {
        $title = __('Bus escalation');
        $pageType = 'bus_escalation';
        $SEOData = new SEOData(
            title: $title,
            description: settings('appName'),
            author: settings('appName'),
            site_name: settings('appName'),
            image: settings('appLogo'),
        );
        return view('admin.buses.bus_escalation', compact('title', 'pageType', 'SEOData'));

    }
    public function buses_swap()
    {
        $title = __('Buses swap');
        $pageType = 'buses_swap';
        $SEOData = new SEOData(
            title: $title,
            description: settings('appName'),
            author: settings('appName'),
            site_name: settings('appName'),
            image: settings('appLogo'),
        );
        return view('admin.buses.buses_swap', compact('title', 'pageType', 'SEOData'));

    }
    // End buses_management
    // Start gift_management
    public function gift_management()
    {
        $title = __('Gift management');
        $pageType = 'gift_management';
        $SEOData = new SEOData(
            title: $title,
            description: settings('appName'),
            author: settings('appName'),
            site_name: settings('appName'),
            image: settings('appLogo'),
        );
        return view('admin.gifts.gift_management', compact('title', 'pageType', 'SEOData'));

    }
    public function gift_distribution()
    {
        $title = __('Gifts distribution');
        $pageType = 'gift_distribution';
        $SEOData = new SEOData(
            title: $title,
            description: settings('appName'),
            author: settings('appName'),
            site_name: settings('appName'),
            image: settings('appLogo'),
        );
        return view('admin.gifts.gift_distribution', compact('title', 'pageType', 'SEOData'));

    }
    // End gift_management
    // Start services_management
    public function services_management()
    {
        $title = __('Services management');
        $pageType = 'services_management';
        $SEOData = new SEOData(
            title: $title,
            description: settings('appName'),
            author: settings('appName'),
            site_name: settings('appName'),
            image: settings('appLogo'),
        );
        return view('admin.services.services_management', compact('title', 'pageType', 'SEOData'));

    }
    public function service_providing()
    {
        $title = __('Service providing');
        $pageType = 'service_providing';
        $SEOData = new SEOData(
            title: $title,
            description: settings('appName'),
            author: settings('appName'),
            site_name: settings('appName'),
            image: settings('appLogo'),
        );
        return view('admin.services.service_providing', compact('title', 'pageType', 'SEOData'));

    }
    // End services_management
    // Start attachments_management
    public function bracelets_management()
    {
        $title = __('Bracelets management');
        $pageType = 'bracelets_management';
        $SEOData = new SEOData(
            title: $title,
            description: settings('appName'),
            author: settings('appName'),
            site_name: settings('appName'),
            image: settings('appLogo'),
        );
        return view('admin.attachments.bracelets_management', compact('title', 'pageType', 'SEOData'));

    }
    public function stickers_management()
    {
        $title = __('Stickers management');
        $pageType = 'stickers_management';
        $SEOData = new SEOData(
            title: $title,
            description: settings('appName'),
            author: settings('appName'),
            site_name: settings('appName'),
            image: settings('appLogo'),
        );
        return view('admin.attachments.stickers_management', compact('title', 'pageType', 'SEOData'));

    }
    // End attachments_management
    // Start media
    public function admin_media ()
    {

        $title = __('Media');
        $pageType = 'admin_media';
        $SEOData = new SEOData(
            title: $title,
            description: settings('appName'),
            author: settings('appName'),
            site_name: settings('appName'),
            image: settings('appLogo'),
        );
        return view('admin.media.admin_media', compact('title', 'pageType', 'SEOData'));
    }
    // End media
    // Start admin_roles
    public function admin_roles ()
    {
        $title = __('Roles');
        $pageType = 'admin_roles';
        $SEOData = new SEOData(
            title: $title,
            description: settings('appName'),
            author: settings('appName'),
            site_name: settings('appName'),
            image: settings('appLogo'),
        );
        return view('admin.roles.admin_roles', compact('title', 'SEOData', 'pageType'));
    }
    // End admin_roles
    // Start users
    public function dashboard_users (Request $request)
    {
        $title = __('Users');
        $pageType = 'dashboard_users';

        $user_role = $request['role'] ?? null;

        $roles_array = Role::pluck('name')->toArray();;

        //dd(User::role('admin')->get());
        if(  $user_role && in_array($user_role, $roles_array)){

            $users = User::role( $user_role )->orderBy('created_at', 'DESC')->paginate(20)->appends(request()->query());
        
        }else{

            $users = User::orderBy('created_at', 'DESC')->paginate(20)->appends(request()->query());

        }

        $all = User::count();
        $admins = User::role( 'admin' )->count();
        $editors = 0;
        $authors = 0;
        $users_c = User::role( 'user' )->count();
        $clients = 0;

        $SEOData = new SEOData(
            title: $title,
            description: settings('appName'),
            author: settings('appName'),
            site_name: settings('appName'),
            image: settings('appLogo'),
        );
        return view('admin.users.dashboard_users', compact('title', 'SEOData', 'pageType', 'users', 'user_role', 'all', 'admins', 'editors', 'authors', 'users_c', 'clients'));
    }

    public function dashboard_users_new ()
    {
        $title = __('Add new user');
        $pageType = 'dashboard_users_new';

        $roles = Role::whereNotIn('name', ['super_admin', 'client'])->get();
        $SEOData = new SEOData(
            title: $title,
            description: settings('appName'),
            author: settings('appName'),
            site_name: settings('appName'),
            image: settings('appLogo'),
        );
        return view('admin.users.dashboard_users_new', compact('title', 'SEOData', 'pageType', 'roles'));
    }

    public function validate_dashboard_users_new (Request $request)
    {
        if( ! Auth::user()->can('users_add') ){
            return redirect()->back()->with('error', __('Sorry! You are not authorized to perform this action.'));
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', 'string', 'not_in:super_admin','not_in:client', 'exists:roles,name']
        ]);

        $create = User::create([
            'name' => strip_tags($request->name),
            'email' => strip_tags($request->email),
            'password' => Hash::make($request->passowrd),
        ]);

        if( ! $create ){
            return redirect()->back()->with('success', 'لم نتمكن من تنفيذ طلبك، برجاء المحاولة بعد قليل!');
        }

        $create->assignRole($request->role);
        event(new Registered($create));

        return redirect()->to(route('dashboard_users_update', [$create->id, $create->email]))->with('success', __('The action ran successfully!'));
    }

    public function dashboard_users_update ( $id, $email )
    {

        $user = User::where(['id'=> $id, 'email'=> $email])->first();
        if( ! $user || $user->role === 'super_admin' ){
            abort(404);
        }

        $title = __('Edit') . ' ' . $user->name;
        $pageType = 'dashboard_users_update';

        $roles = Role::whereNotIn('name', ['super_admin'])->get();
        $SEOData = new SEOData(
            title: $title,
            description: settings('appName'),
            author: settings('appName'),
            site_name: settings('appName'),
            image: settings('appLogo'),
        );
        return view('admin.users.dashboard_users_update', compact('title', 'SEOData', 'pageType', 'user', 'roles'));
    }

    public function validate_dashboard_users_update (Request $request, $id, $email)
    {
        if( ! user_can('update', 'users') ){
            return redirect()->back()->with('error', __('Sorry! You are not authorized to perform this action.'));
        }

        $user = User::where(['id'=> $id, 'email'=> $email])->first();
        if( ! $user ){
            abort(404);
        }
        
        $pass = isset($request->password) && $request->password !== null ? Hash::make($request->password) : $user->password;
        $role = $user->role === 'super_admin' ? 'super_admin' : strip_tags($request->role);

        if( $user->email === $request->email ){

            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'exists:users,email,id,'.$user->id],
                'password' => ['sometimes', 'nullable', 'string', 'min:8'],
                'role' => ['required', 'string', 'not_in:super_admin', 'exists:roles,slug']
            ]);

        }else{

            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['sometimes', 'nullable', 'string', 'min:8'],
                'role' => ['required', 'string', 'not_in:super_admin', 'exists:roles,slug']
            ]);

        }

        $update = $user->update([
            'name' => strip_tags($request->name),
            'email' => strip_tags($request->email),
            'password' => $pass,
            'role' => $role
        ]);

        if( ! $update ){
            return redirect()->back()->with('error', 'لم نتمكن من تنفيذ طلبك، برجاء المحاولة بعد قليل!');
        }

        return redirect()->to(route('dashboard_users_update', [$user->id, $user->email]))->with('success', __('The action ran successfully!'));
    }

    public function validate_dashboard_users_delete (Request $request, $id, $email)
    {

        if( ! Auth::user()->can('users_add') ){
            return response(__('Sorry! You are not authorized to perform this action.'), 400);
        }

        $user = User::where(['id'=> $id, 'email'=> $email])->first();
        if( ! $user ){
            return response(__('Account not found, try again later!'), 400);

        }

        if( $user->id === 1 || $user->hasRole('super_admin') ){
            return response(__('The main account on the site cannot be deleted!'), 400);
        }
        
        $user->delete();

        return response(['msg'=>__('Deleted!'), 'id'=>$id], 200);
    }
    // End users
    // Start settings
    public function admin_settings ()
    {

        $title = __('General settings');
        $pageType = 'admin_settings';
        $SEOData = new SEOData(
            title: $title,
            description: settings('appName'),
            author: settings('appName'),
            site_name: settings('appName'),
            image: settings('appLogo'),
        );
        return view('admin.settings.admin_settings', compact('title', 'SEOData', 'pageType'));

    }

    public function validate_admin_settings (Request $request)
    {
        if( ! Auth::user()->can('settings_update') ){
            return redirect()->back()->with('error', __('Sorry! You are not authorized to perform this action.'));
        }

        $request->validate([
            'appName'    => ['required', 'string', 'min:3', 'max:30'],
            'appDisc'    => ['sometimes', 'nullable', 'string', 'max:500'],
            'appMetaTags'    => ['sometimes', 'nullable', 'string', 'min:3', 'max:500'],
            'appLogo'    =>  ['sometimes', 'nullable', 'exists:filemanager,absolute_url'],
            'appMiniLogo'    =>  ['sometimes', 'nullable', 'exists:filemanager,absolute_url'],
            'appDarkLogo'    =>  ['sometimes', 'nullable', 'exists:filemanager,absolute_url'],
            'appMiniDarkLogo'    =>  ['sometimes', 'nullable', 'exists:filemanager,absolute_url'],
            'appIcon'    =>  ['sometimes', 'nullable', 'exists:filemanager,absolute_url'],

        ]);
            
        $upsert = Setting::upsert(
            [
                ['key'=>'appName', 'value'=> strip_tags($request['appName'])],
                ['key'=>'appDisc', 'value'=> strip_tags($request['appDisc'])],
                ['key'=>'appMetaTags', 'value'=> strip_tags($request['appMetaTags'])],
                ['key'=>'appLogo', 'value'=> $request['appLogo']],
                ['key'=>'appMiniLogo', 'value'=> $request['appMiniLogo']],
                ['key'=>'appDarkLogo', 'value'=> $request['appDarkLogo']], 
                ['key'=>'appMiniDarkLogo', 'value'=> $request['appMiniDarkLogo']], 
                ['key'=>'appIcon', 'value'=> $request['appIcon']]
            ],'key'
        );

        if ( ! $upsert ){
            return redirect()->back()->with('error', 'لم نتمكن من تنفيذ طلبك، برجاء المحاولة بعد قليل!');
        }

        return redirect()->back()->with('success', __('The action ran successfully!'));
    }
    public function admin_social ()
    {

        $title = __('Social media');
        $pageType = 'admin_social';
        $SEOData = new SEOData(
            title: $title,
            description: settings('appName'),
            author: settings('appName'),
            site_name: settings('appName'),
            image: settings('appLogo'),
        );
        return view('admin.settings.admin_social', compact('title', 'SEOData', 'pageType'));

    }

    public function validate_admin_social (Request $request)
    {
        if( ! Auth::user()->can('settings_update') ){
            return redirect()->back()->with('error', __('Sorry! You are not authorized to perform this action.'));
        }

        $request->validate([
            'appFaceboke'    => ['nullable', 'url'],    
            'appTwiter'    => ['nullable', 'url'],    
            'appInstagram'    => ['nullable', 'url'],   
            'appYoutube'    => ['nullable', 'url'],   
            'appWhatsapp'    => ['nullable', 'numeric', 'digits_between:9,15'],  
            'appMobile'    => ['nullable', 'numeric', 'digits_between:9,15'],   
            'appAddress'    => ['nullable', 'string'],   
            'appMail'    => ['nullable', 'email'],   
        ]);
            
        $upsert = Setting::upsert(
            [
                ['key'=>'appFaceboke', 'value'=> strip_tags($request['appFaceboke'])],
                ['key'=>'appTwiter', 'value'=> strip_tags($request['appTwiter'])],
                ['key'=>'appInstagram', 'value'=> strip_tags($request['appInstagram'])],
                ['key'=>'appYoutube', 'value'=> $request['appYoutube']],
                ['key'=>'appWhatsapp', 'value'=> $request['appWhatsapp']],
                ['key'=>'appMobile', 'value'=> $request['appMobile']], 
                ['key'=>'appAddress', 'value'=> $request['appAddress']], 
                ['key'=>'appMail', 'value'=> $request['appMail']]
            ],'key'
        );

        if ( ! $upsert ){
            return redirect()->back()->with('error', 'لم نتمكن من تنفيذ طلبك، برجاء المحاولة بعد قليل!');
        }

        return redirect()->back()->with('success', __('The action ran successfully!'));
    }

    public function admin_maintenance ()
    {

        $title = __('Maintenance mode');
        $pageType = 'admin_maintenance';
        $SEOData = new SEOData(
            title: $title,
            description: settings('appName'),
            author: settings('appName'),
            site_name: settings('appName'),
            image: settings('appLogo'),
        );

        return view('admin.settings.admin_maintenance', compact('title', 'SEOData', 'pageType'));

    }

    public function validate_admin_maintenance (Request $request)
    {
        if( ! Auth::user()->can('settings_update') ){
            return redirect()->back()->with('error', __('Sorry! You are not authorized to perform this action.'));
        }

        $request->validate([
            'appMaintenance'    => ['sometimes', 'nullable', 'string', 'in:on'],
            'appMaintenanceContent'    => ['sometimes', 'nullable', 'string', 'min:3'],
        ]);
        
        $upsert = Setting::upsert(
            [
                ['key'=>'appMaintenance', 'value'=> strip_tags($request['appMaintenance'])],
                ['key'=>'appMaintenanceContent', 'value'=> $request['appMaintenanceContent']],
            ],'key'
        );

        if ( ! $upsert ){
            return redirect()->back()->with('error', 'لم نتمكن من تنفيذ طلبك، برجاء المحاولة بعد قليل!');
        }

        return redirect()->back()->with('success', __('The action ran successfully!'));
    }
    
    public function admin_appterms ()
    {

        $title = __('Terms of Service');
        $pageType = 'admin_appterms';

        $SEOData = new SEOData(
            title: $title,
            description: settings('appName'),
            author: settings('appName'),
            site_name: settings('appName'),
            image: settings('appLogo'),
        );
        return view('admin.settings.admin_appterms', compact('title', 'SEOData', 'pageType'));

    }

    public function validate_admin_appterms (Request $request)
    {
        if( ! Auth::user()->can('settings_update') ){
            return redirect()->back()->with('error', __('Sorry! You are not authorized to perform this action.'));
        }

        $request->validate([
            'appTerms'    => ['sometimes', 'nullable'],
        ]);

        $upsert = Setting::upsert(
            [
                ['key'=>'appTerms', 'value'=> $request['appTerms']],

            ],'key'
        );

        if ( ! $upsert ){
            return redirect()->back()->with('error', 'لم نتمكن من تنفيذ طلبك، برجاء المحاولة بعد قليل!');
        }

        return redirect()->back()->with('success', __('The action ran successfully!'));
    }

    public function admin_apppolicy ()
    {

        $title = __('Privacy Policy');
        $pageType = 'admin_apppolicy';
        $SEOData = new SEOData(
            title: $title,
            description: settings('appName'),
            author: settings('appName'),
            site_name: settings('appName'),
            image: settings('appLogo'),
        );
        return view('admin.settings.admin_apppolicy', compact('title', 'SEOData', 'pageType'));

    }

    public function validate_admin_apppolicy (Request $request)
    {
        if( ! Auth::user()->can('settings_update') ){
            return redirect()->back()->with('error', __('Sorry! You are not authorized to perform this action.'));
        }

        $request->validate([
            'appPolicy'    => ['sometimes', 'nullable'],
        ]);

        $upsert = Setting::upsert(
            [
                ['key'=>'appPolicy', 'value'=> $request['appPolicy']],

            ],'key'
        );

        if ( ! $upsert ){
            return redirect()->back()->with('error', 'لم نتمكن من تنفيذ طلبك، برجاء المحاولة بعد قليل!');
        }

        return redirect()->back()->with('success', __('The action ran successfully!'));
    }
    // End settings
}
