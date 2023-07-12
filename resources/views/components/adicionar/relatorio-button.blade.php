<style>

    .btn-style{
        padding-bottom: 20px;
        padding-top: 20px;
    }

    @media (max-width: 650px) {
        .btn-style {
            width: 100%;
        }
    }
</style>

@php
    $linkRoute = $attributes->get('link-route') ?? '#';
@endphp

<div class="btn-style">
    <a href="{{$linkRoute}}" class="btn btn-primary shadow"><i
            class="fa fa-line-chart fa-sm text-white"></i> Relatório</a>
</div>


