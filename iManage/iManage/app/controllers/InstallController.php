<?php
use October\Rain\Config\Rewrite as NewConfig;


class InstallController extends BaseController{

	/** 
	*	Check the index
	*/
	public function getIndex()
	{
		if(Config::get('mobius.install'))
		{
			throw new Exception ("Application Already Installed.");
		}
		else
		{
			return View::make('install.syscheck');
		}
	}
	public function getDatabase()
	{
		return View::make('install.database');
	}
	public function postDatabase()
	{
		$data = Input::all();
		$newDbConfig = new NewConfig;
		$newDbConfig->toFile(app_path().'/config/database.php', [
              'connections.mysql.host' =>$data['host'],
              'connections.mysql.database' =>$data['database'],
              'connections.mysql.username' =>$data['username'],
              'connections.mysql.password' =>$data['password'],
            ]);
		
		DB::unprepared(file_get_contents(public_path().'/mobius.sql'));

		return View::make('install.timezone');
	}
	public function postTimeZone()
	{
		$timeZone = Input::get('timezone');
		$newAppConfig = new NewConfig;
		$newAppConfig->toFile(app_path().'/config/app.php', [
              'timezone'=> $timeZone 
            ]);
		return View::make('install.adminaccount');
	}
	public function postAdminAccount()
	{
		$data = Input::all();
		//return View::make('install.done');

		try
        {
            $user = Sentry:: createUser(array(
                'email'=> $data['email'],
                'password'=>$data['password'],
                'activated'=>true,
                'first_name'=>$data['first_name'],
                'last_name'=>$data['last_name'],
                ));
            $group = Sentry::findGroupByName('admin');
            $user->addGroup($group);
            $quicknote = new \Quicknote;
            $quicknote->user_id = $user->id;
            $quicknote->save();
            $userProfile = new \UserProfile;
            $userProfile->id = $user->id;
            $userProfile->save(); 
            $imageResult = App::make('AuthController')->{'createUserImage'}($user->id,$data['first_name'][0],$data['last_name'][0]);
            $installationDate = date('Y-m-d H:i:s');
            $installationHost = Request::server('PATH_INFO');
            $newmobiusConfig = new NewConfig;
			$newmobiusConfig->toFile(app_path().'/config/mobius.php', [
              'install'=> true,
              'version' => '1.0',
              'installationDate'=>$installationDate,
              'installationHost' =>$installationHost 
            ]);
            return View::make('install.done');
        }
        catch(Exception $e)
        {
            Log::error('Something Went Wrong in Install Controller Repository - addUserWithDetails():'. $e->getMessage());
            return false;
        }  
	}
}