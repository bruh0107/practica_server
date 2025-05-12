<?php

use PHPUnit\Framework\TestCase;
use Src\Request;
use Model\Patient;

class PatientTest extends TestCase
{
    protected function setUp(): void
    {
        $_SERVER['DOCUMENT_ROOT'] = '/OSPanel/domains/index.loc';

        $this->initApplication();
    }

    protected function initApplication(): void
    {
        $dbConfig = [
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'server',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ];

        $GLOBALS['app'] = new Src\Application(new Src\Settings([
            'app' => include $_SERVER['DOCUMENT_ROOT'] . '/config/app.php',
            'db' => $dbConfig,
            'path' => include $_SERVER['DOCUMENT_ROOT'] . '/config/path.php',
        ]));

        if (!function_exists('app')) {
            function app()
            {
                return $GLOBALS['app'];
            }
        }
    }

    public function testAddPatient(): void
    {
        $patientData = [
            'surname' => 'TestSurname',
            'name' => 'TestName',
            'patronym' => 'TestPatronym',
            'birth_date' => '1922-10-20',
        ];

        $request = $this->createMock(Request::class);
        $request->expects($this->any())
            ->method('all')
            ->willReturn($patientData);
        $request->method = 'POST';

        $controller = new \Controller\Site();
        $controller->addPatient($request);

        $patient = Patient::where($patientData);
        $this->assertTrue($patient->exists());

        $patient->delete();
    }

    public static function patientProvider(): array
    {
        return [
            ['GET', [
                'surname' => '',
                'name' => '',
                'patronym' => '',
                'birth_date' => '',
            ], ''],
            ['POST', [
                'surname' => '',
                'name' => '',
                'patronym' => '',
                'birth_date' => '',
            ],
            '{
            "surname":["Поле surname обязательно"], 
            "name":["Поле name обязательно"],
            ""
            }'
            ]
        ];
    }
}