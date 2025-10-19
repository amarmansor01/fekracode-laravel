<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        // عدد الطلبات اليومية لآخر 7 أيام
        $dailyOrders = Order::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total'))
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // أكثر خدمة طلبًا (مع التأكد من وجود service_id)
        $topService = Order::with('service')
            ->select('service_id', DB::raw('count(*) as total'))
            ->whereNotNull('service_id')
            ->groupBy('service_id')
            ->orderByDesc('total')
            ->first();

        // الإيرادات آخر 30 يوم
        $revenues = Order::select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(price) as total'))
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // توزيع الحالات
        $statusDistribution = Order::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get();

        return view('admin.reports.index', compact('dailyOrders', 'topService', 'revenues', 'statusDistribution'));
    }
}
