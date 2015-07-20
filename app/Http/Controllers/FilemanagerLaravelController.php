<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Pqb\FilemanagerLaravel\FilemanagerLaravel;

class FilemanagerLaravelController extends Controller {

	public function getShow() {
		return view('filemanager-laravel::filemanager.index');
	}


	public function getConnectors() {
		$extraConfig = array('dir_filemanager' => '/media');
        $f = FilemanagerLaravel::Filemanager($extraConfig);
        $f->connector_url = url('/').'/media/filemanager/connectors';
        $f->run();
	}


	public function postConnectors() {
		$extraConfig = array('dir_filemanager' => '/media');
        $f = FilemanagerLaravel::Filemanager($extraConfig);
        $f->connector_url = url('/').'/media/filemanager/connectors';
        $f->run();
	}

}
