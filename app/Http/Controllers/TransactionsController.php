<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;
use Validator;

class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$transaction = Transaction::with('customer')->paginate(4);
        //dd($transaction);
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
        $validate = Validator::make($request->all(), [
            'name'        => 'required|min:5|max:16',
            'amount'      => 'required',
            'customer_id' => 'required']);

        if ($validate->fails()) {
            return response([
                'mensage' => 'El Formulario contiene errores!',
                'errors'  => $validate->errors()], 401);
        }

        $transaction = Transaction::create($request->all());

        if ($transaction) {
            return response([
                'message' => trans('app.transaction_create_succes_message'),
                'id'      => $transaction->id], 200);
        }

        return response([
            'menssage' => trans('app.transaction_create_fail_message')], 500);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return Transaction::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|min:5|max:16',
            'amount'  => 'required',
            'customer_id'      => 'required']);

        if ($validate->fails()) {
            return response([
                'mensage' => 'El Formulario contiene errores!',
                'errors'  => $validate->errors()], 401);
        }

        $transaction = Transaction::find($id);        

        //si se crea el cliente en
        //la base de datos
        if ($transaction) {

            $update=$transaction->update($request->all());

            if ($update) {
                return response([
                'menssage' => trans('app.transaction_update_succes_message'),
                'id'       => $transaction->id], 200);
            }            
        }

        return response([
            'menssage' => trans('app.transaction_update_fail_message')], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaction = new Transaction;
        $delete = $transaction::destroy($id);
        if($delete){
            return response([
                    'menssage'=>trans('app.transaction_delete_succes_message'),
                ]);
        }
        return response([
                'menssage'=>trans('app.transaction_delete_fail_message'),500]);
    }
}
