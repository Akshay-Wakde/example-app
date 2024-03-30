<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Login extends Model
{
    public static function getData($email){
        $query = DB::table('users')
                    ->select('id','name','email','password')
                    // ->where('is_deleted',0)
                    ->where('email',$email)
                    ->first();

                    if($query){
                        $data = array(
                        'id' =>$query->id,
                        'name' =>$query->name,
                        // 'last_name' =>$query->last_name,
                        'email' =>$query->email,
                        // 'user_type' =>$query->user_type,
                        'password' =>$query->password,
                        );
                        return $data;
                    }else{
                        return false;
                    }
    }   

     public static function checkUserEmailExist($email){
          
      $query = DB::table('users')
                    // ->where('is_deleted',0)
                    // ->whereRaw("(email='".$email."' OR alt_email='".$email."')")
                    ->where('email',$email)
                    ->count();
                    if($query==1){
                        return true;
                    }else{
                        return false;
                    }
                    
    }
    
        public function getAdminUserData($userName){
            $query = DB::table('admin_users')->where('username',$userName)->first();
            if($query){
                return $query;
            }else{
                return false;
            }
        }


   //  $sql_access = "SELECT access_attempt FROM tbl_logins_access WHERE access_username = '{$username}' AND access_date = '{$today}' ORDER BY access_id DESC LIMIT 1";
   //  $access = $dbMaster->getResultAsAssoc($connect,$sql_access);

        public function getAcceccAttemptData($username){
         $today = date('Y-m-d');
            $query = DB::table('tbl_logins_access')
                                    ->selectRaw('SUM(access_attempt) as access_attempt')
                                    ->where('access_username',$username)
                                    ->where('access_date',$today)
                                    ->orderBy('access_id','DESC')
                                    ->first();
                        // print_r($query);exit;
                if($query){
                    return $query;
                }else{
                    return false;
                }
        }

        public function updateLoginData($data,$username){
            $query = DB::table('admin_users')->where('username',$username)->update($data);
        }

}
