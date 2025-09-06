@extends('layouts.master')

@section('content')
<!-- hero area -->
<div class="hero-area hero-bg">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12 text-center">
                <div class="hero-text-tablecell">
                    <h1 class="arabic-text">اتصل بنا</h1>
                    <p class="arabic-text">نحن هنا لمساعدتك في أي استفسار أو طلب</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end hero area -->

<!-- contact section -->
<div class="product-section mt-150 mb-150">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="contact-form">
                    <h3 class="arabic-text mb-4">أرسل لنا رسالة</h3>

                    @if(session('success'))
                        <div class="alert alert-success arabic-text">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger arabic-text">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger arabic-text">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('contact.submit') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="arabic-text">الاسم الكامل</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email" class="arabic-text">البريد الإلكتروني</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="arabic-text">رقم الهاتف</label>
                            <input type="tel" class="form-control" id="phone" name="phone">
                        </div>
                        <div class="form-group">
                            <label for="subject" class="arabic-text">الموضوع</label>
                            <input type="text" class="form-control" id="subject" name="subject" required>
                        </div>
                        <div class="form-group">
                            <label for="message" class="arabic-text">الرسالة</label>
                            <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="boxed-btn">إرسال الرسالة</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="contact-info">
                    <h3 class="arabic-text mb-4">معلومات التواصل</h3>

                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="contact-details">
                            <h4 class="arabic-text">العنوان</h4>
                            <p class="arabic-text">شارع الملك فهد<br>الرياض، المملكة العربية السعودية</p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="contact-details">
                            <h4 class="arabic-text">الهاتف</h4>
                            <p>+966 50 123 4567</p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="contact-details">
                            <h4 class="arabic-text">البريد الإلكتروني</h4>
                            <p>support@modashop.com</p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="contact-details">
                            <h4 class="arabic-text">ساعات العمل</h4>
                            <p class="arabic-text">السبت - الخميس: 9:00 ص - 10:00 م<br>الجمعة: 2:00 م - 10:00 م</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end contact section -->

<!-- map section -->
<div class="map-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="arabic-text text-center mb-4">موقعنا على الخريطة</h3>
                <div class="map-container">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3624.123456789!2d46.6753!3d24.7136!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjTCsDQyJzQ5LjAiTiA0NsKwNDAnMzEuMSJF!5e0!3m2!1sen!2ssa!4v1234567890123!5m2!1sen!2ssa"
                        width="100%"
                        height="400"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end map section -->

<style>
.contact-item {
    display: flex;
    align-items: flex-start;
    margin-bottom: 30px;
}

.contact-icon {
    background: #f28123;
    color: white;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-left: 15px;
    flex-shrink: 0;
}

.contact-details h4 {
    margin-bottom: 5px;
    color: #333;
}

.contact-details p {
    margin: 0;
    color: #666;
}

.contact-form .form-group {
    margin-bottom: 20px;
}

.contact-form label {
    font-weight: 600;
    margin-bottom: 5px;
    display: block;
}

.contact-form .form-control {
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 10px 15px;
    font-size: 14px;
}

.contact-form .form-control:focus {
    border-color: #f28123;
    box-shadow: 0 0 0 0.2rem rgba(242, 129, 35, 0.25);
}

.map-container {
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}
</style>
@endsection
