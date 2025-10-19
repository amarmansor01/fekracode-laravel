@extends('layouts.app')

@section('content')
<div class="fc-container">
  <h2>📊 التقارير</h2>

  {{-- جدول عدد الطلبات اليومية --}}
  <h3>عدد الطلبات اليومية (آخر 7 أيام)</h3>
  <table class="fc-table">
    <thead>
      <tr><th>التاريخ</th><th>عدد الطلبات</th></tr>
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
  <canvas id="dailyOrdersChart"></canvas>

  {{-- أكثر خدمة طلباً --}}
  <h3>⭐ أكثر خدمة طلبًا</h3>
  @if($topService && $topService->service)
    <p>{{ $topService->service->name }} ({{ $topService->total }} طلب)</p>
  @else
    <p>لا يوجد بيانات</p>
  @endif

  {{-- الإيرادات آخر 30 يوم --}}
  <h3>💰 الإيرادات (آخر 30 يوم)</h3>
  <table class="fc-table">
    <thead>
      <tr><th>التاريخ</th><th>الإيرادات</th></tr>
    </thead>
    <tbody>
      @foreach($revenues as $row)
        <tr>
          <td>{{ $row->date }}</td>
          <td>{{ $row->total }} $</td>
        </tr>
      @endforeach
    </tbody>
  </table>
  <canvas id="revenuesChart"></canvas>

  {{-- توزيع الحالات --}}
  <h3>📦 توزيع الحالات</h3>
  <table class="fc-table">
    <thead>
      <tr><th>الحالة</th><th>عدد الطلبات</th></tr>
    </thead>
    <tbody>
      @foreach($statusDistribution as $row)
        <tr>
          <td>{{ $row->status }}</td>
          <td>{{ $row->total }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
  <canvas id="statusChart"></canvas>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  // عدد الطلبات اليومية
  const dailyOrdersCtx = document.getElementById('dailyOrdersChart');
  new Chart(dailyOrdersCtx, {
    type: 'line',
    data: {
      labels: @json($dailyOrders->pluck('date')),
      datasets: [{
        label: 'عدد الطلبات',
        data: @json($dailyOrders->pluck('total')),
        borderColor: 'blue',
        fill: false
      }]
    }
  });

  // الإيرادات
  const revenuesCtx = document.getElementById('revenuesChart');
  new Chart(revenuesCtx, {
    type: 'bar',
    data: {
      labels: @json($revenues->pluck('date')),
      datasets: [{
        label: 'الإيرادات ($)',
        data: @json($revenues->pluck('total')),
        backgroundColor: 'green'
      }]
    }
  });

  // توزيع الحالات
  const statusCtx = document.getElementById('statusChart');
  new Chart(statusCtx, {
    type: 'pie',
    data: {
      labels: @json($statusDistribution->pluck('status')),
      datasets: [{
        data: @json($statusDistribution->pluck('total')),
        backgroundColor: ['orange','green','red','blue']
      }]
    }
  });
</script>
@endsection
