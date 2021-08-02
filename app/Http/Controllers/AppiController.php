<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ruya;
use App\Models\Tabir;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AppiController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        if (Auth::attempt(["email" => $email, "password" => $password])) {

            $user = Auth::user();
            $success["token"] = $user->createToken("login")->accessToken;
            return response()->json(['success' => $success

            ], 200);
        } else {

            return response()->json(["error" => "Unauthorized user"], 401);

        }

    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), ['name' => 'required|string|max:255', 'email' => 'required|string|email|max:255|unique:users', 'password' => 'required|string|min:6',]);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 400);
        }
        $request['password'] = Hash::make($request['password']);
        $user = User::create($request->toArray());
        $token = $user->createToken('register')->accessToken;
        $response = ['token' => $token];
        return response()->json($response, 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function ruyaekle(Request $request)
    {
        $validator = Validator::make($request->all(), ['ruya' => 'required|string|max:500', 'his' => 'required|string|max:255|', 'tarih' => 'required|string|min:6',]);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 400);
        }
        if (Auth::guard('api')->check()) {
            $user_id = $request->user()->id;
            $data = ['his' => $request->input('his'), 'ruya_metin' => $request->input('ruya'), 'tarih' => $request->input('tarih'), 'user_id' => $user_id];


            Ruya::create($data);
            $dondur = ["status"=>"ok",$data];
            return response()->json($dondur, 200);
        } else {


            return response()->json(["error" => "Unauthorized user"], 401);
        }


    }


    public function ruyaliste(Request $request)
    {

        if (Auth::guard('api')->check()) {

            $user_id = $request->user()->id;
            $data=Ruya::all()->where("user_id","=",$user_id)->toArray();
            $dondur =$data;
            return response()->json($dondur, 200);
        } else {

            return response()->json(["error" => "Unauthorized user"], 400);
        }


    }



    public function ruyadetay(Request $request)
    {

        if (Auth::guard('api')->check()) {

            $user_id = $request->user()->id;
            $data=Ruya::all()->where("id","=",$request->input("id"));
            $dondur =$data;
            return response()->json($dondur, 200);
        } else {

            return response()->json(["error" => "Unauthorized user"], 401);
        }


    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function tabirekle(Request $request)
    {

        if (Auth::guard('api')->check()) {

            $user_id = $request->user()->id;
            $admin = $request->user()->admin;
            if($admin==1) {
                $validator = Validator::make($request->all(), [
                    'ruya+' => 'required|integer',
                    'tabir' => 'required|string|min:6',]);


                if ($validator->fails()) {
                    return response(['errors' => $validator->errors()->all()], 400);
                }

            }else{
                return response()->json(["error" => "Unauthorized user"], 401);
            }
        } else {

            return response()->json(["error" => "Unauthorized user"], 401);
        }


        $data = [

            'ruya_id' => $request->input('ruya'),
            'tabir' => $request->input('tabir'),
            'user_id' => $user_id];
        Tabir::create($data);

        $dondur = ["status"=>"ok",$data];
        return response()->json($dondur, 200);
    }



    public function tabirdetay(Request $request)
    {

        if (Auth::guard('api')->check()) {

            $user_id = $request->user()->id;
            $data=Tabir::all()->where("ruya_id","=",$request->input("id"));
            $dondur =$data;
            return response()->json($dondur, 200);
        } else {

            return response()->json(["error" => "Unauthorized user"], 401);
        }


    }


}
