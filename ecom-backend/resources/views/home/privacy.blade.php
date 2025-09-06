@extends('layouts.master')

@section('content')
<!-- hero area -->
<div class="hero-area hero-bg">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12 text-center">
                <div class="hero-text-tablecell">
                    <h1 class="arabic-text">سياسة الخصوصية</h1>
                    <p class="arabic-text">نحن في Moda2Shop نحترم خصوصيتك ونلتزم بحماية معلوماتك الشخصية</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end hero area -->

<!-- privacy policy content -->
<div class="product-section mt-150 mb-150">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="privacy-content arabic-text">

                    <h2 class="arabic-text">1. جمع المعلومات</h2>
                    <p class="arabic-text">نقوم بجمع المعلومات التي تقدمها لنا عند:</p>
                    <ul class="arabic-text">
                        <li>إنشاء حساب أو طلب</li>
                        <li>التواصل معنا</li>
                        <li>استخدام موقعنا الإلكتروني</li>
                        <li>الاشتراك في نشرتنا الإخبارية</li>
                    </ul>

                    <h2 class="arabic-text">2. استخدام المعلومات</h2>
                    <p class="arabic-text">نستخدم المعلومات التي نجمعها لـ:</p>
                    <ul class="arabic-text">
                        <li>معالجة طلباتك وتقديم الخدمات</li>
                        <li>تحسين تجربتك على موقعنا</li>
                        <li>إرسال تحديثات حول منتجاتنا وعروضنا</li>
                        <li>الرد على استفساراتك وطلباتك</li>
                    </ul>

                    <h2 class="arabic-text">3. حماية المعلومات</h2>
                    <p class="arabic-text">نحن نستخدم تقنيات أمان متقدمة لحماية معلوماتك الشخصية من الوصول غير المصرح به أو التغيير أو الكشف أو التدمير.</p>

                    <h2 class="arabic-text">4. مشاركة المعلومات</h2>
                    <p class="arabic-text">نحن لا نبيع أو نؤجر أو نشارك معلوماتك الشخصية مع أطراف ثالثة إلا في الحالات التالية:</p>
                    <ul class="arabic-text">
                        <li>بموافقتك الصريحة</li>
                        <li>لتقديم الخدمات المطلوبة</li>
                        <li>للامتثال للقوانين واللوائح</li>
                    </ul>

                    <h2 class="arabic-text">5. ملفات تعريف الارتباط (Cookies)</h2>
                    <p class="arabic-text">نستخدم ملفات تعريف الارتباط لتحسين تجربتك على موقعنا. يمكنك تعطيل ملفات تعريف الارتباط من خلال إعدادات متصفحك.</p>

                    <h2 class="arabic-text">6. حقوقك</h2>
                    <p class="arabic-text">لديك الحق في:</p>
                    <ul class="arabic-text">
                        <li>الوصول إلى معلوماتك الشخصية</li>
                        <li>تصحيح المعلومات غير الصحيحة</li>
                        <li>حذف معلوماتك الشخصية</li>
                        <li>سحب موافقتك في أي وقت</li>
                    </ul>

                    <h2 class="arabic-text">7. التحديثات</h2>
                    <p class="arabic-text">قد نقوم بتحديث سياسة الخصوصية هذه من وقت لآخر. سنقوم بإشعارك بأي تغييرات مهمة عبر موقعنا الإلكتروني.</p>

                    <h2 class="arabic-text">8. التواصل معنا</h2>
                    <p class="arabic-text">إذا كان لديك أي أسئلة حول سياسة الخصوصية هذه، يرجى التواصل معنا عبر:</p>
                    <ul class="arabic-text">
                        <li>البريد الإلكتروني: privacy@modashop.com</li>
                        <li>الهاتف: +966 50 123 4567</li>
                        <li>العنوان: شارع الملك فهد، الرياض، المملكة العربية السعودية</li>
                    </ul>

                    <p class="arabic-text"><strong>تاريخ آخر تحديث:</strong> {{ date('Y-m-d') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end privacy policy content -->
@endsection
