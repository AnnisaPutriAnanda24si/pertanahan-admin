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
                            <li class="nav-item topbar-user dropdown hidden-caret">
                                <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#"
                                    aria-expanded="false">
                                    <div class="avatar-sm">
                                        @if (Auth::user()->profile_picture)
                                            <img src="{{ Storage::url(Auth::user()->profile_picture) }}" alt="..."
                                                class="avatar-img rounded-circle" />
                                        @else
                                            <div
                                                class="avatar-img rounded-circle bg-secondary d-flex align-items-center justify-content-center">
                                                <i class="fas fa-user text-white"></i>
                                            </div>
                                        @endif

                                    </div>
                                    <span class="profile-username">
                                        <span class="op-7">Hi,</span>
                                        <span class="fw-bold">{{ Auth::user()->name }}</span>
                                    </span>
                                </a>
                                <ul class="dropdown-menu dropdown-user animated fadeIn">
                                    <div class="dropdown-user-scroll scrollbar-outer">
                                        <li>
                                            <div class="user-box">
                                                <div class="avatar-lg">
                                                    @if (Auth::user()->profile_picture)
                                                        <img src="{{ Storage::url(Auth::user()->profile_picture) }}"
                                                            alt="image profile" class="avatar-img rounded" />
                                                    @else
                                                        <div
                                                            class="avatar-img rounded bg-secondary d-flex align-items-center justify-content-center">
                                                            <i class="fas fa-user text-white"></i>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="u-text">
                                                    <h4>{{ Auth::user()->name }}</h4>
                                                    <p class="text-muted">{{ Auth::user()->email }}</p>
                                                    {{-- <a href="profile.html" class="btn btn-xs btn-secondary btn-sm">View
                                                        Profile</a> --}}
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
                                            <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                                        </li>
                                    </div>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
