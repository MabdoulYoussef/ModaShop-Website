@extends('layouts.shop')

@section('content')

<!-- Page Title Section -->
<div class="page-title-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-title text-center">
                    <h1 class="arabic-text">اتصل بنا</h1>
                    <p class="arabic-text">نحن هنا لمساعدتك في أي استفسار أو طلب</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Contact Section -->
<div class="contact-section">
    <div class="container">
        <div class="row">
            <!-- Contact Form -->
            <div class="col-lg-8">
                <div class="contact-form-wrapper">
                    <div class="section-title">
                        <h2 class="arabic-text">أرسل لنا رسالة</h2>
                        <p class="arabic-text">سنكون سعداء للرد عليك في أقرب وقت ممكن</p>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success arabic-text">
                            <i class="fas fa-check-circle"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger arabic-text">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ session('error') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger arabic-text">
                            <i class="fas fa-exclamation-circle"></i>
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('contact.submit') }}" method="POST" class="contact-form">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="arabic-text">الاسم الكامل *</label>
                                    <input type="text" class="form-control" id="name" name="name" required placeholder="أدخل اسمك الكامل">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email" class="arabic-text">البريد الإلكتروني *</label>
                                    <input type="email" class="form-control" id="email" name="email" required placeholder="أدخل بريدك الإلكتروني">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone" class="arabic-text">رقم الهاتف</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="أدخل رقم هاتفك">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="subject" class="arabic-text">الموضوع *</label>
                                    <input type="text" class="form-control" id="subject" name="subject" required placeholder="موضوع رسالتك">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="message" class="arabic-text">الرسالة *</label>
                            <textarea class="form-control" id="message" name="message" rows="6" required placeholder="اكتب رسالتك هنا..."></textarea>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary btn-lg arabic-text">
                                <i class="fas fa-paper-plane"></i>
                                إرسال الرسالة
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="col-lg-4">
                <div class="contact-info-wrapper">
                    <div class="section-title">
                        <h2 class="arabic-text">معلومات التواصل</h2>
                    </div>

                    <div class="contact-description">
                        <strong><h6 class="arabic-text">تواصل معنا عبر الطرق التالية</h6></strong>
                    </div>


                        <div class="contact-info-item">
                            <div class="contact-item-header">
                                <div class="contact-icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <h4 class="arabic-text">الهاتف</h4>
                            </div>
                            <div class="contact-content">
                                <p>+966 50 123 4567</p>
                            </div>
                        </div>

                        <div class="contact-info-item">
                            <div class="contact-item-header">
                                <div class="contact-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <h4 class="arabic-text">البريد الإلكتروني</h4>
                            </div>
                            <div class="contact-content">
                                <p>support@modashop.com</p>
                            </div>
                        </div>

                        <div class="contact-info-item">
                            <div class="contact-item-header">
                                <div class="contact-icon">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <h4 class="arabic-text">ساعات العمل</h4>
                            </div>
                            <div class="contact-content">
                                <p class="arabic-text">السبت - الخميس: 9:00 ص - 10:00 م<br>الجمعة: 2:00 م - 10:00 م</p>
                            </div>
                        </div>
                    </div>

                    <!-- Social Media -->
                    <div class="social-media-section">
                        <h4 class="arabic-text">تابعنا على</h4>
                        <div class="social-links">
                            <a href="#" class="social-link facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="social-link twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="social-link instagram">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#" class="social-link whatsapp">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Page Title Section */
.page-title-section {
    background: #f8f9fa;
    padding: 100px 0 60px;
    margin-top: 120px;
    border-bottom: 1px solid #e9ecef;
}

.page-title h1 {
    color: #333;
    font-size: 2.5rem;
    font-weight: 600;
    margin-bottom: 15px;
}

.page-title p {
    color: #666;
    font-size: 1.1rem;
    margin: 0;
}

/* Contact Section */
.contact-section {
    padding: 60px 0;
    background: white;
}

