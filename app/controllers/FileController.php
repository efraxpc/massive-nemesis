<?php

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

/**
 * ProductController Class
 *
 * Implements actions regarding user management
 */
class FileController extends Controller
{
    /**
     * Displays the form for account creation
     *
     * @return  Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('backend.templates.create_article');
    }
    public function store()
    {
        $repo = App::make('ProductRepository');
        $user = $repo->signup(Input::all());
        //////////Validation////////
        $errors =  array('precio' => 'required','nombre'=>'required');
        $validator = Validator::make(Input::all(), $errors);
        if ($validator->fails()){
            return Redirect::to('product/create')->withErrors($validator);
        }
        /////////
        return View::make('frontend.templates.login_home');
    }

    public function upload_image(){

  		$fileInput = Input::file('file');

  		if (Input::hasFile('file')) {
  			$filename = "imagen__".uniqid();
  			$path     = public_path().'/uploads/';
  			$fileType = $fileInput[0]->getClientOriginalName();
  			$fileSize = $fileInput[0]->getClientSize()/1024;

  			//Ahora procedemos a guardar en la bd

  			$id = Auth::user()->id;
  			$usuario = User::find($id);

  			$file = New Archivo;
  			$file->nombre = $filename;
  			$file->ruta   = $path;
  			$file->tipo   = $fileType;
  			$file->tamaño = $fileSize;

  			$file ->user()->associate($usuario);

  			//guardamos el file en el server
  			if ( $fileInput[0]->move($path,$filename.'.'.$fileInput[0]->getClientOriginalName() ) ) {
  				$file->save();
  			}

  		}
    }
}