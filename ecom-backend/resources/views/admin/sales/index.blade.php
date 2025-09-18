@extends('layouts.admin')

@section('title', 'التقارير والمبيعات')
@section('page-title', 'التقارير والمبيعات')
@section('page-description', 'تحليل شامل للمبيعات والأداء التجاري')

@section('content')

<!-- Time Period Filter -->
<div class="admin-card mb-4">
    <div class="admin-card-header">
        <h5><i class="fas fa-calendar-alt me-2"></i>فترة التقرير</h5>
    </div>
    <div class="admin-card-body">
        <form method="GET" action="{{ route('admin.sales.index') }}" class="row g-3">
            <div class="col-md-3">
                <label for="period" class="form-label">الفترة</label>
                <select name="period" id="period" class="form-select" onchange="this.form.submit()">
                    <option value="today" {{ $period == 'today' ? 'selected' : '' }}>اليوم</option>
                    <option value="week" {{ $period == 'week' ? 'selected' : '' }}>هذا الأسبوع</option>
                    <option value="month" {{ $period == 'month' ? 'selected' : '' }}>هذا الشهر</option>
                    <option value="year" {{ $period == 'year' ? 'selected' : '' }}>هذا العام</option>
                    <option value="monthly" {{ $period == 'monthly' ? 'selected' : '' }}>شهري (شهور السنة)</option>
                    <option value="custom" {{ $period == 'custom' ? 'selected' : '' }}>فترة مخصصة</option>
                </select>
            </div>
            <div class="col-md-3" id="custom-date-from" style="{{ $period == 'custom' ? '' : 'display: none;' }}">
                <label for="date_from" class="form-label">من تاريخ</label>
                <input type="date" name="date_from" id="date_from" class="form-control" value="{{ $dateFrom }}">
            </div>
            <div class="col-md-3" id="custom-date-to" style="{{ $period == 'custom' ? '' : 'display: none;' }}">
                <label for="date_to" class="form-label">إلى تاريخ</label>
                <input type="date" name="date_to" id="date_to" class="form-control" value="{{ $dateTo }}">
            </div>
            <div class="col-md-3">
                <label class="form-label">&nbsp;</label>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn-admin">
                        <i class="fas fa-search"></i> تطبيق
                    </button>
                    <button type="button" class="btn-admin-outline" onclick="exportReport()">
                        <i class="fas fa-download"></i> تصدير
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Key Metrics Cards -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stats-card">
            <div class="stats-icon">
                <i class="fas fa-dollar-sign"></i>
            </div>
            <div class="stats-number">{{ number_format($totalRevenue, 0) }}</div>
            <div class="stats-label">إجمالي الإيرادات (درهم)</div>
            <div class="stats-change {{ $revenueChange >= 0 ? 'positive' : 'negative' }}">
                <i class="fas fa-arrow-{{ $revenueChange >= 0 ? 'up' : 'down' }}"></i>
                {{ abs($revenueChange) }}% من الفترة السابقة
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stats-card">
            <div class="stats-icon">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <div class="stats-number">{{ $totalOrders }}</div>
            <div class="stats-label">إجمالي الطلبات</div>
            <div class="stats-change {{ $ordersChange >= 0 ? 'positive' : 'negative' }}">
                <i class="fas fa-arrow-{{ $ordersChange >= 0 ? 'up' : 'down' }}"></i>
                {{ abs($ordersChange) }}% من الفترة السابقة
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stats-card">
            <div class="stats-icon">
                <i class="fas fa-calculator"></i>
            </div>
            <div class="stats-number">{{ number_format($averageOrderValue, 0) }}</div>
            <div class="stats-label">متوسط قيمة الطلب (درهم)</div>
            <div class="stats-change {{ $aovChange >= 0 ? 'positive' : 'negative' }}">
                <i class="fas fa-arrow-{{ $aovChange >= 0 ? 'up' : 'down' }}"></i>
                {{ abs($aovChange) }}% من الفترة السابقة
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stats-card">
            <div class="stats-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="stats-number">{{ $totalCustomers }}</div>
            <div class="stats-label">عملاء جدد</div>
            <div class="stats-change {{ $customersChange >= 0 ? 'positive' : 'negative' }}">
                <i class="fas fa-arrow-{{ $customersChange >= 0 ? 'up' : 'down' }}"></i>
                {{ abs($customersChange) }}% من الفترة السابقة
            </div>
        </div>
    </div>
