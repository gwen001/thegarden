<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use App\Models\User;

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

        return view('users/edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $t_datas = $request->input();
        // var_dump($t_datas);
        unset( $t_datas['_token'] );
        unset( $t_datas['picture'] );
        // var_dump($t_datas);

        // foreach( $t_datas as $k=>$v ) {
        //     $user->$k = $v;
        // }

        if( $request->file() && count($request->file()) && isset($request->file()['picture']) )
        {
            $filename = $this->uploadPicture( $request->file()['picture'] );
            if( $filename !== false ) {
                $user->picture = $filename;
            }
            $user->save();
        }

        $response = Http::withHeaders(['Content-Type: application/x-www-form-urlencoded'])->put(env('API_URL').'/users/'.$user->id, $t_datas);
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

        // echo 'File Name: '.$picture->getClientOriginalName()."\n";
        // echo 'File Extension: '.$picture->getClientOriginalExtension()."\n";
        // echo 'File Real Path: '.$picture->getRealPath()."\n";
        // echo 'File Size: '.$picture->getSize()."\n";
        // echo 'File Mime Type: '.$picture->getMimeType()."\n";

        $destinationPath = 'img/users';
        $filename = md5( uniqid() ) . '.' . $picture->getClientOriginalExtension();
        if( $picture->move($destinationPath,$filename) ) {
            return $filename;
        } else {
            return false;
        }
    }
}
