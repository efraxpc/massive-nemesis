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
//      dd($fileInput);die;
echo "aqui llega";
die;
  		if (Input::hasFile('file')) {
  			$filename = "imagen__".uniqid();
  			$path     = public_path().'/uploads/';
  			$fileType = $fileInput[0]->getClientOriginalName();
  			$fileSize = $fileInput[0]->getClientSize()/1024;

  			//Ahora procedemos a guardar en la bd
  			$id = Auth::user()->id;
        $max_3_files_asociated_in_files_table = DB::select('SELECT max_3_files_asociated_in_files_table(?) as files_aso',array($id));
        $usuario = User::find($id);  

        if ($max_3_files_asociated_in_files_table[0]->files_aso == 0) {
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
        }else{
          echo "tienes ma de 3";
        }
  		}
    }

    public function edit_imagen($id)
    {
        $user = User::find($id);
        if (is_null($user))
        {
            return Redirect::route('login');
        }

        $files = DB::table('users')
            ->join('files', 'users.id', '=', 'files.user_id')
            ->select('files.id','files.nombre','files.tipo','users.email')
            ->where('users.id', '=', $id)
            ->get();

        $max_3_files_asociated_in_files_table = DB::select('SELECT max_3_files_asociated_in_files_table(?) as files_aso',array($id));

        $array = array('user'                 => $user,
                      'files'                 => $files,
                      'files_asociated_table' => $max_3_files_asociated_in_files_table[0]);

            // echo "<pre>";
            // dd($max_3_files_asociated_in_files_table[0]);
            // die;
        return View::make('backend.user.edit_images', $array);
    }

    public function remove_image()
    {
      $id =Input::get('id');
      $file = DB::table('files')->where('id', '=', $id)->first();
      $path_file = public_path().'/uploads/'.$file->nombre.'.'.$file->tipo;

      if (is_readable($path_file)) {
        unlink($path_file);
      }else
      {
        echo "error";
        die;
      }
      //Borrar imagem de bd
      DB::table('files')->where('id', '=', $id)->delete();
    }
}