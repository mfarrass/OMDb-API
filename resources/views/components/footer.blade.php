<style>
    .site-footer {
        background: linear-gradient(to top, #000, #111);
        color: #cfcfcf;
        padding: 60px 0 0;
        margin-top: 80px;
    }

    .footer-grid {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        /* gap: 40px; */
    }


    .footer-brand .logo {
        font-size: 1.6rem;
        font-weight: 800;
        display: inline-block;
        margin-bottom: 10px;
    }

    .footer-desc {
        font-size: 0.9rem;
        line-height: 1.6;
        color: #aaa;
    }

    .footer-social {
        text-align: right;
    }


    .footer-links h4,
    .footer-social h4 {
        font-size: 1rem;
        margin-bottom: 15px;
        color: #fff;
    }

    .footer-links a {
        display: block;
        font-size: 0.9rem;
        margin-bottom: 8px;
        color: #aaa;
        transition: 0.3s;
    }

    .footer-links a:hover {
        color: #f5c518;
    }

    .social-icons {
        display: flex;
        gap: 15px;
    }

    .social-icons a {
        font-size: 1.4rem;
        color: #aaa;
        transition: 0.3s;
    }

    .social-icons a:hover {
        color: #f5c518;
    }

    .footer-bottom {
        /* margin-top: 50px; */
        padding: 20px 0;
        text-align: center;
        font-size: 0.85rem;
        background: #000;
        color: #888;
    }

    .footer-bottom a {
        color: #f5c518;
    }

    /* RESPONSIVE */
    @media (max-width: 900px) {
        .footer-grid {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width: 500px) {
        .footer-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<footer class="site-footer">
    <div class="container footer-grid">

        <!-- BRAND -->
        <div class="footer-brand">
            <a href="/" class="logo">
                <i class='bx bxs-camera-movie main-color'></i>
                Article <span class="main-color">F</span>ilm
            </a>
            <p class="footer-desc">
                {{ __('messages.footer_text') }}
            </p>
        </div>

        <!-- SOCIAL -->
        <div class="footer-social">
            <h4>{{ __('messages.social_media') }}</h4>
            <div class="social-icons">
                <a href="https://github.com/mfarrass" target="_blank">
                    <i class='bx bxl-github'></i>
                </a>
                <a href="https://linkedin.com" target="_blank">
                    <i class='bx bxl-linkedin'></i>
                </a>
                <a href="https://instagram.com" target="_blank">
                    <i class='bx bxl-instagram'></i>
                </a>
            </div>
        </div>

    </div>

    <!-- COPYRIGHT -->
    <div class="footer-bottom">
        <a href="https://mfarrass.github.io/" target="_blank">
            ©  Muhamad Farras
        </a>
           - {{ date('Y') }}
    </div>
</footer>
