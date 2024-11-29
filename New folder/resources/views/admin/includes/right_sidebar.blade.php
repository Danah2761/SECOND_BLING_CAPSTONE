<aside id="rightsidebar" class="right-sidebar">
    <ul class="nav nav-tabs tab-nav-right" role="tablist">
        <li role="presentation" class="active"><a href="#settings" data-toggle="tab">SETTINGS</a></li>
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active" id="settings">
            <div class="demo-settings">
                <p>ACCOUNT SETTINGS</p>
                <ul class="setting-list">
                    @auth('admin')
                    <li>
                        <a class="d-flex align-center" href="{{ route('admin.profile.show') }}">
                            <span class="icon"><i class="material-icons">person</i></span>
                            <span>My Profile</span>
                        </a>
                    </li>
                    <li>
                        <a class="d-flex align-center" href="{{ route('admin.logout') }}"
                           onclick="confirmActionLogout('Are You Sure Want To Logout?', 'logout-form')">
                            <span class="icon"><i class="material-icons">input</i></span>
                            <span>Logout</span>
                        </a>
                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                    @endauth
                        @auth('authen')
                            <li>
                                <a class="d-flex align-center" href="{{ route('admin.authen.show') }}">
                                    <span class="icon"><i class="material-icons">person</i></span>
                                    <span>My Profile</span>
                                </a>
                            </li>
                            <li>
                                <a class="d-flex align-center" href="{{ route('admin.logout') }}"
                                   onclick="confirmActionLogout('Are You Sure Want To Logout?', 'logout-form')">
                                    <span class="icon"><i class="material-icons">input</i></span>
                                    <span>Logout</span>
                                </a>
                                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        @endauth

                        @auth('seller')
                            <li>
                                <a class="d-flex align-center" href="{{ route('seller.profile.show') }}">
                                    <span class="icon"><i class="material-icons">person</i></span>
                                    <span>My Profile</span>
                                </a>
                            </li>
                            <li>
                                <a class="d-flex align-center" href="#"
                                   onclick="confirmActionLogout('Are You Sure Want To Logout?', 'logout-form')">
                                    <span class="icon"><i class="material-icons">input</i></span>
                                    <span>Logout</span>
                                </a>
                                <form id="logout-form" action="{{ route('seller.logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        @endauth
                </ul>
            </div>
        </div>
    </div>
</aside>
