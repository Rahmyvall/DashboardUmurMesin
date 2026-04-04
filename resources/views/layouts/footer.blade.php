 <div class="footer">
     <div class="copyright">
         <p>
             Copyright &copy; {{ date('Y') }}
             <a href="#">Tracking Umur Mesin</a>
         </p>
     </div>
 </div>
 <!--**********************************
            Footer end
        ***********************************-->
 </div>
 <!--**********************************
        Main wrapper end
    ***********************************-->

 <!--**********************************
        Scripts
    ***********************************-->
 <script src="{{ asset('admin/plugins/common/common.min.js') }}"></script>
 <script src="{{ asset('admin/js/custom.min.js') }}"></script>
 <script src="{{ asset('admin/js/settings.js') }}"></script>
 <script src="{{ asset('admin/js/gleek.js') }}"></script>
 <script src="{{ asset('admin/js/styleSwitcher.js') }}"></script>
 <script src="{{ asset('admin/js/dashboard/dashboard-1.js') }}"></script>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
 <script src="{{ asset('sweetalert/dist/sweetalert2.all.min.js') }}"></script>

 <script>
     document.addEventListener("DOMContentLoaded", function() {

         @if (session('success'))
             Swal.fire({
                 title: "Berhasil!",
                 text: "{{ session('success') }}",
                 icon: "success"
             });
         @endif

         @if (session('error'))
             Swal.fire({
                 title: "Gagal!",
                 text: "{{ session('error') }}",
                 icon: "error"
             });
         @endif

     });
 </script>
 <script>
     document.getElementById("year").textContent = new Date().getFullYear();
 </script>
 <script>
     const rowsPerPage = 3;
     const table = document.getElementById("myTable").getElementsByTagName("tbody")[0];
     const rows = table.getElementsByTagName("tr");

     const prevBtn = document.getElementById("prevBtn");
     const nextBtn = document.getElementById("nextBtn");

     let currentPage = 1;
     const totalPages = Math.ceil(rows.length / rowsPerPage);

     function displayTable(page) {
         let start = (page - 1) * rowsPerPage;
         let end = start + rowsPerPage;

         for (let i = 0; i < rows.length; i++) {
             rows[i].style.display = (i >= start && i < end) ? "" : "none";
         }

         // disable tombol kalau di ujung
         prevBtn.parentElement.classList.toggle("disabled", page === 1);
         nextBtn.parentElement.classList.toggle("disabled", page === totalPages);
     }

     // tombol previous
     prevBtn.addEventListener("click", function(e) {
         e.preventDefault();
         if (currentPage > 1) {
             currentPage--;
             displayTable(currentPage);
         }
     });

     // tombol next
     nextBtn.addEventListener("click", function(e) {
         e.preventDefault();
         if (currentPage < totalPages) {
             currentPage++;
             displayTable(currentPage);
         }
     });

     // init
     displayTable(currentPage);
 </script>
 <script>
     function toggleTheme() {
         const body = document.body;
         const icon = document.getElementById("theme-icon");

         body.classList.toggle("dark-mode");

         if (body.classList.contains("dark-mode")) {
             icon.classList.replace("fa-moon", "fa-sun");
             localStorage.setItem("theme", "dark");
         } else {
             icon.classList.replace("fa-sun", "fa-moon");
             localStorage.setItem("theme", "light");
         }
     }

     // load saat pertama buka
     window.onload = function() {
         const theme = localStorage.getItem("theme");
         const icon = document.getElementById("theme-icon");

         if (theme === "dark") {
             document.body.classList.add("dark-mode");
             icon.classList.replace("fa-moon", "fa-sun");
         }
     };
 </script>

 <!-- Chartjs -->
 <script src="{{ asset('admin/plugins/chart.js/Chart.bundle.min.js') }}"></script>
 <!-- Circle progress -->
 <script src="{{ asset('admin/plugins/circle-progress/circle-progress.min.js') }}"></script>
 <!-- Datamap -->
 <script src="{{ asset('admin/plugins/d3v3/index.js') }}"></script>
 <script src="{{ asset('admin/plugins/topojson/topojson.min.js') }}"></script>
 <script src="{{ asset('admin/plugins/datamaps/datamaps.world.min.js') }}"></script>
 <!-- Morrisjs -->
 <script src="{{ asset('admin/plugins/raphael/raphael.min.js') }}"></script>
 <script src="{{ asset('admin/plugins/morris/morris.min.js') }}"></script>
 <!-- Pignose Calender -->
 <script src="{{ asset('admin/plugins/moment/moment.min.js') }}"></script>
 <script src="{{ asset('admin/plugins/pg-calendar/js/pignose.calendar.min.js') }}"></script>
 <!-- ChartistJS -->
 <script src="{{ asset('admin/plugins/chartist/js/chartist.min.js') }}"></script>
 <script src="{{ asset('admin/plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js') }}"></script>

 <script src="{{ asset('admin/js/plugins-init/chartist.init.js') }}"></script>

 <script src="{{ asset('admin/js/dashboard/dashboard-1.js') }}"></script>
 </body>

 </html>
