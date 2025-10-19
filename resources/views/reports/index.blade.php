@extends('layouts.app')

@section('content')
<div class="container">
    <h2>📊 لوحة التقارير</h2>

    {{-- 💰 إجمالي الإيرادات --}}
    <div class="mb-4">
        <h4>💰 إجمالي الإيرادات خلال آخر 30 يوم:</h4>
        <p><strong>{{ number_format($revenue, 2) }} ل.س</strong></p>
    </div>

    {{-- 📌 توزيع حالات الطلبات --}}
    <div class="mb-4">
        <h4>📌 توزيع حالات الطلبات</h4>
        <ul>
            @foreach($statusCounts as $row)
                <li>{{ $row->status }}: {{ $row->total }} طلب</li>
            @endforeach
        </ul>
    </div>

    {{-- 📅 جدول عدد الطلبات لكل يوم --}}
    <div class="mb-4">
        <h4>📅 عدد الطلبات لكل يوم</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>التاريخ</th>
                    <th>عدد الطلبات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dailyOrders as $row)
                <tr>
                    <td>{{ $row->date }}</td>
                    <td>{{ $row->total }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- 📈 رسم بياني للطلبات اليومية --}}
    <div class="mb-4">
        <h4>📈 رسم بياني للطلبات اليومية</h4>
        <canvas id="ordersChart" height="100"></canvas>
    </div>

    {{-- 🔥 أكثر المنتجات طلبًا --}}
    <div class="mb-4">
        <h4>🔥 أكثر المنتجات طلبًا</h4>
        <ul>
            @foreach($topProducts as $product)
                <li>{{ $product->name }}: {{ $product->total }} طلب</li>
            @endforeach
        </ul>
    </div>
</div>
@endsection

@section('scripts')
{{-- تحميل مكتبة Chart.js من CDN --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('ordersChart').getContext('2d');
const ordersChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: {!! json_encode($dailyOrders->pluck('date')) !!},
        datasets: [{
            label: 'عدد الطلبات',
            data: {!! json_encode($dailyOrders->pluck('total')) !!},
            backgroundColor: 'rgba(54, 162, 235, 0.6)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1
                }
            }
        }
    }
});
</script>
@endsection
