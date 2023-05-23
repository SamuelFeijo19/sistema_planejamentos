<style>
    .search_box{
        background-color: rgb(239, 241, 243);
        height: 38px;
        width: 310px;
        border-radius: 10px;
        color: rgba(0,0,0,1.00);
    }

    .search_btn{
        background: #4e73df;
        border-radius: 7px;
        border: none;
        color: white;
        float: right;
        text-decoration: none;
        width: 40px;
        height: 37px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .search_txt{
        border: none;
        background: none;
        outline: none;
        float: left;
        padding: auto;
        padding-left: 10px;
        color: rgb(0, 0, 0);
        font-size: 16px;
        line-height: 40px;
        width: 240px;
    }

    form{
        padding-bottom: 20px;
        padding-top: 20px;
    }
</style>

@php
    $formAction = $attributes->get('form-action') ?? '#';
@endphp

<form action="{{$formAction}}" method="GET">
    <div class="form-group">
        <div class="search_box">
            <button class="search_btn" type="submit">
                <i class="fa fa-search" aria-hidden="true"></i>
            </button>
            <input class="search_txt" type="text" name="search" placeholder="{{$attributes->get('placeholder')}}">
        </div>
    </div>
</form>


