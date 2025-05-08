<?php

namespace Controller;

use Model\Doctor;
use Model\DoctorPosition;
use Model\DoctorSpecialization;
use Model\Patient;
use Model\Position;
use Model\Specialization;
use Src\View;
use Src\Request;
use Model\User;
use Src\Auth\Auth;

class Site
{
    public function index(Request $request): string
    {
        $posts = Post::where('id', $request->id)->get();
        return (new View())->render('site.post', ['posts' => $posts]);
    }

    public function hello(): string
    {
        return new View('site.hello');
    }

    public function signup(Request $request): string
    {
        if ($request->method==='POST' && User::create($request->all())){
            app()->route->redirect('/go');
        }
        return new View('site.signup');
    }

    public function login(Request $request): string
    {
        if($request->method === 'GET'){
            return new View('site.login');
        }

        if(Auth::attempt($request->all())){
            app()->route->redirect('/');
        }

        return new View('site.login', ['message' => 'Неверные логин или пароль']);
    }

    public function logout(Request $request): void
    {
        Auth::logout();
        app()->route->redirect('/');
    }

    public function addEmployee(Request $request): string
    {

        if ($request->method === 'POST'){
            if (User::query()->where('login', $request->get('login'))->exists()) {
                return new View('site.add-employee', ['message' => 'Сотрудник с таким логином уже существует']);
            }

            if (User::create([...$request->all(), 'role_id' => 2])) {
                return new View('site.add-employee', ['message' => 'Сотрудник регистратуры создан']);
            }
        }

        return new View('site.add-employee');
    }

    public function addDoctor(Request $request): string
    {
        $props = [
            'specializations' => Specialization::all(),
            'positions' => Position::all(),
        ];

        if ($request->method === 'POST'){
            $doctor = Doctor::create([...$request->all(), 'user_id' => Auth::user()->id]);

            if ($doctor) {
                DoctorPosition::create([
                   'doctor_id' => $doctor->id,
                   'position_id' => $request->position_id,
                ]);
                DoctorSpecialization::create([
                    'doctor_id' => $doctor->id,
                    'specialization_id' => $request->specialization_id,
                ]);
                return new View('site.add-doctor', [...$props, 'message' => 'Доктор успешно создан']);
            }
        }
        return new View('site.add-doctor', $props);
    }

    public function addPatient(Request $request): string
    {
        if ($request->method === 'POST'){
            if (Patient::create([...$request->all(), 'user_id' => Auth::user()->id])) {
                return new View('site.add-patient', ['message' => 'Пациент успешно создан']);
            }
        }
        return new View('site.add-patient');
    }

    public function createEntry(): string
    {
        return new View('site.create-entry');
    }

    public function getEntries(): string
    {
        return new View('site.entries');
    }

    public function getPatients(): string
    {
        return new View('site.patients');
    }

    public function getDoctors(): string
    {
        return new View('site.doctors');
    }

}
