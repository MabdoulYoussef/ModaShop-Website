@extends('layouts.shop')

@section('content')

<!-- Page Title Section -->
<div class="page-title-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-title text-center">
                    <h1 class="arabic-text">من نحن</h1>
                    <p class="arabic-text">Moda2Shop — مزيج من الأناقة المغربية والذوق العصري</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- About Story Section -->
<div class="about-story-section">
    <div class="container">
        <div class="row align-items-center">
            <!-- Image -->
            <div class="col-lg-6">
                <div class="story-image-wrapper">
                    <img src="{{ asset('assets/img/products/1758887431_68d67e075c31e.JPG') }}" alt="منتجاتنا المغربية" class="story-image">
                    <div class="image-overlay">
                        <div class="overlay-content">
                            <h4 class="arabic-text">منتجاتنا المغربية</h4>
                            <p class="arabic-text">جودة وأصالة في كل تفصيلة</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Story Content -->
            <div class="col-lg-6">
                <div class="story-content">
                    <div class="section-title">
                        <h2 class="arabic-text">قصتنا</h2>
                        <div class="title-line"></div>
                    </div>

                    <div class="story-text">
                        <p class="arabic-text">بدأت الرحلة بشغف صغير وطموح كبير: أن نقدّم ملابسًا عربية مُصمّمة بعناية، تُحترم فيها الحِرفة وتُبرز الأصالة. نعمل مع مُصنّعات محليّات ونختار الخامات بعناية لنقدّم قطعًا تناسب الاحتياجات اليومية والمناسبات الخاصة.</p>

                        <p class="arabic-text">نؤمن أن الموضة وسيلة للتعبير عن الذات — لذلك نحافظ على توازن بين الراحة، الجودة والتصميم. هدفنا هو أن يشعر كل زبون أنه يرتدي قطعة مصممة له بعناية.</p>
                    </div>

                    <div class="story-stats">
                        <div class="row">
                            <div class="col-4">
                                <div class="stat-item">
                                    <h3 class="arabic-text">5+</h3>
                                    <p class="arabic-text">سنوات خبرة</p>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="stat-item">
                                    <h3 class="arabic-text">4000+</h3>
                                    <p class="arabic-text">عميل سعيد</p>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="stat-item">
                                    <h3 class="arabic-text">50+</h3>
                                    <p class="arabic-text">منتج فريد</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="story-cta">
                        <a href="{{ route('products.index') }}" class="btn btn-primary arabic-text">
                            <i class="fas fa-shopping-bag"></i>
                            تصفح منتجاتنا
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Mission & Values Section -->
<div class="mission-values-section">
    <div class="container">
        <div class="section-header text-center">
            <h2 class="arabic-text">مهمتنا وقيمنا</h2>
            <div class="title-line"></div>
            <p class="arabic-text">نحن ملتزمون بتقديم أفضل تجربة تسوق مع الحفاظ على قيمنا الأساسية</p>
        </div>

        <div class="row g-4">
            <!-- Mission -->
            <div class="col-lg-6">
                <div class="mission-card">
                    <div class="card-icon">
                        <i class="fas fa-bullseye"></i>
                    </div>
                    <div class="card-content">
                        <h3 class="arabic-text">مهمتنا</h3>
                        <p class="arabic-text">نقدّم ملابسًا تحمل طابعًا مغربيًا مع تصميم عصري ملموس، مع الاهتمام بالجودة والاستدامة ودعم الصناعة المحليّة.</p>

                        <!-- Mission Features -->
                        <div class="mission-features">
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-palette"></i>
                                </div>
                                <div class="feature-text">
                                    <h5 class="arabic-text">تصميم فريد</h5>
                                    <p class="arabic-text">مزيج من التراث المغربي والحداثة</p>
                                </div>
                            </div>

                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-leaf"></i>
                                </div>
                                <div class="feature-text">
                                    <h5 class="arabic-text">استدامة بيئية</h5>
                                    <p class="arabic-text">خامات صديقة للبيئة</p>
                                </div>
                            </div>

                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="feature-text">
                                    <h5 class="arabic-text">دعم المجتمع</h5>
                                    <p class="arabic-text">تعاون مع الحرفيات المحليات</p>
                                </div>
                            </div>
                        </div>

                        <!-- Mission Quote -->
                        <div class="mission-quote">
                            <blockquote class="arabic-text">
                                "نؤمن بأن الجمال الحقيقي يكمن في الأصالة والجودة"
                            </blockquote>
                            <cite class="arabic-text">— فريق Moda2Shop</cite>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Values -->
            <div class="col-lg-6">
                <div class="values-card">
                    <div class="card-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <div class="card-content">
                        <h3 class="arabic-text">قيمنا</h3>
                        <div class="values-list">
                            <div class="value-item">
                                <i class="fas fa-star"></i>
                                <div class="value-text">
                                    <strong class="arabic-text">الجودة</strong>
                                    <span class="arabic-text">اختيار خامات مدروسة ومراعاة تفاصيل الخياطة</span>
                                </div>
                            </div>
                            <div class="value-item">
                                <i class="fas fa-hands"></i>
                                <div class="value-text">
                                    <strong class="arabic-text">الحرفية</strong>
                                    <span class="arabic-text">دعم منتجين محليين والحفاظ على حرف تقليدية</span>
                                </div>
                            </div>
                            <div class="value-item">
                                <i class="fas fa-leaf"></i>
                                <div class="value-text">
                                    <strong class="arabic-text">المسؤولية</strong>
                                    <span class="arabic-text">تصميم مستدام وتقليل الهدر حيثما أمكن</span>
                                </div>
                            </div>
                            <div class="value-item">
                                <i class="fas fa-handshake"></i>
                                <div class="value-text">
                                    <strong class="arabic-text">الاحترام</strong>
                                    <span class="arabic-text">خدمة زبون محترمة وسريعة وتجربة شراء شفافة</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Timeline Section -->