</div>

<!-- Charts Section -->
<div class="row mb-4">
    <!-- Revenue Chart -->
    <div class="col-lg-8 mb-4">
        <div class="admin-card">
            <div class="admin-card-header">
                <h5><i class="fas fa-chart-line me-2"></i>الإيرادات عبر الوقت</h5>
            </div>
            <div class="admin-card-body">
                <canvas id="revenueChart" height="200"></canvas>
            </div>
        </div>
    </div>

    <!-- Orders Chart -->
    <div class="col-lg-4 mb-4">
        <div class="admin-card">
            <div class="admin-card-header">
                <h5><i class="fas fa-chart-bar me-2"></i>عدد الطلبات</h5>
            </div>
            <div class="admin-card-body">
                <canvas id="ordersChart" height="200"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Product Performance -->
<div class="row mb-4">
    <!-- Top Products -->
    <div class="col-lg-6 mb-4">
        <div class="admin-card">
            <div class="admin-card-header">
                <h5><i class="fas fa-star me-2"></i>أفضل المنتجات مبيعاً</h5>
            </div>
            <div class="admin-card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>المنتج</th>
                                <th>الكمية المباعة</th>
                                <th>الإيرادات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($topProducts as $product)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if($product->image)
                                            <img src="{{ asset('assets/img/products/' . $product->image) }}"
                                                 alt="{{ $product->name }}"
                                                 class="product-thumb me-2"
                                                 style="width: 40px; height: 40px; object-fit: cover; border-radius: 4px;">
                                        @else
                                            <div class="product-placeholder me-2"
                                                 style="width: 40px; height: 40px; background: #f8f9fa; border-radius: 4px; display: flex; align-items: center; justify-content: center;">
                                                <i class="fas fa-image text-muted"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <div class="fw-bold">{{ $product->name }}</div>
                                            <small class="text-muted">{{ $product->category->name ?? 'بدون فئة' }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="fw-bold">{{ $product->total_quantity }}</td>
                                <td class="fw-bold text-success">{{ number_format($product->total_revenue, 0) }} درهم</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Sales by Category -->
    <div class="col-lg-6 mb-4">
        <div class="admin-card">
            <div class="admin-card-header">
                <h5><i class="fas fa-chart-pie me-2"></i>المبيعات حسب الفئة</h5>
            </div>
            <div class="admin-card-body">
                <canvas id="categoryChart" height="200"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Customer Analysis -->
<div class="row mb-4">
    <!-- Top Customers -->
    <div class="col-lg-8 mb-4">
        <div class="admin-card">
            <div class="admin-card-header">
                <h5><i class="fas fa-crown me-2"></i>أفضل العملاء</h5>
            </div>
            <div class="admin-card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>العميل</th>
                                <th>عدد الطلبات</th>
                                <th>إجمالي المشتريات</th>
                                <th>متوسط قيمة الطلب</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($topCustomers as $customer)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="customer-avatar me-2">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold">{{ $customer->full_name }}</div>
                                            <small class="text-muted">{{ $customer->phone }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="fw-bold">{{ $customer->orders_count }}</td>
                                <td class="fw-bold text-success">{{ number_format($customer->total_spent, 0) }} درهم</td>
                                <td class="fw-bold">{{ number_format($customer->average_order_value, 0) }} درهم</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Methods -->
    <div class="col-lg-4 mb-4">
        <div class="admin-card">
            <div class="admin-card-header">
                <h5><i class="fas fa-credit-card me-2"></i>طرق الدفع</h5>
            </div>
            <div class="admin-card-body">
                <canvas id="paymentChart" height="200"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Geographic Sales -->
<div class="row mb-4">
    <div class="col-12">
        <div class="admin-card">
            <div class="admin-card-header">
                <h5><i class="fas fa-map-marker-alt me-2"></i>المبيعات حسب المدينة</h5>
            </div>
            <div class="admin-card-body">
                <div class="row">
                    @foreach($salesByCity as $city)
                    <div class="col-md-3 mb-3">
                        <div class="city-sales-card">
                            <div class="city-name">{{ $city->city }}</div>
                            <div class="city-orders">{{ $city->orders_count }} طلب</div>
                            <div class="city-revenue">{{ number_format($city->total_revenue, 0) }} درهم</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// Revenue Chart
const revenueCtx = document.getElementById('revenueChart').getContext('2d');
new Chart(revenueCtx, {
    type: 'line',
    data: {
        labels: {!! json_encode($chartData['labels']) !!},
        datasets: [{
            label: 'الإيرادات (درهم)',
            data: {!! json_encode($chartData['revenue']) !!},
            borderColor: '#ceb57f',
            backgroundColor: 'rgba(206, 181, 127, 0.1)',
            borderWidth: 3,
            fill: true,
            tension: 0.4
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value) {
                        return value.toLocaleString() + ' درهم';
                    }
                }
            }
        }
    }
});

