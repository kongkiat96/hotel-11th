<aside id="layout-menu" class="layout-menu-horizontal menu-horizontal menu bg-menu-theme flex-grow-0">
    <div class="container-xxl d-flex h-100">
        <ul class="menu-inner">
            <li class="menu-item {{ $url[0] == 'home' ? 'active' : '' }}">
                <a href="{{ url('/home') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div data-i18n="หน้าแรก">หน้าแรก</div>
                </a>
            </li>

            <li class="menu-item {{ $url[0] == 'table' ? 'active' : '' }}">
                <a href="{{ url('/table') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div data-i18n="ตารางข้อมูล">ตารางข้อมูล</div>
                </a>
            </li>

            <li class="menu-item {{ $url[0] == 'employee' ? 'active' : '' }}">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class='menu-icon tf-icons bx bxs-user-rectangle'></i>
                    <div data-i18n="ข้อมูลพนักงาน">ข้อมูลพนักงาน</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item {{ @$urlSubLink == 'list-all-employee' ? 'active' : '' }}">
                        <a href="{{ url('employee/list-all-employee') }}" class="menu-link">
                            <i class='menu-icon tf-icons bx bxs-user-detail'></i>
                            <div data-i18n="รายการข้อมูลพนักงาน">รายการข้อมูลพนักงาน</div>
                        </a>
                    </li>
                    <li class="menu-item {{ @$urlSubLink == 'add-employee' ? 'active' : '' }}">
                        <a href="{{ url('employee/add-employee') }}" class="menu-link">
                            <i class='menu-icon tf-icons bx bxs-user-plus'></i>
                            <div data-i18n="เพิ่มข้อมูลพนักงาน">เพิ่มข้อมูลพนักงาน</div>
                        </a>
                    </li>
                    <li class="menu-item {{ @$urlSubLink == 'search-all-employee' ? 'active' : '' }}">
                        <a href="{{ url('employee/search-employee') }}" class="menu-link">
                            <i class='menu-icon tf-icons bx bxs-file-find'></i>
                            <div data-i18n="ค้นหาข้อมูลพนักงาน">ค้นหาข้อมูลพนักงาน</div>
                        </a>
                    </li>
                    {{-- <li class="menu-item {{ @$urlSubLink == 'request-employee' ? 'active' : '' }}">
                        <a href="{{ url('employee/request-employee') }}" class="menu-link">
                            <i class='menu-icon tf-icons bx bxs-user-voice'></i>
                            <div data-i18n="ขอเพิ่มบุคคลากร">ขอเพิ่มบุคคลากร</div>
                        </a>
                    </li> --}}
                </ul>
            </li>

            <li class="menu-item {{ $url[0] == 'settings-system' ? 'active' : '' }}">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bxs-cog"></i>
                    <div data-i18n="ตั้งค่า">ตั้งค่า</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item {{ @$urlSubLink == 'work-status' ? 'active' : '' }}">
                        <a href="{{ url('settings-system/work-status') }}" class="menu-link">
                            <i class='menu-icon tf-icons bx bxs-purchase-tag'></i>
                            <div data-i18n="สถานะงาน">สถานะงาน</div>
                        </a>
                    </li>
                    <li class="menu-item {{ @$urlSubLink == 'menu' ? 'active' : '' }}">
                        <a href="{{ url('settings-system/menu') }}" class="menu-link">
                            <i class='menu-icon tf-icons bx bx-list-ul'></i>
                            <div data-i18n="รายการเข้าถึงเมนู">รายการเข้าถึงเมนู</div>
                        </a>
                    </li>

                    <li class="menu-item {{ @$urlSubLink == 'about-company' ? 'active' : '' }}">
                        <a href="{{ url('settings-system/about-company') }}" class="menu-link">
                            <i class='menu-icon tf-icons bx bx-buildings'></i>
                            <div data-i18n="กำหนดค่าภายในองค์กร">กำหนดค่าภายในองค์กร</div>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="menu-item">
                <a href="{{ url('/logout') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-log-out"></i>
                    <div data-i18n="ออกจากระบบ"></div>
                </a>
            </li>
        </ul>
    </div>
</aside>
