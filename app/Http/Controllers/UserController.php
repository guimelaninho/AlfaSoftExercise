<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserFilter;
use App\Http\Requests\UserUpdateFilter;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Database\Eloquent\MassAssignmentException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function setData()
    {
        $data['pageName'] = "Usuários";
        $data['route'] = "users";

        return $data;
    }

    public function index()
    {
        $data = $this->setData();
        $data['action'] = 'create';
        $data['pageFunction'] = "Listar";
        $data['entity'] = User::all();
        return view('users.index', compact('data'));
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
        return view('users.form', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserFilter $request)
    {
        try {
            $data = $request->only(['name', 'password', 'email']);
            $data['password'] = Hash::make($data['password']);
            DB::beginTransaction();
            $insert = User::create($data);
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
            return redirect()->route('users.index');
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
        $data['entity'] = User::find($id);
        return view('users.form', compact('data'));
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
        $data['entity'] = User::find($id);
        return view('users.form', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateFilter $request, $id)
    {
        try {
            $data = $request->only(['name', 'paswword', 'email']);
            $data['password'] = Hash::make($data['password']);
            DB::beginTransaction();
            User::find($id)->update($data);
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
            return redirect()->route('users.index');
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
            User::destroy($id);
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
            return redirect()->route('users.index');
        }
        return redirect()->back()->withErrors('msg', $exception->getMessage());
    }
}
