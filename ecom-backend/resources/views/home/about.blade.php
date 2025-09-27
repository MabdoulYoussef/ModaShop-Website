@extends('layouts.master')

@section('content')
    <!-- hero area -->
    <div class="hero-area hero-bg">
        <div class="container">
            <div class="row align-items-center">
                <!-- Text -->
                <div class="col-lg-6">
                    <div class="aboutus-text">
                        <h1 class="about-title">من نحن</h1>
                        <div class="about-content">
                            <p class="about-paragraph">منذ سنوات، كان حلمي الأكبر أن أصبح أستاذًا في الجامعة، أعيش بين قاعات المحاضرات وأشارك المعرفة مع الآخرين. لكن مع مرور الوقت، اكتشفت أن بداخلي شغفًا مختلفًا، شغفًا يدفعني إلى الإبداع وإلى بناء شيء يعكس هويتي وثقافتي المغربية.</p>

                            <p class="about-paragraph">في عام 2018، بدأت مساري الأكاديمي بدراسة عالم الأزياء والاقتصاد، وكان ذلك الباب الذي فتح أمامي أفقًا جديدًا. لم تكن الدراسة مجرد واجب، بل كانت وسيلتي لفهم كيف يمكن للشغف أن يتحوّل إلى مشروع حيّ.</p>

                            <p class="about-paragraph">وفي عام 2019، جاءت الخطوة الحاسمة: ولادة Moda2Shop، علامة مغربية خالصة، تحمل في طياتها هوية بلدي، وتطمح لأن تنافس عالميًا. كانت تلك البداية بمثابة مخاطرة، لكنها في الحقيقة كانت الشرارة الأولى لحلمٍ أكبر.</p>

                            <p class="about-paragraph">اليوم لم يعد النجاح الشخصي غايتي الوحيدة، بل أحمل رسالة أسمى: أن أثبت أنّ الشغف إذا امتزج بالعمل الجاد قادر على تحويل الحلم إلى حقيقة، وأن الهوية المغربية جديرة بأن تتجلّى في أبهى صورها عبر الموضة والإبداع.</p>
                        </div>
                    </div>
                </div>

                <!-- Image -->
                <div class="col-lg-6">
                    <div class="about-image-container">
                        <div class="main-image-wrapper">
                            <img src="/assets/img/products/1758887431_68d67e075c31e.JPG" alt="منتجاتنا المغربية" class="main-about-image" style="width: 340px !important; height: 600px !important; object-fit: cover !important; border-radius: 15px !important; margin-top: 30px !important;">
                            <div class="image-overlay">
                                <div class="overlay-content">
                                    <h3>منتجاتنا المغربية</h3>
                                    <p>جودة عالية وأصالة مغربية</p>
                                </div>
                            </div>
                        </div>
                        <div class="image-decoration">
                            <div class="decoration-circle circle-1"></div>
                            <div class="decoration-circle circle-2"></div>
                            <div class="decoration-circle circle-3"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end hero area -->
@endsection

@section('styles')
<style>
.aboutus-text {
    padding: 2rem 0;
}

.about-title {
    font-size: 3.5rem;
    font-weight: bold;
    color: #2c3e50;
    margin-bottom: 2rem;
    text-align: center;
    position: relative;
}

.about-title::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 4px;
    background: linear-gradient(45deg, #ceb57f, #ad8f53);
    border-radius: 2px;
}

.about-content {
    padding: 1rem 0;
}

.about-paragraph {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #555;
    margin-bottom: 1.5rem;
    text-align: justify;
    padding: 0 1rem;
}

.about-image-container {
    position: relative;
    padding: 2rem;
    display: flex;
    justify-content: center;
    align-items: center;
}

.main-image-wrapper {
    position: relative;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
    width: 80px;
    height: 200px;
    margin: 0 auto;
}

.main-image-wrapper:hover {
    transform: translateY(-10px);
}

.main-about-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.image-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, rgba(206, 181, 127, 0.8), rgba(173, 143, 83, 0.8));
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.main-image-wrapper:hover .image-overlay {
    opacity: 1;
}

.overlay-content {
    text-align: center;
    color: white;
    padding: 2rem;
}

.overlay-content h3 {
    font-size: 2rem;
    font-weight: bold;
    margin-bottom: 1rem;
}

.overlay-content p {
    font-size: 1.2rem;
    margin: 0;
}

.image-decoration {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    pointer-events: none;
    z-index: -1;
}

.decoration-circle {
    position: absolute;
    border-radius: 50%;
    background: linear-gradient(45deg, #ceb57f, #ad8f53);
    opacity: 0.1;
    animation: float 6s ease-in-out infinite;
}

.circle-1 {
    width: 100px;
    height: 100px;
    top: 10%;
    left: 10%;
    animation-delay: 0s;
}

.circle-2 {
    width: 150px;
    height: 150px;
    top: 60%;
    right: 10%;
    animation-delay: 2s;
}

.circle-3 {
    width: 80px;
    height: 80px;
    bottom: 20%;
    left: 20%;
    animation-delay: 4s;
}

@keyframes float {
    0%, 100% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-20px);
    }
}

/* Responsive Design */
@media (max-width: 768px) {
    .about-title {
        font-size: 2.5rem;
    }

    .about-paragraph {
        font-size: 1rem;
        padding: 0;
    }

    .main-about-image {
        height: 300px;
    }

    .about-image-container {
        padding: 1rem;
    }

    .overlay-content h3 {
        font-size: 1.5rem;
    }

    .overlay-content p {
        font-size: 1rem;
    }
}

@media (max-width: 576px) {
    .about-title {
        font-size: 2rem;
    }

    .main-about-image {
        height: 250px;
    }

    .decoration-circle {
        display: none;
    }
}
</style>
@endsection
