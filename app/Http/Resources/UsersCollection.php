<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UsersCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);

        $users = array();

            foreach($this->collection as $value){
                array_push($users,[
                    'key'                       => $value->id_user,
                    'avatar'                    => $value->avatar_user,
                    'user_name'                 => $value->username_user,
                    'name'                      => $value->name_user,
                    'email'                     => $value->email_user,
                    'email_verified_at_user'    => $value->email_verified_at,
                    'password'                  => $value->password_user,
                    'remember_token'            => $value->remember_token,
                    'login_at'                  => $value->login_at_user,
                    'change_password_at'        => $value->change_password_at_user,
                    'created_at'                => $value->created_at,
                    'updated_at'                => $value->updated_at
                ]);
            }
    }
}