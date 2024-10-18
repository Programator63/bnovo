<?php

namespace App\Http\Controllers;

use App\Models\Guests;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use libphonenumber\PhoneNumberUtil;

class GuestController extends Controller
{
    // Метод для создания нового гостя
    public function store(Request $request)
    {
        try {
            // Валидация входящих данных
            $request->validate([
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'email' => 'required|email|unique:guests',
                'phone' => 'required|string|unique:guests',
                'country' => 'string',
            ]);

            // Получение страны из номера телефона
            $country = $this->getCountryFromPhone($request->phone);

            // Создание нового гостя
            $guest = Guests::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'country' => $request->country ?? $country,
            ]);

            // Возврат ответа с созданным гостем и заголовками
            return response()->json($guest, 201);
        } catch (ValidationException $e) {
            // Логирование ошибок валидации
            return response()->json(['error' => 'Error validations.', 'details' => $e->errors()], 422);
        } catch (\Exception $e) {
            // Логирование других ошибок

            return response()->json(['error' => 'Error!'], 500);
        }
    }

    // Метод для получения списка всех гостей
    public function index()
    {
        $guests = Guests::all();
        return response()->json($guests);
    }

    // Метод для получения конкретного гостя
    public function show($id)
    {
        $guest = Guests::find($id);

        if (!$guest) {
            return response()->json(['message' => 'Guest not founded'], 404);
        }

        return response()->json($guest);
    }

    // Метод для обновления данных гостя
    public function update(Request $request, $id)
    {
        try {
        $guest = Guests::find($id);

        if (!$guest) {
            return response()->json(['message' => 'Guest not founded'], 404);
        }

        // Валидация входящих данных
        $request->validate([
            'first_name' => 'sometimes|required|string',
            'last_name' => 'sometimes|required|string',
            'email' => 'sometimes|required|email|unique:guests,email,' . $guest->id,
            'phone' => 'sometimes|required|string|unique:guests,phone,' . $guest->id,
            'country' => 'string',
        ]);

        // Обновление данных гостя
        $guest->update($request->only(['first_name', 'last_name', 'email', 'phone', 'country']));

        return response()->json($guest);
        } catch (ValidationException $e) {
            // Логирование ошибок валидации
            return response()->json(['error' => 'Error validations.', 'details' => $e->errors()], 422);
        } catch (\Exception $e) {
            // Логирование других ошибок
            var_dump($e->getMessage());
            return response()->json(['error' => 'Error!'], 500);
        }
    }

    // Метод для удаления гостя
    public function destroy($id)
    {
        $guest = Guests::find($id);

        if (!$guest) {
            return response()->json(['message' => 'Guest not founded'], 404);
        }

        $guest->delete();
        return response()->json(['message' => 'The guest has been successfully deleted']);
    }

    // Вспомогательный метод для определения страны по номеру телефона
    private function getCountryFromPhone($phone)
    {
        if (substr($phone, 0, 1) != "+") {
            $phone = "+" . $phone;
        }
        $phoneNumberUtil   = PhoneNumberUtil::getInstance();
        $phoneNumberObject = $phoneNumberUtil->parse($phone, null);
        return $phoneNumberUtil->getRegionCodeForNumber($phoneNumberObject) ?? false;
    }
}
