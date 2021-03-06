<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use App\Models\Client\Client;
use App\Models\Indice\Indice;

class ClientController extends Controller
{
    private $client;
    public function __construct(Client $client)
    {
        $this->client = $client;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->indice->orderby('id', 'desc')->paginate(150);
        return view('panel.admin.pages.clients.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.admin.pages.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {
        // dd($request->all());
        $this->indice->create($request->all());
        return redirect()->back()->with('success', 'Cadastrado com sucesso!');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->indice->find($id);
        return view('panel.admin.pages.clients.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClientRequest $request, $id)
    {
        $indice = $this->indice->find($id);
        $indice->update($request->all());
        return redirect()->back()->with('success', 'Editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $this->indice->destroy($id);
        return redirect()->back()->with('success', 'Deletado com sucesso!');
    }

    public function pesquisar(Request $request)
    {
        $data = $this->client->where('name', 'LIKE', '%' . $request->get('value') . '%')->paginate();
        return view('panel.admin.pages.clients.index', compact('data'));
    }
}