<div class="timeline-section">
    <div class="container">
        <div class="section-header text-center">
            <h2 class="arabic-text">رحلة التطوير</h2>
            <div class="title-line"></div>
            <p class="arabic-text">محطات مهمة في مسيرتنا نحو التميز</p>
        </div>

        <div class="timeline-wrapper">
            <div class="timeline-line"></div>
            <div class="row">
                <div class="col-md-4">
                    <div class="timeline-item">
                        <div class="timeline-year">2018</div>
                        <div class="timeline-content">
                            <h4 class="arabic-text">البداية</h4>
                            <p class="arabic-text">الدراسة والبحث في عالم الأزياء، وتبلور فكرة مشروع يربط التراث بالتصميم المعاصر.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="timeline-item">
                        <div class="timeline-year">2019</div>
                        <div class="timeline-content">
                            <h4 class="arabic-text">التأسيس</h4>
                            <p class="arabic-text">تأسيس العلامة وتعاون مع حرفيات محليّات؛ إطلاق أول مجموعة حصرية محلية.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="timeline-item">
                        <div class="timeline-year">اليوم</div>
                        <div class="timeline-content">
                            <h4 class="arabic-text">النمو</h4>
                            <p class="arabic-text">توسّع متواصل في التشكيلة، تركيز على الجودة، وتجربة شراء إلكترونية مُحسّنة للزبائن.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Craftsmanship Section -->
