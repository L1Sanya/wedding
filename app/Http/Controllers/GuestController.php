<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class GuestController extends Controller
{
    // ========== ПУБЛИЧНЫЕ МЕТОДЫ ==========

    /**
     * Принять анкету от гостя
     * POST /api/guests
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'status'     => 'required|in:will_come,will_not_come',
            'with_partner' => 'boolean',
            'partner_first_name' => 'required_if:with_partner,true|nullable|string|max:100',
            'partner_last_name'  => 'nullable|string|max:100',
            'message'    => 'nullable|string|max:500',
        ]);

        $guest = Guest::create([
            'first_name'        => $validated['first_name'],
            'last_name'         => $validated['last_name'],
            'status'            => $validated['status'],
            'with_partner'      => $validated['with_partner'] ?? false,
            'partner_first_name'=> $validated['partner_first_name'] ?? null,
            'partner_last_name' => $validated['partner_last_name'] ?? null,
            'message'           => $validated['message'] ?? null,
            'ip_address'        => $request->ip(),
        ]);

        // Статистика
        $willCome = Guest::willCome()->get();

        return response()->json([
            'success' => true,
            'message' => $guest->status === 'will_come'
                ? 'Спасибо! Рады, что вы будете с нами! ❤️'
                : 'Спасибо за ответ! Будем скучать! 💭',
            'stats' => [
                'will_come'     => $willCome->count(),
                'will_not_come' => Guest::willNotCome()->count(),
                'total_persons' => $willCome->sum('total_persons'),
            ],
        ]);
    }

    /**
     * Статистика для фронта
     * GET /api/stats
     */
    public function stats()
    {
        $willCome = Guest::willCome()->get();

        return response()->json([
            'will_come'     => $willCome->count(),
            'will_not_come' => Guest::willNotCome()->count(),
            'total_persons' => $willCome->sum('total_persons'),
        ]);
    }

    // ========== АДМИНСКИЕ МЕТОДЫ ==========

    /**
     * Страница логина или админка
     * GET /admin
     */
    public function admin(Request $request)
    {
        if (!Session::get('admin_logged_in')) {
            return view('admin.login');
        }

        $status = $request->get('status', 'all');
        $currentStatus = $status; // ← ВОТ ЭТА ПЕРЕМЕННАЯ ДЛЯ ВЬЮХИ

        $query = Guest::orderBy('created_at', 'desc');

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        $guests = $query->get();
        $willCome = Guest::willCome()->get();

        $stats = [
            'will_come_count'     => $willCome->count(),
            'will_not_come_count' => Guest::willNotCome()->count(),
            'total_persons'       => $willCome->sum('total_persons'),
            'with_partner_count'  => $willCome->where('with_partner', true)->count(),
            'total_guests'        => Guest::count(),
        ];

        return view('admin.guests', compact('guests', 'stats', 'currentStatus'));
    }


    /**
     * Проверка пароля
     * POST /admin/login
     */
    public function adminLogin(Request $request)
    {
        $request->validate([
            'password' => 'required|string',
        ]);

        // Берём хеш пароля из БД
        $hashedPassword = Setting::getValue('admin_password');

        if (!$hashedPassword || !Hash::check($request->password, $hashedPassword)) {
            return back()->with('error', 'Неверный пароль');
        }

        // Запоминаем в сессии, что админ вошёл
        Session::put('admin_logged_in', true);

        return redirect('/admin');
    }

    /**
     * Выход
     * GET /admin/logout
     */
    public function adminLogout()
    {
        Session::forget('admin_logged_in');
        return redirect('/admin');
    }

    /**
     * Данные для таблицы (API)
     * GET /api/admin/guests
     */
    public function adminIndex(Request $request)
    {
        // Проверка сессии
        if (!Session::get('admin_logged_in')) {
            return response()->json(['error' => 'Доступ запрещён'], 403);
        }

        $query = Guest::orderBy('created_at', 'desc');

        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $guests = $query->get();
        $willCome = Guest::willCome()->get();

        return response()->json([
            'guests' => $guests->map(function ($guest) {
                return [
                    'id'                => $guest->id,
                    'first_name'        => $guest->first_name,
                    'last_name'         => $guest->last_name,
                    'full_name'         => $guest->full_name,
                    'status'            => $guest->status,
                    'status_text'       => $guest->status === 'will_come' ? '✅ Придёт' : '😔 Не придёт',
                    'with_partner'      => $guest->with_partner,
                    'partner_full_name' => $guest->partner_full_name,
                    'total_persons'     => $guest->total_persons,
                    'message'           => $guest->message,
                    'created_at'        => $guest->created_at->format('d.m.Y H:i'),
                ];
            }),
            'stats' => [
                'will_come_count'       => $willCome->count(),
                'will_not_come_count'   => Guest::willNotCome()->count(),
                'total_persons'         => $willCome->sum('total_persons'),
                'with_partner_count'    => $willCome->where('with_partner', true)->count(),
                'total_guests'          => Guest::count(),
            ],
        ]);
    }

    /**
     * Удалить гостя
     * DELETE /api/admin/guests/{id}
     */
    public function destroy($id)
    {
        if (!Session::get('admin_logged_in')) {
            return response()->json(['error' => 'Доступ запрещён'], 403);
        }

        Guest::findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }

    /**
     * Экспорт CSV
     * GET /api/admin/guests/export
     */
    public function export()
    {
        if (!Session::get('admin_logged_in')) {
            return response()->json(['error' => 'Доступ запрещён'], 403);
        }

        $guests = Guest::orderBy('created_at', 'desc')->get();

        $csv = "Фамилия,Имя,Статус,С парой,Партнёр,Человек,Пожелание,Дата\n";
        foreach ($guests as $guest) {
            $csv .= implode(',', [
                    '"' . $guest->last_name . '"',
                    '"' . $guest->first_name . '"',
                    $guest->status === 'will_come' ? 'Придёт' : 'Не придёт',
                    $guest->with_partner ? 'Да' : 'Нет',
                    '"' . ($guest->partner_full_name ?? '') . '"',
                    $guest->total_persons,
                    '"' . str_replace('"', '""', $guest->message ?? '') . '"',
                    $guest->created_at->format('d.m.Y H:i'),
                ]) . "\n";
        }

        return response($csv, 200, [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="guests.csv"',
        ]);
    }

}
