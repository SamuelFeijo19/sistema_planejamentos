<style>
    .btn-toggle {
        position: relative;
        padding: 0;
    }

    .texts {
        background: #2f51b2;
        width: 60px;
        height: 32px;
        border-radius: 20px;
        border: 1px solid #ccc;
        padding: 3px;
    }

    .btn-toggle .handle {
        position: absolute;
        top: 2px;
        left: 2px;
        width: 28px;
        height: 28px;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 100px;
        transition: transform 0.3s;
    }

    .btn-toggle.active .handle {
        transform: translateX(26px);
    }
</style>

@php
    $linkRoute = $attributes->get('link-route') ?? '#';
@endphp

<a href="{{ $linkRoute }}" class="btn-toggle {{ session('mostrarApenasMeuQuadro') ? 'active' : '' }}">
    <span class="handle"></span>
    <div class="texts">
        <span class="text-on text-white">On</span>
        <span class="text-off text-white">Off</span>
    </div>
    <h6 class="text-white mt-1 font-weight-bold";">Mostrar apenas meu quadro</h6>
</a>