<div class="craftsmanship-section">
    <div class="container">
        <div class="section-header text-center">
            <h2 class="arabic-text">الحرفية والجودة</h2>
            <div class="title-line"></div>
            <p class="arabic-text">نلتزم بأعلى معايير الجودة والحرفية في كل منتج</p>
        </div>

        <div class="row g-4">
            <div class="col-lg-6">
                <div class="craft-card">
                    <div class="craft-icon">
                        <i class="fas fa-tools"></i>
                    </div>
                    <div class="craft-content">
                        <h3 class="arabic-text">الحِرفة أولًا</h3>
                        <p class="arabic-text">نعمل مع حرفيات محلية، ونُعطي كل منتج وقتًا كافيًا لإتقان التفاصيل. كل قطعة تُراجع يدويًا قبل التعبئة.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="craft-card">
                    <div class="craft-icon">
                        <i class="fas fa-recycle"></i>
                    </div>
                    <div class="craft-content">
                        <h3 class="arabic-text">التزام بالاستدامة</h3>
                        <p class="arabic-text">نحاول اختيار خامات أقل ضررًا وتقليل استخدام المواد التي تُسبب هدرًا زائدًا، ونبحث دائمًا عن حلول عملية لتخفيض البصمة البيئية.</p>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>

<!-- CTA Section -->
<div class="about-cta-section">
    <div class="container">
        <div class="cta-content text-center">
            <h2 class="arabic-text">هل أنت جاهز لاكتشاف المجموعات؟</h2>
            <p class="arabic-text">استكشف مجموعتنا المتنوعة من المنتجات المغربية الأصيلة</p>
            <a href="{{ route('products.index') }}" class="btn btn-light btn-lg arabic-text cta-btn-special">
                <i class="fas fa-shopping-bag"></i>
                تصفح المجموعات الآن
            </a>
        </div>
    </div>
</div>

@endsection

@section('styles')
<style>
/* === Premium About Page Styles - Enhanced === */

/* Smooth Scroll */
html {
    scroll-behavior: smooth;
}

/* Page Title Section - Enhanced */
.page-title-section {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%) !important;
    padding: 80px 0 60px 0 !important;
    margin-bottom: 0 !important;
    position: relative;
    overflow: hidden;
}

.page-title-section::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(206, 181, 127, 0.1) 0%, transparent 70%);
    animation: float 20s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translate(0, 0) rotate(0deg); }
    50% { transform: translate(30px, -30px) rotate(180deg); }
}

.page-title {
    position: relative;
    z-index: 2;
}

.page-title h1 {
    font-size: 3.5rem !important;
    font-weight: 800 !important;
    color: #2c3e50 !important;
    margin-bottom: 15px !important;
    text-shadow: 0 2px 10px rgba(0,0,0,0.1) !important;
    background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    animation: fadeInUp 0.8s ease-out;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.page-title p {
    font-size: 1.2rem !important;
    color: #6c757d !important;
    margin-bottom: 0 !important;
}

/* About Story Section */
.about-story-section {
    padding: 80px 0 !important;
    background: #ffffff !important;
}

.story-image-wrapper {
    position: relative;
    border-radius: 25px;
    overflow: hidden;
    box-shadow: 0 25px 50px rgba(0,0,0,0.15);
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    transform-style: preserve-3d;
}

.story-image-wrapper::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(206, 181, 127, 0.1) 0%, transparent 100%);
    z-index: 1;
    opacity: 0;
    transition: opacity 0.4s ease;
}

.story-image-wrapper:hover {
    transform: translateY(-10px) scale(1.02);
    box-shadow: 0 35px 70px rgba(0,0,0,0.2);
}

.story-image-wrapper:hover::before {
    opacity: 1;
}

.story-image-wrapper:hover .story-image {
    transform: scale(1.1);
}

.story-image {
    width: 100%;
    height: 500px;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.image-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(transparent, rgba(0,0,0,0.8));
    padding: 30px 20px 20px;
    color: white;
}

.overlay-content h4 {
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 5px;
}

.overlay-content p {
    font-size: 1rem;
    opacity: 0.9;
    margin-bottom: 0;
}

.section-title h2 {
    font-size: 2.5rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 15px;
}

.title-line {
    width: 60px;
    height: 4px;
    background: linear-gradient(45deg, #b08948, #d4af37);
    margin: 0 auto 20px;
    border-radius: 2px;
}

.story-text p {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #555;
    margin-bottom: 20px;
}

.story-stats {
    margin: 40px 0;
    padding: 40px;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    position: relative;
    overflow: hidden;
}

.story-stats::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(206, 181, 127, 0.15) 0%, transparent 70%);
    animation: rotate 20s linear infinite;
}

