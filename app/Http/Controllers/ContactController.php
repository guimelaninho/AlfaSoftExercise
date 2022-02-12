<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFilter;
use App\Models\Contact;
use Illuminate\Database\Eloquent\MassAssignmentException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function setData()
    {
        $data['pageName'] = "Contatos";
        $data['route'] = "contacts";

        return $data;
    }
    public function index()
    {
        $data = $this->setData();
        $data['action'] = 'create';
        $data['pageFunction'] = "Listar";
        $data['entity'] = Contact::all();
        return view('contacts.index', compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = $this->setData();
        $data['action'] = 'store';
        $data['pageFunction'] = "Criar";
        return view('contacts.form',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactFilter $request)
    {
        try {
           $data = $request->only(['name', 'contact','email']);

            DB::beginTransaction();
            $insert = Contact::create($data);
        } catch (QueryException $exception) {
            DB::rollBack();
            Log::critical($exception->getMessage());
        } catch (MassAssignmentException $exception) {
            DB::rollBack();
            Log::critical($exception->getMessage());
        } catch (\TypeError $exception) {
            DB::rollBack();
            Log::critical($exception->getMessage());
            return response()->json([
                $exception->getMessage()
            ]);
        } finally {
            DB::commit();
            return redirect()->route('contacts.index');
        }
        return redirect()->back()->withErrors('msg', $exception->getMessage());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->setData();
        $data['action'] = 'show';
        $data['pageFunction'] = "Ver";
        $data['entity'] = Contact::find($id);
        return view('contacts.form',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->setData();
        $data['action'] = 'edit';
        $data['pageFunction'] = "Editar";
        $data['entity'] = Contact::find($id);
        return view('contacts.form',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContactFilter $request, $id)
    {
        try {
            $data = $request->only(['name', 'contact','email']);
 
             DB::beginTransaction();
             Contact::find($id)->update($data);
         } catch (QueryException $exception) {
             DB::rollBack();
             Log::critical($exception->getMessage());
         } catch (MassAssignmentException $exception) {
             DB::rollBack();
             Log::critical($exception->getMessage());
         } catch (\TypeError $exception) {
             DB::rollBack();
             Log::critical($exception->getMessage());
             return response()->json([
                 $exception->getMessage()
             ]);
         } finally {
             DB::commit();
             return redirect()->route('contacts.index');
         }
         return redirect()->back()->withErrors('msg', $exception->getMessage());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
 
             DB::beginTransaction();
             Contact::destroy($id);
         } catch (QueryException $exception) {
             DB::rollBack();
             Log::critical($exception->getMessage());
         } catch (MassAssignmentException $exception) {
             DB::rollBack();
             Log::critical($exception->getMessage());
         } catch (\TypeError $exception) {
             DB::rollBack();
             Log::critical($exception->getMessage());
             return response()->json([
                 $exception->getMessage()
             ]);
         } finally {
             DB::commit();
             return redirect()->route('contacts.index');
         }
         return redirect()->back()->withErrors('msg', $exception->getMessage());
    }
}
