<?php
namespace app\commands;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
		
		# Create simple, based on action "login" permissions
		$login = $auth->createPermission('login');
		$login->description = 'Default "login" permission';
		$auth->add($login);
		
		# Create simple, based on action "logout" permissions
        $logout = $auth->createPermission('logout');
		$logout->description = 'Default "logout" permission';
		$auth->add($logout);
		
		# Create simple, based on action "error" permissions
        $error = $auth->createPermission('error');
		$error->description = 'Default "error" permission';
		$auth->add($error);
		
		# Create simple, based on action "sign-up" permissions
        $signup = $auth->createPermission('sign-up');
		$signup->description = 'Default "sign-up" permission';
		$auth->add($signup);
		
        // $index = $auth->createPermission('index');
		// $index->description = 'Default "index" permission';
		
        // $view = $auth->createPermission('view');
		// $view->description = 'Default "view" permission';
		
        // $create = $auth->createPermission('create');
		// $create->description = 'Default "create" permission';
		
        // $update = $auth->createPermission('update');
		// $update->description = 'Default "update" permission';
		
        // $delete = $auth->createPermission('delete');
		// $delete->description = 'Default "delete" permission';

        # Create "guest" role
        $guest = $auth->createRole('guest');
		$guest->description = 'Default "guest" role';
        $auth->add($guest);
		
		$auth->addChild($guest, $login);
		$auth->addChild($guest, $logout);
		$auth->addChild($guest, $error);
		$auth->addChild($guest, $signup);

        # Create "member" role
        $member = $auth->createRole('member');
		$member->description = 'Default "member" role';
        $auth->add($member);
		$auth->addChild($member, $guest);

        # Create "member" role
        $admin = $auth->createRole('admin');
		$member->description = 'Default "admin" role';
        $auth->add($admin);
        $auth->addChild($admin, $member);

        # assign role "admin" for "root" user
        // $auth->assign($admin, 1);
    }
}