@keyframes rotate {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

.stat-item {
    text-align: center;
}

.stat-item h3 {
    font-size: 2.5rem;
    font-weight: 700;
    color: #b08948;
    margin-bottom: 5px;
}

.stat-item p {
    font-size: 1rem;
    color: #6c757d;
    margin-bottom: 0;
}

.story-cta {
    margin-top: 30px;
}

/* Mission & Values Section */
.mission-values-section {
    padding: 80px 0 !important;
    background: #f8f9fa !important;
}

.section-header h2 {
    font-size: 2.5rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 15px;
}

.section-header .title-line {
    margin: 0 auto 20px;
}

.section-header p {
    font-size: 1.2rem;
    color: #6c757d;
    margin-bottom: 0;
}

.mission-card, .values-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border-radius: 25px;
    padding: 45px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.1), 0 0 0 1px rgba(255,255,255,0.5);
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    height: 100%;
    position: relative;
    overflow: hidden;
}

.mission-card::before, .values-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(206, 181, 127, 0.1), transparent);
    transition: left 0.5s ease;
}

.mission-card:hover::before, .values-card:hover::before {
    left: 100%;
}

.mission-card:hover, .values-card:hover {
    transform: translateY(-10px) scale(1.02);
    box-shadow: 0 30px 60px rgba(0,0,0,0.15), 0 0 0 1px rgba(206, 181, 127, 0.3);
    background: rgba(255, 255, 255, 1);
}

.card-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(45deg, #b08948, #d4af37);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 25px;
}

.card-icon i {
    font-size: 2rem;
    color: white;
}

.card-content h3 {
    font-size: 1.8rem;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 20px;
}

.card-content p {
    font-size: 1.1rem;
    line-height: 1.7;
    color: #555;
    margin-bottom: 25px;
}

/* Mission Features */
.mission-features {
    margin: 25px 0;
    padding: 20px;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 15px;
    border: 1px solid rgba(176, 137, 72, 0.1);
}

.feature-item {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
    padding: 15px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.feature-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}

.feature-item:last-child {
    margin-bottom: 0;
}

