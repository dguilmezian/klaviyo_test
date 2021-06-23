<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class Member extends Model
{
    use HasFactory;

    protected $table = 'members';

    /**
     * Store new member in list
     * @param $name
     * @param $email
     * @param $phone
     * @throws \Exception
     */
    public static function store($name, $email, $phone)
    {
        $member = new Member();
        $member->name=$name;
        $member->email=$email;
        $member->phone=$phone;
        $member->contact_list_id=Configuration::getValue('contacts_list');
        try {
            $member->save();
            self::uploadMember($member);
        }catch (\Exception $e){
            throw $e;
        }
    }

    /**
     * Upload new member into klaviyo list
     * @param Member $member
     * @return void
     */
    private static function uploadMember(Member $member)
    {
        $url= 'https://a.klaviyo.com/api/v2/list/'.Configuration::getValue('contacts_list').'/members?api_key='.Configuration::getValue('token');
        $response = Http::post($url, [
            'profiles'=>[
                'name' => $member->name,
                'email' => $member->email,
                'phone'=>$member->phone
            ]
        ]);
        if ($response->successful())
            $member->uploaded=1;
        else
            $member->uploaded=0;
        $member->update();
    }

    /**
     * Upload all not uploaded members
     */
    public static function uploadAllMembers(){
        $members= Member::where('uploaded',0)->get();
        foreach ($members as $member){
            self::uploadMember($member);
        }
    }

    /**
     * Get all members from configurated list
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function getMembers()
    {
        return DB::table('members')
            ->where('contact_list_id',Configuration::getValue('contacts_list'))
            ->paginate(15);
    }


}
