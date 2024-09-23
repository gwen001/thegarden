<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Http\Requests\UserEditRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users/dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = Auth::user();
        // var_dump($user);
        // exit();

        // $request->header->add($parameter);

        return response()->view('users/edit', compact('user'));
        // return response()->view('users/edit', compact('user'))->header('Access-Control-Allow-Origin', 'http://lo.glc.st')->header('Access-Control-Allow-Credentials', 'true');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditRequest $request)
    {
        $user = Auth::user();

        $t_datas = $request->validated();

        // var_dump($t_datas);
        unset( $t_datas['_token'] );
        unset( $t_datas['picture'] );
        // var_dump($t_datas);

        // foreach( $t_datas as $k=>$v ) {
        //     $user->$k = $v;
        // }

        if( $request->file() && count($request->file()) && isset($request->file()['picture']) )
        {
            // $path = $request->file('picture')->storeAs('uploads',$request->file('picture')->getClientOriginalName(),'public');
            // $path = $request->file('picture')->store('uploads','notpublic');
            // $visibility = Storage::getVisibility('/public/uploads/'.$request->file('picture')->getClientOriginalName());
            // Storage::setVisibility('/public/uploads/'.$request->file('picture')->getClientOriginalName(),'public');
            // $path = Storage::disk('public')->put('example.txt', 'blalblalblslblslbsl');
            // var_dump($path);
            // exit();
            $filename = $this->uploadPicture( $request->file()['picture'] );
            if( $filename !== false ) {
                $user->picture = $filename;
            }
            $user->save();
        }

        // $response = Http::withHeaders(['Content-Type: application/x-www-form-urlencoded'])->put(env('API_URL').'/users/'.$user->id, $t_datas);
        $response = Http::withHeaders(['Authorization'=>'Bearer '.$user->api_token])->put(env('API_URL').'/users/'.$user->id, $t_datas);
        // var_dump($response);

        if( $response->ok() ) {
            Session::flash('success', 'Profile updated.');
        } else {
            Session::flash('error', 'Something went wrong!');
        }

        return redirect()->route('users.edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function uploadPicture( $picture )
    {
        // var_dump($picture);
        // var_dump($picture->getError());

        if( $picture->getError() ) {
            return false;
        }

        // echo 'hasFile: '.$request->hasFile('picture')."\n";
        // $picture = $request->file('picture');
        // echo 'getError: '.$picture->getError()."\n";
        // echo 'isValid: '.$picture->isValid()."\n";
        // echo 'get file content: '.$picture->get()."\n";
        // echo 'getClientOriginalName: '.$picture->getClientOriginalName()."\n";
        // echo 'hashName: '.$picture->hashname()."\n";
        // echo 'getClientOriginalExtension: '.$picture->getClientOriginalExtension()."\n";
        // echo 'extension: '.$picture->extension()."\n";
        // echo 'getClientMimeType: '.$picture->getClientMimeType()."\n";
        // echo 'getRealPath: '.$picture->getRealPath()."\n";
        // echo 'getSize: '.$picture->getSize()."\n";
        // echo 'getMimeType: '.$picture->getMimeType()."\n";
        // exit();

        $destinationPath = 'img/users';
        $filename = md5( uniqid() ) . '.' . $picture->getClientOriginalExtension();

        // Storage::disk('public')->put( 'users/'.$filename, $picture->get() );
        // var_dump( asset('storage/'.$filename) );
        // exit();

        if( $picture->move($destinationPath,$filename) ) {
            return $filename;
        } else {
            return false;
        }
    }
}