.feature-icon {
    width: 50px;
    height: 50px;
    background: linear-gradient(45deg, #b08948, #d4af37);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-left: 15px;
    flex-shrink: 0;
}

.feature-icon i {
    font-size: 1.2rem;
    color: white;
}

.feature-text h5 {
    font-size: 1.1rem;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 5px;
}

.feature-text p {
    font-size: 0.95rem;
    color: #6c757d;
    margin-bottom: 0;
    line-height: 1.4;
}

/* Mission Quote */
.mission-quote {
    margin-top: 25px;
    padding: 20px;
    background: linear-gradient(135deg, #b08948 0%, #d4af37 100%);
    border-radius: 15px;
    position: relative;
    overflow: hidden;
}

.mission-quote::before {
    content: '"';
    position: absolute;
    top: -10px;
    right: 20px;
    font-size: 4rem;
    color: rgba(255, 255, 255, 0.2);
    font-family: serif;
    line-height: 1;
}

.mission-quote blockquote {
    font-size: 1.1rem;
    font-style: italic;
    color: white;
    margin-bottom: 10px;
    line-height: 1.6;
    position: relative;
    z-index: 2;
}

.mission-quote cite {
    font-size: 0.9rem;
    color: rgba(255, 255, 255, 0.8);
    font-style: normal;
    position: relative;
    z-index: 2;
}

.values-list {
    margin-top: 20px;
}

.value-item {
    display: flex;
    align-items: flex-start;
    margin-bottom: 20px;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 10px;
    transition: background 0.3s ease;
}

.value-item:hover {
    background: #e9ecef;
}

.value-item i {
    font-size: 1.2rem;
    color: #b08948;
    margin-left: 15px;
    margin-top: 5px;
}

.value-text {
    flex: 1;
}

.value-text strong {
    display: block;
    font-size: 1.1rem;
    color: #2c3e50;
    margin-bottom: 5px;
}

.value-text span {
    font-size: 1rem;
    color: #6c757d;
    line-height: 1.5;
}

/* Timeline Section */
.timeline-section {
    padding: 80px 0 !important;
    background: #ffffff !important;
}

.timeline-wrapper {
    position: relative;
    margin-top: 50px;
}

.timeline-line {
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, #b08948, #d4af37);
    border-radius: 2px;
    z-index: 1;
}

.timeline-item {
    position: relative;
    z-index: 2;
    text-align: center;
}

.timeline-year {
    width: 80px;
    height: 80px;
    background: linear-gradient(45deg, #b08948, #d4af37);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    font-weight: 700;
    margin: 0 auto 20px;
    box-shadow: 0 10px 25px rgba(176,137,72,0.3);
}

.timeline-content {
    background: rgba(255, 255, 255, 0.98);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    padding: 35px 25px;
    border-radius: 20px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.12), 0 0 0 1px rgba(206, 181, 127, 0.1);
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    position: relative;
    overflow: hidden;
}

.timeline-content::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    background: linear-gradient(135deg, #b08948, #d4af37);
    transform: scaleY(0);
    transform-origin: top;
    transition: transform 0.4s ease;
}

.timeline-content:hover::before {
    transform: scaleY(1);
}

.timeline-content:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 25px 50px rgba(0,0,0,0.18), 0 0 0 1px rgba(206, 181, 127, 0.2);
}

.timeline-content h4 {
    font-size: 1.5rem;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 15px;
}

.timeline-content p {
    font-size: 1rem;
    line-height: 1.6;
    color: #555;
    margin-bottom: 0;
}

/* Craftsmanship Section */
.craftsmanship-section {
    padding: 80px 0 !important;
    background: #f8f9fa !important;
}

.craft-card {
    background: #ffffff;
    border-radius: 20px;
    padding: 40px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.08);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    height: 100%;
}

.craft-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 25px 50px rgba(0,0,0,0.15);
}

.craft-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(45deg, #b08948, #d4af37);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 25px;
}

.craft-icon i {
    font-size: 2rem;
    color: white;
}

.craft-content h3 {
    font-size: 1.8rem;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 20px;
}

.craft-content p {
    font-size: 1.1rem;
    line-height: 1.7;
    color: #555;
    margin-bottom: 0;
}

.craft-gallery {
    margin-top: 50px;
}

.gallery-item {
    position: relative;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}

.gallery-item:hover {
    transform: translateY(-5px);
}

.gallery-image {
    width: 100%;
    height: 250px;
    object-fit: cover;
    transition: transform 0.3s ease;
}



/* CTA Section */
.about-cta-section {
    padding: 80px 0 !important;
    background: linear-gradient(135deg, #e9d9ad 0%, #c4b161 100%) !important;
    color: white !important;
    position: relative !important;
    overflow: hidden !important;
    border-radius: 30px !important;
}

.about-cta-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="50" cy="10" r="0.5" fill="rgba(255,255,255,0.05)"/><circle cx="10" cy="60" r="0.5" fill="rgba(255,255,255,0.05)"/><circle cx="90" cy="40" r="0.5" fill="rgba(255,255,255,0.05)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>') !important;
    opacity: 0.3 !important;
}

.cta-content {
    position: relative !important;
    z-index: 2 !important;
}

.cta-content h2 {
    font-size: 2.8rem !important;
    font-weight: 800 !important;
    margin-bottom: 20px !important;
    color: rgba(255, 255, 255, 0.95) !important;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2) !important;
    animation: fadeInUp 0.8s ease-out 0.2s both;
}

