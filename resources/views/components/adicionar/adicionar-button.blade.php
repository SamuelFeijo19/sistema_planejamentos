<style>
    .button-container{
        float: right;
        padding-top: 20px;
    }
    @media (max-width: 650px) {
        .button-container {
            float: none;
            padding-top: 10px;
            width: 100%;
        }
        .btn {
            width: 100%;
        }
    }
</style>

@php
    $linkRoute = $attributes->get('link-route') ?? '#';
    $text = $attributes->get('text-button');
@endphp

<div class="button-container d-flex flex-column-reverse justify-content-center">
    <a href="{{ $linkRoute }}" class="btn btn-primary">
        <span class="material-symbols-outlined align-middle">add</span>{{$text}}
    </a>
</div>
