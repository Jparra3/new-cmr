<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Validator;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $customers = Customer::with('transactions')->paginate(10);
        return $customers;
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
            'first_name' => 'required|min:5|max:16',
            'last_name'  => 'required|min:5|max:16',
            'email'      => 'required|email|unique:customers,email']);

        if ($validate->fails()) {
            return response([
                'mensage' => 'El Formulario contiene errores!',
                'errors'  => $validate->errors()], 401);
        }

        //crear el cliente
        $customer = Customer::create($request->all());

        //si se crea el cliente en
        //la base de datos
        if ($customer) {
            return response([
                'menssage' => trans('app.customer_created_succes_message'),
                'id'       => $customer->id], 200);
        }

        return response([
            'menssage' => trans('app.customer_created_fail_message')], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Customer::findOrFail($id);
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
     * [validacion description]
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public function validacion($request)
    {
        # code...
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
            'first_name' => 'required|min:5|max:16',
            'last_name'  => 'required|min:5|max:16',
            'email'      => 'required|email|unique:customers,email,' . $id . ',id']);

        if ($validate->fails()) {
            return response([
                'mensage' => 'El Formulario contiene errores!',
                'errors'  => $validate->errors()], 401);
        }

        $customer = Customer::find($id);        

        //si se crea el cliente en
        //la base de datos
        if ($customer) {

            $update=$customer->update($request->all());

            if ($update) {
                return response([
                'menssage' => trans('app.customer_update_succes_message'),
                'id'       => $customer->id], 200);
            }            
        }

        return response([
            'menssage' => trans('app.customer_update_fail_message')], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = new Customer;
        $delete = $customer::destroy($id);
        if($delete){
            return response([
                    'menssage'=>trans('app.customer_delete_success_message'),
                ]);
        }
        return response([
                'menssage'=>trans('app.customer_delete_fail_message'),500]);
    }
}
