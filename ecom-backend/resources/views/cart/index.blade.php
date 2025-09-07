@extends('layouts.master')

@section('content')
<style>
    .main-menu ul li a {
        color: #ad8f53 !important;
        font-weight: 600;
    }

    .main-menu ul li a:hover {
        color: #8b6f3f !important;
    }

    .header-icons a {
        color: #ad8f53 !important;
    }

    .header-icons a:hover {
        color: #8b6f3f !important;
    }
</style>
<div class="container" style="margin-top: 70px;">
    <div class="row">
        <div class="col-12">
            <h2 class="text-center mb-4 arabic-text">سلة التسوق</h2>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if(isset($cartData) && $cartData && $cartData->cartItems->count() > 0)
                <div class="card shadow">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>المنتج</th>
                                        <th>السعر</th>
                                        <th>الكمية</th>
                                        <th>المجموع</th>
                                        <th>الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cartData->cartItems as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if($item->product->image)
                                                        <img src="{{ asset('assets/img/products/' . $item->product->image) }}"
                                                             alt="{{ $item->product->name }}"
                                                             class="me-3"
                                                             style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px;">
                                                    @endif
                                                    <div>
                                                        <h6 class="mb-0">{{ $item->product->name }}</h6>
                                                        @if(isset($item->product->size) && $item->product->size)
                                                            <small class="text-muted">المقاس: {{ $item->product->size }}</small>
                                                        @endif
                                                        @if(isset($item->product->description) && $item->product->description)
                                                            <small class="text-muted d-block">{{ Str::limit($item->product->description, 50) }}</small>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ number_format($item->product->price, 0) }} درهم</td>
                                            <td>
                                                <form method="POST" action="{{ route('cart.update', $item->id) }}" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="number"
                                                           name="quantity"
                                                           value="{{ $item->quantity }}"
                                                           min="1"
                                                           max="99"
                                                           class="form-control form-control-sm"
                                                           style="width: 80px;"
                                                           onchange="this.form.submit()">
                                                </form>
                                            </td>
                                            <td>{{ number_format($item->quantity * $item->product->price, 0) }} درهم</td>
                                            <td>
                                                <form method="POST" action="{{ route('cart.remove', $item->id) }}" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('هل أنت متأكد من حذف هذا المنتج؟')">
                                                        <i class="fas fa-trash"></i> حذف
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-6">
                                <div class="d-flex gap-2">
                                    <form method="POST" action="{{ route('cart.clear') }}" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-warning"
                                                onclick="return confirm('هل أنت متأكد من تفريغ السلة؟')">
                                            <i class="fas fa-trash"></i> تفريغ السلة
                                        </button>
                                    </form>
                                    <a href="{{ route('products.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-shopping-bag"></i> متابعة التسوق
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6 text-end">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <h5 class="card-title">ملخص الطلب</h5>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span>المجموع:</span>
                                            <strong>{{ number_format($total, 0) }} درهم</strong>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between">
                                            <span>الإجمالي:</span>
                                            <strong class="text-primary fs-5">{{ number_format($total, 0) }} درهم</strong>
                                        </div>
                                        <div class="mt-3">
                                            <a href="{{ route('orders.checkout') }}" class="btn btn-primary btn-lg w-100">
                                                <i class="fas fa-credit-card"></i> إتمام الطلب
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="alert-empty-cart">
                    <i class="fas fa-shopping-cart"></i>
                    <h4>سلة التسوق فارغة</h4>
                    <p>لم تقم بإضافة أي منتجات إلى السلة بعد</p>
                    <a href="{{ route('products.index') }}" class="btn">ابدأ التسوق</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
