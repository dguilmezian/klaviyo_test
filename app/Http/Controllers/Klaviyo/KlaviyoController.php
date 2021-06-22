<?php

namespace App\Http\Controllers\Klaviyo;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactsListFormRequest;
use App\Http\Requests\TokenFormRequest;
use App\Models\Configuration;

class KlaviyoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($message = false)
    {
        $token = Configuration::getValue('token');
        if (!is_null($token))
            return view('configuration.token', ['token' => $token, 'message' => $message]);
        else
            return view('configuration.token');
    }

    public function storeToken(TokenFormRequest $request)
    {
        $input = $request->all();
        Configuration::store('token', $input['token']);
        return $this->show('Token Actualizado');
    }

    public function showListId($message = false)
    {
        $contactsListId = Configuration::getValue('contacts_list');
        if (!is_null($contactsListId))
            return view('configuration.list', ['contactsList' => $contactsListId, 'message' => $message]);
        else
            return view('configuration.list');
    }

    public function storeContactsListId(ContactsListFormRequest $request)
    {
        $input = $request->all();
        Configuration::store('contacts_list', $input['contactsList']);
        return $this->show('Token Actualizado');
    }
}
