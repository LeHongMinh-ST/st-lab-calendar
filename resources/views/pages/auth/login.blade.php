<x-auth-layout>
    <div class="content login-wrapper">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-6">
                        <div class="login-image-wrapper">
                            <img class="login-image" src="{{asset('assets/images/login.png')}}" alt="login">
                            <div class="line"></div>
                            <div class="login-note text-muted">
                                Lưu ý: Hệ thống quản lý lịch sử dụng phòng máy dành cho cán bộ, sinh viên, người phụ trách các nhóm sử dụng
                                vậy nếu bạn chưa có tài khoản xin vui lòng liên hệ với quản lý phòng lab hoặc cán bộ quản lý hệ thống
                                để thiết lập tài khoản
                            </div>
                        </div>

                    </div>
                    <div class="col-xl-6 ">
                        <form action="" class="login-form">
                            <div class="text-center mb-3">
                                <div class="d-inline-flex align-items-center justify-content-center mb-4 mt-2">
                                    <img src="{{asset('assets/images/FITA.png')}}" class="h-64px" alt="">
                                    <img src="{{asset('assets/images/logoST.jpg')}}" class="h-64px" alt="">
                                </div>
                                <span class="d-block text-muted">Chào mừng bạn đến với</span>
                                <h5 class="mb-0">Hệ thống quản lý lịch sử dụng phòng lab</h5>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tài khoản/Email</label>
                                <div class="form-control-feedback form-control-feedback-start">
                                    <input type="text" class="form-control" placeholder="john@st.com">
                                    <div class="form-control-feedback-icon">
                                        <i class="ph-user-circle text-muted"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Mật khẩu</label>
                                <div class="form-control-feedback form-control-feedback-start">
                                    <input type="password" class="form-control" placeholder="•••••••••••">
                                    <div class="form-control-feedback-icon">
                                        <i class="ph-lock text-muted"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <label class="form-check">
                                    <input type="checkbox" name="remember" class="form-check-input" checked="">
                                    <span class="form-check-label">Nhớ mật khẩu</span>
                                </label>

                                <a href="login_password_recover.html" class="ms-auto">Quên mật khẩu</a>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
                            </div>
{{--                            <div class="text-center text-muted content-divider mb-3">--}}
{{--                                <span class="px-2">Hoặc đăng nhập với</span>--}}
{{--                            </div>--}}
{{--                            <div class="text-center mb-3">--}}
{{--                                <button type="button" class="btn btn-outline-primary btn-icon rounded-pill border-width-2"><i class="ph-google-logo"></i></button>--}}
{{--                            </div>--}}
{{--                            <div class="text-center text-muted content-divider mb-3">--}}
{{--                                <span class="px-2">Bạn chưa có tài khoản?</span>--}}
{{--                            </div>--}}
{{--                            <div class="mb-3">--}}
{{--                                <a href="#" class="btn btn-light w-100">Đăng ký</a>--}}
{{--                            </div>--}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-auth-layout>
