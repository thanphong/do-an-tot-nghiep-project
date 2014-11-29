<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
*/
class AppController extends Controller {
	var $helpers = array("Form","Html","Common","User","Userform","Giangvien","Js","Paginator","Session");
	var $layout = null;
	var $components = array('Session','Auth' => array(
		'loginAction'=>array('Controller' => 'Users', 'action' => 'login'),
        'loginRedirect' => array('Controller' => 'Users', 'action' => 'index'),
        'logoutRedirect' => array('Controller' => 'Users', 'action' => 'index'),
        'authError' => 'You must be logged in to view this page.',
        'loginError' => 'Invalid Username or Password entered, please try again.',
		'authenticate' => array( 'Form' => array('userModel' => 'User',
      	'fields' => array('username' => 'maGiangvien', 'password' => 'matKhau')))));
	var $roles=null;
	var $numberpage=5;
	var $numberRecord=5;
	var $numberpageStep=3;
	// only allow the login controllers only
	public function beforeFilter() {
		$this->Auth->authorize = 'Controller';
		$this->Auth->actionPath = 'Controllers/';
		$this->Auth->authorize = 'Controller';
	}
	
	public function isAuthorized($user) {
		// Here is where we should verify the role and give access based on role
		return true;
	}
	//
	public function isGiaovu(){
		$roles=$this->Session->read('roles');
		try {
			if(is_array($roles)&&in_array(2,$roles)){
				$this->layout="giaovu";
				return true;
			}
		} catch (Exception $e) {
			return false;
		}
		
		
	}
	public function isGiangvien(){
		$roles=$this->Session->read('roles');
		try {
			if(is_array($roles)&&in_array(3,$roles)){
				$this->layout="giangvien";
				return true;
			}
		} catch (Exception $e) {
			return false;
		}
		return false;
	}
	//
	public function pagination($page,$numberrecord,$end){
		$numberrecord=($numberrecord/$this->numberRecord>0?($numberrecord%$this->numberRecord>0? (int)($numberrecord/$this->numberRecord)+1:(int)($numberrecord/$this->numberRecord)):1);
		$end=($end<$numberrecord?$end:$numberrecord);
		$pageend=$page+$this->numberpageStep;
		$pageend=($pageend<=$end?($page-$this->numberpageStep>($end-$this->numberpage)?$end:($page-$this->numberpageStep>1?$end-$this->numberpageStep+1:$this->numberpage)):($pageend<$numberrecord?$pageend:$numberrecord));
		$pagebgin=$pageend-$this->numberpage+1;
		$pagebgin=($pagebgin>1?$pagebgin:1);
		$this->set("pageend",$pageend);
		$this->set("pagebgin",$pagebgin);
		$this->set("page",$page);
		$this->set("numberrecord",$numberrecord);
	
	}
	
}
