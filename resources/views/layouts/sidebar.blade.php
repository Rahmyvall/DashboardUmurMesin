  <div class="nk-sidebar">
      <div class="nk-nav-scroll">
          <ul class="metismenu" id="menu">
              <li class="nav-label">Dashboard</li>
              <li>
                  <a class="has-arrow d-flex align-items-center" href="javascript:void(0);" aria-expanded="false">
                      <i class="fa fa-home me-2"></i>
                      <span class="nav-text">Dashboard</span>
                  </a>
                  <ul aria-expanded="false">
                      <li class="nav-item {{ $menuDashboard ?? '' }}">
                          <a class="d-flex align-items-center" href="{{ route('dashboard') }}">
                              <i class="fa-solid fa-chart-line me-2"></i>
                              <span class="nav-text">Overview Mesin</span>
                          </a>
                      </li>
                  </ul>
              </li>
              <li class="nav-label">Apps</li>
              <li>
                  <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                      <i class="icon-user menu-icon"></i>
                      <span class="nav-text">Users</span>
                  </a>
                  <ul aria-expanded="false">
                      <li>
                          <a href="{{ route('user.index') }}">
                              <i class="fa fa-list"></i> Daftar Pengguna
                          </a>
                      </li>

                      <li>
                          <a href="{{ route('user.create') }}">
                              <i class="fa fa-user-plus"></i> Tambah Pengguna
                          </a>
                      </li>
                  </ul>
              </li>
              <li class="nav-label">Sistem Mesin</li>
              <li>
                  <a class="has-arrow d-flex align-items-center" href="javascript:void()" aria-expanded="false">
                      <i class="fa-solid fa-industry me-2"></i>
                      <span class="nav-text">Manajemen Mesin</span>
                  </a>
                  <ul aria-expanded="false">
                      <li>
                          <a href="{{ route('location.index') }}">
                              <i class="fa-solid fa-location-dot me-2"></i> Lokasi / Area Mesin
                          </a>
                      </li>
                      <li>
                          <a href="{{ route('machine.index') }}">
                              <i class="fa-solid fa-gears me-2"></i> Master Data Mesin
                          </a>
                      </li>
                      <li>
                          <a href="{{ route('machine-usage.index') }}">
                              <i class="fa-solid fa-clock me-2"></i> Jam Operasional
                          </a>
                      </li>
                  </ul>
              </li>
              <li class="nav-label">Maintenance</li>
              <li>
                  <a class="has-arrow d-flex align-items-center" href="javascript:void()" aria-expanded="false">
                      <i class="fa-solid fa-screwdriver-wrench me-2"></i>
                      <span class="nav-text">Maintenance Mesin</span>
                  </a>
                  <ul aria-expanded="false">
                      <li>
                          <a href="./maintenance.html">
                              <i class="fa-solid fa-tools me-2"></i> Data Maintenance
                          </a>
                      </li>
                      <li>
                          <a href="./jadwal-maintenance.html">
                              <i class="fa-solid fa-calendar-check me-2"></i> Jadwal Preventive
                          </a>
                      </li>
                      <li>
                          <a href="./alert.html">
                              <i class="fa-solid fa-bell me-2"></i> Alert / Notifikasi
                          </a>
                      </li>
                      <li>
                          <a href="./log-mesin.html">
                              <i class="fa-solid fa-clipboard-list me-2"></i> Log Kondisi Mesin
                          </a>
                      </li>
                  </ul>
              </li>
          </ul>
      </div>
  </div>
