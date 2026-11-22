<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>BiteSavr: Selamatkan Makanan, Hemat Uangmu</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;700;800&family=Inter:wght@400;500&display=swap" rel="stylesheet">
<style>
:root{--g:#2E9E5B;--gd:#1B5E3A;--o:#FF8A1F;--bg:#F4FAF5;--card:#fff;--tx:#12301F;--mu:#4d6a58;--bd:#d5e6da;box-sizing:border-box;padding-top:env(safe-area-inset-top,0px);padding-bottom:env(safe-area-inset-bottom,0px)}
@media (prefers-color-scheme:dark){:root:not([data-theme="light"]){--bg:#0F1A14;--card:#17271e;--tx:#e6f3ea;--mu:#9bb8a6;--bd:#27402f}}
:root[data-theme="dark"]{--bg:#0F1A14;--card:#17271e;--tx:#e6f3ea;--mu:#9bb8a6;--bd:#27402f}
*{box-sizing:border-box;margin:0}
html{scroll-padding-top:env(safe-area-inset-top,0px);scroll-behavior:smooth}
body{background:var(--bg);color:var(--tx);font:400 16px/1.55 Inter,system-ui,sans-serif;overflow-x:hidden}
h1,h2,h3,.logo{font-family:Poppins,system-ui,sans-serif;line-height:1.1}
nav{position:fixed;top:env(safe-area-inset-top,0px);left:0;right:0;z-index:30;display:flex;align-items:center;justify-content:space-between;padding:12px 20px;background:#0000;transition:background .4s}
nav.sc{background:var(--bg);border-bottom:1px solid var(--bd)}
.logo{font-weight:800;font-size:21px;color:#fff;transition:color .4s}
.logo b{color:var(--o)}
nav.sc .logo{color:var(--g)}
#bar{position:fixed;top:0;left:0;height:4px;width:0;background:var(--o);z-index:40}
.nav-right{display:flex;align-items:center;gap:10px}
.wrap{max-width:1040px;margin:auto;padding:0 20px}
.btn{display:inline-block;background:var(--o);color:#1b1000;font:700 15px Poppins;padding:12px 22px;border-radius:99px;border:0;cursor:pointer;text-decoration:none;transition:transform .2s}
.btn:hover{transform:translateY(-2px) scale(1.04)}
.btn.g{background:var(--g);color:#fff}
.btn.ghost{background:transparent;border:2px solid #fff;color:#fff}
nav.sc .btn.ghost{border-color:var(--g);color:var(--g)}
/* Auth badge */
.auth-badge{display:flex;align-items:center;gap:8px;font-size:14px;color:#fff}
nav.sc .auth-badge{color:var(--tx)}
.auth-badge img{width:30px;height:30px;border-radius:50%;border:2px solid var(--o)}
#bagstory{height:260vh;position:relative}
.bs-stage{position:sticky;top:0;height:100vh;height:100svh;overflow:hidden;background:#1c1c1c;display:grid;place-items:center}
.bs-head{position:absolute;top:calc(env(safe-area-inset-top,0px) + 76px);left:0;right:0;text-align:center;padding:0 20px;z-index:3}
#t0{color:#eee;font:800 clamp(24px,4.6vw,44px)/1.15 Poppins,sans-serif;max-width:640px;margin:auto}
#t1{position:absolute;top:0;left:0;right:0;opacity:0}
#t1 small{display:block;font:800 clamp(22px,4vw,38px)/1.1 Poppins,sans-serif;color:var(--gd)}
#t1 big{display:block;font:800 clamp(46px,9vw,92px)/1 Poppins,sans-serif;color:var(--o)}
#bag{position:relative;width:min(300px,60vw);aspect-ratio:300/340;margin-top:14vh;z-index:2;will-change:transform,filter}
#bag svg{position:relative;z-index:2;width:100%;display:block}
.its{position:absolute;inset:0;z-index:1}
.it{position:absolute;top:0;font-size:clamp(44px,9vw,64px);line-height:1;will-change:transform}
.bn{position:absolute;display:flex;flex-direction:column;gap:8px;width:min(260px,26vw);color:var(--gd);font:800 clamp(15px,1.8vw,20px)/1.25 Poppins,sans-serif;opacity:0;transition:opacity .6s,transform .6s;z-index:3}
.bn i{font-style:normal;font-size:32px}
.bn.l{left:3%;text-align:right;align-items:flex-end;transform:translateX(-30px)}
.bn.r{right:3%;text-align:left;align-items:flex-start;transform:translateX(30px)}
.bn.on{opacity:1;transform:none}
.y1{top:34%}.y2{top:60%}
.bs-hint{position:absolute;bottom:3vh;left:50%;transform:translateX(-50%);font-size:13px;color:#eee;opacity:.75;animation:hn 1.6s infinite;z-index:3}
@keyframes hn{50%{transform:translate(-50%,8px)}}
@media(max-width:720px){#bag{width:min(250px,58vw);margin-top:4vh}.bn.l,.bn.r{left:50%;right:auto;top:auto;bottom:6vh;width:min(86vw,360px);align-items:center;text-align:center;transform:translate(-50%,16px)}.bn.l.on,.bn.r.on{transform:translate(-50%,0)}.bn:not(.act){opacity:0!important}}
.hA{background:linear-gradient(160deg,var(--gd),var(--g));color:#fff;padding:90px 0 44px;overflow:hidden;min-height:calc(100vh - 44px);min-height:calc(100svh - 44px);display:flex;align-items:center}.hA .wrap{width:100%}
.hA .wrap{display:grid;grid-template-columns:1.1fr .9fr;gap:24px;align-items:center}
.hA h1{font-size:clamp(32px,5.6vw,56px);font-weight:800}
.hA p{margin:14px 0 22px;max-width:46ch;opacity:.92}
.big{font:800 clamp(64px,12vw,112px)/1 Poppins;color:var(--o);margin-top:10px}
.float{position:relative;height:clamp(290px,42vh,420px)}
.float span{position:absolute;font-size:72px;animation:fl 4s ease-in-out infinite;filter:drop-shadow(0 12px 14px #0004)}
.float span:nth-child(1){left:8%;top:10%}.float span:nth-child(2){left:52%;top:0;animation-delay:-1s}.float span:nth-child(3){left:30%;top:42%;font-size:96px;animation-delay:-2s}.float span:nth-child(4){left:68%;top:52%;animation-delay:-3s}
@keyframes fl{50%{transform:translateY(-18px) rotate(6deg)}}
.mq{background:var(--o);color:#1b1000;overflow:hidden;white-space:nowrap;font:700 15px Poppins;padding:10px 0}
.mq div{display:inline-block;animation:mq 24s linear infinite}
@keyframes mq{to{transform:translateX(-50%)}}
.sec{padding:52px 0}
.sec h2{font-size:clamp(26px,4vw,38px);margin-bottom:22px}
.deals{display:grid;grid-template-columns:repeat(auto-fit,minmax(210px,1fr));gap:16px}
.deal{background:var(--card);border:1px solid var(--bd);border-radius:18px;padding:18px;transition:transform .25s,box-shadow .25s}
.deal:hover{transform:translateY(-6px);box-shadow:0 14px 28px #0002}
.deal .em{font-size:52px}.deal small{color:var(--mu)}
.tag{display:inline-block;background:var(--o);color:#1b1000;font:700 12px Poppins;padding:3px 10px;border-radius:99px}
.price s{color:var(--mu);font-size:14px}.price b{font:700 20px Poppins;color:var(--g);margin-left:6px}
.timer{font:700 17px Poppins;color:#d4380d;margin:6px 0}
.low{font-size:13px;color:#c45f00;font-weight:500}
.steps{display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:14px;counter-reset:s}
.steps div{background:var(--card);border:1px solid var(--bd);border-radius:16px;padding:18px;opacity:0;transform:translateY(20px);transition:.6s}
.steps div.in{opacity:1;transform:none}
.steps div::before{counter-increment:s;content:counter(s);display:grid;place-items:center;width:34px;height:34px;border-radius:50%;background:var(--g);color:#fff;font:700 15px Poppins;margin-bottom:10px}
.imp{background:var(--gd);color:#fff;padding:40px 0}
.imp .wrap{display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:20px;text-align:center}
.imp b{display:block;font:800 38px Poppins;color:var(--o)}
.dist{display:flex;gap:10px;flex-wrap:wrap}
.dist span{background:var(--card);border:1px solid var(--bd);border-radius:99px;padding:8px 14px;font-size:14px}
.map{position:relative;background:var(--card);border:1px solid var(--bd);border-radius:20px;height:380px;overflow:hidden;margin:22px 0;color:var(--tx)}
.map svg{position:absolute;inset:0;width:100%;height:100%}
.pin{position:absolute;transform:translate(-50%,-100%);font-size:34px;background:none;border:0;cursor:pointer;opacity:0;transition:transform .2s}
.map.in .pin{animation:pn .5s forwards}
.pin:hover{transform:translate(-50%,-110%) scale(1.2)}
@keyframes pn{from{opacity:0;margin-top:-30px}to{opacity:1}}
.pc{position:absolute;left:14px;bottom:14px;background:var(--bg);border:1px solid var(--bd);border-radius:14px;padding:14px 16px;max-width:260px;box-shadow:0 8px 20px #0003}
footer{background:#0c1f15;color:#bfd8c8;padding:34px 0;font-size:14px}
footer .wrap{display:flex;justify-content:space-between;gap:16px;flex-wrap:wrap}
footer .logo{color:var(--g)}
.note{font-size:13px;color:var(--mu);text-align:center;padding:10px 20px}
@media(max-width:720px){.hA .wrap{grid-template-columns:1fr}.float{height:190px}}
@media(prefers-reduced-motion:reduce){*{animation:none!important;transition:none!important;scroll-behavior:auto}.steps div,.story>div{opacity:1;transform:none}.pin{opacity:1}}
</style>
</head>
<body>
<div id="bar"></div>
<nav id="nav">
    <span class="logo">Bite<b>Savr</b></span>
    <div class="nav-right">
        @auth
            <a class="btn ghost" href="{{ route('katalog') }}" style="font-size:13px;padding:9px 18px">Katalog</a>
            @if(auth()->user()->isAdmin())
                <a class="btn g" href="{{ route('admin.dashboard') }}" style="font-size:13px;padding:9px 18px">Panel Admin</a>
            @elseif(auth()->user()->isMitra())
                <a class="btn g" href="{{ route('mitra.dashboard') }}" style="font-size:13px;padding:9px 18px">Dashboard Mitra</a>
            @else
                <a class="btn g" href="{{ route('pesanan.index') }}" style="font-size:13px;padding:9px 18px">Pesanan Saya</a>
            @endif
            <div class="auth-badge">
                @if(auth()->user()->avatar)
                    <img src="{{ auth()->user()->avatar }}" alt="avatar">
                @endif
                {{ auth()->user()->display_name }}
            </div>
            <form method="POST" action="{{ route('logout') }}" style="display:inline">
                @csrf
                <button type="submit" class="btn ghost" style="font-size:13px;padding:9px 16px">Keluar</button>
            </form>
        @else
            <a class="btn g" href="{{ route('katalog') }}" style="font-size:13px;padding:9px 18px">Lihat Katalog</a>
            <a class="btn" href="{{ route('login') }}" style="font-size:13px;padding:9px 18px">Masuk</a>
        @endauth
    </div>
</nav>

<!-- HERO -->
<header class="hA"><div class="wrap">
<div>
    <h1>Makanan enak, harga hemat, zero waste.</h1>
    <div class="big"><span class="cnt" data-to="70">0</span>%</div>
    <p>Diskon hingga 70% dari hotel dan restoran Pekanbaru. Bayar di aplikasi, ambil langsung di kasir.</p>
    <a class="btn" href="{{ route('katalog') }}">Lihat deal hari ini</a>
    @guest
    <a class="btn g" href="{{ route('auth.google') }}" style="margin-left:8px">Daftar dengan Google</a>
    @endguest
</div>
<div class="float" aria-hidden="true"><span>🍱</span><span>🥐</span><span>🍛</span><span>🍰</span></div>
</div></header>

<div class="mq" aria-hidden="true"><div>🍚 Nasi &nbsp;&nbsp; 🍞 Roti &nbsp;&nbsp; ☕ Kopi &nbsp;&nbsp; 🍤 Seafood &nbsp;&nbsp; 🍰 Kue &nbsp;&nbsp; 🍜 Mie &nbsp;&nbsp; 🥗 Salad &nbsp;&nbsp; 🍚 Nasi &nbsp;&nbsp; 🍞 Roti &nbsp;&nbsp; ☕ Kopi &nbsp;&nbsp; 🍤 Seafood &nbsp;&nbsp; 🍰 Kue &nbsp;&nbsp; 🍜 Mie &nbsp;&nbsp; 🥗 Salad &nbsp;&nbsp;</div></div>

<!-- BAGIAN 2: Kantong belanja (scroll-linked) -->
<section id="bagstory"><div class="bs-stage">
<div class="bs-head"><h2 id="t0">Setiap hari, makanan layak makan hampir terbuang.</h2><div id="t1"><small>Kenapa pakai</small><big>BiteSavr?</big></div></div>
<div class="bn l y1"><i>🏷️</i>Makanan enak dengan harga hemat hingga 70%</div>
<div class="bn r y1"><i>📍</i>Selamatkan makanan dari resto dan hotel terdekat</div>
<div class="bn l y2"><i>🌍</i>Bantu bumi dengan mengurangi sampah makanan</div>
<div class="bn r y2"><i>🏪</i>Coba menu baru dari mitra lokal Pekanbaru</div>
<div id="bag">
<div class="its" aria-hidden="true"><span class="it" style="left:11%">🥛</span><span class="it" style="left:29%">🥦</span><span class="it" style="left:47%">🫑</span><span class="it" style="left:64%">🥖</span></div>
<svg viewBox="0 0 300 340" role="img" aria-label="Kantong belanja BiteSavr"><defs><linearGradient id="bgr" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#2E9E5B"/><stop offset="1" stop-color="#1B5E3A"/></linearGradient></defs>
<path d="M28 62L272 62L288 326Q150 342 12 326Z" fill="url(#bgr)"/><path d="M28 62L272 62L268 92Q150 104 32 92Z" fill="#fff" opacity=".14"/>
<path d="M60 140L110 190L90 250M230 120L200 200L240 280M120 280L170 300" stroke="#fff" stroke-opacity=".13" stroke-width="3" fill="none"/>
<g fill="none" stroke="#e6efe9" stroke-width="7" stroke-linecap="round"><ellipse cx="135" cy="205" rx="34" ry="46" transform="rotate(-12 135 205)"/><ellipse cx="170" cy="200" rx="30" ry="42" transform="rotate(14 170 200)"/></g>
<text x="150" y="288" text-anchor="middle" font-family="Poppins,sans-serif" font-weight="800" font-size="30" fill="#e6efe9">BiteSavr</text></svg>
</div>
<span class="bs-hint" id="hint">Scroll untuk lanjut ↓</span>
</div></section>

<!-- BAGIAN 3: Deal, cara kerja, dampak -->
<section class="sec" id="deal"><div class="wrap">
<h2>Deal yang segera berakhir</h2>
<div class="deals">
@forelse($featuredProducts as $p)
<article class="deal">
    <div class="em">🍛</div>
    <h3>{{ $p->nama_produk }}</h3>
    <small>{{ $p->mitraProfile?->nama_usaha }}</small>
    <div class="timer" data-end="{{ $p->batas_waktu_konsumsi?->timestamp }}">--</div>
    <div class="price"><s>Rp{{ number_format($p->harga_asli,0,',','.') }}</s><b>Rp{{ number_format($p->harga_diskon,0,',','.') }}</b></div>
    <span class="tag">-{{ $p->diskon_persen }}%</span>
    <span class="low">Sisa {{ $p->stok }} porsi</span>
</article>
@empty
<article class="deal"><div class="em">🍛</div><h3>Nasi Rendang Set</h3><small>Resto Padang Sederhana</small><div class="timer" data-s="9240">--</div><div class="price"><s>Rp45.000</s><b>Rp15.000</b></div><span class="tag">-67%</span> <span class="low">Sisa 3 porsi</span></article>
<article class="deal"><div class="em">🥐</div><h3>Paket Pastry 4 pcs</h3><small>Hotel Pekanbaru Bakery</small><div class="timer" data-s="5400">--</div><div class="price"><s>Rp60.000</s><b>Rp24.000</b></div><span class="tag">-60%</span> <span class="low">Sisa 5 porsi</span></article>
<article class="deal"><div class="em">🍤</div><h3>Udang Saus Padang</h3><small>Seafood Riau Bahari</small><div class="timer" data-s="3000">--</div><div class="price"><s>Rp80.000</s><b>Rp32.000</b></div><span class="tag">-60%</span> <span class="low">Sisa 2 porsi</span></article>
@endforelse
</div></div></section>

<section class="sec" style="padding-top:0"><div class="wrap">
<h2>Cara kerjanya</h2>
<div class="steps"><div><h3>Temukan</h3><p>Pilih makanan surplus terdekat.</p></div><div><h3>Bayar</h3><p>Bayar digital, struk langsung terbit.</p></div><div><h3>Tunjukkan QR</h3><p>Kasir memindai QR struk kamu.</p></div><div><h3>Ambil</h3><p>Bawa pulang, nikmati sebelum waktu habis.</p></div></div>
</div></section>

<section class="imp"><div class="wrap">
<div><b><span class="cnt" data-to="12840">0</span></b>porsi terselamatkan</div>
<div><b><span class="cnt" data-to="3210">0</span> kg</b>makanan tidak terbuang</div>
<div><b>Rp<span class="cnt" data-to="190">0</span> jt</b>dihemat mahasiswa</div>
</div></section>

<section class="sec"><div class="wrap">
<h2>Mitra BiteSavr di Pekanbaru</h2>
<div class="dist"><span>3 mitra dalam radius 2 km</span><span>7 mitra dalam radius 5 km</span></div>
<div class="map" id="map">
<svg viewBox="0 0 600 360" preserveAspectRatio="none" aria-hidden="true"><path d="M0 250 C120 210 200 290 330 240 S520 190 600 220 L600 360 L0 360Z" fill="#2E9E5B22"/><path d="M0 250 C120 210 200 290 330 240 S520 190 600 220" fill="none" stroke="#2E9E5B" stroke-width="4"/><path d="M40 60H560M40 140H560M120 20V340M300 20V340M470 20V340" stroke="currentColor" stroke-opacity=".12" stroke-width="2"/></svg>
<button class="pin" style="left:20%;top:38%;animation-delay:.2s" data-i="0" aria-label="Padang Sederhana">📍</button>
<button class="pin" style="left:50%;top:30%;animation-delay:.5s" data-i="1" aria-label="Hotel Bakery">📍</button>
<button class="pin" style="left:75%;top:55%;animation-delay:.8s" data-i="2" aria-label="Seafood Bahari">📍</button>
<button class="pin" style="left:38%;top:68%;animation-delay:1.1s" data-i="3" aria-label="Kafe Senja">📍</button>
<div class="pc" id="pc"><b>Pilih pin di peta</b><br><small>Lihat diskon dan sisa waktunya.</small></div>
</div>
<a class="btn g" href="{{ route('katalog') }}">Buka semua deal</a>
</div></section>

<footer><div class="wrap">
<div><span class="logo">Bite<b style="color:var(--o)">Savr</b></span><p>Marketplace makanan surplus Pekanbaru.</p></div>
<div>
    <p>Untuk mitra hotel dan restoran</p>
    <p><a href="{{ route('login') }}" style="color:var(--o)">Login Mitra / Admin</a> · Syarat &amp; Ketentuan</p>
</div>
</div></footer>

<script>
const $=(s,r=document)=>r.querySelector(s),$$=(s,r=document)=>[...r.querySelectorAll(s)];
addEventListener('scroll',()=>{const h=document.documentElement;$('#bar').style.width=(scrollY/(h.scrollHeight-innerHeight)*100)+'%';$('#nav').classList.toggle('sc',scrollY>40)},{passive:true});
function count(root){$$('.cnt',root).forEach(e=>{const to=+e.dataset.to,t0=performance.now();(function f(t){const k=Math.min((t-t0)/1600,1);e.textContent=Math.round(to*(1-Math.pow(1-k,3))).toLocaleString('id-ID');if(k<1)requestAnimationFrame(f)})(t0)})}
// Countdown - support both data-s (seconds) and data-end (unix timestamp)
const tm=$$('.timer');setInterval(()=>tm.forEach(e=>{let s;if(e.dataset.end){s=Math.max(0,Math.round(+e.dataset.end-Date.now()/1000))}else{s=+e.dataset.s;if(s>0)e.dataset.s=--s}const p=n=>String(n).padStart(2,'0');e.textContent='⏱ '+p(s/3600|0)+':'+p(s%3600/60|0)+':'+p(s%60)}),1000);
const io=new IntersectionObserver(es=>es.forEach(e=>{if(!e.isIntersecting)return;e.target.classList.add('in');if(e.target.matches('.hA,.imp'))count(e.target);io.unobserve(e.target)}),{threshold:.35});
$$('.story,.steps div,.map,.hA,.imp').forEach(e=>io.observe(e));
const bs=$('#bagstory'),stg=$('.bs-stage'),bag=$('#bag'),its=$$('.it'),bns=$$('.bn'),t0=$('#t0'),t1=$('#t1'),hint=$('#hint');
const cl=(x,a,b)=>Math.min(1,Math.max(0,(x-a)/(b-a))),ez=x=>1-Math.pow(1-x,3),mx=(a,b,k)=>Math.round(a+(b-a)*k);
const tilt=[-10,-4,5,9],th=[.35,.5,.65,.8];
function upd(){
 const r=bs.getBoundingClientRect(),p=cl(-r.top,0,r.height-innerHeight),c=ez(cl(p,.1,.3));
 stg.style.background='rgb('+mx(28,244,c)+','+mx(28,250,c)+','+mx(28,245,c)+')';
 t0.style.opacity=1-cl(p,.08,.18);t1.style.opacity=cl(p,.16,.28);hint.style.opacity=.75*(1-cl(p,0,.06));
 const e=ez(cl(p,0,.3));
 bag.style.transform='translateY('+((1-e)*38)+'vh) scale('+(.8+.25*e)+') rotate('+(Math.sin(p*Math.PI*6)*2.5*c)+'deg)';
 bag.style.filter='grayscale('+(1-c)+') brightness('+(.7+.3*c)+')';
 its.forEach((el,i)=>{const k=ez(cl(p,.15+i*.07,.32+i*.07));el.style.transform='translateY('+((1-k)*90)+'px) rotate('+(tilt[i]*k)+'deg)'});
 let last=-1;bns.forEach((b,i)=>{const on=p>=th[i];b.classList.toggle('on',on);if(on)last=i});
 bns.forEach((b,i)=>b.classList.toggle('act',i===last));
}
addEventListener('scroll',upd,{passive:true});addEventListener('resize',upd);upd();
const pins=[['Resto Padang Sederhana','Nasi Rendang Set','-67%','1,2 km'],['Hotel Pekanbaru Bakery','Paket Pastry','-60%','1,8 km'],['Seafood Riau Bahari','Udang Saus Padang','-60%','3,4 km'],['Kafe Senja','Roti Bakar & Kopi','-55%','2,0 km']];
$$('.pin').forEach(p=>p.onclick=()=>{const d=pins[p.dataset.i];$('#pc').innerHTML='<b>'+d[0]+'</b><br>'+d[1]+' <span class="tag">'+d[2]+'</span><br><small>Jarak '+d[3]+'</small>'});
</script>
</body>
</html>