.cta-content p {
    font-size: 1.3rem !important;
    margin-bottom: 35px !important;
    opacity: 0.95 !important;
    text-shadow: 0 1px 3px rgba(0, 0, 0, 0.2) !important;
    color: rgba(255, 255, 255, 0.9) !important;
    animation: fadeInUp 0.8s ease-out 0.4s both;
}

/* Buttons - Enhanced */
.btn-primary {
    background: linear-gradient(135deg, #b08948 0%, #d4af37 50%, #ceb57f 100%) !important;
    background-size: 200% 200% !important;
    border: none !important;
    padding: 16px 35px !important;
    border-radius: 50px !important;
    font-weight: 700 !important;
    font-size: 1.15rem !important;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275) !important;
    box-shadow: 0 12px 30px rgba(176,137,72,0.35), 0 0 0 0 rgba(176,137,72,0.5) !important;
    position: relative;
    overflow: hidden;
    animation: fadeInUp 0.8s ease-out 0.6s both;
}

.btn-primary::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.3);
    transform: translate(-50%, -50%);
    transition: width 0.6s ease, height 0.6s ease;
}

.btn-primary:hover::before {
    width: 300px;
    height: 300px;
}

.btn-primary:hover {
    transform: translateY(-5px) scale(1.05);
    box-shadow: 0 20px 40px rgba(176,137,72,0.5), 0 0 0 8px rgba(176,137,72,0.1);
    background-position: 100% 0;
}

.btn-lg {
    padding: 18px 40px !important;
    font-size: 1.2rem !important;
}

.cta-btn-special {
    background: rgba(255, 255, 255, 0.98) !important;
    color: #8b6f3f !important;
    border: 3px solid rgba(255, 255, 255, 0.9) !important;
    font-weight: 800 !important;
    text-shadow: none !important;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25), 0 0 0 0 rgba(255, 255, 255, 0.5) !important;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275) !important;
    border-radius: 35px !important;
    position: relative;
    overflow: hidden;
    animation: fadeInUp 0.8s ease-out 0.8s both, pulse 2s ease-in-out infinite;
}

.cta-btn-special::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(206, 181, 127, 0.2), transparent);
    transition: left 0.5s ease;
}

.cta-btn-special:hover::before {
    left: 100%;
}

@keyframes pulse {
    0%, 100% { box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25), 0 0 0 0 rgba(255, 255, 255, 0.5); }
    50% { box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25), 0 0 0 10px rgba(255, 255, 255, 0); }
}

.cta-btn-special:hover {
    background: white !important;
    color: #6b5a3f !important;
    transform: translateY(-5px) scale(1.08) !important;
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.35), 0 0 0 0 rgba(255, 255, 255, 0.5) !important;
    border-color: white !important;
}

/* Responsive Design */
@media (max-width: 991px) {
    .page-title h1 {
        font-size: 2.5rem;
    }

    .section-title h2, .section-header h2 {
        font-size: 2rem;
    }

    .story-image {
        height: 400px;
    }

    .timeline-line {
        display: none;
    }

    .timeline-item {
        margin-bottom: 30px;
    }
}

@media (max-width: 768px) {
    .page-title-section {
        padding: 40px 0;
    }

    .about-story-section, .mission-values-section, .timeline-section, .craftsmanship-section, .about-cta-section {
        padding: 60px 0;
    }

    .page-title h1 {
        font-size: 2rem;
    }

    .section-title h2, .section-header h2 {
        font-size: 1.8rem;
    }

    .story-image {
        height: 300px;
    }

    .mission-card, .values-card, .craft-card {
        padding: 30px 20px;
        margin-bottom: 30px;
    }

    .stat-item h3 {
        font-size: 2rem;
    }
}

@media (max-width: 480px) {
    .page-title h1 {
        font-size: 1.8rem;
    }

    .section-title h2, .section-header h2 {
        font-size: 1.6rem;
    }

    .card-icon, .craft-icon {
        width: 60px;
        height: 60px;
    }

    .card-icon i, .craft-icon i {
        font-size: 1.5rem;
    }

    .timeline-year {
        width: 60px;
        height: 60px;
        font-size: 1rem;
    }

    .gallery-image {
        height: 200px;
    }
}