.contact-form-wrapper,
.contact-info-wrapper {
    background: white;
    padding: 50px;
    border-radius: 8px;
    border: 1px solid #e9ecef;
    margin-bottom: 40px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.section-title {
    margin-bottom: 40px;
    text-align: center;
}

.section-title h2 {
    color: #333;
    font-size: 1.8rem;
    font-weight: 600;
    margin-bottom: 15px;
}

.section-title p {
    color: #666;
    font-size: 1rem;
    margin: 0;
}

.contact-description {
    text-align: center;
    margin-bottom: 30px;
    padding: 15px 20px;
    background: #f8f9fa;
    border-radius: 5px;
    border: 1px solid #e9ecef;
}

.contact-description p {
    color: #666;
    font-size: 0.95rem;
    margin: 0;
    font-style: italic;
}

/* Form Styling */
.contact-form .form-group {
    margin-bottom: 30px;
}

.contact-form label {
    font-weight: 500;
    margin-bottom: 10px;
    display: block;
    color: #333;
    font-size: 0.95rem;
}

.contact-form .form-control {
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 15px 20px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: white;
}

.contact-form .form-control:focus {
    border-color: #333;
    box-shadow: 0 0 0 0.2rem rgba(0,0,0,0.1);
    background: white;
    outline: none;
}

.contact-form .form-control::placeholder {
    color: #999;
    font-style: normal;
}

/* Button Styling */
.btn-primary {
    background: #333;
    border: none;
    border-radius: 5px;
    padding: 15px 40px;
    font-size: 1rem;
    font-weight: 500;
    text-transform: none;
    transition: all 0.3s ease;
    color: white;
}

.btn-primary:hover {
    background: #555;
    transform: none;
    box-shadow: none;
}

.btn-primary i {
    margin-left: 8px;
}

/* Alert Styling */
.alert {
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 15px 20px;
    margin-bottom: 30px;
    font-weight: 400;
}

.alert-success {
    background: #f8f9fa;
    color: #333;
    border-color: #28a745;
}

.alert-danger {
    background: #f8f9fa;
    color: #333;
    border-color: #dc3545;
}

.alert i {
    margin-left: 8px;
}

/* Contact Info Styling */
.contact-info-list {
    margin-bottom: 40px;
}

.contact-info-item {
    margin-bottom: 30px;
    padding: 25px;
    background: #f8f9fa;
    border-radius: 5px;
    border: 1px solid #e9ecef;
    transition: all 0.3s ease;
}

.contact-info-item:hover {
    background: #e9ecef;
    transform: none;
}

.contact-item-header {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
    gap: 15px;
}

.contact-icon {
    background: #333;
    color: white;
    width: 45px;
    height: 45px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    font-size: 1rem;
}

.contact-item-header h4 {
    margin: 0;
    color: #333;
    font-size: 1.1rem;
    font-weight: 600;
}

.contact-content p {
    margin: 0;
    color: #666;
    line-height: 1.6;
}

/* Social Media Section */
.social-media-section {
    text-align: center;
    padding: 30px 20px;
    background: #f8f9fa;
    border-radius: 5px;
    border: 1px solid #e9ecef;
    margin-top: 30px;
}

.social-media-section h4 {
    color: #333;
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 20px;
}

.social-links {
    display: flex;
    justify-content: center;
    gap: 15px;
}

.social-link {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    text-decoration: none;
    transition: all 0.3s ease;
    font-size: 1rem;
}

.social-link:hover {
    transform: none;
    box-shadow: none;
    color: white;
    text-decoration: none;
    opacity: 0.8;
}

.social-link.facebook {
    background: #3b5998;
}

.social-link.twitter {
    background: #1da1f2;
}

.social-link.instagram {
    background: #e4405f;
}

.social-link.whatsapp {
    background: #25d366;
}

/* Responsive Design */
@media (max-width: 768px) {
    .page-title-section {
        padding: 80px 0 40px;
        margin-top: 90px;
    }

    .page-title h1 {
        font-size: 2rem;
    }

    .page-title p {
        font-size: 1rem;
    }

    .contact-section {
        padding: 40px 0;
    }

    .contact-form-wrapper,
    .contact-info-wrapper {
        padding: 30px;
        margin-bottom: 30px;
    }

    .section-title h2 {
        font-size: 1.5rem;
    }

    .contact-info-item {
        padding: 20px;
    }

    .contact-item-header {
        gap: 12px;
        margin-bottom: 12px;
    }

    .contact-icon {
        width: 40px;
        height: 40px;
        font-size: 0.9rem;
    }

    .contact-item-header h4 {
        font-size: 1rem;
    }

    .contact-content p {
        padding-right: 0;
    }

    .social-links {
        gap: 10px;
    }

    .social-link {
        width: 40px;
        height: 40px;
        font-size: 0.9rem;
    }
}

@media (max-width: 576px) {
    .page-title h1 {
        font-size: 1.6rem;
    }

    .contact-form-wrapper,
    .contact-info-wrapper {
        padding: 25px;
    }

    .contact-form .form-control {
        padding: 12px 15px;
    }

    .btn-primary {
        padding: 12px 30px;
        font-size: 0.95rem;
    }
}
</style>
@endsection
