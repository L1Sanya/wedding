<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ-панель — Гости свадьбы</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f5ede4;
            color: #2c1f1a;
            padding: 20px;
            min-height: 100vh;
        }
        .container { max-width: 1100px; margin: 0 auto; }
        .header {
            background: #fffdf9;
            padding: 20px 28px;
            border-radius: 12px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.04);
            border: 1px solid #e8dccf;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 14px;
            margin-bottom: 20px;
        }
        .header h1 { font-size: 1.6em; color: #2c1f1a; }
        .header-subtitle { font-size: 0.85em; color: #8c7b6e; font-style: italic; }
        .logout-btn {
            padding: 10px 22px;
            background: #e0d5c7;
            border-radius: 25px;
            text-decoration: none;
            color: #2c1f1a;
            font-weight: 500;
            transition: 0.3s;
        }
        .logout-btn:hover { background: #d0c0b0; }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 14px;
            margin-bottom: 20px;
        }
        .stat-card {
            background: #fffdf9;
            padding: 22px 18px;
            border-radius: 10px;
            text-align: center;
            border: 1px solid #e8dccf;
        }
        .stat-card .number { font-size: 2.4em; font-weight: bold; }
        .stat-card .label { font-size: 0.8em; color: #8c7b6e; margin-top: 4px; }
        .green .number { color: #2d6a4f; }
        .red .number { color: #c0392b; }
        .gold .number { color: #c9a96e; }
        .blue .number { color: #4a6fa5; }

        .filter-bar {
            background: #fffdf9;
            padding: 14px 20px;
            border-radius: 10px;
            border: 1px solid #e8dccf;
            margin-bottom: 16px;
        }
        .filter-bar a {
            display: inline-block;
            padding: 8px 18px;
            margin-right: 8px;
            border-radius: 20px;
            text-decoration: none;
            color: #4a3b35;
            font-weight: 500;
            font-size: 0.9em;
            border: 1px solid #e0d5c7;
            transition: 0.3s;
        }
        .filter-bar a:hover { background: #faf3e8; }
        .filter-bar a.active { background: #7a2e3b; color: #fff; border-color: #7a2e3b; }

        .table-wrap {
            background: #fffdf9;
            border-radius: 12px;
            overflow-x: auto;
            border: 1px solid #e8dccf;
        }
        table { width: 100%; border-collapse: collapse; font-size: 0.88em; }
        thead { background: #faf3e8; }
        th {
            padding: 14px 12px;
            text-align: left;
            font-weight: 600;
            font-size: 0.8em;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        td { padding: 12px 12px; border-top: 1px solid #f0e8db; }
        tbody tr:hover td { background: #fdf8f2; }

        .badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.78em;
            font-weight: 600;
        }
        .badge-success { background: #d8f3dc; color: #2d6a4f; }
        .badge-danger { background: #fce4e4; color: #c0392b; }

        .empty { text-align: center; padding: 50px; color: #8c7b6e; font-style: italic; }

        @media (max-width: 768px) {
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
            th, td { padding: 10px 6px; font-size: 0.75em; }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <div>
            <h1>💍 Гости свадьбы</h1>
            <p class="header-subtitle">Цырен & Сарюна • 23 августа 2026</p>
        </div>
        <a href="/admin/logout" class="logout-btn">🚪 Выйти</a>
    </div>

    <div class="stats-grid">
        <div class="stat-card green">
            <div class="number">{{ $stats['will_come_count'] }}</div>
            <div class="label">✅ Придут (анкет)</div>
        </div>
        <div class="stat-card gold">
            <div class="number">{{ $stats['total_persons'] }}</div>
            <div class="label">👥 Всего человек</div>
        </div>
        <div class="stat-card blue">
            <div class="number">{{ $stats['with_partner_count'] }}</div>
            <div class="label">💑 С парой</div>
        </div>
        <div class="stat-card red">
            <div class="number">{{ $stats['will_not_come_count'] }}</div>
            <div class="label">😔 Не придут</div>
        </div>
    </div>

    <div class="filter-bar">
        <a href="/admin?status=all" class="{{ $currentStatus === 'all' ? 'active' : '' }}">📋 Все</a>
        <a href="/admin?status=will_come" class="{{ $currentStatus === 'will_come' ? 'active' : '' }}">✅ Придут</a>
        <a href="/admin?status=will_not_come" class="{{ $currentStatus === 'will_not_come' ? 'active' : '' }}">😔 Не придут</a>
        <a href="/admin" style="margin-left:16px;">🔄 Обновить</a>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
            <tr>
                <th>№</th>
                <th>Фамилия</th>
                <th>Имя</th>
                <th>Статус</th>
                <th>ФИ партнёра</th>
                <th>👥</th>
                <th>Пожелание</th>
                <th>Дата</th>
            </tr>
            </thead>
            <tbody>
            @forelse($guests as $index => $guest)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><strong>{{ $guest->last_name }}</strong></td>
                    <td>{{ $guest->first_name }}</td>
                    <td>
                                <span class="badge {{ $guest->status === 'will_come' ? 'badge-success' : 'badge-danger' }}">
                                    {{ $guest->status === 'will_come' ? '✅ Придёт' : '😔 Не придёт' }}
                                </span>
                    </td>
                    <td>
                        @if($guest->with_partner && $guest->partner_first_name)
                            {{ $guest->partner_last_name ?? '' }} {{ $guest->partner_first_name }}
                        @else
                            —
                        @endif
                    </td>
                    <td><strong>{{ $guest->total_persons }}</strong></td>
                    <td style="max-width:200px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;color:#8c7b6e;font-style:italic;">
                        {{ $guest->message ?? '—' }}
                    </td>
                    <td>{{ $guest->created_at->format('d.m.Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="empty">Гостей пока нет</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
