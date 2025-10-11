@extends('layouts.shop')

@section('content')
<!-- ABOUT PAGE -->
<div class="about-page">
    <!-- HERO -->
    <section class="about-hero py-5">
        <div class="container">
            <div class="row align-items-center gy-4">
                <!-- Text (right column in RTL) -->
                <div class="col-lg-6 order-lg-1">
                    <div class="about-text">
                        <h1 class="about-title">من نحن</h1>
                        <p class="lead about-lead">Moda2Shop — مزيجٍ من الأناقة المغربية والذوق العصري. نصمم ونجمع قطعاً تعكس هويتنا، ترتكز على جودة الخامات والحرفية الدقيقة.</p>

                        <div class="about-content">
                            <p>بدأت الرحلة بشغف صغير وطموح كبير: أن نقدّم ملابسًا عربية مُصمّمة بعناية، تُحترم فيها الحِرفة وتُبرز الأصالة. نعمل مع مُصنّعات محليّات ونختار الخامات بعناية لنقدّم قطعًا تناسب الاحتياجات اليومية والمناسبات الخاصة.</p>

                            <p>نؤمن أن الموضة وسيلة للتعبير عن الذات — لذلك نحافظ على توازن بين الراحة، الجودة والتصميم. هدفنا هو أن يشعر كل زبون أنه يرتدي قطعة مصممة له بعناية.</p>

                            <a href="{{ route('products.index') }}" class="btn btn-primary cta-btn mt-3">تصفح منتجاتنا</a>
                        </div>
                    </div>
                </div>

                <!-- Image -->
                <div class="col-lg-6 order-lg-0 text-center">
                    <div class="about-image">
                        <img src="{{ asset('assets/img/products/1758887431_68d67e075c31e.JPG') }}" alt="منتجاتنا المغربية" class="main-about-img">
                        <div class="image-caption">
                            <h4>منتجاتنا المغربية</h4>
                            <p>جودة وأصالة في كل تفصيلة</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- MISSION & VALUES -->
    <section class="about-values py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card value-card h-100">
                        <div class="card-body">
                            <h3 class="card-title">مهمتنا</h3>
                            <p>نقدّم ملابسًا تحمل طابعًا مغربيًا مع تصميم عصري ملموس، مع الاهتمام بالجودة والاستدامة ودعم الصناعة المحليّة.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card value-card h-100">
                        <div class="card-body">
                            <h3 class="card-title">قيمنا</h3>
                            <ul class="value-list">
                                <li><strong>الجودة</strong> — اختيار خامات مدروسة ومراعاة تفاصيل الخياطة.</li>
                                <li><strong>الحرفية</strong> — دعم منتجين محليين والحفاظ على حرفٍ تقليدية.</li>
                                <li><strong>المسؤولية</strong> — تصميم مستدام وتقليل الهدر حيثما أمكن.</li>
                                <li><strong>الاحترام</strong> — خدمة زبون محترمة وسريعة وتجربة شراء شفافة.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- TIMELINE -->
    <section class="about-timeline py-5 bg-light">
        <div class="container">
            <h3 class="section-title text-center mb-4">لمحة تاريخية</h3>
            <div class="row timeline-row gx-4 gy-4">
                <div class="col-md-4">
                    <div class="timeline-card">
                        <h4>2018</h4>
                        <p>البداية: الدراسة والبحث في عالم الأزياء، وتبلور فكرة مشروع يربط التراث بالتصميم المعاصر.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="timeline-card">
                        <h4>2019</h4>
                        <p>تأسيس العلامة وتعاون مع حرفيات محليّات؛ إطلاق أول مجموعة حصرية محلية.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="timeline-card">
                        <h4>اليوم</h4>
                        <p>توسّع متواصل في التشكيلة، تركيز على الجودة، وتجربة شراء إلكترونية مُحسّنة للزبائن.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- TEAM / CRAFTSMANSHIP -->
    <section class="about-team py-5">
        <div class="container">
            <h3 class="section-title text-center mb-4">العمل وورشاتنا</h3>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card craft-card h-100">
                        <div class="card-body">
                            <h4>الحِرفة أولًا</h4>
                            <p>نعمل مع حرفيات محلية، ونُعطي كل منتج وقتًا كافيًا لإتقان التفاصيل. كل قطعة تُراجع يدويًا قبل التعبئة.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card craft-card h-100">
                        <div class="card-body">
                            <h4>التزام بالاستدامة</h4>
                            <p>نحاول اختيار خامات أقل ضررًا وتقليل استخدام المواد التي تُسبب هدرًا زائدًا، ونبحث دائمًا عن حلول عملية لتخفيض البصمة البيئية.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- small gallery -->
            <div class="gallery mt-4">
                <div class="row g-3">
                    <div class="col-sm-4">
                        <img src="{{ asset('assets/img/products/1758887431_68d67e075c31e.JPG') }}" alt="صورة ورشة" class="gallery-img">
                    </div>
                    <div class="col-sm-4">
                        <img src="{{ asset('assets/img/products/another1.jpg') }}" alt="تفاصيل قماش" class="gallery-img">
                    </div>
                    <div class="col-sm-4">
                        <img src="{{ asset('assets/img/products/another2.jpg') }}" alt="منتج جاهز" class="gallery-img">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="about-cta py-5 bg-white">
        <div class="container text-center">
            <h3 class="mb-3">هل أنت جاهز لاكتشاف المجموعات؟</h3>
            <a href="{{ route('products.index') }}" class="btn btn-outline-primary btn-lg">تصفح المجموعات الآن</a>
        </div>
    </section>
