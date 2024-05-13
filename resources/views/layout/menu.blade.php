<li class="nav-item">
    <a href="{{ url('home') }}" class="nav-link">
      <i class="nav-icon far fa-image"></i>
      <p>
        Beranda
      </p>
    </a>
  </li>

  @if ($user->role == 'admin')

  <li class="nav-item">
    <a href="{{ url('klasifikasigunung') }}" class="nav-link">
      <i class="nav-icon far fa-image"></i>
      <p>
      Klasifikasi Gunung
      </p>
    </a>
  </li>
  <li class="nav-item">
    <a href="{{ url('member') }}" class="nav-link">
      <i class="nav-icon far fa-image"></i>
      <p>
      Input Member
      </p>
    </a>
  </li>
  <li class="nav-item">
    <a href="{{ url('transaksi') }}" class="nav-link">
      <i class="nav-icon far fa-image"></i>
      <p>
      Transaksi
      </p>
    </a>
  </li>
  <li class="nav-item">
    <a href="{{ url('gift') }}" class="nav-link">
      <i class="nav-icon far fa-image"></i>
      <p>
      Daftar Gift
      </p>
    </a>
  </li>
  <li class="nav-item">
    <a href="{{ url('klaimpoin') }}" class="nav-link">
      <i class="nav-icon far fa-image"></i>
      <p>
      Klaim Poin
      </p>
    </a>
  </li>
  <li class="nav-item">
    <a href="{{ url('umpanbalik') }}" class="nav-link">
      <i class="nav-icon far fa-image"></i>
      <p>
      Umpan Balik
      </p>
    </a>
  </li>
  <li class="nav-item">
    <a href="{{ url('laporan') }}" class="nav-link">
      <i class="nav-icon far fa-image"></i>
      <p>
      Laporan
      </p>
    </a>
  </li>

  @elseif ($user->role == 'kasir')
  <li class="nav-item">
    <a href="{{ url('produk') }}" class="nav-link">
      <i class="nav-icon far fa-image"></i>
      <p>
        Produk
      </p>
    </a>
  </li>
  <li class="nav-item">
    <a href="{{ url('/kasir/transaksi/tambah') }}" class="nav-link">
      <i class="nav-icon far fa-image"></i>
      <p>
      Input Transaksi
      </p>
    </a>
  </li>
  <li class="nav-item">
    <a href="{{ url('/kasir/transaksi') }}" class="nav-link">
      <i class="nav-icon far fa-image"></i>
      <p>
      History Transaksi
      </p>
    </a>
  </li>
  {{-- @elseif ($user->role == 'member')
  <li class="nav-item">
    <a href="{{ url('klasifikasigunung') }}" class="nav-link">
      <i class="nav-icon far fa-image"></i>
      <p>
      Klasifikasi Gunung
      </p>
    </a>
  </li>
  <li class="nav-item">
    <a href="{{ url('poinloyalitas') }}" class="nav-link">
      <i class="nav-icon far fa-image"></i>
      <p>
      Poin
      </p>
    </a>
  </li>
  <li class="nav-item">
    <a href="{{ url('klaimpoin') }}" class="nav-link">
      <i class="nav-icon far fa-image"></i>
      <p>
      Klaim Poin
      </p>
    </a>
  </li>
  <li class="nav-item">
    <a href="{{ url('umpanbalik') }}" class="nav-link">
      <i class="nav-icon far fa-image"></i>
      <p>
      Umpan Balik
      </p>
    </a>
  </li>
  <li class="nav-item">
    <a href="{{ url('produk') }}" class="nav-link">
      <i class="nav-icon far fa-image"></i>
      <p>
        Produk
      </p>
    </a>
  </li> --}}
  @elseif ($user->role == 'manajer')
  <li class="nav-item">
    <a href="{{ url('laporan') }}" class="nav-link">
      <i class="nav-icon far fa-image"></i>
      <p>
      Laporan
      </p>
    </a>
  </li>
  @endif
