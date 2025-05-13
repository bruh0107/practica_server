<?php

use PHPUnit\Framework\TestCase;
use Src\Request;
use Model\Patient;

class PatientTest extends TestCase
{
    // Метод, который будет выполнен перед каждым тестом. Здесь мы настраиваем среду для тестов.
    protected function setUp(): void
    {
        $_SERVER['DOCUMENT_ROOT'] = '/OSPanel/domains/index.loc';  // Устанавливаем корень документа для приложения
        $this->initApplication();  // Инициализируем приложение
    }

    // Метод для инициализации приложения, создаем глобальную переменную $app, если она еще не существует.
    protected function initApplication(): void
    {
        // Создаем объект приложения с настройками
        $GLOBALS['app'] = new Src\Application(new Src\Settings([
            'app' => include $_SERVER['DOCUMENT_ROOT'] . '/config/app.php',  // Загружаем настройки приложения
            'db' => include $_SERVER['DOCUMENT_ROOT'] . '/config/db.php',    // Загружаем настройки базы данных
            'path' => include $_SERVER['DOCUMENT_ROOT'] . '/config/path.php', // Загружаем пути
        ]));

        // Проверяем, если функция app() еще не существует, создаем её для доступа к $app.
        if (!function_exists('app')) {
            function app()
            {
                return $GLOBALS['app'];  // Возвращаем глобальную переменную $app
            }
        }
    }

    // Тестируем функцию добавления пациента
    #[\PHPUnit\Framework\Attributes\DataProvider('patientProvider')]  // Указываем провайдер тестовых данных
    #[\PHPUnit\Framework\Attributes\RunInSeparateProcess]  // Запускать тест в отдельном процессе (для изоляции)
    public function testAddPatient(string $httpMethod, array $patientData, ?string $expectedFragment = ''): void
    {
        // Мокаем объект запроса Request
        $mockRequest = $this->createMock(Request::class);
        $mockRequest->method = $httpMethod;  // Устанавливаем метод HTTP запроса (GET, POST)
        $mockRequest->method('all')->willReturn($patientData);  // Мокаем метод 'all', чтобы вернуть данные пациента

        ob_start();  // Начинаем захват вывода в буфер
        (new \Controller\Site())->addPatient($mockRequest);  // Вызываем метод addPatient с моканым запросом
        $output = ob_get_clean();  // Получаем и очищаем вывод из буфера

        // Если метод запроса GET, проверяем, что форма для добавления пациента присутствует в выводе
        if ($httpMethod === 'GET') {
            $this->assertStringContainsString('<form method="post" class="add-patient-form">', $output);
            return;
        };

        // Если мы ожидали ошибку, проверяем, что ошибки присутствуют в выводе
        if ($expectedFragment !== 'Location: /add-patient') {
            $errors = json_decode($expectedFragment, true);  // Декодируем ошибки из строки JSON
            foreach ($errors as $error) {
                $this->assertStringContainsString($error[0], $output);  // Проверяем каждую ошибку в выводе
            }
        } else {
            // Если ошибки нет, проверяем, что пациент был добавлен в базу данных
            $patient = Patient::where($patientData)->first();
            $this->assertNotNull($patient);  // Убеждаемся, что пациент был добавлен
        }
    }

    // Провайдер данных для теста, возвращает различные наборы данных для разных тестов
    public static function patientProvider(): array
    {
        return [
            // Пример для GET запроса, когда поля не заполнены
            ['GET', [
                'surname' => '',
                'name' => '',
                'patronym' => '',
                'birth_date' => '',
            ]],

            // Пример для POST запроса с ошибками в данных
            ['POST', [
                'surname' => '',
                'name' => '',
                'patronym' => '',
                'birth_date' => '',
            ],
                '{"surname":["Поле surname обязательно"],"name":["Поле name обязательно"],"birth_date":["Поле birth_date обязательно"]}'
            ],

            // Пример для POST запроса с неправильной датой рождения (в будущем)
            ['POST', [
                'surname' => 'TestSurname',
                'name' => 'TestName',
                'patronym' => 'TestPatronym',
                'birth_date' => '2123-10-20',
            ],
                '{"birth_date":["Дата не может быть в будущем"]}'
            ],

            // Пример для POST запроса с валидными данными, когда пациент успешно добавлен
            ['POST', [
                'surname' => 'TestSurname',
                'name' => 'TestName',
                'patronym' => 'TestPatronym',
                'birth_date' => '1922-10-20',
            ], 'Location: /add-patient']
        ];
    }

    // Метод, который вызывается после каждого теста, очищает базу данных от тестовых данных
    protected function tearDown(): void
    {
        // Удаляем пациента с определенными данными
        Patient::where([
            'surname' => 'TestSurname',
            'name' => 'TestName',
            'patronym' => 'TestPatronym',
            'birth_date' => '1922-10-20',
        ])->delete();
    }
}
