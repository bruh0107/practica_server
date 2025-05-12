<?php

namespace Controller;

use Model\Doctor;
use Model\DoctorPosition;
use Model\DoctorSpecialization;
use Model\Entry;
use Model\Patient;
use Model\Position;
use Model\Specialization;
use Src\View;
use Src\Request;
use Model\User;
use Src\Auth\Auth;
use function Validator\createValidator;

class Site
{

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

        $validator  = createValidator($request->all(), [
            'login' => ['required'],
            'password' => ['required'],
        ], [
            'required' => 'Поле :field обязательно',
        ]);

        if($validator->fails()){
            return (new View())->render('site.login', ['errors' => $validator->errors()]);
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

            $validator  = createValidator($request->all(), [
                'login' => ['required', 'unique:users,login'],
                'password' => ['required', 'min:6', 'max:20'],
            ], [
                'required' => 'Поле :field обязательно',
                'unique' => 'Сотрудник с таким логином уже существует',
                'min' => 'Поле :field должно содержать хотя бы 6 символов',
                'max' => 'Поле :field может содержать максимум 20 символов',
            ]);

            if($validator->fails()){
                return (new View())->render('site.add-employee', ['errors' => $validator->errors()]);
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
            $validator  = createValidator($request->all(), [
                'surname' => ['required'],
                'name' => ['required'],
                'birth_date' => ['required'],
                'position_id' => ['required'],
                'specialization_id' => ['required'],
            ], [
                'required' => 'Поле :field обязательно'
            ]);

            if($validator->fails()){
                return (new View())->render('site.add-doctor', [...$props, 'errors' => $validator->errors()]);
            }

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
            $validator  = createValidator($request->all(), [
                'surname' => ['required'],
                'name' => ['required'],
                'birth_date' => ['required'],
            ], [
                'required' => 'Поле :field обязательно'
            ]);

            if($validator->fails()){
                return (new View())->render('site.add-patient', ['errors' => $validator->errors()]);
            }

            if (Patient::create([...$request->all(), 'user_id' => Auth::user()->id])) {
                return new View('site.add-patient', ['message' => 'Пациент успешно создан']);
            }
        }
        return new View('site.add-patient');
    }

    public function createEntry(Request $request): string
    {
        $props = [
            'patients' => Patient::all(),
            'doctors' => Doctor::all(),
        ];

        if ($request->method === 'POST'){
            $validator  = createValidator($request->all(), [
                'patient_id' => ['required'],
                'doctor_id' => ['required'],
                'time' => ['required'],
            ], [
                'required' => 'Поле :field обязательно'
            ]);

            if($validator->fails()){
                return (new View())->render('site.create-entry', [...$props, 'errors' => $validator->errors()]);
            }

            if (Entry::create([...$request->all(), 'status_id' => 2])) {
                return new View('site.create-entry', [...$props, 'message' => 'Запись создана']);
            }
        }
        return new View('site.create-entry', $props);
    }

    public function getEntries($message): string
    {
        $entries = Entry::with(['entryDoctor', 'entryPatient', 'entryStatus'])->get();

        return new View('site.entries', ['entries' => $entries, 'message' => $message]);
    }

    public function getPatients(): string
    {
        $patients = Patient::all();
        return new View('site.patients', ['patients' => $patients]);
    }

    public function getDoctors(): string
    {
        $search = $_GET['search'] ?? null;

        $query = Doctor::with(['specializations', 'position']);

        if ($search) {
            $query->where('surname', 'like', "%$search%");
        }

        $doctors = $query->get();

        return new View('site.doctors', ['doctors' => $doctors, 'search' => $search]);
    }

    public function getDoctorById($id): string
    {
        return new View('site.doctorId', [
            'doctor' => Doctor::with(['specializations', 'position', 'patients' => function($query) {
                $query->distinct();
            }])->find($id)
        ]);
    }

    public function getPatientById($id): string
    {
        return new View('site.patientId', [
            'patient' => Patient::with(['doctors', 'entries' => function($query) {
                $query->distinct();
            }])->find($id)
            ]
        );
    }

    public function cancelEntry($id): string
    {
        Entry::find($id)->update(['status_id' => 1]);
        return $this->getEntries('Запись отменена');
    }
}
