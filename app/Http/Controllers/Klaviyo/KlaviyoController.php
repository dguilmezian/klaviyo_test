<?php

namespace App\Http\Controllers\Klaviyo;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactsListFormRequest;
use App\Http\Requests\TokenFormRequest;
use App\Models\Configuration;
use Illuminate\Support\Facades\Redirect;

class KlaviyoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show form for private key token
     * @param false $message
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($message = false)
    {
        $token = Configuration::getValue('token');
        if (!is_null($token))
            return view('configuration.token', ['token' => $token, 'message' => $message]);
        else
            return view('configuration.token');
    }

    /**
     * Store private key token
     * @param TokenFormRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function storeToken(TokenFormRequest $request)
    {
        $input = $request->all();
        Configuration::store('token', $input['token']);
        return $this->show('Private Key Updated');
    }

    /**
     * Show form for list id
     * @param false $message
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showListId($message = false)
    {
        $contactsListId = Configuration::getValue('contacts_list');
        if (!is_null($contactsListId))
            return view('configuration.list', ['contactsList' => $contactsListId, 'message' => $message]);
        else
            return view('configuration.list');
    }

    /**
     * Store list id
     * @param ContactsListFormRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function storeContactsListId(ContactsListFormRequest $request)
    {
        $input = $request->all();
        Configuration::store('contacts_list', $input['contactsList']);
        return $this->showListId('Contact List Updated');
    }

    /**
     * Track the time when button was clicked
     * @return \Illuminate\Http\RedirectResponse
     */
    public function trackButton()
    {
        $timestamp = time();
        if (Configuration::postTime($timestamp))
            return Redirect::to('/members')->with('clicked', true);
        else
            return Redirect::to('/members')->with('clicked', false);
    }

    public function showPublicKey($message=false){
        $public_api_key = Configuration::getValue('public_api_key');
        if (!is_null($public_api_key))
            return view('configuration.public_key', ['public_api_key' => $public_api_key, 'message' => $message]);
        else
            return view('configuration.public_key');
    }

    public function storePublicKey(PublicKeyFormRequest $request){
        $input = $request->all();
        Configuration::store('public_api_key', $input['public_api_key']);
        return $this->showPublicKey('Public API Key Updated');
    }
}