// Orders Chart
const ordersCtx = document.getElementById('ordersChart').getContext('2d');
new Chart(ordersCtx, {
    type: 'bar',
    data: {
        labels: {!! json_encode($chartData['labels']) !!},
        datasets: [{
            label: 'عدد الطلبات',
            data: {!! json_encode($chartData['orders']) !!},
            backgroundColor: 'rgba(206, 181, 127, 0.8)',
            borderColor: '#ceb57f',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// Category Chart
const categoryCtx = document.getElementById('categoryChart').getContext('2d');
new Chart(categoryCtx, {
    type: 'doughnut',
    data: {
        labels: {!! json_encode($categoryData['labels']) !!},
        datasets: [{
            data: {!! json_encode($categoryData['data']) !!},
            backgroundColor: [
                '#ceb57f',
                '#8b6f3f',
                '#ad8f53',
                '#b48b57',
                '#d4af37'
            ]
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom'
            }
        }
    }
});

// Payment Chart
const paymentCtx = document.getElementById('paymentChart').getContext('2d');
new Chart(paymentCtx, {
    type: 'pie',
    data: {
        labels: {!! json_encode($paymentData['labels']) !!},
        datasets: [{
            data: {!! json_encode($paymentData['data']) !!},
            backgroundColor: [
                '#28a745',
                '#007bff'
            ]
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom'
            }
        }
    }
});

// Period filter change
document.getElementById('period').addEventListener('change', function() {
    const customFields = ['custom-date-from', 'custom-date-to'];
    if (this.value === 'custom') {
        customFields.forEach(id => {
            document.getElementById(id).style.display = 'block';
        });
    } else {
        customFields.forEach(id => {
            document.getElementById(id).style.display = 'none';
        });
    }
});

// Export function
function exportReport() {
    const period = document.getElementById('period').value;
    const dateFrom = document.getElementById('date_from').value;
    const dateTo = document.getElementById('date_to').value;

    let url = '{{ route("admin.sales.export") }}?period=' + period;
    if (period === 'custom') {
        url += '&date_from=' + dateFrom + '&date_to=' + dateTo;
    }

    window.open(url, '_blank');
}
</script>

<style>
.stats-change {
    font-size: 0.8rem;
    margin-top: 5px;
}

.stats-change.positive {
    color: #28a745;
}

.stats-change.negative {
    color: #dc3545;
}

.product-thumb {
    border: 1px solid #dee2e6;
}

.customer-avatar {
    width: 40px;
    height: 40px;
    background: #ceb57f;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.city-sales-card {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 8px;
    text-align: center;
    border-left: 4px solid #ceb57f;
}

.city-name {
    font-weight: bold;
    font-size: 1.1rem;
    color: #333;
}

.city-orders {
    color: #666;
    font-size: 0.9rem;
    margin: 5px 0;
}

.city-revenue {
    color: #ceb57f;
    font-weight: bold;
    font-size: 1rem;
}
</style>
@endsection
