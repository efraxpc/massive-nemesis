<?php

class ProfileController extends BaseController
{

    public function index()
    {
		$users = User::all();

		echo "<pre>";
		dd(Input::get());
		exit;

		//$user= UserInfo::where('user_id','=',$id)->get();

		$pictures= UserPicture::where('user_id','=',$id)->get();
	
        return View::make('site.profiles.index')->with('user',$user)->with('pictures',$pictures);
		
    }
    
    public function edit($id) {

		$user = UserInfo::findOrFail($id);
	
        return View::make('site.profiles.edit',['row'=>$user]);
    }

     public function update($id) {
        try {

		$user = UserInfo::findOrFail($id);

		$photo= Input::File('photo');
        
        strip_tags($photo);
												
		$rules = ['photo' => 'mimes:jpg,jpeg,png'];
		
		$messages = array(
			'mimes'  => 'Attention! Only file types are allowed: jpg or png.',
		);
		
		$validator = \Validator::make(['photo'=> $photo],$rules,$messages);
	
		if($validator->passes()) {
			
			if ($photo){
				
				$filename= $photo->getClientOriginalName();
				$destinationPath= public_path() . '/uploads/users/avatars/';
				$uploadSuccess	= $photo->move($destinationPath, $filename);
			
				$user->photo 	= $filename;
			
			}else{
				$user->photo 	= Input::get('old_photo');
			}
			$user->name 	= Input::get('name');
			$user->lastname = Input::get('lastname');
			$user->phone 	= Input::get('phone');
			$user->bday 	= date('Y-m-d', strtotime(Input::get('bday')));
			$user->updated_at= new DateTime;
			
			$user->update(['id']);
		}
		   return Redirect::action('profile')->with('error', false)
											->with('msg','<strong><i class="icon-ok"></i></strong> Actualización Completada.')
											->with('class', 'success');
			} catch (Exception $exc) {

				echo $exc->getMessage() . " " . $exc->getLine();
				
				return Redirect::back()->with('error', true)
										>with('msg', '<strong><i class="icon-remove"></i>Error!</strong> Proceso Falló, contacte con administrador')
										->with('class', 'danger')->withErrors($validator);
			}
	}
	
	public function picture_upload()
    {
	try {
		
        if (Input::hasFile('photos')){
		
			$user 			= Auth::id();
			$photos 		= Input::file('photos');
			$photos_caption = Input::get('caption');
			
			$i=0;
			foreach($photos as $photo) {
				$filename= $photo->getClientOriginalName();
				$destinationPath= public_path() . '/uploads/users/galery/';
				$uploadSuccess	= $photo->move($destinationPath, $filename);
				
				$j=0;
				foreach($photos_caption as $caption) {
					if($i == $j){
						$new_photo=array('user_id'=>$user,'filename'=>$filename,'caption'=>$caption);
						$new_user_pictures= UserPicture::create($new_photo);
					}
				$j++;
				}		
			$i++;	
			}
		}
		return Redirect::route('profile')->with('error', false)
												->with('msg','<i class="icon-ok"></i> Fotos añadidas satisfactoriamente.')
												->with('class', 'success');
			
		} catch (Exception $exc) {

			$hola= $exc->getMessage() . " " . $exc->getLine();

			
			return Redirect::route('profile')->with('error', true)
									->with('msg', '<strong><i class="icon-remove"></i>Error!</strong> Proceso Falló, contacte con administrador')
									->with('class', 'danger');
		}
	}
	
	 
    public function edit_email($id) {
		try {
			$user = User::findOrFail($id);
			
		if(Input::get('email')){
			$user->email = Input::get('email');
			$user->updated_at= new DateTime;
				
			$user->update(['id']);
		}
		return Redirect::back()->with('error', false)->with('msg','<strong><i class="icon-remove"></i>Edición</strong> completada!')
													->with('class', 'success');
        } catch (Exception $exc) {

            echo $exc->getMessage() . " " . $exc->getLine();
           
            return Redirect::back()->with('error', true)
									->with('msg', '<strong><i class="icon-remove"></i>Error!</strong> Proceso Falló, contacte con administrador')
									->with('class', 'danger');
        }
    }
		
    public function delete($id) {
		try {
		$user = User::findOrFail($id);
		$user->delete(['id']);
		
		return Redirect::back()->with('error', false)->with('msg','<strong><i class="icon-remove"></i>Delete</strong> process completed!')
													->with('class', 'danger');
        } catch (Exception $exc) {

            echo $exc->getMessage() . " " . $exc->getLine();

            return Redirect::back()->with('error', true)
									->with('msg', '<strong><i class="icon-remove"></i>Error!</strong> Proceso Falló, contacte con administrador')
									->with('class', 'danger');
        }
    }
    
}
