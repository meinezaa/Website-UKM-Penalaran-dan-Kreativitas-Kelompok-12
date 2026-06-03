<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Us - UPN Mengajar</title>

    <link class="text-gray-500" rel="stylesheet" href="{{ asset('css/style.css') }}" />
  </head>

  <body>
    <header>
      <div>
        <img src="{{ asset('foto/logo.jpeg') }}" alt="Logo UPN Mengajar" />
        <h1>UPN Mengajar</h1>
        <p>
          Program Pengabdian Pendidikan UKM Penalaran dan Kreativitas UPN
          Veteran Jawa Timur
        </p>
      </div>

      <nav>
        <ul>
          <li><a href="{{ url('/') }}">Home</a></li>

          <li class="dropdown">
            <a href="#">Tentang Kami</a>
            <ul class="dropdown-menu">
              <li><a href="#">Tentang UPN Mengajar</a></li>
              <li><a href="#">UKM Penalaran & Kreativitas</a></li>
              <li><a href="#">Tim UPN Mengajar</a></li>
              <li><a href="{{ route('kontak') }}">Kontak Kami</a></li>
            </ul>
          </li>

          <li><a href="{{ route('admin.kegiatan') }}">Kegiatan</a></li>
          <li><a href="{{ route('admin.relawan') }}">Relawan</a></li>
        </ul>
      </nav>

      <div>
        <a href="{{ route('admin.dashboard') }}">Login / Dashboard</a>
      </div>
    </header>

    <section id="contact">
      <h2>Kontak Kami</h2>

      <p>
        Jika memiliki pertanyaan mengenai program UPN Mengajar, silakan
        menghubungi kami melalui formulir berikut.
      </p>

      @if(session('sukses'))
        <div style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
            {{ session('sukses') }}
        </div>
      @endif

      <div>
        <article>
          <h3>Formulir Pesan</h3>

          <form action="{{ route('kontak.kirim') }}" method="POST">
            @csrf
            <div>
              <label>Nama Lengkap</label><br />
              <input type="text" name="nama" required value="{{ old('nama') }}" />
            </div>

            <br />

            <div>
              <label>Email</label><br />
              <input type="email" name="email" required value="{{ old('email') }}" />
            </div>

            <br />

            <div>
              <label>Nomor Telepon</label><br />
              <input type="text" name="telepon" required value="{{ old('telepon') }}" />
            </div>

            <br />

            <div>
              <label>Subjek Pesan</label><br />
              <input type="text" name="subjek" required value="{{ old('subjek') }}" />
            </div>

            <br />

            <div>
              <label>Isi Pesan</label><br />
              <textarea name="pesan" rows="5" required>{{ old('pesan') }}</textarea>
            </div>

            <br />

            <button type="submit">Kirim Pesan</button>
          </form>
        </article>

        <br /><br />

        <article>
          <h3>Informasi Kontak</h3>

          <p>
            Jika ingin menghubungi kami secara langsung, silakan melalui kontak
            berikut:
          </p>

          <p>
            <strong>Email :</strong><br />
            <a href="mailto:upnmengajar.jt@gmail.com">
              upnmengajar.jt@gmail.com
            </a>
          </p>

          <p>
            <strong>Instagram :</strong><br />
            <a href="https://instagram.com/upnmengajar.jt" target="_blank"> @upnmengajar.jt </a>
          </p>

          <p>
            <strong>WhatsApp :</strong><br />
            <a href="https://wa.me/6289699808453" target="_blank"> 089699808453 (Nabila) </a>
          </p>
        </article>
      </div>
    </section>

    <footer class="site-footer">
      <div class="footer-container">
        <div class="footer-col about-col">
          <img src="{{ asset('foto/logo.jpeg') }}" alt="Logo UPN Mengajar" /><br />
          <div class="text-placeholder">
            <p>
              UPN Mengajar adalah salah satu program kerja dari UKM Penalaran
              dan Kreativitas UPN Veteran Jawa Timur
            </p>
          </div>
        </div>
        <br />
        <div class="footer-col links-col">
          <a href="{{ url('/') }}">Home</a> <br />
          <a href="#">Tentang</a> <br />
          <a href="{{ route('admin.kegiatan') }}">Kegiatan</a> <br />
          <a href="{{ route('admin.relawan') }}">Relawan</a>
        </div>
        <br />
        <div class="footer-col contact-col">
          <h4>Kontak</h4>
          <p>
            <img src="{{ asset('foto/logo email.jpg') }}" alt="" /><a href="mailto:upnmengajar.jt@gmail.com" class="contact-item">upnmengajar.jt@gmail.com</a>
            &nbsp;|&nbsp;
            <img src="{{ asset('foto/logo instagram.jpg') }}" alt="" /><a href="https://instagram.com/upnmengajar.jt" class="contact-item" target="_blank">@upnmengajar.jt</a>
            &nbsp;|&nbsp;
            <img src="{{ asset('foto/logo wa.jpg') }}" alt="" />
            <a href="https://wa.me/6289699808453" class="contact-item" target="_blank">089699808453 (Nabila)</a>
          </p>
        </div>
      </div>
      <div class="footer-bottom">
        <p>
          &copy; {{ date('Y') }} | UPN Mengajar — UKM Penalaran & Kreativitas UPN "Veteran" Jatim
        </p>
      </div>
    </footer>
  </body>
</html>