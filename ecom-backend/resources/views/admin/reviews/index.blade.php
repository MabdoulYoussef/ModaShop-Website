@extends('layouts.admin')

@section('title', 'إدارة التقييمات')
@section('page-title', 'إدارة التقييمات')
@section('page-description', 'عرض وإدارة تقييمات العملاء للمنتجات')

@section('content')

<!-- Success/Error Messages -->
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fas fa-check-circle me-2"></i>
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="fas fa-exclamation-circle me-2"></i>
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<!-- Reviews Statistics -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="admin-card text-center">
            <div class="admin-card-body">
                <i class="fas fa-star text-warning fa-2x mb-3"></i>
                <h4 class="text-primary">{{ $reviews->total() }}</h4>
                <p class="mb-0">إجمالي التقييمات</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="admin-card text-center">
            <div class="admin-card-body">
                <i class="fas fa-check-circle text-success fa-2x mb-3"></i>
                <h4 class="text-success">{{ $reviews->where('is_approved', true)->count() }}</h4>
                <p class="mb-0">التقييمات المعتمدة</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="admin-card text-center">
            <div class="admin-card-body">
                <i class="fas fa-clock text-warning fa-2x mb-3"></i>
                <h4 class="text-warning">{{ $reviews->where('is_approved', false)->count() }}</h4>
                <p class="mb-0">في انتظار الموافقة</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="admin-card text-center">
            <div class="admin-card-body">
                <i class="fas fa-star-half-alt text-info fa-2x mb-3"></i>
                <h4 class="text-info">{{ number_format($reviews->avg('rating'), 1) }}</h4>
                <p class="mb-0">متوسط التقييم</p>
            </div>
        </div>
    </div>
</div>