</div>
@endsection

@section('styles')
<style>
/* === About page specific styles === */
.about-page { direction: rtl; text-align: right; color: #333; }

/* HERO */
.about-hero { background: #ffffff; padding-top: 40px; padding-bottom: 40px; }
.about-title {
    font-family: 'Tajawal', 'Cairo', sans-serif;
    font-size: 2.8rem;
    font-weight: 800;
    color: #b08948;
    margin-bottom: 0.75rem;
    text-align: right;
}
.about-lead { font-size: 1.05rem; color: #666; margin-bottom: 1rem; }
.about-content p { color: #555; margin-bottom: 1rem; font-size: 1rem; line-height: 1.7; }

/* CTA button */
.cta-btn {
    background: linear-gradient(45deg,#ceb57f,#ad8f53);
    border: none;
    color: #fff;
    padding: 10px 22px;
    border-radius: 28px;
    font-weight: 700;
    box-shadow: 0 6px 18px rgba(173,143,83,0.12);
}

/* IMAGE */
.about-image { display:flex; flex-direction:column; align-items:center; }
.main-about-img {
    width: 100%;
    max-width: 420px;
    height: auto;
    max-height: 620px;
    object-fit: cover;
    border-radius: 16px;
    box-shadow: 0 18px 40px rgba(0,0,0,0.08);
    border: 6px solid #ffffff;
}
.image-caption { margin-top: 14px; text-align: center; color: #8b6f3f; }
.image-caption h4 { margin-bottom: 4px; font-weight:700; }

/* VALUES CARDS */
.value-card { border: none; border-radius: 12px; box-shadow: 0 12px 30px rgba(0,0,0,0.05); }
.value-card .card-body { padding: 22px; }
.value-list { list-style: none; padding-left: 0; margin-top: 8px; color: #444; }
.value-list li { padding: 6px 0; }

/* TIMELINE */
.about-timeline { padding-top: 36px; padding-bottom: 36px; }
.section-title { color: #2c3e50; font-weight: 700; font-size: 1.6rem; }
.timeline-card { background: #fff; padding: 18px; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.04); min-height: 140px; }
.timeline-card h4 { color: #b08948; margin-bottom: 8px; }

/* CRAFT / TEAM */
.craft-card { border: none; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.04); }
.gallery-img { width: 100%; height: 170px; object-fit: cover; border-radius: 8px; box-shadow: 0 8px 20px rgba(0,0,0,0.06); }

/* CTA SECTION */
.about-cta { padding-top: 40px; padding-bottom: 60px; }

/* RESPONSIVE */
@media (max-width: 991px) {
    .about-title { font-size: 2rem; text-align: center; }
    .about-lead, .about-content p { text-align: center; padding: 0 10px; }
    .about-image { margin-top: 0; }
    .main-about-img { max-width: 360px; }
}

/* Large screens spacing */
@media (min-width: 1400px) {
    .about-hero, .about-values, .about-timeline, .about-team, .about-cta { padding-left: 0; padding-right: 0; }
    .container { max-width: 1200px; }
}

/* Minor RTL fix for lists and cards to always align right */
.value-card, .timeline-card, .craft-card { text-align: right; direction: rtl; }
</style>
@endsection
