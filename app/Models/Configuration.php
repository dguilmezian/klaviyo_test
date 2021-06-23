<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class Configuration extends Model
{
    use HasFactory;

    protected $table = 'configuration';
    protected $fillable = ['name', 'value'];

    /**
     * Store a new key => value in database
     * @param $name
     * @param $value
     */
    public static function store($name, $value)
    {
        $result = self::getValue($name);
        if (is_null($result)) {
            DB::table('configuration')->insert([
                'name' => $name,
                'value' => $value
            ]);
        } else {
            self::updateValue($name, $value);
        }
    }

    /**
     * Update configuration value from database
     * @param $name
     * @param $value
     */
    public static function updateValue($name, $value)
    {
        DB::table('configuration')
            ->where('name', $name)
            ->update(['value' => $value]);
    }

    /**
     * Get configuration value from database
     * @param $name
     * @return mixed|string
     */
    public static function getValue($name)
    {
        $row = DB::table('configuration')->where('name', $name)->first();
        if ($row)
            return $row->value;
        else
            return '';
    }

    /**
     * Post time when button clicked
     * @param $time
     * @return bool
     */
    public static function postTime($time)
    {
        $url = "https://a.klaviyo.com/api/track?data=";
        $data = array(
            'token' => Configuration::getValue('public_api_key'),
            'event' => 'Button Clicked',
            'time' => $time
        );
        $data = json_encode($data, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
        $data = urlencode($data);
        $data = base64_encode($data);
        $url = $url . $data;
        $response = Http::get($url);
        if ($response->successful())
            return true;
        else
            return false;
    }

}
