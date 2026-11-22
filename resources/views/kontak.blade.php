@extends('layout')
@section('c')
<h1>Contact Us</h1>
<div class="c"><h3>Alamat</h3><p>{{ $p->alamat ?? '' }}</p>
@if(!empty($p->whatsapp))<p>Nomor kontak / WhatsApp: <a href="https://wa.me/{{ preg_replace('/\D/','',$p->whatsapp) }}" target="_blank">{{ $p->whatsapp }}</a></p>@endif
<p>@foreach(['instagram','facebook','tiktok'] as $s)@if(!empty($p->$s))<a class="btn o" href="{{ $p->$s }}" target="_blank">{{ ucfirst($s) }}</a> @endif @endforeach</p>
@if(!empty($p->link_maps))@if(str_contains($p->link_maps,'/embed'))<iframe src="{{ $p->link_maps }}" width="100%" height="320" style="border:0;border-radius:10px" loading="lazy"></iframe>@else<p><a class="btn" href="{{ $p->link_maps }}" target="_blank">Buka peta lokasi</a></p>@endif @endif</div>
@endsection