<!-- Filters and Search -->
<div class="row mb-4">
    <div class="col-12">
        <div class="admin-card">
            <div class="admin-card-body">
                <form method="GET" class="row g-3">
                    <div class="col-md-3">
                        <label for="approved" class="form-label">حالة الموافقة</label>
                        <select name="approved" id="approved" class="form-select">
                            <option value="">جميع التقييمات</option>
                            <option value="1" {{ request('approved') == '1' ? 'selected' : '' }}>معتمدة</option>
                            <option value="0" {{ request('approved') == '0' ? 'selected' : '' }}>غير معتمدة</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="rating" class="form-label">التقييم</label>
                        <select name="rating" id="rating" class="form-select">
                            <option value="">جميع التقييمات</option>
                            <option value="5" {{ request('rating') == '5' ? 'selected' : '' }}>5 نجوم</option>
                            <option value="4" {{ request('rating') == '4' ? 'selected' : '' }}>4 نجوم</option>
                            <option value="3" {{ request('rating') == '3' ? 'selected' : '' }}>3 نجوم</option>
                            <option value="2" {{ request('rating') == '2' ? 'selected' : '' }}>2 نجوم</option>
                            <option value="1" {{ request('rating') == '1' ? 'selected' : '' }}>1 نجمة</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="search" class="form-label">البحث</label>
                        <input type="text" name="search" id="search" class="form-control" 
                               placeholder="البحث في التعليقات..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">&nbsp;</label>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn-admin">
                                <i class="fas fa-search"></i> بحث
                            </button>
                            <a href="{{ route('admin.reviews.index') }}" class="btn-admin-outline">
                                <i class="fas fa-times"></i> مسح
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Reviews List -->
<div class="row">
    <div class="col-12">
        <div class="admin-card">
            <div class="admin-card-header">
                <h5><i class="fas fa-comments me-2"></i>قائمة التقييمات</h5>
            </div>
            <div class="admin-card-body">
                @if($reviews->count() > 0)
                    <div class="table-responsive">
                        <table class="table admin-table">
                            <thead>
                                <tr>
                                    <th>العميل</th>
                                    <th>المنتج</th>
                                    <th>التقييم</th>
                                    <th>التعليق</th>
                                    <th>الحالة</th>
                                    <th>التاريخ</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reviews as $review)
                                <tr>
                                    <td>
                                        <div class="customer-info">
                                            <div class="customer-avatar">
                                                <i class="fas fa-user"></i>
                                            </div>
                                            <div class="customer-details">
                                                <h6 class="mb-0">{{ $review->customer->firstname }} {{ $review->customer->lastname }}</h6>
                                                <small class="text-muted">{{ $review->customer->phone }}</small>
                                                <small class="text-muted d-block">{{ $review->customer->city }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="product-info">
                                            @if($review->product->image)
                                                <img src="{{ asset('storage/' . $review->product->image) }}" 
                                                     alt="{{ $review->product->name }}" class="product-thumb">
                                            @else
                                                <div class="no-image">
                                                    <i class="fas fa-image"></i>
                                                </div>
                                            @endif
                                            <div class="product-details">
                                                <h6 class="mb-0">{{ $review->product->name }}</h6>
                                                <small class="text-muted">{{ $review->product->category->name ?? 'بدون فئة' }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="rating-display">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= $review->rating ? 'text-warning' : 'text-muted' }}"></i>
                                            @endfor
                                            <span class="rating-number">({{ $review->rating }})</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="comment-preview">
                                            {{ Str::limit($review->comment, 100) }}
                                            @if(strlen($review->comment) > 100)
                                                <button class="btn btn-sm btn-link p-0" data-bs-toggle="modal" 
                                                        data-bs-target="#commentModal{{ $review->id }}">
                                                    عرض المزيد
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        @if($review->is_approved)
                                            <span class="badge bg-success">
                                                <i class="fas fa-check"></i> معتمد
                                            </span>
                                        @else
                                            <span class="badge bg-warning">
                                                <i class="fas fa-clock"></i> في الانتظار
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="date-info">
                                            <small class="text-muted">{{ $review->created_at->format('d/m/Y') }}</small>
                                            <small class="text-muted d-block">{{ $review->created_at->format('H:i') }}</small>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            @if(!$review->is_approved)
                                                <form action="{{ route('admin.reviews.approve', $review->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="is_approved" value="1">
                                                    <button type="submit" class="btn btn-sm btn-success" 
                                                            onclick="return confirm('هل تريد الموافقة على هذا التقييم؟')">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{ route('admin.reviews.reject', $review->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="is_approved" value="0">
                                                    <button type="submit" class="btn btn-sm btn-warning" 
                                                            onclick="return confirm('هل تريد رفض هذا التقييم؟')">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </form>
                                            @endif
                                            
                                            <button class="btn btn-sm btn-info" data-bs-toggle="modal" 
                                                    data-bs-target="#reviewModal{{ $review->id }}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            
                                            <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" 
                                                        onclick="return confirm('هل تريد حذف هذا التقييم نهائياً؟')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Review Detail Modal -->
                                <div class="modal fade" id="reviewModal{{ $review->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">تفاصيل التقييم</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h6>معلومات العميل:</h6>
                                                        <p><strong>الاسم:</strong> {{ $review->customer->firstname }} {{ $review->customer->lastname }}</p>
                                                        <p><strong>الهاتف:</strong> {{ $review->customer->phone }}</p>
                                                        <p><strong>المدينة:</strong> {{ $review->customer->city }}</p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h6>معلومات المنتج:</h6>
                                                        <p><strong>المنتج:</strong> {{ $review->product->name }}</p>
                                                        <p><strong>الفئة:</strong> {{ $review->product->category->name ?? 'بدون فئة' }}</p>
                                                        <p><strong>السعر:</strong> {{ number_format($review->product->price, 2) }} درهم</p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="rating-section">
                                                    <h6>التقييم:</h6>
                                                    <div class="rating-display mb-3">
                                                        @for($i = 1; $i <= 5; $i++)
                                                            <i class="fas fa-star {{ $i <= $review->rating ? 'text-warning' : 'text-muted' }} fa-2x"></i>
                                                        @endfor
                                                        <span class="rating-number fs-4 ms-2">({{ $review->rating }}/5)</span>
                                                    </div>
                                                </div>
                                                <div class="comment-section">
                                                    <h6>التعليق:</h6>
                                                    <div class="comment-full bg-light p-3 rounded">
                                                        {{ $review->comment }}
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="meta-info">
                                                    <p><strong>تاريخ التقييم:</strong> {{ $review->created_at->format('d/m/Y H:i') }}</p>
                                                    <p><strong>الحالة:</strong> 
                                                        @if($review->is_approved)
                                                            <span class="badge bg-success">معتمد</span>
                                                        @else
                                                            <span class="badge bg-warning">في الانتظار</span>
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                @if(!$review->is_approved)
                                                    <form action="{{ route('admin.reviews.approve', $review->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="is_approved" value="1">
                                                        <button type="submit" class="btn btn-success">
                                                            <i class="fas fa-check"></i> الموافقة
                                                        </button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('admin.reviews.reject', $review->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="is_approved" value="0">
                                                        <button type="submit" class="btn btn-warning">
                                                            <i class="fas fa-times"></i> رفض
                                                        </button>
                                                    </form>
                                                @endif
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Full Comment Modal -->
                                <div class="modal fade" id="commentModal{{ $review->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">التعليق الكامل</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="comment-full">
                                                    {{ $review->comment }}
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $reviews->appends(request()->query())->links() }}
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-comments fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">لا توجد تقييمات</h5>
                        <p class="text-muted">لم يتم العثور على أي تقييمات تطابق معايير البحث</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection

@section('styles')
<style>
/* Reviews Styling */
.customer-info {
    display: flex;
    align-items: center;
    gap: 12px;
}

.customer-avatar {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #d4af37, #8b6f3f);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 16px;
}

.customer-details h6 {
    margin: 0;
    font-weight: 600;
    color: #333;
}

.product-info {
    display: flex;
    align-items: center;
    gap: 12px;
}

.product-thumb {
    width: 40px;
    height: 40px;
    object-fit: cover;
    border-radius: 8px;
    border: 2px solid #f0f0f0;
}

.no-image {
    width: 40px;
    height: 40px;
    background: #f8f9fa;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #999;
    border: 2px solid #e9ecef;
}

.product-details h6 {
    margin: 0;
    font-weight: 600;
    color: #333;
}

.rating-display {
    display: flex;
    align-items: center;
    gap: 5px;
}

.rating-number {
    font-weight: 600;
    color: #666;
    margin-right: 5px;
}

.comment-preview {
    max-width: 200px;
    line-height: 1.4;
}

.action-buttons {
    display: flex;
    gap: 5px;
}

.action-buttons .btn {
    padding: 4px 8px;
    font-size: 12px;
}

.date-info {
    text-align: center;
}

/* Statistics Cards */
.admin-card.text-center .admin-card-body {
    padding: 20px;
}

.admin-card.text-center i {
    display: block;
    margin-bottom: 10px;
}

.admin-card.text-center h4 {
    font-size: 2rem;
    font-weight: bold;
    margin-bottom: 5px;
}

/* Modal Styling */
.modal-content {
    border: none;
    border-radius: 10px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
}

.modal-header {
    background: linear-gradient(135deg, #d4af37, #8b6f3f);
    color: white;
    border-radius: 10px 10px 0 0;
}

.modal-header .btn-close {
    filter: invert(1);
}

.comment-full {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 8px;
    border-left: 4px solid #d4af37;
    line-height: 1.6;
}

/* Responsive Design */
@media (max-width: 768px) {
    .customer-info,
    .product-info {
        flex-direction: column;
        align-items: flex-start;
        text-align: center;
    }
    
    .customer-avatar,
    .product-thumb,
    .no-image {
        align-self: center;
    }
    
    .action-buttons {
        flex-direction: column;
        gap: 2px;
    }
    
    .comment-preview {
        max-width: 150px;
    }
}

/* Alert Styling */
.alert {
    border: none;
    border-radius: 10px;
    padding: 15px 20px;
    margin-bottom: 20px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.alert-success {
    background: linear-gradient(135deg, #d4edda, #c3e6cb);
    color: #155724;
    border-left: 4px solid #28a745;
}

.alert-danger {
    background: linear-gradient(135deg, #f8d7da, #f5c6cb);
    color: #721c24;
    border-left: 4px solid #dc3545;
}
</style>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add animation to statistics cards
    const statCards = document.querySelectorAll('.admin-card.text-center');
    statCards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            card.style.transition = 'all 0.5s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });
    
    // Add hover effects to action buttons
    const actionButtons = document.querySelectorAll('.action-buttons .btn');
    actionButtons.forEach(button => {
        button.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.1)';
        });
        
        button.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    });
    
    // Auto-refresh for pending reviews
    setInterval(function() {
        const pendingCount = {{ $reviews->where('is_approved', false)->count() }};
        if (pendingCount > 0) {
            location.reload();
        }
    }, 30000); // Refresh every 30 seconds if there are pending reviews
});
</script>
@endsection
