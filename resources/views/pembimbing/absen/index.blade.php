@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
  <div class="row">
    <!-- Sidebar Info -->
    <div class="col-md-3">
      <div class="card p-3 shadow-sm">
        <h5 class="fw-bold mb-3">Detail Absensi</h5>

        <!-- Info Box -->
        <div id="infoBox" class="alert alert-secondary small">
          Klik tanggal di kalender untuk melihat daftar siswa yang absen.
        </div>

        <!-- Detail Absensi -->
        <div id="absenDetail" class="mt-3 d-none">
          <div class="card bg-light border-0 shadow-sm">
            <div class="card-body">
              <h6 class="fw-bold mb-2 text-secondary">Tanggal:</h6>
              <p id="detailTanggal" class="mb-3"></p>

              <h6 class="fw-bold mb-2 text-secondary">Daftar Siswa:</h6>
              <ul id="daftarSiswa" class="list-group small"></ul>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Calendar -->
    <div class="col-md-9">
      <div class="card p-3 shadow-sm">
        <div id="calendar"></div>
      </div>
    </div>
  </div>
</div>

<!-- FullCalendar -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

<script>
  $.ajaxSetup({
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
  });

  document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendar');
    const calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      locale: 'id',
      selectable: true,
      events: @json($events),

      dateClick: function (info) {
        const tanggal = info.dateStr;

        // Reset tampilan
        $('#infoBox').addClass('d-none');
        $('#absenDetail').addClass('d-none');
        $('#daftarSiswa').empty();

        // Fetch data absensi siswa per tanggal
        $.get("{{ route('pembimbing.absen.by-date') }}", { tanggal: tanggal })
          .done(function (data) {
            if (data.length > 0) {
              $('#absenDetail').removeClass('d-none');
              $('#detailTanggal').text(tanggal);

              data.forEach(item => {
                const listItem = `
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>${item.nama}</span>
                    <span class="badge 
                      ${item.status === 'hadir' ? 'bg-success' :
                        item.status === 'izin' ? 'bg-warning' :
                        item.status === 'sakit' ? 'bg-info' : 'bg-danger'}">
                      ${item.status}
                    </span>
                  </li>`;
                $('#daftarSiswa').append(listItem);
              });
            } else {
              $('#infoBox').removeClass('d-none').text('Tidak ada absensi di tanggal ini.');
            }
          })
          .fail(function (xhr, status, error) {
            console.error("AJAX gagal:", status, error);
            console.log("Response text:", xhr.responseText);
            $('#infoBox').removeClass('d-none').text('Terjadi kesalahan saat memuat data.');
          });
      }
    });

    calendar.render();
  });
</script>
@endsection