/* RTL Support */
.arabic-text {
    direction: rtl;
    text-align: right;
}

.section-header .title-line {
    margin: 0 auto 20px;
}

@media (max-width: 768px) {
    .arabic-text {
        text-align: center;
    }
}

/* Scroll Animations */
@keyframes slideInLeft {
    from {
        opacity: 0;
        transform: translateX(-50px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes slideInRight {
    from {
        opacity: 0;
        transform: translateX(50px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

/* Enhanced Stat Items */
.stat-item {
    position: relative;
    z-index: 2;
    padding: 20px;
    transition: transform 0.3s ease;
}

.stat-item:hover {
    transform: translateY(-5px);
}

.stat-item h3 {
    font-size: 3rem !important;
    background: linear-gradient(135deg, #b08948 0%, #d4af37 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    animation: countUp 2s ease-out;
}

@keyframes countUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Enhanced Feature Items */
.feature-item {
    animation: slideInRight 0.6s ease-out both;
}

.feature-item:nth-child(1) { animation-delay: 0.1s; }
.feature-item:nth-child(2) { animation-delay: 0.2s; }
.feature-item:nth-child(3) { animation-delay: 0.3s; }

/* Enhanced Value Items */
.value-item {
    animation: slideInLeft 0.6s ease-out both;
}

.value-item:nth-child(1) { animation-delay: 0.1s; }
.value-item:nth-child(2) { animation-delay: 0.2s; }
.value-item:nth-child(3) { animation-delay: 0.3s; }
.value-item:nth-child(4) { animation-delay: 0.4s; }

/* Enhanced Timeline Items */
.timeline-item {
    animation: fadeInUp 0.8s ease-out both;
}

.timeline-item:nth-child(1) { animation-delay: 0.1s; }
.timeline-item:nth-child(2) { animation-delay: 0.3s; }
.timeline-item:nth-child(3) { animation-delay: 0.5s; }

/* Enhanced Craft Cards */
.craft-card {
    animation: fadeInUp 0.8s ease-out both;
}

.craft-card:nth-child(1) { animation-delay: 0.2s; }
.craft-card:nth-child(2) { animation-delay: 0.4s; }

/* Section Fade In */
.about-story-section,
.mission-values-section,
.timeline-section,
.craftsmanship-section {
    animation: fadeIn 1s ease-out;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

/* Enhanced Image Overlay */
.image-overlay {
    animation: fadeInUp 0.8s ease-out 0.5s both;
}

/* Smooth Hover Effects for Icons */
.card-icon, .craft-icon {
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.card-icon:hover, .craft-icon:hover {
    transform: rotate(360deg) scale(1.1);
    box-shadow: 0 15px 35px rgba(176, 137, 72, 0.4);
}

/* Enhanced Timeline Year */
.timeline-year {
    transition: all 0.4s ease;
    animation: pulse 3s ease-in-out infinite;
}

.timeline-year:hover {
    transform: scale(1.15) rotate(360deg);
    box-shadow: 0 15px 40px rgba(176, 137, 72, 0.5);
}

/* Loading States */
.story-image {
    opacity: 0;
    animation: fadeIn 1s ease-out 0.3s forwards;
}

/* Enhanced Mission Quote */
.mission-quote {
    animation: fadeInUp 0.8s ease-out 0.6s both;
    position: relative;
}

.mission-quote::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.5), transparent);
    animation: shimmer 2s ease-in-out infinite;
}

@keyframes shimmer {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
}

/* Performance Optimizations */
.story-image-wrapper,
.mission-card,
.values-card,
.timeline-content,
.craft-card {
    will-change: transform;
}

/* Print Styles */
@media print {
    .page-title-section::before,
    .story-stats::before,
    .mission-card::before,
    .values-card::before {
        display: none;
    }
}
</style>
@endsection
