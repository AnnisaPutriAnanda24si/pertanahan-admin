                <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
                    <div class="container-fluid">
                        <nav
                            class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
                             <img src="https://www.henkel-gcc.com/resource/image/32556/1x1/1000/1000/64143212d44e70e6c927885764745c24/30FAE5974EBEDC298CD595B173662700/persil-logo.webp"
                            alt="navbar brand" class="navbar-brand" height="80" />
                            {{-- <div class="input-group">
                                <div class="input-group-prepend">
                                    <button type="submit" class="btn btn-search pe-1">
                                        <i class="fa fa-search search-icon"></i>
                                    </button>
                                </div>
                                <input type="text" placeholder="Search ..." class="form-control" />
                            </div> --}}
                        </nav>

                        <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                            {{-- <li class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none">
                                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#"
                                    role="button" aria-expanded="false" aria-haspopup="true">
                                    <i class="fa fa-search"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-search animated fadeIn">
                                    <form class="navbar-left navbar-form nav-search">
                                        <div class="input-group">
                                            <input type="text" placeholder="Search ..." class="form-control" />
                                        </div>
                                    </form>
                                </ul>
                            </li>
                            <li class="nav-item topbar-icon dropdown hidden-caret">
                                <a class="nav-link dropdown-toggle" href="#" id="messageDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-envelope"></i>
                                </a>
                                <ul class="dropdown-menu messages-notif-box animated fadeIn"
                                    aria-labelledby="messageDropdown">
                                    <li>
                                        <div class="dropdown-title d-flex justify-content-between align-items-center">
                                            Messages
                                            <a href="#" class="small">Mark all as read</a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="message-notif-scroll scrollbar-outer">
                                            <div class="notif-center">
                                                <a href="#">
                                                    <div class="notif-img">
                                                        <img src="{{ asset('assets') }}/img/jm_denis.jpg"
                                                            alt="Img Profile" />
                                                    </div>
                                                    <div class="notif-content">
                                                        <span class="subject">Jimmy Denis</span>
                                                        <span class="block"> How are you ? </span>
                                                        <span class="time">5 minutes ago</span>
                                                    </div>
                                                </a>
                                                <a href="#">
                                                    <div class="notif-img">
                                                        <img src="{{ asset('assets') }}/img/chadengle.jpg"
                                                            alt="Img Profile" />
                                                    </div>
                                                    <div class="notif-content">
                                                        <span class="subject">Chad</span>
                                                        <span class="block"> Ok, Thanks ! </span>
                                                        <span class="time">12 minutes ago</span>
                                                    </div>
                                                </a>
                                                <a href="#">
                                                    <div class="notif-img">
                                                        <img src="{{ asset('assets') }}/img/mlane.jpg"
                                                            alt="Img Profile" />
                                                    </div>
                                                    <div class="notif-content">
                                                        <span class="subject">Jhon Doe</span>
                                                        <span class="block">
                                                            Ready for the meeting today...
                                                        </span>
                                                        <span class="time">12 minutes ago</span>
                                                    </div>
                                                </a>
                                                <a href="#">
                                                    <div class="notif-img">
                                                        <img src="{{ asset('assets') }}/img/talha.jpg"
                                                            alt="Img Profile" />
                                                    </div>
                                                    <div class="notif-content">
                                                        <span class="subject">Talha</span>
                                                        <span class="block"> Hi, Apa Kabar ? </span>
                                                        <span class="time">17 minutes ago</span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="see-all" href="javascript:void(0);">See all messages<i
                                                class="fa fa-angle-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item topbar-icon dropdown hidden-caret">
                                <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-bell"></i>
                                    <span class="notification">4</span>
                                </a>
                                <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
                                    <li>
                                        <div class="dropdown-title">
                                            You have 4 new notification
                                        </div>
                                    </li>
                                    <li>
                                        <div class="notif-scroll scrollbar-outer">
                                            <div class="notif-center">
                                                <a href="#">
                                                    <div class="notif-icon notif-primary">
                                                        <i class="fa fa-user-plus"></i>
                                                    </div>
                                                    <div class="notif-content">
                                                        <span class="block"> New user registered </span>
                                                        <span class="time">5 minutes ago</span>
                                                    </div>
                                                </a>
                                                <a href="#">
                                                    <div class="notif-icon notif-success">
                                                        <i class="fa fa-comment"></i>
                                                    </div>
                                                    <div class="notif-content">
                                                        <span class="block">
                                                            Rahmad commented on Admin
                                                        </span>
                                                        <span class="time">12 minutes ago</span>
                                                    </div>
                                                </a>
                                                <a href="#">
                                                    <div class="notif-img">
                                                        <img src="{{ asset('assets') }}/img/profile2.jpg"
                                                            alt="Img Profile" />
                                                    </div>
                                                    <div class="notif-content">
                                                        <span class="block">
                                                            Reza send messages to you
                                                        </span>
                                                        <span class="time">12 minutes ago</span>
                                                    </div>
                                                </a>
                                                <a href="#">
                                                    <div class="notif-icon notif-danger">
                                                        <i class="fa fa-heart"></i>
                                                    </div>
                                                    <div class="notif-content">
                                                        <span class="block"> Farrah liked Admin </span>
                                                        <span class="time">17 minutes ago</span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="see-all" href="javascript:void(0);">See all notifications<i
                                                class="fa fa-angle-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item topbar-icon dropdown hidden-caret">
                                <a class="nav-link" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                                    <i class="fas fa-layer-group"></i>
                                </a>
                                <div class="dropdown-menu quick-actions animated fadeIn">
                                    <div class="quick-actions-header">
                                        <span class="title mb-1">Quick Actions</span>
                                        <span class="subtitle op-7">Shortcuts</span>
                                    </div>
                                    <div class="quick-actions-scroll scrollbar-outer">
                                        <div class="quick-actions-items">
                                            <div class="row m-0">
                                                <a class="col-6 col-md-4 p-0" href="#">
                                                    <div class="quick-actions-item">
                                                        <div class="avatar-item bg-danger rounded-circle">
                                                            <i class="far fa-calendar-alt"></i>
                                                        </div>
                                                        <span class="text">Calendar</span>
                                                    </div>
                                                </a>
                                                <a class="col-6 col-md-4 p-0" href="#">
                                                    <div class="quick-actions-item">
                                                        <div class="avatar-item bg-warning rounded-circle">
                                                            <i class="fas fa-map"></i>
                                                        </div>
                                                        <span class="text">Maps</span>
                                                    </div>
                                                </a>
                                                <a class="col-6 col-md-4 p-0" href="#">
                                                    <div class="quick-actions-item">
                                                        <div class="avatar-item bg-info rounded-circle">
                                                            <i class="fas fa-file-excel"></i>
                                                        </div>
                                                        <span class="text">Reports</span>
                                                    </div>
                                                </a>
                                                <a class="col-6 col-md-4 p-0" href="#">
                                                    <div class="quick-actions-item">
                                                        <div class="avatar-item bg-success rounded-circle">
                                                            <i class="fas fa-envelope"></i>
                                                        </div>
                                                        <span class="text">Emails</span>
                                                    </div>
                                                </a>
                                                <a class="col-6 col-md-4 p-0" href="#">
                                                    <div class="quick-actions-item">
                                                        <div class="avatar-item bg-primary rounded-circle">
                                                            <i class="fas fa-file-invoice-dollar"></i>
                                                        </div>
                                                        <span class="text">Invoice</span>
                                                    </div>
                                                </a>
                                                <a class="col-6 col-md-4 p-0" href="#">
                                                    <div class="quick-actions-item">
                                                        <div class="avatar-item bg-secondary rounded-circle">
                                                            <i class="fas fa-credit-card"></i>
                                                        </div>
                                                        <span class="text">Payments</span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li> --}}

                            <li class="nav-item topbar-user dropdown hidden-caret">
                                <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#"
                                    aria-expanded="false">
                                    <div class="avatar-sm">
                                        {{-- <img src="{{ asset('assets') }}/img/profile.jpg" alt="..."
                                            class="avatar-img rounded-circle" /> --}}
                                              <img src="data:image/jpeg;base64,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" alt="..."
                                            class="avatar-img rounded-circle" />
                                    </div>
                                    <span class="profile-username">
                                        <span class="op-7">Hi,</span>
                                        <span class="fw-bold">Admin</span>
                                    </span>
                                </a>
                                <ul class="dropdown-menu dropdown-user animated fadeIn">
                                    <div class="dropdown-user-scroll scrollbar-outer">
                                        <li>
                                            <div class="user-box">
                                                <div class="avatar-lg">
                                                    <img src="{{ asset('assets') }}/img/profile.jpg"
                                                        alt="image profile" class="avatar-img rounded" />
                                                </div>
                                                <div class="u-text">
                                                    <h4>Hizrian</h4>
                                                    <p class="text-muted">hello@example.com</p>
                                                    <a href="profile.html"
                                                        class="btn btn-xs btn-secondary btn-sm">View Profile</a>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">My Profile</a>
                                            <a class="dropdown-item" href="#">My Balance</a>
                                            <a class="dropdown-item" href="#">Inbox</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Account Setting</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="{{route('login')}}">Logout</a>
                                        </li>
                                    </div>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
