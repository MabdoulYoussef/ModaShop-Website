@extends('layouts.master')

@section('content')
<!-- hero area -->
<div class="hero-area hero-bg">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12 text-center">
                <div class="hero-text-tablecell">
                    <h1 class="arabic-text">شروط الاستخدام</h1>
                    <p class="arabic-text">يرجى قراءة شروط الاستخدام هذه بعناية قبل استخدام موقع Moda2Shop</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end hero area -->

<!-- terms content -->
<div class="product-section mt-150 mb-150">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="terms-content arabic-text">

                    <h2 class="arabic-text">1. قبول الشروط</h2>
                    <p class="arabic-text">باستخدام موقع Moda2Shop، فإنك توافق على الالتزام بشروط الاستخدام هذه. إذا كنت لا توافق على أي من هذه الشروط، يرجى عدم استخدام موقعنا.</p>

                    <h2 class="arabic-text">2. وصف الخدمة</h2>
                    <p class="arabic-text">Moda2Shop هو متجر إلكتروني متخصص في بيع الملابس العربية العصرية والأنيقة. نقدم منتجات عالية الجودة مع خدمة عملاء متميزة.</p>

                    <h2 class="arabic-text">3. الحساب والمسؤولية</h2>
                    <p class="arabic-text">عند إنشاء حساب على موقعنا، أنت مسؤول عن:</p>
                    <ul class="arabic-text">
                        <li>الحفاظ على سرية كلمة المرور</li>
                        <li>جميع الأنشطة التي تحدث تحت حسابك</li>
                        <li>إبلاغنا فوراً عن أي استخدام غير مصرح به</li>
                        <li>تقديم معلومات دقيقة ومحدثة</li>
                    </ul>

                    <h2 class="arabic-text">4. الطلبات والدفع</h2>
                    <p class="arabic-text">جميع الطلبات تخضع للتوفر والموافقة. نحتفظ بالحق في رفض أو إلغاء أي طلب لأي سبب كان. الأسعار المعروضة على الموقع قد تتغير دون إشعار مسبق.</p>

                    <h2 class="arabic-text">5. الشحن والتسليم</h2>
                    <p class="arabic-text">نحن نقدم خدمة الشحن المجاني لجميع الطلبات. أوقات التسليم قد تختلف حسب الموقع. نحن غير مسؤولين عن التأخير الناتج عن الظروف الخارجة عن سيطرتنا.</p>

                    <h2 class="arabic-text">6. الإرجاع والاسترداد</h2>
                    <p class="arabic-text">يمكنك إرجاع المنتجات خلال 7 أيام من تاريخ التسليم بشرط أن تكون:</p>
                    <ul class="arabic-text">
                        <li>في حالتها الأصلية</li>
                        <li>مع جميع الملصقات والتغليف</li>
                        <li>غير مستخدمة أو ملبوسة</li>
                    </ul>

                    <h2 class="arabic-text">7. الملكية الفكرية</h2>
                    <p class="arabic-text">جميع المحتويات الموجودة على موقع Moda2Shop، بما في ذلك النصوص والصور والتصاميم، محمية بحقوق الطبع والنشر. لا يجوز استخدامها دون إذن كتابي منا.</p>

                    <h2 class="arabic-text">8. إخلاء المسؤولية</h2>
                    <p class="arabic-text">نحن نقدم الموقع "كما هو" دون ضمانات من أي نوع. نحن غير مسؤولين عن أي أضرار مباشرة أو غير مباشرة قد تنتج عن استخدام الموقع.</p>

                    <h2 class="arabic-text">9. تعديل الشروط</h2>
                    <p class="arabic-text">نحتفظ بالحق في تعديل شروط الاستخدام هذه في أي وقت. التعديلات ستصبح فعالة فور نشرها على الموقع. استمرار استخدامك للموقع بعد التعديلات يعني موافقتك عليها.</p>

                    <h2 class="arabic-text">10. القانون الحاكم</h2>
                    <p class="arabic-text">هذه الشروط تحكمها قوانين المملكة العربية السعودية. أي نزاعات ستخضع لاختصاص المحاكم السعودية.</p>

                    <h2 class="arabic-text">11. التواصل معنا</h2>
                    <p class="arabic-text">إذا كان لديك أي أسئلة حول شروط الاستخدام هذه، يرجى التواصل معنا عبر:</p>
                    <ul class="arabic-text">
                        <li>البريد الإلكتروني: support@modashop.com</li>
                        <li>الهاتف: +966 50 123 4567</li>
                        <li>العنوان: شارع الملك فهد، الرياض، المملكة العربية السعودية</li>
                    </ul>

                    <p class="arabic-text"><strong>تاريخ آخر تحديث:</strong> {{ date('Y-m-d') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end terms content -->
@endsection
